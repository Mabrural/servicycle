<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use App\Models\Vehicle;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Mail\BookingMail;
use Illuminate\Support\Facades\Mail;

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

    // // function untuk menyimpan data booking servis
    // public function store(Request $request)
    // {
    //     try {
    //         // Validasi data
    //         $validated = $request->validate([
    //             'workshop_id' => 'required|exists:workshops,id',
    //             'vehicle_id' => 'required|exists:vehicles,id',
    //             'booking_date' => 'required|string', // Format: d-m-Y
    //             'booking_time' => 'required|string', // Format: H:i
    //             'notes' => 'nullable|string|max:500',
    //         ]);

    //         Log::info('Raw booking data received:', $validated);

    //         // Cek vehicle ownership
    //         $vehicle = Vehicle::where('id', $validated['vehicle_id'])
    //             ->where('created_by', Auth::id())
    //             ->first();

    //         if (!$vehicle) {
    //             return redirect()->back()
    //                 ->withErrors(['vehicle_id' => 'Kendaraan tidak ditemukan atau tidak memiliki akses'])
    //                 ->withInput();
    //         }

    //         // Format tanggal - PERBAIKAN DI SINI
    //         // Frontend mengirim: booking_date = "27-10-2025" dan booking_time = "09:00"
    //         $dateString = $validated['booking_date']; // "27-10-2025"
    //         $timeString = $validated['booking_time']; // "09:00"

    //         // Gabungkan dan format ke database
    //         $dateTimeString = $dateString . ' ' . $timeString; // "27-10-2025 09:00"

    //         try {
    //             $bookingDateTime = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $dateTimeString);

    //             // Validasi bahwa tanggal tidak di masa lalu
    //             if ($bookingDateTime->isPast()) {
    //                 return redirect()->back()
    //                     ->withErrors(['booking_date' => 'Tanggal booking tidak boleh di masa lalu'])
    //                     ->withInput();
    //             }

    //             $formattedDateTime = $bookingDateTime->format('Y-m-d H:i:s');
    //         } catch (\Exception $e) {
    //             Log::error('Date parsing error:', [
    //                 'date_string' => $dateTimeString,
    //                 'error' => $e->getMessage()
    //             ]);

    //             return redirect()->back()
    //                 ->withErrors(['booking_date' => 'Format tanggal tidak valid. Gunakan format: DD-MM-YYYY'])
    //                 ->withInput();
    //         }

    //         Log::info('Formatted booking datetime:', [
    //             'input' => $dateTimeString,
    //             'formatted' => $formattedDateTime
    //         ]);

    //         // Buat booking
    //         $booking = BookingService::create([
    //             'created_by' => Auth::id(),
    //             'workshop_id' => $validated['workshop_id'],
    //             'vehicle_id' => $validated['vehicle_id'],
    //             'booking_date' => $formattedDateTime,
    //             'status' => 'menunggu_konfirmasi',
    //             'notes' => $validated['notes'] ?? null,
    //         ]);

    //         Log::info('Booking created successfully:', [
    //             'booking_id' => $booking->id,
    //             'booking_data' => $booking->toArray()
    //         ]);

    //         // Redirect ke success page
    //         return redirect()->route('bookings.success', $booking->id)
    //             ->with('success', 'Booking servis berhasil dibuat!');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         Log::error('Validation failed:', ['errors' => $e->errors()]);
    //         return redirect()->back()
    //             ->withErrors($e->errors())
    //             ->withInput();
    //     } catch (\Exception $e) {
    //         Log::error('Booking creation failed:', [
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString(),
    //             'input_data' => $request->all()
    //         ]);

    //         return redirect()->back()
    //             ->with('error', 'Terjadi kesalahan saat membuat booking: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }
    public function store(Request $request)
    {
        try {
            // ✅ 1. Validasi data input
            $validated = $request->validate([
                'workshop_id' => 'required|exists:workshops,id',
                'vehicle_id' => 'required|exists:vehicles,id',
                'booking_date' => 'required|string', // Format: d-m-Y
                'booking_time' => 'required|string', // Format: H:i
                'notes' => 'nullable|string|max:500',
            ]);

            Log::info('Raw booking data received:', $validated);

            // ✅ 2. Cek apakah kendaraan milik user yang login
            $vehicle = Vehicle::where('id', $validated['vehicle_id'])
                ->where('created_by', Auth::id())
                ->first();

            if (!$vehicle) {
                return redirect()->back()
                    ->withErrors(['vehicle_id' => 'Kendaraan tidak ditemukan atau tidak memiliki akses'])
                    ->withInput();
            }

            // ✅ 3. Gabungkan tanggal dan jam booking
            $dateString = $validated['booking_date']; // "27-10-2025"
            $timeString = $validated['booking_time']; // "09:00"
            $dateTimeString = $dateString . ' ' . $timeString; // "27-10-2025 09:00"

            try {
                $bookingDateTime = Carbon::createFromFormat('d-m-Y H:i', $dateTimeString);

                // Validasi: tanggal tidak boleh di masa lalu
                if ($bookingDateTime->isPast()) {
                    return redirect()->back()
                        ->withErrors(['booking_date' => 'Tanggal booking tidak boleh di masa lalu'])
                        ->withInput();
                }

                $formattedDateTime = $bookingDateTime->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                Log::error('Date parsing error:', [
                    'date_string' => $dateTimeString,
                    'error' => $e->getMessage()
                ]);

                return redirect()->back()
                    ->withErrors(['booking_date' => 'Format tanggal tidak valid. Gunakan format: DD-MM-YYYY'])
                    ->withInput();
            }

            Log::info('Formatted booking datetime:', [
                'input' => $dateTimeString,
                'formatted' => $formattedDateTime
            ]);

            // ✅ 4. Simpan booking ke database
            $booking = BookingService::create([
                'created_by'   => Auth::id(),
                'workshop_id'  => $validated['workshop_id'],
                'vehicle_id'   => $validated['vehicle_id'],
                'booking_date' => $formattedDateTime,
                'status'       => 'menunggu_konfirmasi',
                'notes'        => $validated['notes'] ?? null,
            ]);

            Log::info('Booking created successfully:', [
                'booking_id' => $booking->id,
                'booking_data' => $booking->toArray()
            ]);

            // ✅ 5. Kirim email notifikasi ke bengkel
            try {
                if ($booking->workshop && $booking->workshop->email) {
                    Mail::to($booking->workshop->email)->send(new BookingMail($booking));
                    Log::info('Booking notification email sent to workshop:', [
                        'workshop_email' => $booking->workshop->email,
                        'booking_id' => $booking->id
                    ]);
                } else {
                    Log::warning('Workshop email not found, skipping email notification', [
                        'workshop_id' => $booking->workshop_id
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Failed to send booking email notification:', [
                    'booking_id' => $booking->id,
                    'error' => $e->getMessage()
                ]);
            }

            // ✅ 6. Redirect ke halaman sukses
            return redirect()->route('bookings.success', $booking->id)
                ->with('success', 'Booking servis berhasil dibuat!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Booking creation failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input_data' => $request->all()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat membuat booking: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function success($id)
    {
        $booking = BookingService::with(['workshop', 'vehicle'])
            ->where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        return view('homepage.booking-success', compact('booking'));
    }

    public function syaratKetentuan()
    {
        return view('homepage.syarat-ketentuan');
    }

    public function kebijakanPrivasi()
    {
        return view('homepage.kebijakan-privasi');
    }
}
