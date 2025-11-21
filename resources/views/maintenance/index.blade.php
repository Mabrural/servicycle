@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Perawatan Kendaraan <i class="bx bx-crown text-warning"></i></h3>
            <p class="text-muted mb-0">Pantau kondisi kendaraan Anda dengan cerdas—dari pengingat servis hingga analisa performa.</p>
        </div>

        <a href="#" class="btn btn-warning text-dark fw-semibold shadow-sm">
            <i class="bx bx-rocket"></i> Upgrade Premium
        </a>
    </div>

    {{-- Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kategori Perawatan</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Pengingat Servis</option>
                        <option>Oli & Pelumas</option>
                        <option>Ban & Rem</option>
                        <option>Tune Up</option>
                        <option>Perawatan Lainnya</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Penting</option>
                        <option>Segera</option>
                        <option>Selesai</option>
                    </select>
                </div>

                <div class="col-md-4 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-filter"></i> Terapkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Perawatan --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">
            <span>Daftar Perawatan Kendaraan</span>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>

        <div class="list-group list-group-flush">

            {{-- Item 1: Pengingat Servis --}}
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-start bg-light">
                <div class="me-3">
                    <div class="fw-semibold">
                        Pengingat Servis – Toyota Avanza
                        <span class="badge bg-warning text-dark">Premium</span>
                    </div>
                    <small class="text-muted d-block">Estimasi servis berikutnya: 25 Okt 2025 • 09:00</small>
                    <small class="text-muted">Odometer terakhir: 42.300 km</small>
                </div>
                <span class="badge bg-primary rounded-pill">Segera</span>
            </div>

            {{-- Item 2: Ganti Oli --}}
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div class="me-3">
                    <div class="fw-semibold text-success">
                        Ganti Oli – Honda Beat
                    </div>
                    <small class="text-muted">Terakhir dilakukan: 15 Okt 2025 • 38.200 km</small>
                </div>
                <span class="text-muted small">Selesai</span>
            </div>

            {{-- Item 3: Analisa Performa --}}
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div class="me-3">
                    <div class="fw-semibold text-info">
                        Analisa Performa – Yamaha NMAX
                        <span class="badge bg-warning text-dark">Premium</span>
                    </div>
                    <small class="text-muted">Efisiensi BBM menurun 15% — Perlu pengecekan.</small>
                </div>
                <span class="text-muted small">1 jam lalu</span>
            </div>

            {{-- Item 4: Perawatan Ban --}}
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div class="me-3">
                    <div class="fw-semibold text-danger">
                        Perawatan Ban – Mitsubishi Xpander
                    </div>
                    <small class="text-muted">Usia ban 2 tahun. Disarankan cek tekanan & kondisi.</small>
                </div>
                <span class="badge bg-danger rounded-pill">Penting</span>
            </div>

        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–4 dari 12 perawatan</span>
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
@endsection
