<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Mail\WorkshopVerificationStatusMail;
use Illuminate\Support\Facades\Mail;

/**
 * Controller untuk verifikasi bengkel (approve / reject).
 */
class WorkshopVerificationController extends Controller
{
    /**
     * Tampilkan daftar semua bengkel (yang menunggu atau sudah diverifikasi)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var \Illuminate\Http\Request $request */
        $search = $request->input('search');
        $status = $request->input('status', 'all');
        $sort = $request->input('sort', 'latest');

        // Query dasar
        $query = Workshop::with('creator');

        // Filter pencarian (nama bengkel, alamat, atau pemilik)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhereHas('creator', function ($creatorQuery) use ($search) {
                        $creatorQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter status bengkel
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // Urutan data
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // latest
        }

        // Ambil statistik (total, pending, approved, rejected)
        $stats = [
            'total' => Workshop::count(),
            'pending' => Workshop::where('status', 'pending')->count(),
            'approved' => Workshop::where('status', 'approved')->count(),
            'rejected' => Workshop::where('status', 'rejected')->count(),
        ];

        // Ambil data dengan pagination (10 per halaman)
        $workshops = $query->paginate(10)->appends($request->query());

        // Return ke view
        return view('workshops.verification.index', compact('workshops', 'stats'));
    }

    /**
     * Simpan data baru (tidak digunakan di proses verifikasi, bisa kosong)
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        /** @var \Illuminate\Http\Request $request */
        //
    }

    /**
     * Update status bengkel (approve / reject)
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function update(Request $request, int $id)
    // {
    //     /** @var \Illuminate\Http\Request $request */
    //     /** @var int $id */
    //     /** @var \App\Models\Workshop $workshop */
    //     $workshop = Workshop::findOrFail($id);

    //     $status = $request->input('status');

    //     if (!in_array($status, ['approved', 'rejected'], true)) {
    //         return redirect()->back()->with('error', 'Status tidak valid.');
    //     }

    //     $workshop->status = $status;
    //     $workshop->save();

    //     $message = $status === 'approved'
    //         ? 'Bengkel berhasil disetujui!'
    //         : 'Bengkel telah ditolak.';

    //     return redirect()->back()->with('success', $message);
    // }
    public function update(Request $request, int $id)
    {
        $workshop = Workshop::findOrFail($id);
        $status = $request->input('status');

        if (!in_array($status, ['approved', 'rejected'], true)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $workshop->status = $status;
        $workshop->save();

        // Kirim email ke pemilik bengkel
        if ($workshop->email) {
            Mail::to($workshop->email)->send(new WorkshopVerificationStatusMail($workshop, $status));
        }

        $message = $status === 'approved'
            ? 'Bengkel berhasil disetujui dan notifikasi email telah dikirim!'
            : 'Bengkel telah ditolak dan notifikasi email telah dikirim.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Hapus bengkel dari sistem (opsional)
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        /** @var int $id */
        /** @var \App\Models\Workshop $workshop */
        $workshop = Workshop::findOrFail($id);
        $workshop->delete();

        return redirect()->back()->with('success', 'Data bengkel dihapus.');
    }

    public function show($id)
    {
        $workshop = Workshop::with('creator')->findOrFail($id);
        return view('workshops.verification.show', compact('workshop'));
    }

}
