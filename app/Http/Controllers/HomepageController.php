<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $workshops = Workshop::select('id', 'name', 'city', 'address', 'latitude', 'longitude')->get();
        return view('homepage.index', compact('workshops'));
    }
}
