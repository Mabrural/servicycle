@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Jadwal Servis Kendaraan</h3>
            <p class="text-muted mb-0">Lihat dan kelola jadwal servis kendaraan Anda yang akan datang.</p>
        </div>
        <a href="#" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Periode Servis</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Minggu ini</option>
                        <option>Bulan ini</option>
                        <option>Bulan depan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status Jadwal</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Dijadwalkan</option>
                        <option>Selesai</option>
                        <option>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cari Kendaraan / Plat</label>
                    <input type="text" class="form-control" placeholder="Contoh: BM 1234 XY atau Avanza">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Jadwal Servis --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">
            <span>📅 Daftar Jadwal Servis</span>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Kendaraan</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Servis</th>
                        <th>Tanggal Jadwal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh Data Statis --}}
                    <tr>
                        <td>1</td>
                        <td>Toyota Avanza</td>
                        <td>BM 1234 XY</td>
                        <td>Servis Rutin</td>
                        <td>25 Okt 2025</td>
                        <td>09:00 WIB</td>
                        <td><span class="badge bg-info text-dark">Dijadwalkan</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Honda Beat</td>
                        <td>BM 5678 ZZ</td>
                        <td>Ganti Oli</td>
                        <td>28 Okt 2025</td>
                        <td>14:30 WIB</td>
                        <td><span class="badge bg-warning text-dark">Menunggu Konfirmasi</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Mitsubishi Xpander</td>
                        <td>BM 9001 QA</td>
                        <td>Servis Mesin</td>
                        <td>30 Okt 2025</td>
                        <td>10:00 WIB</td>
                        <td><span class="badge bg-danger">Dibatalkan</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-secondary disabled">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–3 dari 42 data</span>
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
