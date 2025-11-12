@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                <div class="mb-2 mb-md-0">
                    <h3 class="fw-bold mb-1 text-primary">Bengkel Saya</h3>
                    <p class="text-muted mb-0">
                        Kelola informasi bengkel dan pantau aktivitas servis pelanggan dengan mudah dan efisien.
                    </p>
                </div>
                <button class="btn btn-outline-primary btn-sm rounded-pill shadow-sm" id="refreshButton"
                    onclick="location.reload();">
                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                </button>

            </div>

            {{-- Pencarian --}}
            <div class="input-group mb-4" style="max-width: 400px;">
                <span class="input-group-text bg-light border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" id="searchWorkshop" class="form-control form-control-sm border-start-0"
                    placeholder="Cari bengkel berdasarkan nama atau kota...">
            </div>

            {{-- Daftar Bengkel --}}
            <div class="row" id="workshopList">
                @forelse ($workshops as $workshop)
                    <div class="col-md-6 col-lg-4 mb-4 workshop-card"
                        data-name="{{ strtolower($workshop->name . ' ' . $workshop->city) }}">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-card">

                            {{-- Foto utama --}}
                            <div class="position-relative">
                                <img src="{{ $workshop->primaryImage->image_url }}" class="card-img-top"
                                    alt="{{ $workshop->name }}"
                                    style="height: 180px; object-fit: cover; object-position: center;">
                                <span class="badge position-absolute top-0 start-0 m-2 px-3 py-2"
                                    style="background: linear-gradient(90deg, #007bff, #00c6ff); font-weight: 500;">
                                    <i class="fa-solid fa-tools me-1"></i>
                                    {{ ucfirst($workshop->status) }}
                                </span>
                            </div>

                            {{-- Konten --}}
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title fw-semibold text-dark mb-1">{{ $workshop->name }}</h5>
                                <small class="text-muted d-block mb-3">
                                    <i class="bi bi-geo-alt me-1"></i> {{ $workshop->city }}, {{ $workshop->province }}
                                </small>

                                <ul class="list-unstyled small mb-4">
                                    <li class="mb-1">
                                        <i class="fa-solid fa-wrench me-2 text-primary"></i>
                                        Jenis: {{ is_array($workshop->types) ? implode(', ', $workshop->types) : '-' }}
                                    </li>
                                    <li class="mb-1">
                                        <i class="fa-solid fa-phone me-2 text-primary"></i> {{ $workshop->phone ?? '-' }}
                                    </li>
                                    <li class="mb-1">
                                        <i class="fa-solid fa-envelope me-2 text-primary"></i> {{ $workshop->email ?? '-' }}
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-map-marker-alt me-2 text-primary"></i>
                                        @if (!empty($workshop->latitude) && !empty($workshop->longitude))
                                            <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                                                target="_blank" class="text-decoration-none text-muted hover-link">
                                                {{ $workshop->address ?? '-' }}
                                            </a>
                                        @else
                                            {{ $workshop->address ?? '-' }}
                                        @endif
                                    </li>
                                </ul>

                                {{-- Tombol aksi --}}
                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('my-workshop.show', $workshop->id) }}"
                                        class="btn btn-sm btn-outline-primary flex-fill rounded-pill">
                                        <i class="bi bi-eye me-1"></i> Lihat
                                    </a>
                                    <a href="{{ route('my-workshop.edit', $workshop->id) }}"
                                        class="btn btn-sm btn-outline-warning flex-fill rounded-pill">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center mt-5">
                        <img src="{{ asset('img/empty.jpg') }}" alt="No Workshops" width="200" class="mb-3 opacity-75">
                        <h5 class="text-muted fw-normal">Belum ada bengkel terdaftar</h5>
                        <a href="{{ route('my-workshop.create') }}" class="btn btn-primary rounded-pill mt-3 px-4">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Bengkel Pertama
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    {{-- Script pencarian --}}
    <script>
        document.getElementById('searchWorkshop').addEventListener('keyup', function() {
            const search = this.value.toLowerCase();
            const cards = document.querySelectorAll('.workshop-card');
            cards.forEach(card => {
                card.style.display = card.getAttribute('data-name').includes(search) ? '' : 'none';
            });
        });
    </script>

    {{-- Styling tambahan --}}
    <style>
        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .hover-link:hover {
            color: #007bff !important;
            text-decoration: underline !important;
        }

        .card-body ul {
            line-height: 1.6;
        }

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

            .btn-sm {
                font-size: 12px;
                padding: 6px 10px;
            }
        }
    </style>
@endsection
