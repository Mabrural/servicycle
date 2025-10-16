@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><strong>Edit</strong> Kendaraan</h1>
            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Form Edit Kendaraan --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Jenis Kendaraan --}}
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_type" class="form-label fw-semibold">Jenis Kendaraan</label>
                            <select name="vehicle_type" id="vehicle_type" class="form-select" required>
                                <option value="mobil" {{ old('vehicle_type', $vehicle->vehicle_type) == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                <option value="motor" {{ old('vehicle_type', $vehicle->vehicle_type) == 'motor' ? 'selected' : '' }}>Motor</option>
                            </select>
                        </div>

                        {{-- Merek --}}
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label fw-semibold">Merek</label>
                            <input type="text" name="brand" id="brand" 
                                   class="form-control" 
                                   value="{{ old('brand', $vehicle->brand) }}" required>
                        </div>

                        {{-- Model --}}
                        <div class="col-md-6 mb-3">
                            <label for="model" class="form-label fw-semibold">Model</label>
                            <input type="text" name="model" id="model" 
                                   class="form-control" 
                                   value="{{ old('model', $vehicle->model) }}" required>
                        </div>

                        {{-- Tahun --}}
                        <div class="col-md-6 mb-3">
                            <label for="year" class="form-label fw-semibold">Tahun</label>
                            <input type="number" name="year" id="year" class="form-control"
                                   min="1990" max="{{ date('Y') + 1 }}"
                                   value="{{ old('year', $vehicle->year) }}" required>
                        </div>

                        {{-- Plat Nomor --}}
                        <div class="col-md-6 mb-3">
                            <label for="license_plate" class="form-label fw-semibold">Nomor Plat</label>
                            <input type="text" name="license_plate" id="license_plate" 
                                   class="form-control" 
                                   value="{{ old('license_plate', $vehicle->license_plate) }}" required>
                        </div>

                        {{-- Nomor Rangka (VIN) --}}
                        <div class="col-md-6 mb-3">
                            <label for="vin" class="form-label fw-semibold">Nomor Rangka (VIN)</label>
                            <input type="text" name="vin" id="vin" 
                                   class="form-control" 
                                   value="{{ old('vin', $vehicle->vin) }}">
                        </div>

                        {{-- Warna --}}
                        <div class="col-md-6 mb-3">
                            <label for="color" class="form-label fw-semibold">Warna</label>
                            <input type="text" name="color" id="color" 
                                   class="form-control" 
                                   value="{{ old('color', $vehicle->color) }}">
                        </div>

                        {{-- Kapasitas Mesin --}}
                        <div class="col-md-6 mb-3">
                            <label for="engine_capacity" class="form-label fw-semibold">Kapasitas Mesin (cc)</label>
                            <input type="number" name="engine_capacity" id="engine_capacity" 
                                   class="form-control" 
                                   value="{{ old('engine_capacity', $vehicle->engine_capacity) }}">
                        </div>

                        {{-- Transmisi --}}
                        <div class="col-md-6 mb-3">
                            <label for="transmission" class="form-label fw-semibold">Transmisi</label>
                            <select name="transmission" id="transmission" class="form-select" required>
                                <option value="manual" {{ old('transmission', $vehicle->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="matic" {{ old('transmission', $vehicle->transmission) == 'matic' ? 'selected' : '' }}>Matic</option>
                            </select>
                        </div>

                        {{-- Jenis BBM --}}
                        <div class="col-md-6 mb-3">
                            <label for="fuel_type" class="form-label fw-semibold">Jenis BBM</label>
                            <select name="fuel_type" id="fuel_type" class="form-select" required>
                                <option value="pertalite" {{ old('fuel_type', $vehicle->fuel_type) == 'pertalite' ? 'selected' : '' }}>Pertalite</option>
                                <option value="pertamax" {{ old('fuel_type', $vehicle->fuel_type) == 'pertamax' ? 'selected' : '' }}>Pertamax</option>
                                <option value="solar" {{ old('fuel_type', $vehicle->fuel_type) == 'solar' ? 'selected' : '' }}>Solar</option>
                                <option value="listrik" {{ old('fuel_type', $vehicle->fuel_type) == 'listrik' ? 'selected' : '' }}>Listrik</option>
                            </select>
                        </div>

                        {{-- Gambar --}}
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label fw-semibold">Foto Kendaraan</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>

                            @if ($vehicle->image)
                                <div class="mt-3">
                                    <p class="text-muted mb-1">Foto Saat Ini:</p>
                                    <img src="{{ url('/storage/vehicle_images/' . $vehicle->image) }}" 
                                         alt="Foto Kendaraan"
                                         class="rounded border" 
                                         style="height: 160px; object-fit: cover;">
                                </div>
                            @endif
                        </div>

                        {{-- Catatan --}}
                        <div class="col-md-12 mb-3">
                            <label for="notes" class="form-label fw-semibold">Catatan</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes', $vehicle->notes) }}</textarea>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
