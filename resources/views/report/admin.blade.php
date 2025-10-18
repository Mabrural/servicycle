@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1"><strong>Laporan & Analitik</strong></h1>
                <p class="text-muted mb-0">Pantau performa aplikasi, pengguna, dan transaksi dengan data yang lebih mendalam.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </button>
                <button class="btn btn-outline-success btn-sm">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </button>
            </div>
        </div>

        {{-- Filter --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Periode Waktu</label>
                        <select class="form-select">
                            <option>Harian</option>
                            <option>Bulanan</option>
                            <option>Tahunan</option>
                            <option>Kustom</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tanggal Mulai</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tanggal Selesai</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary"><i class="bi bi-funnel"></i> Terapkan Filter</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistik Umum --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Transaksi</h6>
                        <h3 class="fw-bold">Rp 124,5 Jt</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +15% dari bulan lalu</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Pengguna Baru</h6>
                        <h3 class="fw-bold">328</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +8%</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Servis Selesai</h6>
                        <h3 class="fw-bold">274</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> +6%</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Paket Langganan Aktif</h6>
                        <h3 class="fw-bold">121</h3>
                        <small class="text-muted"><i class="bi bi-dash"></i> stabil</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Laporan --}}
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">📊 Grafik Pertumbuhan Transaksi</div>
                    <div class="card-body">
                        <canvas id="transactionChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">💰 Distribusi Metode Pembayaran</div>
                    <div class="card-body">
                        <canvas id="paymentChart" height="240"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Detail Transaksi --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">🧾 Detail Transaksi Pengguna</div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>Paket</th>
                            <th>Metode Pembayaran</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Isyabel Salsabilla</td>
                            <td>Paket Tahunan</td>
                            <td>DANA</td>
                            <td>Rp499.000</td>
                            <td><span class="badge bg-success">Berhasil</span></td>
                            <td>25 Okt 2025</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Hendry Zhang</td>
                            <td>Paket Bulanan</td>
                            <td>GoPay</td>
                            <td>Rp49.000</td>
                            <td><span class="badge bg-success">Berhasil</span></td>
                            <td>10 Okt 2025</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Budi Santoso</td>
                            <td>Paket Bulanan</td>
                            <td>Transfer Bank</td>
                            <td>Rp49.000</td>
                            <td><span class="badge bg-danger">Gagal</span></td>
                            <td>05 Okt 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Transaksi (Line)
    const ctxTransaction = document.getElementById('transactionChart').getContext('2d');
    new Chart(ctxTransaction, {
        type: 'line',
        data: {
            labels: ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
            datasets: [{
                label: 'Total Transaksi (Jt)',
                data: [20, 25, 40, 55, 70, 90, 124],
                borderColor: '#03c3ec',
                backgroundColor: 'rgba(3,195,236,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Grafik Pie - Metode Pembayaran
    const ctxPayment = document.getElementById('paymentChart').getContext('2d');
    new Chart(ctxPayment, {
        type: 'doughnut',
        data: {
            labels: ['DANA', 'GoPay', 'OVO', 'Transfer Bank', 'Kartu Kredit'],
            datasets: [{
                data: [40, 30, 15, 10, 5],
                backgroundColor: ['#03c3ec', '#696cff', '#71dd37', '#ffab00', '#ff3e1d'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
