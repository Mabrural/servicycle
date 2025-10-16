@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <h1 class="h3 mb-3"><strong>Bengkel</strong> Dashboard</h1>
        <p class="text-muted mb-4">Selamat datang, {{ Auth::user()->name ?? 'Mitra Bengkel' }} 👋</p>

        {{-- Ringkasan Data --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Servis Hari Ini</h6>
                        <h3 class="fw-bold">12</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +3 dari kemarin</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Antrian Aktif</h6>
                        <h3 class="fw-bold">7</h3>
                        <small class="text-warning"><i class="bi bi-hourglass-split"></i> Sedang dikerjakan</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Pendapatan Bulan Ini</h6>
                        <h3 class="fw-bold">Rp 24.3 Jt</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +8%</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Rating Pelanggan</h6>
                        <h3 class="fw-bold">4.8 / 5</h3>
                        <small class="text-muted"><i class="bi bi-star-fill text-warning"></i> Berdasarkan 120 ulasan</small>
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
                                <tr>
                                    <td>1</td>
                                    <td>Rizky Pratama</td>
                                    <td>Toyota Avanza</td>
                                    <td>Servis Rutin</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>10:45 AM</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Dewi Anggraini</td>
                                    <td>Honda Beat</td>
                                    <td>Ganti Oli</td>
                                    <td><span class="badge bg-warning text-dark">Proses</span></td>
                                    <td>10:10 AM</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Bambang Sutanto</td>
                                    <td>Daihatsu Xenia</td>
                                    <td>Perbaikan Rem</td>
                                    <td><span class="badge bg-info text-dark">Menunggu</span></td>
                                    <td>09:35 AM</td>
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
    // Grafik Garis - Tren Servis Bulanan
    const ctxService = document.getElementById('serviceChart').getContext('2d');
    new Chart(ctxService, {
        type: 'line',
        data: {
            labels: ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
            datasets: [{
                label: 'Jumlah Servis',
                data: [25, 40, 55, 70, 65, 90],
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

    // Grafik Pie - Jenis Layanan Terpopuler
    const ctxType = document.getElementById('serviceTypeChart').getContext('2d');
    new Chart(ctxType, {
        type: 'doughnut',
        data: {
            labels: ['Servis Rutin', 'Ganti Oli', 'Perbaikan Rem', 'Tune Up'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: ['#696cff', '#71dd37', '#03c3ec', '#ffab00'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
