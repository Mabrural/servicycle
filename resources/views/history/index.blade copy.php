@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Riwayat Servis Kendaraan</h3>
            <p class="text-muted mb-0">Lihat daftar riwayat perawatan dan servis kendaraan Anda.</p>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Periode</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Bulan ini</option>
                        <option>3 bulan terakhir</option>
                        <option>6 bulan terakhir</option>
                        <option>Tahun ini</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status Servis</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Selesai</option>
                        <option>Proses</option>
                        <option>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cari Kendaraan / Plat</label>
                    <input type="text" class="form-control" placeholder="Contoh: BM 1234 XY atau Avanza">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Riwayat Servis --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">
            <span>🧾 Daftar Riwayat Servis</span>
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
                        <th>Status</th>
                        <th>Tanggal Servis</th>
                        <th>Total Biaya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Toyota Avanza</td>
                        <td>BM 1234 XY</td>
                        <td>Servis Rutin</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                        <td>15 Okt 2025</td>
                        <td>Rp 750.000</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Honda Beat</td>
                        <td>BM 5678 ZZ</td>
                        <td>Ganti Oli</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                        <td>12 Okt 2025</td>
                        <td>Rp 150.000</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Mitsubishi Xpander</td>
                        <td>BM 9001 QA</td>
                        <td>Rem & Suspensi</td>
                        <td><span class="badge bg-warning text-dark">Proses</span></td>
                        <td>17 Okt 2025</td>
                        <td>Rp 1.250.000</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Yamaha NMAX</td>
                        <td>BM 2233 JJ</td>
                        <td>Ganti Ban</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                        <td>10 Okt 2025</td>
                        <td>Rp 400.000</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Daihatsu Terios</td>
                        <td>BM 3344 AB</td>
                        <td>Servis Mesin</td>
                        <td><span class="badge bg-danger">Dibatalkan</span></td>
                        <td>05 Okt 2025</td>
                        <td>Rp 0</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary disabled">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–5 dari 124 data</span>
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
