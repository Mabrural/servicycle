<?php
// app/Http/Controllers/WorkshopController.php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\WorkshopImage;
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
        // Cek apakah user sudah memiliki workshop
        if (Workshop::userHasWorkshop(Auth::id())) {
            $workshop = Workshop::getByUserId(Auth::id());
            return view('workshop.already-registered', compact('workshop'));
        }

        return view('workshop.create');
    }

    /**
     * Store a newly created workshop in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah user sudah memiliki workshop
        if (Workshop::userHasWorkshop(Auth::id())) {
            return redirect()->back()
                ->with('error', 'Anda sudah memiliki bengkel terdaftar.');
        }

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
            'services.*' => 'in:service_rutin,ganti_oli,tune_up,perbaikan_mesin,perbaikan_rem,ganti_ban,servis_ac,kelistrikan',
            'specialization' => 'nullable|string|max:255',
            'operating_hours' => 'required|string|max:255',
            'custom_hours' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120'
        ], [
            'types.required' => 'Pilih minimal satu jenis bengkel.',
            'types.*.in' => 'Jenis bengkel yang dipilih tidak valid.',
            'services.required' => 'Pilih minimal satu layanan.',
            'services.*.in' => 'Layanan yang dipilih tidak valid.',
            'latitude.between' => 'Latitude harus antara -90 dan 90.',
            'longitude.between' => 'Longitude harus antara -180 dan 180.',
            'photos.*.image' => 'File harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'photos.*.max' => 'Ukuran gambar maksimal 5MB.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Handle operating hours
            $operatingHours = $request->operating_hours;
            if ($operatingHours === 'custom' && $request->custom_hours) {
                $operatingHours = $request->custom_hours;
            }

            // Create workshop
            $workshop = Workshop::create([
                'name' => $request->name,
                'types' => $request->types,
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
                'services' => $request->services,
                'specialization' => $request->specialization,
                'operating_hours' => $operatingHours,
                'description' => $request->description,
                'status' => 'pending',
                'created_by' => Auth::id(),
            ]);

            // Handle photo uploads
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photo) {
                    $path = $photo->store('workshop-images', 'public');
                    
                    WorkshopImage::create([
                        'workshop_id' => $workshop->id,
                        'image_path' => $path,
                        'image_name' => $photo->getClientOriginalName(),
                        'order' => $index,
                        'is_primary' => $index === 0 // Set first image as primary
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('profile.index', $workshop->id)
                ->with('success', 'Bengkel berhasil didaftarkan! Status: Menunggu Verifikasi');

        } catch (\Exception $e) {
            DB::rollBack();
            
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
        $workshop = Workshop::with(['creator', 'images'])->findOrFail($id);
        return view('workshop.show', compact('workshop'));
    }

    /**
     * Show list of workshops.
     */
    public function index()
    {
        $workshops = Workshop::with('images')->approved()->get();
        return view('workshop.index', compact('workshops'));
    }

    /**
     * Show edit form for workshop
     */
    public function edit($id)
    {
        $workshop = Workshop::with('images')->findOrFail($id);
        
        // Authorization check - hanya creator yang bisa edit
        if ($workshop->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('workshop.edit', compact('workshop'));
    }

    /**
     * Check if user has registered workshop (API)
     */
    public function checkRegistration()
    {
        $workshop = Workshop::with('images')->getByUserId(Auth::id());
        
        return response()->json([
            'registered' => !is_null($workshop),
            'workshop' => $workshop
        ]);
    }

    /**
     * Handle edit request (API)
     */
    public function requestEdit(Request $request)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        // Logic untuk handle edit request
        // Bisa kirim email notifikasi atau buat ticket

        return response()->json([
            'success' => true,
            'message' => 'Permohonan perubahan berhasil dikirim. Tim kami akan menghubungi Anda dalam 1-2 hari kerja.'
        ]);
    }
}