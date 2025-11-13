@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0"><strong>Hasil</strong> Diagnosis</h1>
                <a href="#" class="btn btn-secondary btn-sm d-flex align-items-center shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Diagnosis
                </a>
            </div>

            {{-- Card Hasil Diagnosis --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-cpu me-2 text-primary"></i> Hasil Analisis Sistem Pakar
                    </h5>
                    <p class="text-muted small mb-4">Berdasarkan gejala yang Anda pilih, berikut hasil analisis kendaraan
                        Anda.</p>

                    {{-- Data Kendaraan --}}
                    <div class="bg-light p-3 rounded-3 mb-4">
                        <h6 class="fw-semibold mb-1">Suzuki All New Satria F150 (2016)</h6>
                        <small class="text-muted">Plat: BP 6042 GQ</small>
                    </div>

                    {{-- Hasil Diagnosis --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-1 text-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i> Kemungkinan Kerusakan:
                        </h6>
                        <p class="mb-3 fs-6">Kerusakan pada sistem bahan bakar (Fuel System).</p>

                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-danger" style="width: 85%;" role="progressbar" aria-valuenow="85"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <small class="text-muted d-block mt-1">Tingkat keyakinan: 85%</small>
                    </div>

                    {{-- Penjelasan --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-2 text-primary">
                            <i class="bi bi-info-circle me-1"></i> Penjelasan
                        </h6>
                        <p class="text-secondary mb-0" style="text-align: justify;">
                            Berdasarkan gejala seperti mesin sulit dinyalakan, suara kasar, dan konsumsi bahan bakar boros,
                            sistem mendeteksi adanya kemungkinan gangguan pada sistem bahan bakar — bisa disebabkan oleh
                            saringan bahan bakar tersumbat atau injektor kotor.
                        </p>
                    </div>

                    {{-- Rekomendasi --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-2 text-success">
                            <i class="bi bi-tools me-1"></i> Rekomendasi Tindakan
                        </h6>
                        <ul class="text-secondary mb-0">
                            <li>Periksa kondisi filter bensin dan bersihkan jika kotor.</li>
                            <li>Gunakan bahan bakar berkualitas seperti Pertamax atau sejenisnya.</li>
                            <li>Lakukan servis berkala untuk mencegah kerusakan lebih lanjut.</li>
                        </ul>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end mt-4">
                        <a href="#" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="#" class="btn btn-primary shadow-sm">
                            <i class="bi bi-printer me-1"></i> Cetak Hasil
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
