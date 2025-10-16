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
                        <h3 class="fw-bold">1,245</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +12%</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Bengkel</h6>
                        <h3 class="fw-bold">86</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +5%</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Kendaraan</h6>
                        <h3 class="fw-bold">342</h3>
                        <small class="text-danger"><i class="bi bi-arrow-down"></i> -2%</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Transaksi</h6>
                        <h3 class="fw-bold">Rp 78.2 Jt</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +9%</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Statistik --}}
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">📈 Statistik Pengguna</div>
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
                                <tr>
                                    <td>1</td>
                                    <td>Andi Wijaya</td>
                                    <td><span class="badge bg-primary">Admin</span></td>
                                    <td>Menambahkan data bengkel baru</td>
                                    <td>10:24 AM</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Sinta Dewi</td>
                                    <td><span class="badge bg-success">Workshop</span></td>
                                    <td>Memperbarui profil bengkel</td>
                                    <td>09:58 AM</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Budi Setiawan</td>
                                    <td><span class="badge bg-info">Vehicle Owner</span></td>
                                    <td>Mendaftarkan kendaraan baru</td>
                                    <td>09:20 AM</td>
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
    // Grafik Garis - Statistik Pengguna
    const ctxLine = document.getElementById('userChart').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
            datasets: [{
                label: 'Jumlah Pengguna',
                data: [10, 25, 40, 60, 80, 100],
                borderColor: '#696cff',
                backgroundColor: 'rgba(105,108,255,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Grafik Pie - Distribusi Role
    const ctxPie = document.getElementById('roleChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Admin', 'Workshop', 'Vehicle Owner'],
            datasets: [{
                data: [50, 30, 20],
                backgroundColor: ['#696cff', '#71dd37', '#03c3ec'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
