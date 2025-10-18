@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Promosi & Event Bengkel</h3>
            <p class="text-muted mb-0">Kelola promo menarik dan event spesial untuk pelanggan Anda.</p>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahPromoModal">
            <i class="fas fa-plus-circle"></i> Tambah Promo Baru
        </button>
    </div>

    {{-- Info / Highlight --}}
    <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
        <i class="fas fa-megaphone-fill me-2 fs-5"></i>
        <div>
            Promo yang aktif akan otomatis muncul di halaman utama pelanggan 🚗💨
        </div>
    </div>

    {{-- Daftar Promo --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">
            🎉 Daftar Promosi Aktif
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Promo</th>
                        <th>Deskripsi</th>
                        <th>Periode</th>
                        <th>Diskon</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh Data Promo --}}
                    <tr>
                        <td>1</td>
                        <td><strong>Servis Akhir Tahun</strong></td>
                        <td>Diskon 25% untuk servis mobil dan motor hingga 31 Desember.</td>
                        <td>1 Nov – 31 Des 2025</td>
                        <td><span class="badge bg-success">25%</span></td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailPromoModal" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusPromoModal" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>Gratis Ganti Oli!</strong></td>
                        <td>Setiap pembelian ban minimal 2 unit, gratis oli 1L.</td>
                        <td>10 – 25 Okt 2025</td>
                        <td><span class="badge bg-primary">Gratis Oli</span></td>
                        <td><span class="badge bg-secondary">Berakhir</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary disabled">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–2 dari 10 promo</span>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                </ul>
            </nav>
        </div>
    </div>

    {{-- Modal: Tambah Promo --}}
    <div class="modal fade" id="tambahPromoModal" tabindex="-1" aria-labelledby="tambahPromoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="tambahPromoLabel">Tambah Promo Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Promo</label>
                        <input type="text" class="form-control" placeholder="Contoh: Promo Ganti Oli Akhir Tahun">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" rows="3" placeholder="Tuliskan detail promosi di sini..."></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Berakhir</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Jenis Diskon</label>
                        <select class="form-select">
                            <option>Potongan Persentase (%)</option>
                            <option>Potongan Nominal (Rp)</option>
                            <option>Bonus / Gratis Produk</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Nilai Diskon</label>
                        <input type="text" class="form-control" placeholder="Contoh: 20% atau Rp 50.000">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Promo</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal: Detail Promo --}}
    <div class="modal fade" id="detailPromoModal" tabindex="-1" aria-labelledby="detailPromoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="detailPromoLabel">Detail Promo: Servis Akhir Tahun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Deskripsi:</strong> Dapatkan potongan harga 25% untuk semua jenis servis mobil dan motor hingga 31 Desember 2025.</p>
                    <p><strong>Periode:</strong> 1 November – 31 Desember 2025</p>
                    <p><strong>Diskon:</strong> 25%</p>
                    <p><strong>Status:</strong> Aktif</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-warning"><i class="fas fa-pencil"></i> Edit Promo</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Hapus Promo --}}
    <div class="modal fade" id="hapusPromoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Hapus Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus promo ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
