<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $workshops = Workshop::select('id', 'name', 'city', 'address', 'latitude', 'longitude')->get();
        return view('homepage.layouts.main', compact('workshops'));
    }

    public function getWorkshopDetails($id)
    {
        $workshop = Workshop::findOrFail($id);

        return view('homepage.show-workshop', compact('workshop'));
    }

    public function bookingService($id)
    {
        $booking = Workshop::findOrFail($id);

        return view('homepage.booking', compact('booking'));
    }
}
