@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Notifikasi Servis</h3>
            <p class="text-muted mb-0">Pantau semua pembaruan dan pemberitahuan terkait servis kendaraan Anda.</p>
        </div>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-check2-all"></i> Tandai Semua Dibaca
        </button>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Jenis Notifikasi</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Pengingat Servis</option>
                        <option>Konfirmasi Jadwal</option>
                        <option>Status Pengerjaan</option>
                        <option>Pembatalan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Belum Dibaca</option>
                        <option>Sudah Dibaca</option>
                    </select>
                </div>
                <div class="col-md-4 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-funnel"></i> Terapkan Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Notifikasi --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">
            <span>🔔 Daftar Notifikasi</span>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>

        <div class="list-group list-group-flush">
            {{-- Notifikasi Belum Dibaca --}}
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start bg-light">
                <div class="me-auto">
                    <div class="fw-semibold">📅 Pengingat Servis Toyota Avanza</div>
                    <small class="text-muted">Servis rutin dijadwalkan pada 25 Okt 2025 pukul 09:00 WIB.</small>
                </div>
                <span class="badge bg-primary rounded-pill">Baru</span>
            </a>

            {{-- Notifikasi Sudah Dibaca --}}
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-semibold">✅ Servis Honda Beat Telah Selesai</div>
                    <small class="text-muted">Servis oli Anda selesai pada 15 Okt 2025.</small>
                </div>
                <span class="text-muted small">2 hari lalu</span>
            </a>

            {{-- Notifikasi Pembatalan --}}
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-semibold text-danger">❌ Jadwal Servis Mitsubishi Xpander Dibatalkan</div>
                    <small class="text-muted">Jadwal tanggal 30 Okt 2025 telah dibatalkan oleh bengkel.</small>
                </div>
                <span class="text-muted small">3 hari lalu</span>
            </a>

            {{-- Notifikasi Status Pengerjaan --}}
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-semibold text-warning">🛠️ Servis Yamaha NMAX Sedang Dikerjakan</div>
                    <small class="text-muted">Estimasi selesai pukul 16:00 WIB.</small>
                </div>
                <span class="text-muted small">1 jam lalu</span>
            </a>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–4 dari 24 notifikasi</span>
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
