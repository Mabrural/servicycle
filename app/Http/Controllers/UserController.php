<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('manajemen-pengguna.index', compact('users'));
    }

    public function toggleRole($id)
    {
        $user = User::findOrFail($id);

        // Toggle antara admin dan user biasa
        $user->role = $user->role === 'admin' ? 'vehicle_owner' : 'admin';
        $user->save();

        return redirect()->back()->with('success', 'Hak akses pengguna berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Toggle status aktif / nonaktif
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', 'Status pengguna berhasil diperbarui.');
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
        return view('manajemen-pengguna.edit');
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
    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('manajemen-pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
