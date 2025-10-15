<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Workshop;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Jika user login dan rolenya 'workshop'
    if (Auth::check() && Auth::user()->role === 'workshop') {

        // Cek apakah user sudah punya data bengkel
        $hasWorkshop = Workshop::where('created_by', Auth::id())->exists();

        // Jika belum punya bengkel, arahkan ke profil bengkel
        if (!$hasWorkshop) {
            return redirect()->route('profil-bengkel.index');
        }
    }
    // Jika user login dan rolenya 'vehicle_owner'
    if (Auth::check() && Auth::user()->role === 'vehicle_owner') {

        // Cek apakah user sudah punya data kendaraan
        $hasVehicle = Vehicle::where('created_by', Auth::id())->exists();

        // Jika belum punya kendaraan, arahkan ke daftar kendaraan
        if (!$hasVehicle) {
            return redirect()->route('kendaraan-saya.create');
        }
    }

    // Jika bukan workshop atau sudah punya data bengkel → lanjut ke dashboard
    return view('dashboard.index');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
