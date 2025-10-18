@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manajemen Booking Servis</h3>
            <p class="text-muted mb-0">Pantau dan kelola semua booking servis kendaraan pelanggan.</p>
        </div>
        <button class="btn btn-outline-secondary btn-sm" id="refreshButton">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status Booking</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Menunggu Konfirmasi</option>
                        <option>Diterima</option>
                        <option>Dalam Proses</option>
                        <option>Selesai</option>
                        <option>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Booking</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cari Nama / Plat Nomor</label>
                    <input type="text" class="form-control" placeholder="Contoh: Andi / BM 1234 XY">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Booking Servis --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            📅 Daftar Booking Servis
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Kendaraan</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Servis</th>
                        <th>Waktu Booking</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh Data --}}
                    <tr>
                        <td>1</td>
                        <td><strong>Andi Pratama</strong><br><small class="text-muted">andi@email.com</small></td>
                        <td>Toyota Avanza</td>
                        <td>BM 1234 XY</td>
                        <td>Servis Rutin</td>
                        <td>18 Okt 2025, 10:00</td>
                        <td><span class="badge bg-warning text-dark">Menunggu Konfirmasi</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-success" title="Terima Booking">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Tolak Booking">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>Siti Rahma</strong><br><small class="text-muted">siti@email.com</small></td>
                        <td>Honda Beat</td>
                        <td>BM 5678 ZZ</td>
                        <td>Ganti Oli</td>
                        <td>17 Okt 2025, 09:30</td>
                        <td><span class="badge bg-success">Diterima</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-warning" title="Proses Servis">
                                    <i class="fas fa-tools"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong>Budi Santoso</strong><br><small class="text-muted">budi@email.com</small></td>
                        <td>Mitsubishi Xpander</td>
                        <td>BM 9001 QA</td>
                        <td>Rem & Suspensi</td>
                        <td>16 Okt 2025, 14:00</td>
                        <td><span class="badge bg-info text-dark">Dalam Proses</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-success" title="Tandai Selesai">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>Dewi Ananda</strong><br><small class="text-muted">dewi@email.com</small></td>
                        <td>Yamaha NMAX</td>
                        <td>BM 2233 JJ</td>
                        <td>Servis Mesin</td>
                        <td>14 Okt 2025, 11:00</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>Rudi Saputra</strong><br><small class="text-muted">rudi@email.com</small></td>
                        <td>Daihatsu Terios</td>
                        <td>BM 3344 AB</td>
                        <td>Ganti Ban</td>
                        <td>13 Okt 2025, 15:00</td>
                        <td><span class="badge bg-danger">Dibatalkan</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary disabled" title="Tidak tersedia">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–5 dari 87 booking</span>
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

    {{-- Modal Konfirmasi Aksi --}}
    <div class="modal fade" id="confirmActionModal" tabindex="-1" aria-labelledby="confirmActionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="#">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="confirmActionLabel">Konfirmasi Aksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin melakukan tindakan ini terhadap booking ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
