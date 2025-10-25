<?php

namespace App\Http\Controllers;

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

    // public function bookingService($id)
    // {
    //     $booking = Workshop::findOrFail($id);

    //     return view('homepage.booking', compact('booking'));
    // }
    public function bookingService($id)
    {
        // Ambil data bengkel berdasarkan ID
        $booking = Workshop::findOrFail($id);

        // Ambil semua kendaraan milik user yang sedang login
        $vehicles = Vehicle::where('created_by', Auth::id())->get();

        // Kirimkan data ke view
        return view('homepage.booking', compact('booking', 'vehicles'));
    }
}
