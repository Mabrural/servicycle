<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use App\Models\Vehicle;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'booking_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            // Format tanggal dari d-m-Y ke Y-m-d H:i:s
            $bookingDate = \Carbon\Carbon::createFromFormat('d-m-Y', $validated['booking_date'])->format('Y-m-d H:i:s');

            // Buat booking
            $booking = BookingService::create([
                'created_by' => Auth::id(),
                'workshop_id' => $validated['workshop_id'],
                'vehicle_id' => $validated['vehicle_id'],
                'booking_date' => $bookingDate,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);


            return redirect()->route('bookings.success', $booking->id)
                ->with('success', 'Booking servis berhasil dibuat!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat membuat booking: ' . $e->getMessage())
                ->withInput();
        }
    }
}
