@extends('layouts.main')
@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Header Profil Bengkel -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <img src="{{ asset('img/bengkel-mobil.jpeg') }}" 
                             alt="Workshop Logo" 
                             class="rounded-circle me-3" 
                             width="90" height="90">
                        <div>
                            <h4 class="text-primary mb-1 fw-bold">Bengkel Jaya Motor</h4>
                            <p class="mb-0 text-muted">“Servis cepat, hasil mantap 🚗”</p>
                        </div>
                    </div>
                    <a href="#editProfileModal" data-bs-toggle="modal" class="btn btn-primary">
                        <i class="bx bx-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Informasi Bengkel -->
        <div class="col-md-8 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary"><i class="bx bx-info-circle"></i> Informasi Bengkel</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Nama Bengkel</h6>
                        <p class="text-muted">Bengkel Jaya Motor</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Alamat</h6>
                        <p class="text-muted">Jl. Ahmad Yani No. 45, Batam Kota</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Nomor Telepon</h6>
                        <p class="text-muted">+62 812 3456 7890</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Jam Operasional</h6>
                        <p class="text-muted">Senin - Sabtu, 08:00 - 17:00</p>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Deskripsi</h6>
                        <p class="text-muted">
                            Bengkel kami melayani servis kendaraan motor dan mobil dengan tenaga ahli profesional
                            dan harga terjangkau. Kami juga menyediakan layanan booking online untuk memudahkan pelanggan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Kinerja (Business Intelligence Mini Dashboard) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary"><i class="bx bx-bar-chart"></i> Statistik Bengkel</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-label-primary p-3 me-3"><i class="bx bx-wrench fs-4"></i></span>
                        <div>
                            <h6 class="mb-0 fw-semibold">Servis Bulan Ini</h6>
                            <small class="text-muted">35 kendaraan</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-label-success p-3 me-3"><i class="bx bx-user fs-4"></i></span>
                        <div>
                            <h6 class="mb-0 fw-semibold">Pelanggan Baru</h6>
                            <small class="text-muted">+12 pelanggan</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-label-info p-3 me-3"><i class="bx bx-dollar fs-4"></i></span>
                        <div>
                            <h6 class="mb-0 fw-semibold">Pendapatan Bulan Ini</h6>
                            <small class="text-muted">Rp 8.500.000</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="/" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editProfileLabel"><i class="bx bx-edit-alt"></i> Edit Profil Bengkel</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Bengkel</label>
                                <input type="text" name="name" class="form-control" value="Bengkel Jaya Motor" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control" value="+62 812 3456 7890">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea name="address" class="form-control" rows="2" required>Jl. Ahmad Yani No. 45, Batam Kota</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jam Operasional</label>
                                <input type="text" name="hours" class="form-control" value="08:00 - 17:00">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Logo / Foto Bengkel</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3">Bengkel kami melayani servis kendaraan motor dan mobil...</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
