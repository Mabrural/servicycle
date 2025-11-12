<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bengkel - {{ $workshop->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 12px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-bottom: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .profile-card {
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 120px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            z-index: 0;
        }

        .profile-content {
            position: relative;
            z-index: 1;
            padding-top: 80px;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: var(--box-shadow);
            object-fit: cover;
            object-position: center;
        }

        .badge-status {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.75rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .service-badge {
            display: inline-block;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            margin: 0.25rem;
            font-size: 0.85rem;
            border: 1px solid rgba(67, 97, 238, 0.2);
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: scale(1.03);
        }

        .gallery-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            object-position: center;
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: white;
            padding: 0.5rem;
            opacity: 0;
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .map-container {
            border-radius: 8px;
            overflow: hidden;
            height: 200px;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
            color: white;
        }

        .operating-hours {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .operating-hours:last-child {
            border-bottom: none;
        }

        .day {
            font-weight: 500;
        }

        .time {
            color: var(--primary-color);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .profile-content {
                padding-top: 60px;
                text-align: center;
            }

            .profile-img {
                width: 120px;
                height: 120px;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-icon {
                margin-bottom: 0.5rem;
            }

            .gallery-item img {
                height: 100px;
            }
        }

        .status-approved {
            background-color: rgba(76, 201, 240, 0.2);
            color: #4cc9f0;
        }

        .status-pending {
            background-color: rgba(247, 37, 133, 0.2);
            color: #f72585;
        }

        .status-rejected {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container-xxl flex-grow-1 container-p-y py-4">
        <div class="row g-4">
            <!-- Kolom kiri -->
            <div class="col-lg-8 col-md-12 order-0">
                <!-- Profil Bengkel -->
                <div class="card profile-card">
                    <div class="card-body p-0">
                        <!-- Header dengan background gradient -->
                        <div class="profile-header"
                            style="height: 120px; background: linear-gradient(135deg, #4361ee, #3f37c9);"></div>
                        <a href="#" onclick="window.history.back()" class="btn btn-outline-primary mt-2 ml-5"><i
                                class="fas fa-arrow-left"></i> Kembali</a>

                        <!-- Konten Profil -->
                        <div class="profile-content position-relative">
                            <div
                                class="d-flex flex-column flex-md-row align-items-center text-center text-md-start px-3 px-md-4 pb-4">
                                <!-- Foto Profil -->
                                <div class="profile-img-container position-relative">
                                    @if ($workshop->primaryImage)
                                        <img src="{{ $workshop->primaryImage->image_url }}"
                                            alt="Foto Bengkel {{ $workshop->name }}" class="profile-img">
                                    @else
                                        <div
                                            class="profile-img d-flex align-items-center justify-content-center bg-light">
                                            <i class="fas fa-tools fa-2x text-muted"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Informasi Bengkel -->
                                <div class="profile-info mt-3 mt-md-0 ms-md-4 flex-grow-1">
                                    <div
                                        class="d-flex flex-column flex-md-row justify-content-between align-items-center align-items-md-start">
                                        <div class="text-center text-md-start">
                                            <h3 class="card-title mb-1 fw-bold text-dark">{{ $workshop->name }}</h3>
                                            <p class="mb-1 text-muted">
                                                <i class="fas fa-toolbox me-1"></i>
                                                @if (is_array($workshop->types))
                                                    Spesialis {{ implode(' dan ', $workshop->types) }}
                                                @else
                                                    Spesialis {{ $workshop->types }}
                                                @endif
                                            </p>
                                            <span class="badge badge-status status-{{ $workshop->status }} mt-2">
                                                @if ($workshop->status == 'approved')
                                                    <i class="fas fa-check-circle me-1"></i> Disetujui
                                                @elseif($workshop->status == 'pending')
                                                    <i class="fas fa-clock me-1"></i> Menunggu
                                                @elseif($workshop->status == 'rejected')
                                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                                @else
                                                    <i class="fas fa-question-circle me-1"></i>
                                                    {{ ucfirst($workshop->status) }}
                                                @endif
                                            </span>
                                        </div>

                                        <!-- Tombol Edit - Tetap di kanan atas di desktop, di bawah di mobile -->
                                        <div class="mt-3 mt-md-0">
                                            <a href="{{ route('my-workshop.edit', $workshop->id) }}"
                                                class="btn btn-edit">
                                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Data
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Kontak Info -->
                                    <div class="contact-info mt-3 text-center text-md-start">
                                        @if ($workshop->phone)
                                            <p class="mb-2">
                                                <i class="fa-solid fa-phone me-2 text-primary"></i>
                                                <span class="text-dark">{{ $workshop->phone }}</span>
                                            </p>
                                        @endif

                                        @if ($workshop->email)
                                            <p class="mb-0">
                                                <i class="fa-solid fa-envelope me-2 text-primary"></i>
                                                <span class="text-dark">{{ $workshop->email }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .profile-card {
                        border: none;
                        border-radius: 16px;
                        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                        overflow: hidden;
                        margin-bottom: 1.5rem;
                    }

                    .profile-header {
                        width: 100%;
                    }

                    .profile-img-container {
                        margin-top: -75px;
                        z-index: 2;
                    }

                    .profile-img {
                        width: 150px;
                        height: 150px;
                        border-radius: 50%;
                        border: 5px solid white;
                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
                        object-fit: cover;
                        object-position: center;
                    }

                    .profile-content {
                        position: relative;
                        z-index: 1;
                    }

                    .badge-status {
                        font-size: 0.75rem;
                        padding: 0.5rem 1rem;
                        border-radius: 50px;
                        font-weight: 500;
                    }

                    .status-approved {
                        background-color: rgba(76, 201, 240, 0.15);
                        color: #4cc9f0;
                        border: 1px solid rgba(76, 201, 240, 0.3);
                    }

                    .status-pending {
                        background-color: rgba(247, 37, 133, 0.15);
                        color: #f72585;
                        border: 1px solid rgba(247, 37, 133, 0.3);
                    }

                    .status-rejected {
                        background-color: rgba(220, 53, 69, 0.15);
                        color: #dc3545;
                        border: 1px solid rgba(220, 53, 69, 0.3);
                    }

                    .btn-edit {
                        background: linear-gradient(135deg, #4361ee, #3f37c9);
                        color: white;
                        border: none;
                        border-radius: 50px;
                        padding: 0.6rem 1.5rem;
                        font-weight: 500;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
                        white-space: nowrap;
                    }

                    .btn-edit:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 6px 18px rgba(67, 97, 238, 0.4);
                        color: white;
                    }

                    .contact-info p {
                        margin-bottom: 0.5rem;
                    }

                    /* Responsive Design */
                    @media (max-width: 768px) {
                        .profile-img {
                            width: 120px;
                            height: 120px;
                        }

                        .profile-img-container {
                            margin-top: -60px;
                        }

                        .profile-content {
                            text-align: center;
                        }

                        .profile-info {
                            width: 100%;
                        }

                        .btn-edit {
                            width: 100%;
                            max-width: 200px;
                        }

                        .contact-info {
                            margin-top: 1rem;
                        }
                    }

                    @media (max-width: 576px) {
                        .profile-img {
                            width: 100px;
                            height: 100px;
                        }

                        .profile-img-container {
                            margin-top: -50px;
                        }

                        .card-title {
                            font-size: 1.5rem;
                        }
                    }

                    /* Animasi */
                    .profile-card {
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                    }

                    .profile-card:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
                    }
                </style>

                <!-- Informasi Umum -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Umum</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-signature"></i>
                                    </div>
                                    <div>
                                        <strong>Nama Bengkel</strong>
                                        <div>{{ $workshop->name }}</div>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-toolbox"></i>
                                    </div>
                                    <div>
                                        <strong>Jenis Bengkel</strong>
                                        <div>
                                            @if (is_array($workshop->types))
                                                {{ implode(', ', $workshop->types) }}
                                            @else
                                                {{ $workshop->types }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <strong>Alamat</strong>
                                        <div>{{ $workshop->address }}</div>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map"></i>
                                    </div>
                                    <div>
                                        <strong>Provinsi</strong>
                                        <div>{{ $workshop->province }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div>
                                        <strong>Kota</strong>
                                        <div>{{ $workshop->city }}</div>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map-pin"></i>
                                    </div>
                                    <div>
                                        <strong>Kecamatan</strong>
                                        <div>{{ $workshop->district }}</div>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-location-dot"></i>
                                    </div>
                                    <div>
                                        <strong>Kelurahan</strong>
                                        <div>{{ $workshop->village }}</div>
                                    </div>
                                </div>

                                @if ($workshop->postal_code)
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-mail-bulk"></i>
                                        </div>
                                        <div>
                                            <strong>Kode Pos</strong>
                                            <div>{{ $workshop->postal_code }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan & Spesialisasi -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-concierge-bell me-2"></i>Layanan & Spesialisasi</h5>
                    </div>
                    <div class="card-body">
                        @if ($workshop->services && count($workshop->services) > 0)
                            <div class="mb-3">
                                <strong class="d-block mb-2">Layanan yang Tersedia:</strong>
                                <div>
                                    @foreach ($workshop->services as $service)
                                        <span class="service-badge">
                                            <i class="fas fa-check me-1"></i>
                                            {{ $serviceNames[$service] ?? ucfirst(str_replace('_', ' ', $service)) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p class="text-muted"><i class="fas fa-info-circle me-1"></i> Belum ada layanan yang
                                ditambahkan</p>
                        @endif

                        @if ($workshop->specialization)
                            <div class="info-item mt-3">
                                <div class="info-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <strong>Spesialisasi</strong>
                                    <div>{{ $workshop->specialization }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Jam Operasional</h5>
                    </div>
                    <div class="card-body">
                        @if ($workshop->operating_hours)
                            @if (in_array($workshop->operating_hours, ['08:00-17:00', '09:00-18:00', '07:00-21:00', '24jam']))
                                <div class="operating-hours">
                                    <span class="day">Senin - Sabtu</span>
                                    <span class="time">
                                        @if ($workshop->operating_hours == '08:00-17:00')
                                            08.00 - 17.00
                                        @elseif($workshop->operating_hours == '09:00-18:00')
                                            09.00 - 18.00
                                        @elseif($workshop->operating_hours == '07:00-21:00')
                                            07.00 - 21.00
                                        @elseif($workshop->operating_hours == '24jam')
                                            24 Jam
                                        @endif
                                    </span>
                                </div>
                                <div class="operating-hours">
                                    <span class="day">Minggu</span>
                                    <span class="time">
                                        @if ($workshop->operating_hours == '24jam' || $workshop->operating_hours == '07:00-21:00')
                                            @if ($workshop->operating_hours == '24jam')
                                                24 Jam
                                            @else
                                                07.00 - 21.00
                                            @endif
                                        @else
                                            Tutup
                                        @endif
                                    </span>
                                </div>
                            @else
                                <p><strong>Jam Operasional:</strong> {{ $workshop->operating_hours }}</p>
                            @endif
                        @else
                            <p class="text-muted"><i class="fas fa-info-circle me-1"></i> Jam operasional belum diatur
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Deskripsi Bengkel -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-align-left me-2"></i>Deskripsi Bengkel</h5>
                    </div>
                    <div class="card-body">
                        @if ($workshop->description)
                            <p class="mb-0">{{ $workshop->description }}</p>
                        @else
                            <p class="text-muted"><i class="fas fa-info-circle me-1"></i> Belum ada deskripsi bengkel
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kolom kanan -->
            <div class="col-lg-4 col-md-12">
                <!-- Lokasi -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-map-location-dot me-2"></i>Lokasi Bengkel</h5>
                    </div>
                    <div class="card-body">
                        @if ($workshop->latitude && $workshop->longitude)
                            <div class="mb-3">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-latitude"></i>
                                    </div>
                                    <div>
                                        <strong>Latitude</strong>
                                        <div>{{ number_format($workshop->latitude, 6) }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-longitude"></i>
                                    </div>
                                    <div>
                                        <strong>Longitude</strong>
                                        <div>{{ number_format($workshop->longitude, 6) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="map-container">
                                <iframe
                                    src="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}&hl=id&z=15&output=embed"
                                    style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        @else
                            <p class="text-muted"><i class="fas fa-info-circle me-1"></i> Lokasi belum ditentukan</p>
                        @endif
                    </div>
                </div>

                <!-- Galeri -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-images me-2"></i>Galeri Bengkel</h5>
                    </div>
                    <div class="card-body">
                        @if ($workshop->images && $workshop->images->count() > 0)
                            <div class="row g-2">
                                @foreach ($workshop->images->take(4) as $image)
                                    <div class="col-6">
                                        <div class="gallery-item">
                                            <img src="{{ $image->image_url }}"
                                                alt="Foto Bengkel {{ $workshop->name }}"
                                                onclick="openImageModal('{{ $image->image_url }}')">
                                            <div class="gallery-overlay">
                                                <small>Klik untuk memperbesar</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if ($workshop->images->count() > 4)
                                    <div class="col-12 text-center mt-2">
                                        <small class="text-muted">+{{ $workshop->images->count() - 4 }} foto
                                            lainnya</small>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-muted"><i class="fas fa-info-circle me-1"></i> Belum ada foto bengkel</p>
                        @endif
                    </div>
                </div>

                <!-- Informasi Pendaftaran -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-file-signature me-2"></i>Informasi Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div>
                                <strong>Tanggal Daftar</strong>
                                <div>{{ $workshop->created_at->translatedFormat('d F Y') }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <strong>Terakhir Diupdate</strong>
                                <div>{{ $workshop->updated_at->translatedFormat('d F Y') }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <strong>Didaftarkan oleh</strong>
                                <div>{{ $workshop->creator->name ?? 'User' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Preview -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Bengkel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img id="modalImage" src="" class="img-fluid rounded" alt="Foto Bengkel"
                        style="max-height: 70vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }

        // Animasi untuk card saat di-scroll
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
        });
    </script>
</body>

</html>
