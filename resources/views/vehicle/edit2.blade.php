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

            {{-- Notifikasi Error Global --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan!</strong> Silakan periksa kembali isian Anda.
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ ucfirst($error) }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form Edit Kendaraan --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            {{-- Jenis Kendaraan --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kendaraan</label>
                                <select name="vehicle_type" class="form-select @error('vehicle_type') is-invalid @enderror">
                                    <option value="mobil"
                                        {{ old('vehicle_type', $vehicle->vehicle_type) == 'mobil' ? 'selected' : '' }}>Mobil
                                    </option>
                                    <option value="motor"
                                        {{ old('vehicle_type', $vehicle->vehicle_type) == 'motor' ? 'selected' : '' }}>Motor
                                    </option>
                                </select>
                                @error('vehicle_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Merek --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Merek</label>
                                <input type="text" name="brand" value="{{ old('brand', $vehicle->brand) }}"
                                    class="form-control @error('brand') is-invalid @enderror">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Model --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Model</label>
                                <input type="text" name="model" value="{{ old('model', $vehicle->model) }}"
                                    class="form-control @error('model') is-invalid @enderror">
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tahun --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tahun</label>
                                <input type="number" name="year" value="{{ old('year', $vehicle->year) }}"
                                    class="form-control @error('year') is-invalid @enderror" min="1990"
                                    max="{{ date('Y') + 1 }}">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Plat Nomor --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor Plat</label>
                                <input type="text" name="license_plate"
                                    value="{{ old('license_plate', $vehicle->license_plate) }}"
                                    class="form-control @error('license_plate') is-invalid @enderror">
                                @error('license_plate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- VIN --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor Rangka (VIN)</label>
                                <input type="text" name="vin" value="{{ old('vin', $vehicle->vin) }}"
                                    class="form-control @error('vin') is-invalid @enderror">
                                @error('vin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Warna --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Warna</label>
                                <input type="text" name="color" value="{{ old('color', $vehicle->color) }}"
                                    class="form-control @error('color') is-invalid @enderror">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kapasitas Mesin --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kapasitas Mesin (cc)</label>
                                <input type="number" name="engine_capacity"
                                    value="{{ old('engine_capacity', $vehicle->engine_capacity) }}"
                                    class="form-control @error('engine_capacity') is-invalid @enderror">
                                @error('engine_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Transmisi --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Transmisi</label>
                                <select name="transmission" class="form-select @error('transmission') is-invalid @enderror">
                                    <option value="manual"
                                        {{ old('transmission', $vehicle->transmission) == 'manual' ? 'selected' : '' }}>
                                        Manual</option>
                                    <option value="matic"
                                        {{ old('transmission', $vehicle->transmission) == 'matic' ? 'selected' : '' }}>
                                        Matic</option>
                                </select>
                                @error('transmission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jenis BBM --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis BBM</label>
                                <select name="fuel_type" class="form-select @error('fuel_type') is-invalid @enderror">
                                    <option value="pertalite"
                                        {{ old('fuel_type', $vehicle->fuel_type) == 'pertalite' ? 'selected' : '' }}>
                                        Pertalite</option>
                                    <option value="pertamax"
                                        {{ old('fuel_type', $vehicle->fuel_type) == 'pertamax' ? 'selected' : '' }}>
                                        Pertamax</option>
                                    <option value="solar"
                                        {{ old('fuel_type', $vehicle->fuel_type) == 'solar' ? 'selected' : '' }}>Solar
                                    </option>
                                    <option value="listrik"
                                        {{ old('fuel_type', $vehicle->fuel_type) == 'listrik' ? 'selected' : '' }}>Listrik
                                    </option>
                                </select>
                                @error('fuel_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gambar Lama + Ganti Gambar --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Foto Kendaraan</label>
                                @if ($vehicle->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/vehicle_images/' . $vehicle->image) }}" alt="Preview"
                                            class="rounded shadow-sm" style="height: 120px; object-fit: cover;">
                                    </div>
                                @endif
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Catatan --}}
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Catatan</label>
                                <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="Tambahkan catatan...">{{ old('notes', $vehicle->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
