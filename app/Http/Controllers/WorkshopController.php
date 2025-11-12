<?php
// app/Http/Controllers/WorkshopController.php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\WorkshopImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
            return redirect()->route('my-workshop.index');
        }


        return view('workshop.create');
    }

    /**
     * Store a newly created workshop in storage.
     */
    // public function store(Request $request)
    // {
    //     // Cek apakah user sudah memiliki workshop
    //     if (Workshop::userHasWorkshop(Auth::id())) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Anda sudah memiliki bengkel terdaftar.'
    //         ], 422);
    //     }

    //     // Validasi data
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'types' => 'required|array|min:1',
    //         'types.*' => 'in:motor,mobil,sepeda',
    //         'address' => 'required|string',
    //         'province' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'district' => 'required|string|max:255',
    //         'village' => 'required|string|max:255',
    //         'postal_code' => 'nullable|string|max:10',
    //         'latitude' => 'required|numeric|between:-90,90',
    //         'longitude' => 'required|numeric|between:-180,180',
    //         'phone' => 'required|string|max:20',
    //         'email' => 'nullable|email|max:255',
    //         'services' => 'required|array|min:1',
    //         'services.*' => 'in:service_rutin,ganti_oli,tune_up,perbaikan_mesin,perbaikan_rem,ganti_ban,servis_ac,kelistrikan',
    //         'specialization' => 'nullable|string|max:255',
    //         'operating_hours' => 'required|string|max:255',
    //         'custom_hours' => 'nullable|string|max:100',
    //         'description' => 'nullable|string',
    //         'photos' => 'nullable|array',
    //         'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120'
    //     ], [
    //         'types.required' => 'Pilih minimal satu jenis bengkel.',
    //         'types.*.in' => 'Jenis bengkel yang dipilih tidak valid.',
    //         'services.required' => 'Pilih minimal satu layanan.',
    //         'services.*.in' => 'Layanan yang dipilih tidak valid.',
    //         'latitude.between' => 'Latitude harus antara -90 dan 90.',
    //         'longitude.between' => 'Longitude harus antara -180 dan 180.',
    //         'photos.*.image' => 'File harus berupa gambar.',
    //         'photos.*.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
    //         'photos.*.max' => 'Ukuran gambar maksimal 5MB.'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validasi gagal',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     try {
    //         DB::beginTransaction();

    //         // Handle operating hours
    //         $operatingHours = $request->operating_hours;
    //         if ($operatingHours === 'custom' && $request->custom_hours) {
    //             $operatingHours = $request->custom_hours;
    //         }

    //         // Create workshop
    //         $workshop = Workshop::create([
    //             'name' => $request->name,
    //             'types' => $request->types,
    //             'address' => $request->address,
    //             'province' => $request->province,
    //             'city' => $request->city,
    //             'district' => $request->district,
    //             'village' => $request->village,
    //             'postal_code' => $request->postal_code,
    //             'latitude' => $request->latitude,
    //             'longitude' => $request->longitude,
    //             'phone' => $request->phone,
    //             'email' => $request->email,
    //             'services' => $request->services,
    //             'specialization' => $request->specialization,
    //             'operating_hours' => $operatingHours,
    //             'description' => $request->description,
    //             'status' => 'pending',
    //             'created_by' => Auth::id(),
    //         ]);

    //         // Handle photo uploads
    //         if ($request->hasFile('photos')) {
    //             foreach ($request->file('photos') as $index => $photo) {
    //                 $path = $photo->store('workshop-images', 'public');

    //                 WorkshopImage::create([
    //                     'workshop_id' => $workshop->id,
    //                     'image_path' => $path,
    //                     'image_name' => $photo->getClientOriginalName(),
    //                     'order' => $index,
    //                     'is_primary' => $index === 0 // Set first image as primary
    //                 ]);
    //             }
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Bengkel berhasil didaftarkan! Status: Menunggu Verifikasi',
    //             'workshop' => $workshop
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function store(Request $request)
    {
        // Cek apakah user sudah memiliki workshop
        if (Workshop::userHasWorkshop(Auth::id())) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memiliki bengkel terdaftar.'
            ], 422);
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
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
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

            // Kirim email ke semua admin
            try {
                $admins = \App\Models\User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    Mail::to($admin->email)
                        ->send(new \App\Mail\VerifyWorkshopMail($workshop));
                }
            } catch (\Exception $mailException) {
                // Log error tapi jangan ganggu proses utama
                \Illuminate\Support\Facades\Log::error('Gagal kirim email ke admin: ' . $mailException->getMessage());
            }

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

            return response()->json([
                'success' => true,
                'message' => 'Bengkel berhasil didaftarkan! Status: Menunggu Verifikasi',
                'workshop' => $workshop
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Show list of workshops.
     */

    public function index()
    {
        $workshops = Workshop::with('images')
            ->where('created_by', Auth::id())
            ->get();

        return view('workshop.index', compact('workshops'));
    }


    /**
     * Show edit form for workshop
     */
    public function edit($id)
    {
        $workshop = Workshop::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        return view('workshop.edit', compact('workshop'));
    }

    public function show($id)
    {
        $workshop = Workshop::where('id', $id)
            ->where('created_by', Auth::id())
            ->with(['images', 'creator'])
            ->firstOrFail();

        // Service names mapping
        $serviceNames = [
            'service_rutin' => 'Service Rutin',
            'ganti_oli' => 'Ganti Oli & Filter',
            'tune_up' => 'Tune Up',
            'perbaikan_mesin' => 'Perbaikan Mesin',
            'perbaikan_rem' => 'Servis Rem',
            'ganti_ban' => 'Ganti Ban',
            'servis_ac' => 'Servis AC',
            'kelistrikan' => 'Servis Kelistrikan'
        ];

        return view('workshop.show', compact('workshop', 'serviceNames'));
    }

    public function update(Request $request, $id)
    {
        $workshop = Workshop::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

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
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'remove_photos' => 'nullable|array',
            'remove_photos.*' => 'integer|exists:workshop_images,id'
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
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Handle operating hours
            $operatingHours = $request->operating_hours;
            if ($operatingHours === 'custom' && $request->custom_hours) {
                $operatingHours = $request->custom_hours;
            }

            // Update workshop
            $workshop->update([
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
                'status' => 'pending', // Reset status to pending when updating
            ]);

            // Handle remove photos
            if ($request->has('remove_photos')) {
                foreach ($request->remove_photos as $photoId) {
                    $workshopImage = WorkshopImage::where('id', $photoId)
                        ->where('workshop_id', $workshop->id)
                        ->first();

                    if ($workshopImage) {
                        // Delete file from storage
                        Storage::disk('public')->delete($workshopImage->image_path);
                        $workshopImage->delete();
                    }
                }
            }

            // Handle new photo uploads
            if ($request->hasFile('photos')) {
                $existingImagesCount = $workshop->images()->count();

                foreach ($request->file('photos') as $index => $photo) {
                    $path = $photo->store('workshop-images', 'public');

                    WorkshopImage::create([
                        'workshop_id' => $workshop->id,
                        'image_path' => $path,
                        'image_name' => $photo->getClientOriginalName(),
                        'order' => $existingImagesCount + $index,
                        'is_primary' => ($existingImagesCount === 0 && $index === 0) // Set as primary if no images exist
                    ]);
                }
            }

            // Update primary image if needed
            if ($request->has('primary_photo') && $workshop->images()->count() > 0) {
                $workshop->images()->update(['is_primary' => false]);
                $primaryImage = WorkshopImage::where('id', $request->primary_photo)
                    ->where('workshop_id', $workshop->id)
                    ->first();
                if ($primaryImage) {
                    $primaryImage->update(['is_primary' => true]);
                }
            }

            DB::commit();

            // Reload workshop with images
            $workshop->load('images');

            return response()->json([
                'success' => true,
                'message' => 'Data bengkel berhasil diperbarui! Status: Menunggu Verifikasi Ulang',
                'workshop' => $workshop
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ], 500);
        }
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
