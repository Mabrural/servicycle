@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="h3 mb-3"><strong>Bengkel</strong> Dashboard</h1>
        <p class="text-muted mb-4">Selamat datang, {{ Auth::user()->name ?? 'Mitra Bengkel' }} 👋</p>

        {{-- Ringkasan Data --}}
        <div class="row">
            <div class="col-md-6 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Servis Hari Ini</h6>
                        <h3 class="fw-bold">{{ $todayServices }}</h3>
                        <small class="text-muted">Tanggal {{ now()->format('d M Y') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Antrian Aktif</h6>
                        <h3 class="fw-bold">{{ $activeQueue }}</h3>
                        <small class="text-warning"><i class="bi bi-hourglass-split"></i> Sedang dikerjakan</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Statistik --}}
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">📈 Tren Servis Bulanan</div>
                    <div class="card-body">
                        <canvas id="serviceChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">🧰 Jenis Layanan Terpopuler</div>
                    <div class="card-body">
                        <canvas id="serviceTypeChart" height="240"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Aktivitas Terbaru --}}
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">🕒 Servis Terbaru</div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Kendaraan</th>
                                    <th>Layanan</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestServices as $i => $service)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $service->creator->name ?? '-' }}</td>
                                        <td>{{ $service->vehicle->full_name ?? '-' }}</td>
                                        <td>{{ $service->notes ?? '-' }}</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'selesai' => 'success',
                                                    'dikerjakan' => 'warning text-dark',
                                                    'menunggu_konfirmasi' => 'info text-dark',
                                                    'ditolak' => 'danger',
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$service->status] ?? 'secondary' }}">
                                                {{ ucfirst(str_replace('_', ' ', $service->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $service->booking_date->format('d M Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">Belum ada data servis.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Grafik Tren Servis Bulanan
        new Chart(document.getElementById('serviceChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Jumlah Servis',
                    data: {!! json_encode($values) !!},
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

        // Grafik Layanan Terpopuler
        new Chart(document.getElementById('serviceTypeChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($serviceTypes->keys()) !!},
                datasets: [{
                    data: {!! json_encode($serviceTypes->values()) !!},
                    backgroundColor: ['#696cff', '#71dd37', '#03c3ec', '#ffab00'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection
