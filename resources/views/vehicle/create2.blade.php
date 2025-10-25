@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0"><strong>Tambah Kendaraan</strong></h1>
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

            {{-- Form Tambah Kendaraan --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row g-3">

                            {{-- Jenis Kendaraan --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kendaraan</label>
                                <select name="vehicle_type" class="form-select @error('vehicle_type') is-invalid @enderror">
                                    <option value="">Pilih jenis</option>
                                    <option value="mobil" {{ old('vehicle_type') == 'mobil' ? 'selected' : '' }}>Mobil
                                    </option>
                                    <option value="motor" {{ old('vehicle_type') == 'motor' ? 'selected' : '' }}>Motor
                                    </option>
                                </select>
                                @error('vehicle_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Merek --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Merek</label>
                                <input type="text" name="brand" value="{{ old('brand') }}"
                                    class="form-control @error('brand') is-invalid @enderror" placeholder="Contoh: Toyota">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Model --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Model</label>
                                <input type="text" name="model" value="{{ old('model') }}"
                                    class="form-control @error('model') is-invalid @enderror" placeholder="Contoh: Avanza">
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tahun --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tahun</label>
                                <input type="number" name="year" value="{{ old('year') }}"
                                    class="form-control @error('year') is-invalid @enderror" min="1990"
                                    max="{{ date('Y') + 1 }}">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Plat Nomor --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor Plat</label>
                                <input type="text" name="license_plate" value="{{ old('license_plate') }}"
                                    class="form-control @error('license_plate') is-invalid @enderror"
                                    placeholder="Contoh: BP 1234 XY">
                                @error('license_plate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nomor Rangka (VIN) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor Rangka (VIN)</label>
                                <input type="text" name="vin" value="{{ old('vin') }}"
                                    class="form-control @error('vin') is-invalid @enderror" placeholder="Opsional">
                                @error('vin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Warna --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Warna</label>
                                <input type="text" name="color" value="{{ old('color') }}"
                                    class="form-control @error('color') is-invalid @enderror"
                                    placeholder="Contoh: Hitam / Merah">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kapasitas Mesin --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kapasitas Mesin (cc)</label>
                                <input type="number" name="engine_capacity" value="{{ old('engine_capacity') }}"
                                    class="form-control @error('engine_capacity') is-invalid @enderror"
                                    placeholder="Contoh: 1500">
                                @error('engine_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Transmisi --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Transmisi</label>
                                <select name="transmission" class="form-select @error('transmission') is-invalid @enderror">
                                    <option value="">Pilih transmisi</option>
                                    <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual
                                    </option>
                                    <option value="matic" {{ old('transmission') == 'matic' ? 'selected' : '' }}>Matic
                                    </option>
                                </select>
                                @error('transmission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jenis BBM --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis BBM</label>
                                <select name="fuel_type" class="form-select @error('fuel_type') is-invalid @enderror">
                                    <option value="">Pilih jenis BBM</option>
                                    <option value="pertalite" {{ old('fuel_type') == 'pertalite' ? 'selected' : '' }}>
                                        Pertalite</option>
                                    <option value="pertamax" {{ old('fuel_type') == 'pertamax' ? 'selected' : '' }}>
                                        Pertamax</option>
                                    <option value="solar" {{ old('fuel_type') == 'solar' ? 'selected' : '' }}>Solar
                                    </option>
                                    <option value="listrik" {{ old('fuel_type') == 'listrik' ? 'selected' : '' }}>Listrik
                                    </option>
                                </select>
                                @error('fuel_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gambar --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Foto Kendaraan</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, max 2MB</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Catatan --}}
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Catatan</label>
                                <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="Tambahkan catatan tambahan jika ada...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
