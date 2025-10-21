@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <div class="col-lg-8 col-md-12 order-0">
            <!-- Profil Bengkel -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    <img src="{{ asset('img/bengkel-mobil.jpeg') }}" alt="Workshop Photo"
                        class="rounded-3 mb-3 mb-md-0 me-md-4"
                        style="width: 150px; height: 150px; object-fit: cover; object-position: center;">
                    
                    <div class="w-100">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h4 class="card-title mb-1">Bengkel Maju Jaya</h4>
                                <p class="mb-1 text-muted">Spesialis Mobil dan Motor</p>
                                <span class="badge bg-success mb-2 mb-md-0">Approved</span>
                            </div>
                            <a href="#" class="btn btn-sm btn-warning mt-2 mt-md-0">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data
                            </a>
                        </div>

                        <p class="mt-3 mb-1"><i class="fa-solid fa-phone"></i> 0812-3456-7890</p>
                        <p class="mb-0"><i class="fa-solid fa-envelope"></i> bengkelmajujaya@gmail.com</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Umum -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Umum</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <p><strong>Nama Bengkel:</strong> Bengkel Maju Jaya</p>
                            <p><strong>Jenis Bengkel:</strong> Mobil, Motor</p>
                            <p><strong>Alamat:</strong> Jl. Sudirman No. 123, Batam Center</p>
                            <p><strong>Provinsi:</strong> Kepulauan Riau</p>
                        </div>
                        <div class="col-12 col-sm-6">
                            <p><strong>Kota:</strong> Batam</p>
                            <p><strong>Kecamatan:</strong> Batam Kota</p>
                            <p><strong>Kelurahan:</strong> Baloi Permai</p>
                            <p><strong>Kode Pos:</strong> 29444</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Layanan & Spesialisasi -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Layanan & Spesialisasi</h5>
                </div>
                <div class="card-body">
                    <p><strong>Layanan:</strong></p>
                    <ul class="mb-3">
                        <li>Ganti Oli</li>
                        <li>Servis Mesin</li>
                        <li>Balancing & Spooring</li>
                    </ul>
                    <p><strong>Spesialisasi:</strong> Mobil Jepang dan Motor Matic</p>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Jam Operasional</h5>
                </div>
                <div class="card-body">
                    <p><strong>Senin - Sabtu:</strong> 08.00 - 17.00</p>
                    <p><strong>Minggu:</strong> Tutup</p>
                </div>
            </div>

            <!-- Deskripsi Bengkel -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Deskripsi Bengkel</h5>
                </div>
                <div class="card-body">
                    <p>
                        Bengkel Maju Jaya telah berdiri sejak tahun 2015 dan berfokus pada perawatan kendaraan roda dua dan roda empat. 
                        Dilengkapi dengan mekanik berpengalaman serta alat modern untuk menjamin kualitas servis terbaik bagi pelanggan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="col-lg-4 col-md-12">
            <!-- Lokasi -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Lokasi Bengkel</h5>
                </div>
                <div class="card-body">
                    <p><strong>Latitude:</strong> 1.123456</p>
                    <p><strong>Longitude:</strong> 104.123456</p>
                    <div class="ratio ratio-4x3">
                        <iframe src="https://www.google.com/maps?q=1.123456,104.123456&hl=id&z=14&output=embed" 
                                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Galeri -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Galeri Bengkel</h5>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="col-6 col-md-6">
                            <img src="{{ asset('img/bengkel-mobil.jpeg') }}" 
                                class="img-fluid rounded w-100" 
                                style="object-fit: cover; height: 120px;">
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
