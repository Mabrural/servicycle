<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Bengkel</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f6f9fc 0%, #edf2f7 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .verification-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            background: #fff;
        }

        .card-header {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            padding: 1.5rem;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 10px;
            font-size: 1.4rem;
        }

        .info-table th {
            width: 35%;
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }

        .status-badge {
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .btn-approve,
        .btn-reject {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-approve {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
        }

        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(34, 197, 94, 0.3);
        }

        .btn-reject {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(239, 68, 68, 0.3);
        }

        .alert-section {
            background: #f8f9fa;
            padding: 1.2rem;
            border-radius: 10px;
            text-align: center;
        }

        .alert-section i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .alert-section h5 {
            font-weight: 600;
        }

        /* Galeri foto */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
        }

        .gallery img {
            border-radius: 10px;
            width: 100%;
            height: 120px;
            object-fit: cover;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        /* Map */
        .map-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        /* Modal Gambar */
        #modalImage {
            max-height: 80vh;
            object-fit: contain;
            background: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card verification-card mt-4">
                    <div class="card-header">
                        <h4><i class="fas fa-clipboard-check"></i> Verifikasi Bengkel</h4>
                    </div>

                    <div class="card-body p-4">
                        <table class="table table-bordered align-middle">
                            <tr>
                                <th>Nama Bengkel</th>
                                <td><strong class="text-primary">{{ $workshop->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $workshop->address }}</td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td>{{ $workshop->city }}</td>
                            </tr>
                            <tr>
                                <th>Pemilik</th>
                                <td>
                                    {{ $workshop->creator->name ?? '-' }}<br>
                                    <small class="text-muted">{{ $workshop->creator->email ?? '-' }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span
                                        class="badge status-badge 
                                    @if ($workshop->status == 'pending') bg-warning text-dark
                                    @elseif($workshop->status == 'approved') bg-success
                                    @elseif($workshop->status == 'rejected') bg-danger @endif">
                                        <i class="fas fa-info-circle me-1"></i> {{ ucfirst($workshop->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>

                        {{-- Lokasi Bengkel --}}
                        @if ($workshop->latitude && $workshop->longitude)
                            <div class="mt-4">
                                <h6 class="fw-bold mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Lokasi
                                    Bengkel</h6>
                                <div class="map-container">
                                    <iframe width="100%" height="300" frameborder="0" style="border:0"
                                        src="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}&hl=id&z=15&output=embed"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        @endif

                        {{-- Foto Bengkel --}}
                        @if ($workshop->images && $workshop->images->count() > 0)
                            <div class="mt-4">
                                <h6 class="fw-bold mb-2"><i class="fas fa-images me-2 text-primary"></i> Foto Bengkel
                                </h6>
                                <div class="gallery">
                                    @foreach ($workshop->images as $image)
                                        <div class="position-relative">
                                            @if ($image->is_primary)
                                                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                                                    <i class="fas fa-star me-1"></i> Utama
                                                </span>
                                            @endif
                                            <img src="{{ $image->image_url }}"
                                                alt="{{ $image->image_name ?? 'Foto Bengkel' }}"
                                                title="{{ $image->image_name ?? 'Foto Bengkel' }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="mt-4 alert alert-light text-center">
                                <i class="fas fa-image-slash text-secondary mb-2" style="font-size:1.5rem;"></i><br>
                                <span class="text-muted">Belum ada foto bengkel yang diunggah.</span>
                            </div>
                        @endif

                        {{-- Tombol Aksi --}}
                        @if ($workshop->status == 'pending')
                            <div class="d-flex flex-column flex-md-row gap-3 mt-4">
                                <form action="{{ route('workshop-verify.update', $workshop->id) }}" method="POST"
                                    class="flex-fill">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-approve">
                                        <i class="fas fa-check-circle me-2"></i> Setujui Bengkel
                                    </button>
                                </form>

                                <form id="rejectForm" action="{{ route('workshop-verify.update', $workshop->id) }}"
                                    method="POST" class="flex-fill">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="button" id="btnReject" class="btn btn-reject">
                                        <i class="fas fa-times-circle me-2"></i> Tolak Bengkel
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="alert-section mt-4">
                                @if ($workshop->status == 'approved')
                                    <i class="fas fa-check-circle text-success"></i>
                                    <h5>Bengkel ini sudah disetujui</h5>
                                @elseif($workshop->status == 'rejected')
                                    <i class="fas fa-times-circle text-danger"></i>
                                    <h5>Bengkel ini telah ditolak</h5>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview Gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg bg-dark">
                <div class="modal-body p-0 text-center">
                    <img id="modalImage" src="" class="img-fluid rounded" alt="Preview Gambar">
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rejectButton = document.getElementById('btnReject');
            const rejectForm = document.getElementById('rejectForm');

            if (rejectButton) {
                rejectButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Tolak Bengkel?',
                        text: 'Apakah Anda yakin ingin menolak verifikasi bengkel ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, tolak',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            rejectForm.submit();
                        }
                    });
                });
            }

            // Modal Preview Gambar
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');
            document.querySelectorAll('.gallery img').forEach(img => {
                img.addEventListener('click', () => {
                    modalImage.src = img.src;
                    imageModal.show();
                });
            });

            // SweetAlert notifikasi
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false
                });
            @elseif (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
</body>

</html>
