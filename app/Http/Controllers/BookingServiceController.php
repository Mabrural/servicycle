<?php

namespace App\Http\Controllers;

use App\Mail\BookingStatusMail;
use App\Models\BookingService;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingServiceController extends Controller
{
    // Tampilkan semua booking (bisa disesuaikan per role)

    // public function index()
    // {
    //     $workshop = Workshop::where('created_by', Auth::id())->first();

    //     $bookings = BookingService::with(['creator', 'workshop', 'vehicle'])
    //         ->where('workshop_id', $workshop->id ?? null)
    //         ->latest()
    //         ->get();

    //     return view('booking.workshop.index', compact('bookings'));
    // }
    public function index(Request $request)
    {
        $workshop = Workshop::where('created_by', Auth::id())->first();

        $query = BookingService::with(['creator', 'workshop', 'vehicle'])
            ->where('workshop_id', $workshop->id ?? null);

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $query->where(function ($q) use ($request) {
                match ($request->periode) {
                    'bulan_ini' => $q->whereMonth('booking_date', now()->month)
                        ->whereYear('booking_date', now()->year),
                    '3_bulan_terakhir' => $q->where('booking_date', '>=', now()->subMonths(3)),
                    '6_bulan_terakhir' => $q->where('booking_date', '>=', now()->subMonths(6)),
                    'tahun_ini' => $q->whereYear('booking_date', now()->year),
                    default => null,
                };
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('creator', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                })
                    ->orWhereHas('vehicle', function ($q) use ($searchTerm) {
                        $q->where('license_plate', 'like', "%{$searchTerm}%")
                            ->orWhere('brand', 'like', "%{$searchTerm}%")
                            ->orWhere('model', 'like', "%{$searchTerm}%");
                    });
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        // Untuk menjaga filter saat refresh
        $filters = $request->only(['periode', 'status', 'search']);

        return view('booking.workshop.index', compact('bookings', 'filters'));
    }

    // function untuk menampilkan history servis by user
    public function historyService(Request $request)
    {
        $query = BookingService::with(['workshop', 'vehicle'])
            ->where('created_by', Auth::id());

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $query->where(function ($q) use ($request) {
                match ($request->periode) {
                    'bulan_ini' => $q->whereMonth('booking_date', now()->month)
                        ->whereYear('booking_date', now()->year),
                    '3_bulan_terakhir' => $q->where('booking_date', '>=', now()->subMonths(3)),
                    '6_bulan_terakhir' => $q->where('booking_date', '>=', now()->subMonths(6)),
                    'tahun_ini' => $q->whereYear('booking_date', now()->year),
                    default => null,
                };
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian kendaraan/plat
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('vehicle', function ($q) use ($searchTerm) {
                $q->where('license_plate', 'like', "%{$searchTerm}%")
                    ->orWhere('brand', 'like', "%{$searchTerm}%")
                    ->orWhere('model', 'like', "%{$searchTerm}%");
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        // Untuk menjaga filter saat refresh
        $filters = $request->only(['periode', 'status', 'search']);

        return view('history.index', compact('bookings', 'filters'));
    }

    // update status servis dari aplikasi
    public function updateStatus(Request $request, $id)
    {
        $booking = BookingService::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        // Kirim email ke user yang melakukan booking
        if ($booking->creator && $booking->creator->email) {
            Mail::to($booking->creator->email)->send(new BookingStatusMail($booking));
        }

        return back()->with('success', 'Status booking berhasil diperbarui dan email notifikasi telah dikirim.');
    }

    // Tampilkan detail booking
    public function show(BookingService $bookingService)
    {
        // Eager load relationships
        $bookingService->load(['creator', 'workshop', 'vehicle']);

        return view('history.show', compact('bookingService'));
    }

    // untuk jalur update status dari email
    public function updateStatusFromEmail($id, $status)
    {
        // Pastikan status yang dikirim valid
        $allowedStatuses = ['diterima', 'ditolak'];

        if (!in_array($status, $allowedStatuses)) {
            return redirect()->route('workshop.booking')
                ->with('error', 'Status tidak valid.');
        }

        $booking = BookingService::findOrFail($id);

        // Cek jika status yang dikirim sama dengan status yang ada di database
        if ($booking->status === $status) {
            return redirect()->route('workshop.booking')
                ->with('info', 'Anda sudah pernah ' . ($status === 'diterima' ? 'menerima' : 'menolak') . ' servis ini.');
        }

        // Update status
        $booking->status = $status;
        $booking->save();

        // Kirim email ke user yang melakukan booking
        if ($booking->creator && $booking->creator->email) {
            Mail::to($booking->creator->email)->send(new BookingStatusMail($booking));
        }

        return redirect()->route('workshop.booking')
            ->with('success', "Booking berhasil $status.");
    }

    public function verifyFromEmail($id)
    {
        $booking = BookingService::with(['creator', 'vehicle', 'workshop'])->findOrFail($id);

        return view('booking.verify-from-email', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = BookingService::findOrFail($id);

        // Cegah pembatalan jika status bukan menunggu konfirmasi
        if ($booking->status !== 'menunggu_konfirmasi') {
            return redirect()->back()->with('error', 'Servis ini tidak dapat dibatalkan.');
        }

        // Update status
        $booking->update([
            'status' => 'dibatalkan',
        ]);

        return redirect()->back()->with('success', 'Servis berhasil dibatalkan.');
    }
}
