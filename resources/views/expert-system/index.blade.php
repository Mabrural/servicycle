@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <strong>Diagnosis</strong>
                </h1>
            </div>

            {{-- Pencarian --}}
            <div class="mb-4">
                <input type="text" id="searchVehicle" class="form-control form-control-sm"
                    placeholder="Cari kendaraan berdasarkan merek atau plat..." style="max-width: 350px;">
            </div>

            {{-- Daftar Kendaraan (Static) --}}
            <div class="row" id="vehicleList">
                <div class="col-md-4 mb-4 vehicle-card" data-name="suzuki bp6042gq">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="{{ asset('img/bengkel.jpg') }}" class="card-img-top" alt="Suzuki All New Satria F150"
                                style="height: 180px; object-fit: cover;">
                            <span class="badge bg-gradient position-absolute top-0 start-0 m-2 px-3 py-2"
                                style="background: linear-gradient(90deg, #007bff, #00c6ff);">
                                <i class="bi bi-bicycle"></i> MOTOR
                            </span>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-1">Suzuki All New Satria F150 (2016)</h5>
                            <small class="text-muted d-block mb-2">Plat: BP 6042 GQ</small>

                            <ul class="list-unstyled small mb-3">
                                <li><i class="bi bi-palette me-2 text-muted"></i> Warna: Biru</li>
                                <li><i class="bi bi-gear-wide-connected me-2 text-muted"></i> Transmisi: Manual</li>
                                <li><i class="bi bi-fuel-pump me-2 text-muted"></i> BBM: Pertamax</li>
                                <li><i class="bi bi-speedometer2 me-2 text-muted"></i> CC: 150</li>
                            </ul>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('diagnosis') }}" class="btn btn-outline-primary btn-sm w-100 me-2">
                                    <i class="bi bi-cpu"></i> Mulai Diagnosis
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
