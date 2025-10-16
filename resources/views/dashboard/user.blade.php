@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <h1 class="h3 mb-3"><strong>User</strong> Dashboard</h1>

        {{-- Ringkasan Data --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Kendaraan Saya</h6>
                        <h3 class="fw-bold">4</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +1 bulan ini</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Servis Selesai</h6>
                        <h3 class="fw-bold">12</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +3 servis baru</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Servis Aktif</h6>
                        <h3 class="fw-bold">2</h3>
                        <small class="text-warning"><i class="bi bi-clock"></i> Sedang dikerjakan</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Biaya Servis</h6>
                        <h3 class="fw-bold">Rp 4.8 Jt</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +15% dari bulan lalu</small>
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
                        <canvas id="serviceChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">🚗 Jenis Kendaraan Saya</div>
                    <div class="card-body">
                        <canvas id="vehicleChart" height="240"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Servis Terbaru --}}
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">🧰 Servis Terbaru</div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Kendaraan</th>
                                    <th>Bengkel</th>
                                    <th>Status</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>12 Okt 2025</td>
                                    <td>Toyota Avanza</td>
                                    <td>Bengkel Jaya Motor</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>Rp 850.000</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>03 Okt 2025</td>
                                    <td>Honda Beat</td>
                                    <td>Bengkel Makmur</td>
                                    <td><span class="badge bg-warning text-dark">Proses</span></td>
                                    <td>Rp 300.000</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>27 Sep 2025</td>
                                    <td>Toyota Avanza</td>
                                    <td>Bengkel Sejahtera</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>Rp 650.000</td>
                                </tr>
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
    // Grafik Garis - Riwayat Servis
    const ctxService = document.getElementById('serviceChart').getContext('2d');
    new Chart(ctxService, {
        type: 'line',
        data: {
            labels: ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
            datasets: [{
                label: 'Jumlah Servis',
                data: [2, 3, 5, 4, 6, 8],
                borderColor: '#71dd37',
                backgroundColor: 'rgba(113,221,55,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Grafik Pie - Jenis Kendaraan
    const ctxVehicle = document.getElementById('vehicleChart').getContext('2d');
    new Chart(ctxVehicle, {
        type: 'doughnut',
        data: {
            labels: ['Mobil', 'Motor'],
            datasets: [{
                data: [60, 40],
                backgroundColor: ['#696cff', '#03c3ec'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
