<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah user sudah memiliki kendaraan
        if (Vehicle::userHasVehicle(Auth::id())) {
            return redirect()->route('kendaraan-saya.show')
                ->with('info', 'Anda sudah memiliki kendaraan terdaftar.');
        }

        return view('kendaraan-saya.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // cek apakah user sudah memiliki kendaraan
        if (Vehicle::userHasVehicle(Auth::id())){
            return redirect()->route('kendaraan-saya.edit')
                ->with('info', 'anda sudah memiliki kendaraan terdaftar.');
        }

        return view('kendaraan-saya.create');
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
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
