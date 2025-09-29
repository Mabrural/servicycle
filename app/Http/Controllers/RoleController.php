<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function selectRole()
    {
        return view('pilih-role.index');
    }

    public function setRole(Request $request)
    {
        // Validasi input
        $request->validate([
            'role' => 'required|in:vehicle_owner,workshop',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update kolom role dan is_set_role
        $user->update([
            'role' => $request->role,
            'is_set_role' => true,
        ]);

        // Redirect ke dashboard
        return redirect()->route('dashboard')->with('success', 'Peran berhasil dipilih!');
    }
}
