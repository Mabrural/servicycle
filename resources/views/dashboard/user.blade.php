@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <h1 class="h3 mb-3"><strong>User</strong> Dashboard</h1>
            <p class="text-muted mb-4">Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }} 👋</p>

            {{-- Ringkasan Data --}}
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Total Kendaraan Saya</h6>
                            <h3 class="fw-bold">{{ $totalVehicles }}</h3>
                            <small class="text-success">
                                <i class="bi bi-car-front"></i>
                                {{ $totalVehicles > 0 ? 'Kendaraan terdaftar' : 'Belum ada kendaraan' }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Total Servis Selesai</h6>
                            <h3 class="fw-bold">{{ $totalCompletedServices }}</h3>
                            <small class="text-success">
                                <i class="bi bi-check-circle"></i>
                                Servis berhasil
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Servis Aktif</h6>
                            <h3 class="fw-bold">{{ $activeServices }}</h3>
                            <small class="text-warning">
                                <i class="bi bi-clock"></i>
                                Sedang dikerjakan
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Servis Bulan Ini</h6>
                            <h3 class="fw-bold">{{ $servicesThisMonth }}</h3>
                            <small class="text-info">
                                <i class="bi bi-calendar-check"></i>
                                Servis di bulan {{ now()->format('F') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grafik Statistik --}}
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">📈 Riwayat Servis per Bulan</div>
                        <div class="card-body">
                            @if (array_sum($serviceHistory['data']) > 0)
                                <canvas id="serviceChart" height="120"></canvas>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-bar-chart text-muted fs-1"></i>
                                    <p class="text-muted mt-3">Belum ada data servis untuk ditampilkan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">🚗 Jenis Kendaraan Saya</div>
                        <div class="card-body">
                            @if ($totalVehicles > 0)
                                <canvas id="vehicleChart" height="240"></canvas>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-car-front text-muted fs-1"></i>
                                    <p class="text-muted mt-3">Belum ada kendaraan terdaftar</p>
                                    <a href="{{ route('vehicles.create') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-plus-circle"></i> Tambah Kendaraan
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Servis Terbaru --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                            <span>🧰 Servis Terbaru</span>
                            <small class="text-muted">Menampilkan {{ $recentServices->count() }} servis terbaru</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Kendaraan</th>
                                        <th>Bengkel</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentServices as $index => $service)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $service['booking_date'] }}</td>
                                            <td>{{ $service['vehicle_name'] }}</td>
                                            <td>{{ $service['workshop_name'] }}</td>
                                            <td>
                                                <span class="badge {{ $service['status_badge']['class'] }}">
                                                    {{ $service['status_badge']['text'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                Belum ada riwayat servis
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if ($recentServices->count() > 0)
                            <div class="card-footer bg-white text-center">
                                <a href="{{ route('history') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-clock-history"></i> Lihat Semua Riwayat Servis
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Grafik Garis - Riwayat Servis
        @if (array_sum($serviceHistory['data']) > 0)
            const ctxService = document.getElementById('serviceChart');
            if (ctxService) {
                new Chart(ctxService, {
                    type: 'line',
                    data: {
                        labels: @json($serviceHistory['labels']),
                        datasets: [{
                            label: 'Jumlah Servis',
                            data: @json($serviceHistory['data']),
                            borderColor: '#71dd37',
                            backgroundColor: 'rgba(113,221,55,0.2)',
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        @endif

        // Grafik Pie - Jenis Kendaraan
        @if ($totalVehicles > 0)
            const ctxVehicle = document.getElementById('vehicleChart');
            if (ctxVehicle) {
                new Chart(ctxVehicle, {
                    type: 'doughnut',
                    data: {
                        labels: @json($vehicleTypes['labels']),
                        datasets: [{
                            data: @json($vehicleTypes['data']),
                            backgroundColor: @json($vehicleTypes['colors']),
                            borderWidth: 0
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        }
                    }
                });
            }
        @endif
    </script>
@endsection
