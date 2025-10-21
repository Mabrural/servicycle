@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Bengkel Saya</h3>
                    <p class="text-muted mb-0">Kelola informasi bengkel dan pantau seluruh aktivitas servis pelanggan dengan mudah.</p>
                </div>
                <button class="btn btn-outline-secondary btn-sm" id="refreshButton">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
            </div>

            {{-- Pencarian --}}
            <div class="mb-4">
                <input type="text" id="searchWorkshop" class="form-control form-control-sm"
                    placeholder="Cari bengkel berdasarkan nama atau kota..." style="max-width: 350px;">
            </div>

            {{-- Daftar Bengkel --}}
            <div class="row" id="workshopList">
                @forelse ($workshops as $workshop)
                    <div class="col-md-4 mb-4 workshop-card"
                        data-name="{{ strtolower($workshop->name . ' ' . $workshop->city) }}">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">

                            {{-- Foto utama --}}
                            <div class="position-relative">
                                @php
                                    $photo =
                                        is_array($workshop->photos) && count($workshop->photos) > 0
                                            ? url('/storage/workshop-images/' . $workshop->photos[0])
                                            : asset('img/no-vehicle.jpg');
                                @endphp

                                <img src="{{ $photo }}" class="card-img-top" alt="{{ $workshop->name }}"
                                    style="height: 180px; object-fit: cover; object-position: center;">

                                <span class="badge bg-gradient position-absolute top-0 start-0 m-2 px-3 py-2"
                                    style="background: linear-gradient(90deg, #007bff, #00c6ff);">
                                    <i class="fa-solid fa-tools me-1"></i>
                                    {{ ucfirst($workshop->status) }}
                                </span>
                            </div>

                            {{-- Konten --}}
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-1">{{ $workshop->name }}</h5>
                                <small class="text-muted d-block mb-2">{{ $workshop->city }},
                                    {{ $workshop->province }}</small>

                                <ul class="list-unstyled small mb-3">
                                    <li><i class="fa-solid fa-wrench me-2 text-muted"></i> Jenis:
                                        {{ is_array($workshop->types) ? implode(', ', $workshop->types) : '-' }}
                                    </li>
                                    <li><i class="fa-solid fa-phone me-2 text-muted"></i> {{ $workshop->phone ?? '-' }}</li>
                                    <li><i class="fa-solid fa-envelope me-2 text-muted"></i> {{ $workshop->email ?? '-' }}
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-map-marker-alt me-2 text-muted"></i>
                                        @if (!empty($workshop->latitude) && !empty($workshop->longitude))
                                            <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                                                target="_blank" class="">
                                                {{ $workshop->address ?? '-' }}
                                            </a>
                                        @else
                                            {{ $workshop->address ?? '-' }}
                                        @endif
                                    </li>

                                </ul>

                                {{-- Tombol aksi --}}
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('my-workshop.show', $workshop->id) }}"
                                        class="btn btn-outline-primary btn-sm w-50 me-2">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('my-workshop.edit', $workshop->id) }}"
                                        class="btn btn-outline-warning btn-sm w-50">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center mt-5">
                        <img src="{{ asset('img/empty.jpg') }}" alt="No Workshops" width="180" class="mb-3">
                        <h5 class="text-muted">Belum ada bengkel terdaftar</h5>
                        <a href="{{ route('my-workshop.create') }}" class="btn btn-primary mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Bengkel Pertama
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    {{-- Pencarian JavaScript --}}
    <script>
        document.getElementById('searchWorkshop').addEventListener('keyup', function() {
            const search = this.value.toLowerCase();
            const cards = document.querySelectorAll('.workshop-card');
            cards.forEach(card => {
                card.style.display = card.getAttribute('data-name').includes(search) ? '' : 'none';
            });
        });
    </script>

    {{-- Responsiveness tambahan --}}
    <style>
        @media (max-width: 768px) {
            .card-body ul {
                font-size: 13px;
            }

            .card-body h5 {
                font-size: 16px;
            }

            .card-body small {
                font-size: 12px;
            }
        }
    </style>
@endsection
