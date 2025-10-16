@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><strong>Tambah</strong> Kendaraan</h1>
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Form Tambah Kendaraan --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Kendaraan --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kendaraan</label>
                        <input type="text" name="nama_kendaraan" class="form-control @error('nama_kendaraan') is-invalid @enderror" placeholder="Contoh: Toyota Avanza, Honda Beat, dll" required>
                        @error('nama_kendaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nomor Plat --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Plat</label>
                        <input type="text" name="nomor_plat" class="form-control @error('nomor_plat') is-invalid @enderror" placeholder="Contoh: BP 1234 XY" required>
                        @error('nomor_plat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tahun Kendaraan --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Kendaraan</label>
                        <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" placeholder="Contoh: 2020" min="1990" max="{{ date('Y') }}" required>
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Transmisi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Transmisi</label>
                        <select name="transmisi" class="form-select @error('transmisi') is-invalid @enderror" required>
                            <option value="">-- Pilih Transmisi --</option>
                            <option value="Manual">Manual</option>
                            <option value="Matic">Matic</option>
                        </select>
                        @error('transmisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis BBM --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis BBM</label>
                        <select name="bbm" class="form-select @error('bbm') is-invalid @enderror" required>
                            <option value="">-- Pilih BBM --</option>
                            <option value="Pertalite">Pertalite</option>
                            <option value="Pertamax">Pertamax</option>
                            <option value="Solar">Solar</option>
                            <option value="Dexlite">Dexlite</option>
                        </select>
                        @error('bbm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Upload Foto Kendaraan --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Kendaraan</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Opsional — format .jpg, .png, atau .jpeg (maks 2MB)</small>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Kendaraan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
