<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    // public function index()
    // {
    //     return view('homepage.index');
    // }
    public function index()
{
    $workshops = Workshop::select('id', 'name', 'address', 'latitude', 'longitude')->get();
    return view('homepage.index', compact('workshops'));
}

}
