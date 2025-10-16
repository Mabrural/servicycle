@extends('layouts.main')


@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <h1 class="h3 mb-3"><strong>Kendaraan</strong> Saya</h1>

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <input type="text" class="form-control form-control-sm" placeholder="Cari kendaraan..." style="width: 250px;">
            </div>
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-sm d-flex align-items-center">
    <i class="fa-solid fa-circle-plus me-1"></i> Tambah Kendaraan
    <span class="badge ms-2 d-flex align-items-center" 
          style="background: linear-gradient(90deg, #FFD700, #FFB300); color: #000;">
        <i class="fa-solid fa-crown me-1"></i> VIP
    </span>
</a>

        </div>

        {{-- Daftar Kendaraan --}}
        <div class="row">
            {{-- Contoh data statis sementara --}}
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="bi bi-car-front-fill fs-1 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Toyota Avanza</h5>
                                <small class="text-muted">Plat: BP 1234 XY</small>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-3">
                            <li><i class="bi bi-speedometer2 text-muted me-2"></i> Tahun: 2020</li>
                            <li><i class="bi bi-gear-wide-connected text-muted me-2"></i> Transmisi: Manual</li>
                            <li><i class="bi bi-fuel-pump text-muted me-2"></i> BBM: Pertalite</li>
                        </ul>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vehicles.show', 1) }}" class="btn btn-outline-primary btn-sm w-50 me-2">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                            <a href="{{ route('vehicles.edit', 1) }}" class="btn btn-outline-warning btn-sm w-50">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="bi bi-bicycle fs-1 text-info"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Honda Beat</h5>
                                <small class="text-muted">Plat: BP 6789 ZT</small>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-3">
                            <li><i class="bi bi-speedometer2 text-muted me-2"></i> Tahun: 2021</li>
                            <li><i class="bi bi-gear-wide-connected text-muted me-2"></i> Transmisi: Matic</li>
                            <li><i class="bi bi-fuel-pump text-muted me-2"></i> BBM: Pertamax</li>
                        </ul>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vehicles.show', 2) }}" class="btn btn-outline-primary btn-sm w-50 me-2">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                            <a href="{{ route('vehicles.edit', 2) }}" class="btn btn-outline-warning btn-sm w-50">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tambahkan kendaraan lain di sini --}}
        </div>

    </div>
</div>
@endsection
