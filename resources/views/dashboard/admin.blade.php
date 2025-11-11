@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-fluid p-0">

            {{-- Header --}}
            <h1 class="h3 mb-3"><strong>Admin</strong> Dashboard</h1>

            {{-- Ringkasan Data --}}
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Total Pengguna</h6>
                            <h3 class="fw-bold">{{ number_format($totalUsers) }}</h3>
                            <small class="text-success"><i class="bi bi-people-fill"></i> Semua Pengguna</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Total Bengkel</h6>
                            <h3 class="fw-bold">{{ number_format($totalWorkshops) }}</h3>
                            <small class="text-success"><i class="bi bi-shop"></i> Terdaftar</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Total Kendaraan</h6>
                            <h3 class="fw-bold">{{ number_format($totalVehicles) }}</h3>
                            <small class="text-info"><i class="bi bi-car-front-fill"></i> Terdaftar</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted mb-2">Total Transaksi</h6>
                            <h3 class="fw-bold">{{ number_format($totalTransactions) }}</h3>
                            <small class="text-primary"><i class="bi bi-cart-check-fill"></i> Booking Servis</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grafik Statistik --}}
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">📈 Statistik Pengguna (6 Bulan Terakhir)</div>
                        <div class="card-body">
                            <canvas id="userChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">💼 Distribusi Role</div>
                        <div class="card-body">
                            <canvas id="roleChart" height="240"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Aktivitas Terbaru --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">🕒 Aktivitas Terbaru</div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pengguna</th>
                                        <th>Role</th>
                                        <th>Aktivitas</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentActivities as $index => $activity)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $activity['name'] }}</td>
                                            <td>
                                                @php
                                                    $roleBadges = [
                                                        'admin' => 'bg-primary',
                                                        'workshop' => 'bg-success',
                                                        'vehicle_owner' => 'bg-info',
                                                    ];
                                                    $roleTexts = [
                                                        'admin' => 'Admin',
                                                        'workshop' => 'Workshop',
                                                        'vehicle_owner' => 'Vehicle Owner',
                                                    ];
                                                @endphp
                                                <span class="badge {{ $roleBadges[$activity['role']] ?? 'bg-secondary' }}">
                                                    {{ $roleTexts[$activity['role']] ?? $activity['role'] }}
                                                </span>
                                            </td>
                                            <td>{{ $activity['activity'] }}</td>
                                            <td>{{ $activity['time']->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada aktivitas terbaru</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Grafik Garis - Statistik Pengguna
        const ctxLine = document.getElementById('userChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: @json($userStats['months']),
                datasets: [{
                    label: 'Jumlah Pengguna Baru',
                    data: @json($userStats['counts']),
                    borderColor: '#696cff',
                    backgroundColor: 'rgba(105,108,255,0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Grafik Pie - Distribusi Role
        const ctxPie = document.getElementById('roleChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Admin', 'Workshop', 'Vehicle Owner'],
                datasets: [{
                    data: [
                        {{ $roleDistribution['admin'] }},
                        {{ $roleDistribution['workshop'] }},
                        {{ $roleDistribution['vehicle_owner'] }}
                    ],
                    backgroundColor: ['#696cff', '#71dd37', '#03c3ec'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
