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
    // public function index()
    // {
    //     // Pastikan user sudah login
    //     $user = Auth::user();

    //     if (!$user) {
    //         return redirect()->route('login');
    //     }

    //     // === Role: Workshop ===
    //     if ($user->role === 'workshop') {
    //         $hasWorkshop = Workshop::where('created_by', $user->id)->exists();

    //         if (!$hasWorkshop) {
    //             // Jika belum punya bengkel → arahkan ke halaman profil bengkel
    //             return redirect()->route('profil-bengkel.index');
    //         }
    //     }

    //     // === Role: Vehicle Owner ===
    //     if ($user->role === 'vehicle_owner') {
    //         $hasVehicle = Vehicle::where('created_by', $user->id)->exists();

    //         if (!$hasVehicle) {
    //             // Jika belum punya kendaraan → arahkan ke halaman tambah kendaraan
    //             return redirect()->route('kendaraan-saya.create');
    //         }
    //     }

    //     // === Default: tampilkan dashboard ===
    //     return view('dashboard.index');
    // }
    public function index()
    {
        // Pastikan user sudah login
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // === Role: Admin ===
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        // === Role: Workshop ===
        if ($user->role === 'workshop') {
            $hasWorkshop = Workshop::where('created_by', $user->id)->exists();

            if (!$hasWorkshop) {
                // Jika belum punya bengkel → arahkan ke halaman profil bengkel
                return redirect()->route('profile.create');
            }

            return redirect('/workshop/dashboard');
        }

        // === Role: Vehicle Owner ===
        if ($user->role === 'vehicle_owner') {
            $hasVehicle = Vehicle::where('created_by', $user->id)->exists();

            if (!$hasVehicle) {
                // Jika belum punya kendaraan → arahkan ke halaman tambah kendaraan
                return redirect()->route('vehicles.create');
            }

            return redirect('/user/dashboard');
        }

        // === Default: tampilkan dashboard umum ===
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
