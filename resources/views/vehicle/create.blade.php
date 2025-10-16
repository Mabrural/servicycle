@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><strong>Tambah</strong> Kendaraan</h1>
            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Form Tambah Kendaraan --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- Jenis Kendaraan --}}
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_type" class="form-label fw-semibold">Jenis Kendaraan</label>
                            <select name="vehicle_type" id="vehicle_type" class="form-select" required>
                                <option value="" disabled selected>Pilih jenis</option>
                                <option value="mobil">Mobil</option>
                                <option value="motor">Motor</option>
                            </select>
                        </div>

                        {{-- Merek --}}
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label fw-semibold">Merek</label>
                            <input type="text" name="brand" id="brand" class="form-control" placeholder="Contoh: Toyota" required>
                        </div>

                        {{-- Model --}}
                        <div class="col-md-6 mb-3">
                            <label for="model" class="form-label fw-semibold">Model</label>
                            <input type="text" name="model" id="model" class="form-control" placeholder="Contoh: Avanza" required>
                        </div>

                        {{-- Tahun --}}
                        <div class="col-md-6 mb-3">
                            <label for="year" class="form-label fw-semibold">Tahun</label>
                            <input type="number" name="year" id="year" class="form-control" min="1990" max="{{ date('Y') + 1 }}" required>
                        </div>

                        {{-- Plat Nomor --}}
                        <div class="col-md-6 mb-3">
                            <label for="license_plate" class="form-label fw-semibold">Nomor Plat</label>
                            <input type="text" name="license_plate" id="license_plate" class="form-control" placeholder="Contoh: BP 1234 XY" required>
                        </div>

                        {{-- Nomor Rangka (VIN) --}}
                        <div class="col-md-6 mb-3">
                            <label for="vin" class="form-label fw-semibold">Nomor Rangka (VIN)</label>
                            <input type="text" name="vin" id="vin" class="form-control" placeholder="Opsional">
                        </div>

                        {{-- Warna --}}
                        <div class="col-md-6 mb-3">
                            <label for="color" class="form-label fw-semibold">Warna</label>
                            <input type="text" name="color" id="color" class="form-control" placeholder="Contoh: Hitam / Merah">
                        </div>

                        {{-- Kapasitas Mesin --}}
                        <div class="col-md-6 mb-3">
                            <label for="engine_capacity" class="form-label fw-semibold">Kapasitas Mesin (cc)</label>
                            <input type="number" name="engine_capacity" id="engine_capacity" class="form-control" placeholder="Contoh: 1500">
                        </div>

                        {{-- Transmisi --}}
                        <div class="col-md-6 mb-3">
                            <label for="transmission" class="form-label fw-semibold">Transmisi</label>
                            <select name="transmission" id="transmission" class="form-select" required>
                                <option value="" disabled selected>Pilih transmisi</option>
                                <option value="manual">Manual</option>
                                <option value="matic">Matic</option>
                            </select>
                        </div>

                        {{-- Jenis BBM --}}
                        <div class="col-md-6 mb-3">
                            <label for="fuel_type" class="form-label fw-semibold">Jenis BBM</label>
                            <select name="fuel_type" id="fuel_type" class="form-select" required>
                                <option value="" disabled selected>Pilih jenis BBM</option>
                                <option value="pertalite">Pertalite</option>
                                <option value="pertamax">Pertamax</option>
                                <option value="solar">Solar</option>
                                <option value="listrik">Listrik</option>
                            </select>
                        </div>

                        {{-- Gambar --}}
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label fw-semibold">Foto Kendaraan</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, max 2MB</small>
                        </div>

                        {{-- Catatan --}}
                        <div class="col-md-12 mb-3">
                            <label for="notes" class="form-label fw-semibold">Catatan</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control" placeholder="Tambahkan catatan tambahan jika ada..."></textarea>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Kendaraan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
