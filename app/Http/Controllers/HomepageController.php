<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use App\Models\Vehicle;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomepageController extends Controller
{
    public function index()
    {
        $workshops = Workshop::select('id', 'name', 'city', 'address', 'latitude', 'longitude')->get();
        return view('homepage.index', compact('workshops'));
    }

    public function getWorkshopDetails($id)
    {
        $workshop = Workshop::findOrFail($id);

        return view('homepage.show-workshop', compact('workshop'));
    }

    public function bookingService($id)
    {
        // Ambil data bengkel berdasarkan ID
        $workshop = Workshop::findOrFail($id);

        // Ambil semua kendaraan milik user yang sedang login
        $vehicles = Vehicle::where('created_by', Auth::id())->get();

        // Kirim data ke view
        return view('homepage.booking', compact('workshop', 'vehicles'));
    }

    // function untuk menyimpan data booking servis
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'workshop_id' => 'required|exists:workshops,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'booking_date' => 'required|date_format:d-m-Y',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            // Debug data yang diterima
            Log::info('Booking data received:', $validated);

            // Format tanggal dari d-m-Y ke Y-m-d H:i:s
            // Tambahkan waktu default (09:00:00) jika hanya tanggal saja
            $bookingDate = \Carbon\Carbon::createFromFormat('d-m-Y', $validated['booking_date'])
                ->setTime(9, 0, 0) // Set waktu default ke 09:00:00
                ->format('Y-m-d H:i:s');

            Log::info('Formatted booking date:', ['formatted' => $bookingDate]);

            // Pastikan vehicle milik user yang login
            $vehicle = Vehicle::where('id', $validated['vehicle_id'])
                ->where('created_by', Auth::id())
                ->first();

            if (!$vehicle) {
                return redirect()->back()
                    ->with('error', 'Kendaraan tidak ditemukan atau tidak memiliki akses')
                    ->withInput();
            }

            // Buat booking
            $booking = BookingService::create([
                'created_by' => Auth::id(),
                'workshop_id' => $validated['workshop_id'],
                'vehicle_id' => $validated['vehicle_id'],
                'booking_date' => $bookingDate,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            log::info('Booking created successfully:', ['booking_id' => $booking->id]);

            return redirect()->route('bookings.success', $booking->id)
                ->with('success', 'Booking servis berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Booking creation failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat membuat booking: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function success($id)
    {
        $booking = BookingService::with(['workshop', 'vehicle'])
            ->where('created_by', Auth::id())
            ->findOrFail($id);

        return view('homepage.booking-success', compact('booking'));
    }
}
