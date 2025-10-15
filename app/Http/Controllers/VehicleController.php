<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah user sudah memiliki kendaraan
        if (Vehicle::userHasVehicle(Auth::id())) {
            return redirect()->route('kendaraan-saya.show')
                ->with('info', 'Anda sudah memiliki kendaraan terdaftar.');
        }

        return view('kendaraan-saya.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // cek apakah user sudah memiliki kendaraan
        if (Vehicle::userHasVehicle(Auth::id())){
            return redirect()->route('kendaraan-saya.edit')
                ->with('info', 'anda sudah memiliki kendaraan terdaftar.');
        }

        return view('kendaraan-saya.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'vehicleType' => 'required|in:motor,mobil',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1980|max:' . (date('Y') + 1),
            'licensePlate' => 'required|string|max:20|unique:vehicles,license_plate',
            'vin' => 'required|string|max:50|unique:vehicles,vin',
            'color' => 'required|string|max:50',
            'engineCapacity' => 'required|integer|min:50|max:10000',
            'transmission' => 'required|in:manual,matic',
            'fuelType' => 'required|in:pertalite,pertamax,solar,listrik',
            'notes' => 'nullable|string|max:500',
            'vehiclePhoto' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB, hanya 1 file
        ], [
            'vehicleType.required' => 'Jenis kendaraan harus dipilih',
            'vehicleType.in' => 'Jenis kendaraan tidak valid',
            
            'brand.required' => 'Merek kendaraan harus diisi',
            'brand.max' => 'Merek kendaraan maksimal 100 karakter',
            
            'model.required' => 'Model kendaraan harus diisi',
            'model.max' => 'Model kendaraan maksimal 100 karakter',
            
            'year.required' => 'Tahun pembuatan harus diisi',
            'year.integer' => 'Tahun pembuatan harus berupa angka',
            'year.min' => 'Tahun pembuatan minimal 1980',
            'year.max' => 'Tahun pembuatan maksimal ' . (date('Y') + 1),
            
            'licensePlate.required' => 'Nomor polisi harus diisi',
            'licensePlate.max' => 'Nomor polisi maksimal 20 karakter',
            'licensePlate.unique' => 'Nomor polisi sudah terdaftar',
            
            'vin.required' => 'Nomor rangka (VIN) harus diisi',
            'vin.max' => 'Nomor rangka (VIN) maksimal 50 karakter',
            'vin.unique' => 'Nomor rangka (VIN) sudah terdaftar',
            
            'color.required' => 'Warna kendaraan harus diisi',
            'color.max' => 'Warna kendaraan maksimal 50 karakter',
            
            'engineCapacity.required' => 'Kapasitas mesin harus diisi',
            'engineCapacity.integer' => 'Kapasitas mesin harus berupa angka',
            'engineCapacity.min' => 'Kapasitas mesin minimal 50 CC',
            'engineCapacity.max' => 'Kapasitas mesin maksimal 10000 CC',
            
            'transmission.required' => 'Tipe transmisi harus dipilih',
            'transmission.in' => 'Tipe transmisi tidak valid',
            
            'fuelType.required' => 'Jenis bahan bakar harus dipilih',
            'fuelType.in' => 'Jenis bahan bakar tidak valid',
            
            'notes.max' => 'Catatan tambahan maksimal 500 karakter',
            
            'vehiclePhoto.required' => 'Foto kendaraan harus diupload',
            'vehiclePhoto.image' => 'File harus berupa gambar',
            'vehiclePhoto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
            'vehiclePhoto.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan dalam pengisian form. Silakan periksa kembali data Anda.');
        }

        try {
            // Mulai database transaction
            DB::beginTransaction();

            // Handle photo upload
            $imagePath = null;
            if ($request->hasFile('vehiclePhoto')) {
                $image = $request->file('vehiclePhoto');
                
                // Generate unique filename
                $filename = 'vehicle_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Store the image in storage/app/public/vehicles
                $imagePath = $image->storeAs('vehicles', $filename, 'public');
            }

            // Create vehicle
            $vehicle = Vehicle::create([
                'vehicle_type' => $request->vehicleType,
                'brand' => $request->brand,
                'model' => $request->model,
                'year' => $request->year,
                'license_plate' => $request->licensePlate,
                'vin' => $request->vin,
                'color' => $request->color,
                'engine_capacity' => $request->engineCapacity,
                'transmission' => $request->transmission,
                'fuel_type' => $request->fuelType,
                'notes' => $request->notes,
                'image' => $imagePath, // Simpan path gambar
                'created_by' => Auth::id(),
            ]);

            // Commit transaction
            DB::commit();

            return redirect()->route('kendaraan-saya.index', $vehicle->id)
                ->with('success', 'Kendaraan berhasil didaftarkan!');

        } catch (\Exception $e) {
            // Rollback transaction jika terjadi error
            DB::rollBack();
            
            // Hapus file yang sudah diupload jika ada error
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            Log::error('Error creating vehicle: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftarkan kendaraan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
