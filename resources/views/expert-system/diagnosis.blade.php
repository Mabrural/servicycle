@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0"><strong>Diagnosis</strong> Kendaraan</h1>
                <a href="#" class="btn btn-secondary btn-sm d-flex align-items-center shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            {{-- Card Diagnosis --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-wrench-adjustable-circle me-2 text-primary"></i>
                        Pilih Gejala yang Dirasakan
                    </h5>
                    <p class="text-muted small mb-4">Centang gejala yang sesuai dengan kondisi kendaraan Anda.</p>

                    <form>
                        <div class="row">
                            {{-- Kolom kiri --}}
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala1">
                                    <label class="form-check-label" for="gejala1">
                                        Mesin sulit dinyalakan
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala2">
                                    <label class="form-check-label" for="gejala2">
                                        Suara mesin kasar atau tidak halus
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala3">
                                    <label class="form-check-label" for="gejala3">
                                        Asap knalpot berwarna hitam pekat
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala4">
                                    <label class="form-check-label" for="gejala4">
                                        Tenaga motor berkurang saat akselerasi
                                    </label>
                                </div>
                            </div>

                            {{-- Kolom kanan --}}
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala5">
                                    <label class="form-check-label" for="gejala5">
                                        Konsumsi bahan bakar boros
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala6">
                                    <label class="form-check-label" for="gejala6">
                                        Lampu utama redup saat mesin hidup
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala7">
                                    <label class="form-check-label" for="gejala7">
                                        Mesin cepat panas (overheating)
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="gejala8">
                                    <label class="form-check-label" for="gejala8">
                                        Keluar bau bensin menyengat
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </button>
                            {{-- <button type="button" class="btn btn-primary shadow-sm">
                            <i class="bi bi-cpu me-1"></i> Proses Diagnosis
                        </button> --}}
                            <a href="{{ route('diagnosis.result') }}" class="btn btn-primary shadow-sm">Proses Diagnosis</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
