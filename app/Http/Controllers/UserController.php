<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $users = User::all();
    //     return view('manajemen-pengguna.index', compact('users'));
    // }
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('user-management.index', compact('users'));
    }


    public function getData(Request $request)
    {

        $query = User::query();

        // 🔍 Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active' ? 1 : 0);
        }

        // Pagination
        $perPage = $request->perPage ?? 10;
        $users = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'html' => view('manajemen-pengguna.partials.table', compact('users'))->render(),
            'pagination' => (string) $users->appends($request->except('page'))->links()
        ]);
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
        return view('user-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,vehicle_owner,workshop,user',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Hak akses wajib dipilih.',
            'role.in' => 'Hak akses tidak valid.',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = 1; // ✅ Status default: Aktif

        User::create($validated);

        return redirect()->route('user-management.index')->with('success', 'Pengguna berhasil ditambahkan!');
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
    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Kirim ke view edit
        return view('user-management.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed', // ✅ nullable artinya boleh kosong
            'role' => 'required|in:admin,vehicle_owner,workshop,user',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Hak akses wajib dipilih.',
            'role.in' => 'Hak akses tidak valid.',
        ]);

        // ✅ Jika password diisi, update password
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']); // agar tidak menimpa password lama dengan null
        }

        $user->update($validated);

        return redirect()->route('user-management.index')->with('success', 'Data pengguna berhasil diperbarui!');
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
        return redirect()->route('user-management.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
