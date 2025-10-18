@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Catatan Masalah Kendaraan</h3>
            <p class="text-muted mb-0">Kelola dan pantau semua catatan masalah kendaraan Anda sebelum dan sesudah servis.</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMasalahModal">
            <i class="bi bi-plus-circle"></i> Tambah Catatan
        </button>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kendaraan</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Toyota Avanza</option>
                        <option>Honda Beat</option>
                        <option>Yamaha NMAX</option>
                        <option>Mitsubishi Xpander</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Belum Ditangani</option>
                        <option>Dalam Proses</option>
                        <option>Selesai</option>
                    </select>
                </div>
                <div class="col-md-4 d-grid">
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-funnel"></i> Terapkan Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Catatan Masalah --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">
            <span>🧾 Daftar Catatan Masalah</span>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>

        <div class="list-group list-group-flush">
            {{-- Masalah Belum Ditangani --}}
            <div class="list-group-item d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-semibold text-danger">🚗 Toyota Avanza — Rem Berbunyi</div>
                    <small class="text-muted">Diketahui sejak 10 Okt 2025. Perlu pemeriksaan kampas rem.</small>
                </div>
                <span class="badge bg-danger rounded-pill">Belum Ditangani</span>
            </div>

            {{-- Masalah Dalam Proses --}}
            <div class="list-group-item d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-semibold text-warning">🏍️ Yamaha NMAX — Oli Bocor</div>
                    <small class="text-muted">Sedang diperiksa di bengkel — Estimasi selesai besok.</small>
                </div>
                <span class="badge bg-warning text-dark rounded-pill">Dalam Proses</span>
            </div>

            {{-- Masalah Selesai --}}
            <div class="list-group-item d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-semibold text-success">🚙 Honda CR-V — Mesin Kasar</div>
                    <small class="text-muted">Sudah diperbaiki dan diuji pada 12 Okt 2025.</small>
                </div>
                <span class="badge bg-success rounded-pill">Selesai</span>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–3 dari 12 catatan</span>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                </ul>
            </nav>
        </div>
    </div>

</div>

{{-- Modal Tambah Catatan Masalah --}}
<div class="modal fade" id="tambahMasalahModal" tabindex="-1" aria-labelledby="tambahMasalahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="tambahMasalahModalLabel">Tambah Catatan Masalah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Kendaraan</label>
                        <select class="form-select" required>
                            <option disabled selected>Pilih kendaraan...</option>
                            <option>Toyota Avanza</option>
                            <option>Honda Beat</option>
                            <option>Yamaha NMAX</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Masalah</label>
                        <input type="text" class="form-control" placeholder="Contoh: Mesin mengeluarkan suara aneh" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Masalah</label>
                        <textarea class="form-control" rows="4" placeholder="Jelaskan secara singkat masalah yang dialami..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select">
                            <option>Belum Ditangani</option>
                            <option>Dalam Proses</option>
                            <option>Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
