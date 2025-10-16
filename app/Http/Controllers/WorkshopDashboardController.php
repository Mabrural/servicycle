<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkshopDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.workshop');
    }
}
