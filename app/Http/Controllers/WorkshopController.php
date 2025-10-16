<?php
// app/Http/Controllers/WorkshopController.php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WorkshopController extends Controller
{
    /**
     * Show the form for creating a new workshop.
     */
    public function create()
    {
        return view('workshop.create');
    }

    /**
     * Store a newly created workshop in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'types' => 'required|array|min:1',
            'types.*' => 'in:motor,mobil,sepeda',
            'address' => 'required|string',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'services' => 'required|array|min:1',
            'services.*' => 'in:service_rutin,ganti_oli,tune_up,perbaikan_mesin,perbaikan_rem',
            'specialization' => 'nullable|string|max:255',
            'operating_hours' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'types.required' => 'Pilih minimal satu jenis bengkel.',
            'types.*.in' => 'Jenis bengkel yang dipilih tidak valid.',
            'services.required' => 'Pilih minimal satu layanan.',
            'services.*.in' => 'Layanan yang dipilih tidak valid.',
            'latitude.between' => 'Latitude harus antara -90 dan 90.',
            'longitude.between' => 'Longitude harus antara -180 dan 180.',
            'photos.*.image' => 'File harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'photos.*.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Handle photo uploads
            $photoPaths = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('workshop-photos', 'public');
                    $photoPaths[] = $path;
                }
            }

            // Create workshop
            $workshop = Workshop::create([
                'name' => $request->name,
                'types' => json_encode($request->types),
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district,
                'village' => $request->village,
                'postal_code' => $request->postal_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'phone' => $request->phone,
                'email' => $request->email,
                'services' => json_encode($request->services),
                'specialization' => $request->specialization,
                'operating_hours' => $request->operating_hours,
                'description' => $request->description,
                'photos' => !empty($photoPaths) ? json_encode($photoPaths) : null,
                'status' => 'pending', // Default status
                'created_by' => Auth::id(),
            ]);

            DB::commit();

            return redirect()->route('profile.show', $workshop->id)
                ->with('success', 'Bengkel berhasil ditambahkan dan menunggu persetujuan.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded photos if error occurs
            if (!empty($photoPaths)) {
                foreach ($photoPaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified workshop.
     */
    public function show($id)
    {
        $workshop = Workshop::with('creator')->findOrFail($id);
        return view('workshop.show', compact('workshop'));
    }

    /**
     * Show list of workshops.
     */
    public function index()
    {
        $workshops = Workshop::where('status', 'approved')->get();
        return view('workshop.index', compact('workshops'));
    }
}