@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <strong>Kendaraan</strong> Saya
                </h1>

                <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-sm d-flex align-items-center shadow-sm">
                    <i class="fa-solid fa-circle-plus me-1"></i> Tambah Kendaraan
                </a>
            </div>

            {{-- Pencarian --}}
            <div class="mb-4">
                <input type="text" id="searchVehicle" class="form-control form-control-sm"
                    placeholder="Cari kendaraan berdasarkan merek atau plat..." style="max-width: 350px;">
            </div>

            {{-- Daftar Kendaraan --}}
            <div class="row" id="vehicleList">
                @forelse ($vehicles as $vehicle)
                    <div class="col-md-4 mb-4 vehicle-card"
                        data-name="{{ strtolower($vehicle->brand . ' ' . $vehicle->license_plate) }}">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="position-relative">
                                <img src="{{ $vehicle->image ? url('/storage/vehicle_images/' . $vehicle->image) : asset('img/no-vehicle.jpg') }}"
                                    class="card-img-top" alt="{{ $vehicle->full_name }}"
                                    style="height: 180px; object-fit: cover;">
                                <span class="badge bg-gradient position-absolute top-0 start-0 m-2 px-3 py-2"
                                    style="background: linear-gradient(90deg, #007bff, #00c6ff);">
                                    <i
                                        class="bi {{ $vehicle->vehicle_type === 'motor' ? 'bi-bicycle' : 'bi-car-front-fill' }}"></i>
                                    {{ $vehicle->vehicle_type_indo }}
                                </span>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-1">{{ $vehicle->full_name }}</h5>
                                <small class="text-muted d-block mb-2">Plat: {{ $vehicle->license_plate }}</small>

                                <ul class="list-unstyled small mb-3">
                                    <li><i class="bi bi-palette me-2 text-muted"></i> Warna:
                                        {{ ucfirst($vehicle->color) ?? '-' }}</li>
                                    <li><i class="bi bi-gear-wide-connected me-2 text-muted"></i> Transmisi:
                                        {{ $vehicle->transmission_indo }}</li>
                                    <li><i class="bi bi-fuel-pump me-2 text-muted"></i> BBM: {{ $vehicle->fuel_type_indo }}
                                    </li>
                                    <li><i class="bi bi-speedometer2 me-2 text-muted"></i> CC:
                                        {{ $vehicle->engine_capacity ?? '-' }}</li>
                                </ul>

                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('vehicles.show', $vehicle->id) }}"
                                        class="btn btn-outline-primary btn-sm w-50 me-2">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                        class="btn btn-outline-warning btn-sm w-50">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center mt-5">
                        <img src="{{ asset('img/empty.jpg') }}" alt="No Vehicles" width="180" class="mb-3">
                        <h5 class="text-muted">Belum ada kendaraan terdaftar</h5>
                        <a href="{{ route('vehicles.create') }}" class="btn btn-primary mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Kendaraan Pertama
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    {{-- Pencarian JavaScript --}}
    <script>
        document.getElementById('searchVehicle').addEventListener('keyup', function() {
            const search = this.value.toLowerCase();
            const cards = document.querySelectorAll('.vehicle-card');
            cards.forEach(card => {
                card.style.display = card.getAttribute('data-name').includes(search) ? '' : 'none';
            });
        });
    </script>
@endsection
