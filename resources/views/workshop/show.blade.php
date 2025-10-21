@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <div class="col-lg-8 col-md-12 order-0">
            <!-- Profil Bengkel -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    @if($workshop->primaryImage)
                        <img src="{{ $workshop->primaryImage->image_url }}" alt="Foto Bengkel {{ $workshop->name }}"
                            class="rounded-3 mb-3 mb-md-0 me-md-4"
                            style="width: 150px; height: 150px; object-fit: cover; object-position: center;">
                    @else
                        <div class="rounded-3 mb-3 mb-md-0 me-md-4 d-flex align-items-center justify-content-center bg-light"
                            style="width: 150px; height: 150px;">
                            <i class="fas fa-tools fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="w-100">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h4 class="card-title mb-1">{{ $workshop->name }}</h4>
                                <p class="mb-1 text-muted">
                                    @if(is_array($workshop->types))
                                        Spesialis {{ implode(' dan ', $workshop->types) }}
                                    @else
                                        Spesialis {{ $workshop->types }}
                                    @endif
                                </p>
                                <span class="badge 
                                    @if($workshop->status == 'approved') bg-success
                                    @elseif($workshop->status == 'pending') bg-warning
                                    @elseif($workshop->status == 'rejected') bg-danger
                                    @else bg-secondary @endif mb-2 mb-md-0">
                                    {{ ucfirst($workshop->status) }}
                                </span>
                            </div>
                            <a href="{{ route('my-workshop.edit', $workshop->id) }}" class="btn btn-sm btn-warning mt-2 mt-md-0">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data
                            </a>
                        </div>

                        @if($workshop->phone)
                        <p class="mt-3 mb-1"><i class="fa-solid fa-phone"></i> {{ $workshop->phone }}</p>
                        @endif

                        @if($workshop->email)
                        <p class="mb-0"><i class="fa-solid fa-envelope"></i> {{ $workshop->email }}</p>
                        @endif
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
                            <p><strong>Nama Bengkel:</strong> {{ $workshop->name }}</p>
                            <p><strong>Jenis Bengkel:</strong> 
                                @if(is_array($workshop->types))
                                    {{ implode(', ', $workshop->types) }}
                                @else
                                    {{ $workshop->types }}
                                @endif
                            </p>
                            <p><strong>Alamat:</strong> {{ $workshop->address }}</p>
                            <p><strong>Provinsi:</strong> {{ $workshop->province }}</p>
                        </div>
                        <div class="col-12 col-sm-6">
                            <p><strong>Kota:</strong> {{ $workshop->city }}</p>
                            <p><strong>Kecamatan:</strong> {{ $workshop->district }}</p>
                            <p><strong>Kelurahan:</strong> {{ $workshop->village }}</p>
                            @if($workshop->postal_code)
                            <p><strong>Kode Pos:</strong> {{ $workshop->postal_code }}</p>
                            @endif
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
                    @if($workshop->services && count($workshop->services) > 0)
                    <p><strong>Layanan:</strong></p>
                    <ul class="mb-3">
                        @foreach($workshop->services as $service)
                            <li>{{ $serviceNames[$service] ?? ucfirst(str_replace('_', ' ', $service)) }}</li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-muted">Belum ada layanan yang ditambahkan</p>
                    @endif

                    @if($workshop->specialization)
                    <p><strong>Spesialisasi:</strong> {{ $workshop->specialization }}</p>
                    @endif
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Jam Operasional</h5>
                </div>
                <div class="card-body">
                    @if($workshop->operating_hours)
                        @if(in_array($workshop->operating_hours, ['08:00-17:00', '09:00-18:00', '07:00-21:00', '24jam']))
                            @if($workshop->operating_hours == '08:00-17:00')
                                <p><strong>Senin - Sabtu:</strong> 08.00 - 17.00</p>
                                <p><strong>Minggu:</strong> Tutup</p>
                            @elseif($workshop->operating_hours == '09:00-18:00')
                                <p><strong>Senin - Sabtu:</strong> 09.00 - 18.00</p>
                                <p><strong>Minggu:</strong> Tutup</p>
                            @elseif($workshop->operating_hours == '07:00-21:00')
                                <p><strong>Setiap Hari:</strong> 07.00 - 21.00</p>
                            @elseif($workshop->operating_hours == '24jam')
                                <p><strong>Setiap Hari:</strong> 24 Jam</p>
                            @endif
                        @else
                            <p><strong>Jam Operasional:</strong> {{ $workshop->operating_hours }}</p>
                        @endif
                    @else
                    <p class="text-muted">Jam operasional belum diatur</p>
                    @endif
                </div>
            </div>

            <!-- Deskripsi Bengkel -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Deskripsi Bengkel</h5>
                </div>
                <div class="card-body">
                    @if($workshop->description)
                        <p>{{ $workshop->description }}</p>
                    @else
                        <p class="text-muted">Belum ada deskripsi bengkel</p>
                    @endif
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
                    @if($workshop->latitude && $workshop->longitude)
                    <p><strong>Latitude:</strong> {{ number_format($workshop->latitude, 6) }}</p>
                    <p><strong>Longitude:</strong> {{ number_format($workshop->longitude, 6) }}</p>
                    <div class="ratio ratio-4x3">
                        <iframe 
                            src="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}&hl=id&z=15&output=embed" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    @else
                    <p class="text-muted">Lokasi belum ditentukan</p>
                    @endif
                </div>
            </div>

            <!-- Galeri -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Galeri Bengkel</h5>
                </div>
                <div class="card-body">
                    @if($workshop->images && $workshop->images->count() > 0)
                    <div class="row g-2">
                        @foreach($workshop->images->take(4) as $image)
                        <div class="col-6 col-md-6">
                            <img src="{{ $image->image_url }}" 
                                class="img-fluid rounded w-100" 
                                style="object-fit: cover; height: 120px; cursor: pointer;"
                                alt="Foto Bengkel {{ $workshop->name }}"
                                onclick="openImageModal('{{ $image->image_url }}')">
                        </div>
                        @endforeach
                        
                        @if($workshop->images->count() > 4)
                        <div class="col-12 text-center mt-2">
                            <small class="text-muted">+{{ $workshop->images->count() - 4 }} foto lainnya</small>
                        </div>
                        @endif
                    </div>
                    @else
                    <p class="text-muted">Belum ada foto bengkel</p>
                    @endif
                </div>
            </div>

            <!-- Informasi Pendaftaran -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tanggal Daftar:</strong> {{ $workshop->created_at->translatedFormat('d F Y') }}</p>
                    <p><strong>Terakhir Diupdate:</strong> {{ $workshop->updated_at->translatedFormat('d F Y') }}</p>
                    <p><strong>Didaftarkan oleh:</strong> {{ $workshop->creator->name ?? 'User' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Bengkel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Foto Bengkel">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>
@endpush

@push('styles')
<style>
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .badge {
        font-size: 0.75em;
    }
    
    .img-fluid {
        transition: transform 0.2s ease-in-out;
    }
    
    .img-fluid:hover {
        transform: scale(1.05);
    }
</style>
@endpush