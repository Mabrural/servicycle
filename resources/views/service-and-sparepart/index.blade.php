@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manajemen Servis & Sparepart</h3>
            <p class="text-muted mb-0">Atur daftar layanan servis dan sparepart yang tersedia di bengkel Anda.</p>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- Bagian 1: Jenis Servis --}}
    {{-- ============================= --}}
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-bold">🛠️ Daftar Jenis Servis</span>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="fas fa-plus-circle"></i> Tambah Servis
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Servis</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Estimasi Waktu</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong>Servis Rutin</strong></td>
                        <td>Perawatan Berkala</td>
                        <td>Rp 250.000</td>
                        <td>1 jam 30 menit</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editServiceModal">
                                    <i class="fas fa-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteServiceModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>Ganti Oli</strong></td>
                        <td>Pelumas</td>
                        <td>Rp 100.000</td>
                        <td>30 menit</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editServiceModal">
                                    <i class="fas fa-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteServiceModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–2 dari 12 jenis servis</span>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">›</a></li>
            </ul>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- Bagian 2: Sparepart --}}
    {{-- ============================= --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-bold">⚙️ Daftar Sparepart</span>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSparepartModal">
                <i class="fas fa-plus-circle"></i> Tambah Sparepart
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Sparepart</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong>Busi NGK</strong></td>
                        <td>Mesin</td>
                        <td>Rp 35.000</td>
                        <td>20</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSparepartModal">
                                    <i class="fas fa-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteSparepartModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>Oli Yamalube</strong></td>
                        <td>Pelumas</td>
                        <td>Rp 50.000</td>
                        <td>15</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSparepartModal">
                                    <i class="fas fa-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteSparepartModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <span class="text-muted small">Menampilkan 1–2 dari 8 sparepart</span>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">›</a></li>
            </ul>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MODAL: SERVIS --}}
    {{-- ============================= --}}
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="#">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addServiceLabel">Tambah Jenis Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Servis</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estimasi Waktu</label>
                        <input type="text" class="form-control" placeholder="Contoh: 1 jam 30 menit" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Jenis Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nama Servis</label>
                    <input type="text" class="form-control" value="Servis Rutin">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Hapus Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin menghapus jenis servis ini?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MODAL: SPAREPART --}}
    {{-- ============================= --}}
    <div class="modal fade" id="addSparepartModal" tabindex="-1" aria-labelledby="addSparepartLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="#">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addSparepartLabel">Tambah Sparepart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Sparepart</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editSparepartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Sparepart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nama Sparepart</label>
                    <input type="text" class="form-control" value="Busi NGK">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteSparepartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Hapus Sparepart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin menghapus sparepart ini?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
