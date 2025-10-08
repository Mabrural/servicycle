@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4">🚗 Manajemen Kendaraan</h4>

    <div class="row" id="vehicleCards">

        <!-- Card Kendaraan 1 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Gambar Kendaraan">
                <div class="card-body">
                    <h5 class="card-title">Honda Beat</h5>
                    <p class="card-text mb-2"><strong>Nomor Polisi:</strong> BP 1234 XY</p>
                    <p class="card-text mb-2"><strong>Tipe:</strong> Motor</p>
                    <p class="card-text mb-2"><strong>Merek / Model:</strong> Honda Beat Street</p>
                    <p class="card-text"><strong>Servis Terakhir:</strong> 10 September 2025</p>

                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Kendaraan 2 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Gambar Kendaraan">
                <div class="card-body">
                    <h5 class="card-title">Toyota Avanza</h5>
                    <p class="card-text mb-2"><strong>Nomor Polisi:</strong> BP 5678 ZA</p>
                    <p class="card-text mb-2"><strong>Tipe:</strong> Mobil</p>
                    <p class="card-text mb-2"><strong>Merek / Model:</strong> Toyota Avanza G</p>
                    <p class="card-text"><strong>Servis Terakhir:</strong> 20 Agustus 2025</p>

                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Kendaraan 3 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Gambar Kendaraan">
                <div class="card-body">
                    <h5 class="card-title">Yamaha NMAX</h5>
                    <p class="card-text mb-2"><strong>Nomor Polisi:</strong> BP 9090 YY</p>
                    <p class="card-text mb-2"><strong>Tipe:</strong> Motor</p>
                    <p class="card-text mb-2"><strong>Merek / Model:</strong> Yamaha NMAX ABS</p>
                    <p class="card-text"><strong>Servis Terakhir:</strong> 5 September 2025</p>

                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Tombol Kembali ke Dashboard -->
    <div class="text-center mt-4">
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
