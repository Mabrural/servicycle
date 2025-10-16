<?php
// app/Http/Controllers/WorkshopController.php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class WorkshopController extends Controller
{
    // public function index()
    // {
    //     // Cek apakah user sudah memiliki workshop
    //     if (Workshop::userHasWorkshop(Auth::id())) {
    //         return redirect()->route('profil-bengkel.show')
    //             ->with('info', 'Anda sudah memiliki workshop terdaftar.');
    //     }

    //     return view('profil-bengkel.create');
    // }

    public function index()
    {
        return view('workshop.index');
    }
    /**
     * Menampilkan form pendaftaran workshop
     */
    public function create()
    {
        return view('workshop.create');
    }
    // public function create()
    // {
    //     // Cek apakah user sudah memiliki workshop
    //     if (Workshop::userHasWorkshop(Auth::id())) {
    //         return redirect()->route('profil-bengkel.show')
    //             ->with('info', 'Anda sudah memiliki workshop terdaftar.');
    //     }

    //     return view('profil-bengkel.create');
    // }

    /**
     * Menyimpan data workshop baru
     */
        // public function store(Request $request)
        // {
        //     $validated = $request->validate([
        //         'name' => 'required|string|max:255',
        //         'types' => 'required|array',
        //         'address' => 'required|string',
        //         'province' => 'required|string|max:100',
        //         'city' => 'required|string|max:100',
        //         'district' => 'nullable|string|max:100',
        //         'village' => 'nullable|string|max:100',
        //         'postal_code' => 'nullable|string|max:20',
        //         'latitude' => 'nullable|numeric',
        //         'longitude' => 'nullable|numeric',
        //         'phone' => 'required|string|max:20',
        //         'email' => 'nullable|email|max:255',
        //         'services' => 'nullable|array',
        //         'specialization' => 'nullable|array',
        //         'operating_hours' => 'nullable|string|max:100',
        //         'description' => 'nullable|string',
        //         'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        //     ], [
        //         'required' => 'Kolom :attribute wajib diisi.',
        //         'image' => 'File harus berupa gambar.',
        //         'max' => 'Ukuran file maksimal 2MB per foto.',
        //     ]);

        //     $validated['created_by'] = Auth::id();
        //     $validated['status'] = 'pending';

        //     // Simpan foto ke storage/app/public/workshop_photos/
        //     $photoPaths = [];
        //     if ($request->hasFile('photos')) {
        //         $destinationPath = storage_path('app/public/workshop_photos');

        //         if (!File::exists($destinationPath)) {
        //             File::makeDirectory($destinationPath, 0775, true);
        //         }

        //         foreach ($request->file('photos') as $file) {
        //             $extension = $file->getClientOriginalExtension();
        //             $hashedName = hash('sha256', Str::uuid() . time() . $file->getClientOriginalName()) . '.' . $extension;

        //             $file->move($destinationPath, $hashedName);
        //             $photoPaths[] = $hashedName;
        //         }
        //     }

        //     $validated['photos'] = $photoPaths;

        //     Workshop::create($validated);

        //     return redirect()->route('workshops.index')->with('success', 'Bengkel berhasil ditambahkan dan menunggu persetujuan!');
        // }
    public function store(Request $request)
    {
        // Validasi role user
        if (Auth::user()->role !== 'workshop') {
            return redirect()->back()
                ->with('error', 'Hanya user dengan role workshop yang dapat mendaftarkan bengkel.');
        }

        // Cek apakah user sudah memiliki workshop
        if (Workshop::userHasWorkshop(Auth::id())) {
            return redirect()->route('workshop.show')
                ->with('info', 'Anda sudah memiliki workshop terdaftar.');
        }

        $validator = Validator::make($request->all(), [
            'workshopName' => 'required|string|max:255',
            'workshopType' => 'required|array|min:1',
            'workshopType.*' => 'in:motor,mobil',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'postalCode' => 'nullable|string|max:10',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'services' => 'required|array|min:1',
            'services.*' => 'string',
            'specialization' => 'nullable|string|max:255',
            'operatingHours' => 'required|string',
            'description' => 'nullable|string',
            'workshopPhoto' => 'required|array|min:1',
            'workshopPhoto.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle upload foto
        $photoPaths = [];
        if ($request->hasFile('workshopPhoto')) {
            foreach ($request->file('workshopPhoto') as $photo) {
                $path = $photo->store('workshop-photos', 'public');
                $photoPaths[] = $path;
            }
        }

        try {
            $workshop = Workshop::create([
                'name' => $request->workshopName,
                'types' => $request->workshopType,
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district,
                'village' => $request->village,
                'postal_code' => $request->postalCode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'phone' => $request->phone,
                'email' => $request->email,
                'services' => $request->services,
                'specialization' => $request->specialization,
                'operating_hours' => $request->operatingHours,
                'description' => $request->description,
                'photos' => $photoPaths,
                'created_by' => Auth::id(),
            ]);

            return redirect()->route('workshop.show')
                ->with('success', 'Pendaftaran workshop berhasil! Menunggu verifikasi admin.');

        } catch (\Exception $e) {
            // Hapus foto yang sudah diupload jika ada error
            foreach ($photoPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Menampilkan detail workshop user
     */
    public function show()
    {
        $workshop = Workshop::getByUserId(Auth::id());

        if (!$workshop) {
            return redirect()->route('workshop.create')
                ->with('info', 'Silakan daftarkan workshop Anda terlebih dahulu.');
        }

        return view('workshop.show', compact('workshop'));
    }

    /**
     * Menampilkan form edit workshop
     */
    public function edit()
    {
        $workshop = Workshop::getByUserId(Auth::id());

        if (!$workshop) {
            return redirect()->route('workshop.create')
                ->with('info', 'Silakan daftarkan workshop Anda terlebih dahulu.');
        }

        // Hanya boleh edit jika status pending atau rejected
        if ($workshop->status === 'approved') {
            return redirect()->route('workshop.show')
                ->with('info', 'Workshop yang sudah disetujui tidak dapat diubah. Silakan ajukan perubahan melalui menu edit request.');
        }

        return view('workshop.edit', compact('workshop'));
    }

    /**
     * Mengupdate data workshop
     */
    public function update(Request $request)
    {
        $workshop = Workshop::getByUserId(Auth::id());

        if (!$workshop) {
            return redirect()->route('workshop.create')
                ->with('error', 'Workshop tidak ditemukan.');
        }

        // Hanya boleh edit jika status pending atau rejected
        if ($workshop->status === 'approved') {
            return redirect()->route('workshop.show')
                ->with('error', 'Workshop yang sudah disetujui tidak dapat diubah.');
        }

        $validator = Validator::make($request->all(), [
            'workshopName' => 'required|string|max:255',
            'workshopType' => 'required|array|min:1',
            'workshopType.*' => 'in:motor,mobil',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'postalCode' => 'nullable|string|max:10',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'services' => 'required|array|min:1',
            'services.*' => 'string',
            'specialization' => 'nullable|string|max:255',
            'operatingHours' => 'required|string',
            'description' => 'nullable|string',
            'workshopPhoto' => 'sometimes|array',
            'workshopPhoto.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle upload foto baru
        $newPhotoPaths = [];
        $oldPhotos = $workshop->photos ?? [];

        if ($request->hasFile('workshopPhoto')) {
            foreach ($request->file('workshopPhoto') as $photo) {
                $path = $photo->store('workshop-photos', 'public');
                $newPhotoPaths[] = $path;
            }
        }

        try {
            $updateData = [
                'name' => $request->workshopName,
                'types' => $request->workshopType,
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district,
                'village' => $request->village,
                'postal_code' => $request->postalCode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'phone' => $request->phone,
                'email' => $request->email,
                'services' => $request->services,
                'specialization' => $request->specialization,
                'operating_hours' => $request->operatingHours,
                'description' => $request->description,
                'status' => 'pending', // Reset status ke pending setelah edit
            ];

            // Jika ada foto baru, ganti semua foto lama
            if (!empty($newPhotoPaths)) {
                // Hapus foto lama
                foreach ($oldPhotos as $oldPhoto) {
                    Storage::disk('public')->delete($oldPhoto);
                }
                $updateData['photos'] = $newPhotoPaths;
            }

            $workshop->update($updateData);

            return redirect()->route('workshop.show')
                ->with('success', 'Data workshop berhasil diperbarui! Menunggu verifikasi ulang admin.');
        } catch (\Exception $e) {
            // Hapus foto baru yang sudah diupload jika ada error
            foreach ($newPhotoPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Ajax check untuk memeriksa apakah user sudah memiliki workshop
     */
    public function checkRegistration()
    {
        $hasWorkshop = Workshop::userHasWorkshop(Auth::id());
        $workshop = null;

        if ($hasWorkshop) {
            $workshop = Workshop::getByUserId(Auth::id());
        }

        return response()->json([
            'hasWorkshop' => $hasWorkshop,
            'workshop' => $workshop
        ]);
    }
}
