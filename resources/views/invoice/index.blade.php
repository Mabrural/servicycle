@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manajemen Invoice Servis</h3>
            <p class="text-muted mb-0">Lihat dan kelola semua invoice hasil servis pelanggan.</p>
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
                    <label class="form-label fw-semibold">Status Pembayaran</label>
                    <select class="form-select">
                        <option>Semua</option>
                        <option>Lunas</option>
                        <option>Belum Lunas</option>
                        <option>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Invoice</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cari Nama / Nomor Invoice</label>
                    <input type="text" class="form-control" placeholder="Contoh: Andi / INV-0012">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Invoice --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            💳 Daftar Invoice Servis
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>No. Invoice</th>
                        <th>Pelanggan</th>
                        <th>Kendaraan</th>
                        <th>Jenis Servis</th>
                        <th>Tanggal Servis</th>
                        <th>Total Biaya</th>
                        <th>Status Pembayaran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh Data --}}
                    <tr>
                        <td>1</td>
                        <td><strong>INV-0012</strong></td>
                        <td><strong>Andi Pratama</strong><br><small class="text-muted">andi@email.com</small></td>
                        <td>Toyota Avanza</td>
                        <td>Servis Rutin + Ganti Oli</td>
                        <td>18 Okt 2025</td>
                        <td><strong>Rp 350.000</strong></td>
                        <td><span class="badge bg-success">Lunas</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailInvoiceModal" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" title="Cetak Invoice">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteInvoiceModal" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>INV-0013</strong></td>
                        <td><strong>Siti Rahma</strong><br><small class="text-muted">siti@email.com</small></td>
                        <td>Honda Beat</td>
                        <td>Ganti Ban + Servis Ringan</td>
                        <td>17 Okt 2025</td>
                        <td><strong>Rp 270.000</strong></td>
                        <td><span class="badge bg-warning text-dark">Belum Lunas</span></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-success" title="Tandai Lunas">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailInvoiceModal" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong>INV-0014</strong></td>
                        <td><strong>Budi Santoso</strong><br><small class="text-muted">budi@email.com</small></td>
                        <td>Mitsubishi Xpander</td>
                        <td>Perbaikan Rem & Suspensi</td>
                        <td>16 Okt 2025</td>
                        <td><strong>Rp 1.200.000</strong></td>
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
            <span class="text-muted small">Menampilkan 1–3 dari 45 invoice</span>
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

    {{-- Modal Detail Invoice --}}
    <div class="modal fade" id="detailInvoiceModal" tabindex="-1" aria-labelledby="detailInvoiceLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="detailInvoiceLabel">Detail Invoice #INV-0012</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Pelanggan</h6>
                            <p class="mb-0">Andi Pratama</p>
                            <small class="text-muted">andi@email.com</small>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="fw-bold">Tanggal Servis</h6>
                            <p>18 Oktober 2025</p>
                        </div>
                    </div>
                    <hr>
                    <h6 class="fw-bold mb-3">Detail Servis</h6>
                    <table class="table table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Deskripsi</th>
                                <th class="text-end">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Servis Rutin</td>
                                <td class="text-end">Rp 250.000</td>
                            </tr>
                            <tr>
                                <td>Ganti Oli</td>
                                <td class="text-end">Rp 100.000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th class="text-end">Rp 350.000</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="text-end mt-3">
                        <span class="badge bg-success fs-6">Lunas</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary"><i class="fas fa-print"></i> Cetak Invoice</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="deleteInvoiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Hapus Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus invoice ini? Tindakan ini tidak dapat dibatalkan.
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
