@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><strong>Detail</strong> Kendaraan</h1>
            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Detail Kendaraan --}}
        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <img src="{{ $vehicle->image_url }}" 
                         alt="{{ $vehicle->full_name }}" 
                         class="img-fluid w-100" 
                         style="object-fit: cover; height: 350px;">

                    <div class="card-body text-center">
                        <h4 class="fw-bold mb-1">{{ $vehicle->full_name }}</h4>
                        <span class="badge bg-primary me-1">{{ $vehicle->vehicle_type_indo }}</span>
                        <span class="badge bg-info me-1">{{ ucfirst($vehicle->transmission_indo) }}</span>
                        <span class="badge bg-success">{{ $vehicle->fuel_type_indo }}</span>
                        <hr>
                        <p class="text-muted mb-0">
                            <i class="bi bi-person-circle me-1"></i> 
                            Pemilik: {{ $vehicle->creator->name ?? 'Tidak Diketahui' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">
                        <i class="bi bi-info-circle me-1"></i> Informasi Kendaraan
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <th class="text-muted" style="width: 35%;">Merek</th>
                                <td>{{ $vehicle->brand }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Model</th>
                                <td>{{ $vehicle->model }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Tahun</th>
                                <td>{{ $vehicle->year }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Nomor Plat</th>
                                <td><span class="badge bg-dark fs-6">{{ strtoupper($vehicle->license_plate) }}</span></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Nomor Rangka (VIN)</th>
                                <td>{{ $vehicle->vin ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Warna</th>
                                <td>{{ ucfirst($vehicle->color ?? '-') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Kapasitas Mesin</th>
                                <td>{{ $vehicle->engine_capacity ? $vehicle->engine_capacity . ' cc' : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Transmisi</th>
                                <td>{{ $vehicle->transmission_indo }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Jenis BBM</th>
                                <td>{{ $vehicle->fuel_type_indo }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Catatan</th>
                                <td>{{ $vehicle->notes ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning me-2">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
