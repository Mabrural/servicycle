<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingServiceController extends Controller
{
    // Tampilkan semua booking (bisa disesuaikan per role)

    public function index()
    {
        $workshop = Workshop::where('created_by', Auth::id())->first();

        $bookings = BookingService::with(['creator', 'workshop', 'vehicle'])
            ->where('workshop_id', $workshop->id ?? null)
            ->latest()
            ->get();

        return view('booking.workshop.index', compact('bookings'));
    }

    // function untuk menampilkan history servis by user
    public function historyService()
    {
        $bookings = BookingService::with(['workshop', 'vehicle'])
            ->where('created_by', Auth::id())
            ->latest()
            ->get();

        return view('history.index', compact('bookings'));
    }

    // Simpan booking baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'workshop_id' => 'required|exists:workshops,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'booking_date' => 'required|date_format:Y-m-d H:i',
            'notes' => 'nullable|string',
        ]);

        $validated['created_by'] = Auth::id();

        $booking = BookingService::create($validated);

        return response()->json([
            'message' => 'Booking berhasil dibuat.',
            'data' => $booking->load(['creator', 'workshop', 'vehicle']),
        ]);
    }

    // Tampilkan detail booking
    public function show(BookingService $bookingService)
    {
        return response()->json($bookingService->load(['creator', 'workshop', 'vehicle']));
    }

    // Update data booking
    public function update(Request $request, BookingService $bookingService)
    {
        $validated = $request->validate([
            'workshop_id' => 'sometimes|exists:workshops,id',
            'vehicle_id' => 'sometimes|exists:vehicles,id',
            'booking_date' => 'sometimes|date_format:Y-m-d H:i',
            'status' => 'sometimes|string',
            'notes' => 'nullable|string',
        ]);

        $bookingService->update($validated);

        return response()->json([
            'message' => 'Booking berhasil diperbarui.',
            'data' => $bookingService->load(['creator', 'workshop', 'vehicle']),
        ]);
    }

    // Hapus booking
    public function destroy(BookingService $bookingService)
    {
        $bookingService->delete();

        return response()->json(['message' => 'Booking berhasil dihapus.']);
    }
}
