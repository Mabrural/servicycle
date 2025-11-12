<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopVerificationController extends Controller
{
    /**
     * Tampilkan daftar semua bengkel (yang menunggu atau sudah diverifikasi)
     */
    public function index()
    {
        $workshops = Workshop::orderBy('created_at', 'desc')->get();

        return view('workshops.verification.index', compact('workshops'));
    }

    /**
     * Simpan data baru (tidak digunakan di proses verifikasi, bisa kosong)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update status bengkel (approve / reject)
     */
    public function update(Request $request, $id)
    {
        $workshop = Workshop::findOrFail($id);
        $status = $request->input('status');

        if (!in_array($status, ['approved', 'rejected'])) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $workshop->status = $status;
        $workshop->save();

        $message = $status === 'approved' 
            ? 'Bengkel berhasil disetujui!' 
            : 'Bengkel telah ditolak.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Hapus bengkel dari sistem (opsional)
     */
    public function destroy($id)
    {
        $workshop = Workshop::findOrFail($id);
        $workshop->delete();

        return redirect()->back()->with('success', 'Data bengkel dihapus.');
    }
}
