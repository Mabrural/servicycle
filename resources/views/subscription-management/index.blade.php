@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manajemen Paket & Langganan Pengguna</h3>
            <p class="text-muted mb-0">Kelola paket langganan ServiCycle Premium dan pantau aktivitas pengguna yang berlangganan.</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPaketModal">
            <i class="bi bi-plus-circle"></i> Tambah Paket Baru
        </button>
    </div>

    {{-- Section: Paket Premium --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
            <span>📦 Daftar Paket Langganan</span>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Paket</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th>Deskripsi Singkat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Paket Bulanan</td>
                        <td>30 Hari</td>
                        <td>Rp49.000</td>
                        <td>Cocok untuk pengguna baru.</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPaketModal"><i class="fas fa-edit fa-sm"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Paket Tahunan</td>
                        <td>365 Hari</td>
                        <td>Rp499.000</td>
                        <td>Premium sepanjang tahun.</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPaketModal"><i class="fas fa-edit fa-sm"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section: Riwayat Langganan Pengguna --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
            <span>👥 Riwayat Langganan Pengguna</span>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Paket</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal Pembelian</th>
                        <th>Berlaku Hingga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Isyabel Salsabilla</td>
                        <td>isyabel@example.com</td>
                        <td>Paket Tahunan</td>
                        <td>DANA</td>
                        <td>Rp499.000</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>25 Okt 2025</td>
                        <td>25 Okt 2026</td>
                    </tr>
                    <tr>
                        <td>Hendry Zhang</td>
                        <td>hendry@example.com</td>
                        <td>Paket Bulanan</td>
                        <td>GoPay</td>
                        <td>Rp49.000</td>
                        <td><span class="badge bg-secondary">Kedaluwarsa</span></td>
                        <td>20 Sep 2025</td>
                        <td>20 Okt 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Modal: Tambah Paket --}}
<div class="modal fade" id="tambahPaketModal" tabindex="-1" aria-labelledby="tambahPaketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="tambahPaketModalLabel">Tambah Paket Langganan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Paket</label>
                            <input type="text" class="form-control" placeholder="Contoh: Paket Bulanan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Durasi (hari)</label>
                            <input type="number" class="form-control" placeholder="30" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" class="form-control" placeholder="49000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" required>
                                <option selected>Aktif</option>
                                <option>Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan deskripsi singkat paket..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Paket</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal: Edit Paket --}}
<div class="modal fade" id="editPaketModal" tabindex="-1" aria-labelledby="editPaketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editPaketModalLabel">Edit Paket Langganan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Paket</label>
                            <input type="text" class="form-control" value="Paket Bulanan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Durasi (hari)</label>
                            <input type="number" class="form-control" value="30" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" class="form-control" value="49000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select">
                                <option selected>Aktif</option>
                                <option>Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" rows="3">Cocok untuk pengguna baru.</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
