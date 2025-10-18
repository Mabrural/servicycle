@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manajemen Langganan</h3>
            <p class="text-muted mb-0">Kelola status langganan ServiCycle Premium Anda dengan mudah.</p>
        </div>
    </div>

    {{-- Section: Status Langganan --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-md-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <div class="display-6 text-warning me-3"><i class="bi bi-gem"></i></div>
                <div>
                    <h5 class="fw-bold mb-1">ServiCycle Premium</h5>
                    <p class="text-muted mb-0">Status Langganan: 
                        <span class="fw-semibold text-success">Aktif</span>
                    </p>
                    <small class="text-muted">Berlaku hingga: 25 Oktober 2026</small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#renewModal">
                    <i class="bi bi-arrow-repeat"></i> Perpanjang
                </button>
                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal">
                    <i class="bi bi-x-circle"></i> Batalkan
                </button>
            </div>
        </div>
    </div>

    {{-- Section: Riwayat Pembayaran --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
            <span>💳 Riwayat Pembayaran</span>
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Paket</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>25 Okt 2025</td>
                        <td>Paket Tahunan</td>
                        <td>DANA</td>
                        <td>Rp499.000</td>
                        <td><span class="badge bg-success">Berhasil</span></td>
                        <td><a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></a></td>
                    </tr>
                    <tr>
                        <td>25 Okt 2024</td>
                        <td>Paket Tahunan</td>
                        <td>GoPay</td>
                        <td>Rp499.000</td>
                        <td><span class="badge bg-success">Berhasil</span></td>
                        <td><a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></a></td>
                    </tr>
                    <tr>
                        <td>25 Sep 2023</td>
                        <td>Paket Bulanan</td>
                        <td>OVO</td>
                        <td>Rp49.000</td>
                        <td><span class="badge bg-secondary">Kedaluwarsa</span></td>
                        <td><a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section: Informasi Akun --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">👤 Informasi Akun Premium</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" class="form-control" value="Isyabel Salsabilla" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" value="isyabel@example.com" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Paket Aktif</label>
                    <input type="text" class="form-control" value="Paket Tahunan" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Pembaruan Berikutnya</label>
                    <input type="text" class="form-control" value="25 Oktober 2026" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Perpanjang --}}
<div class="modal fade" id="renewModal" tabindex="-1" aria-labelledby="renewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="renewModalLabel">Perpanjang Langganan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form>
                <div class="modal-body">
                    <p>Anda akan memperpanjang langganan untuk <span class="fw-bold text-warning">Paket Tahunan</span>.</p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pembayaran</label>
                        <select class="form-select" required>
                            <option selected disabled>Pilih metode pembayaran...</option>
                            <option>DANA</option>
                            <option>GoPay</option>
                            <option>OVO</option>
                            <option>Transfer Bank</option>
                            <option>Kartu Kredit</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" required id="renewCheck">
                        <label class="form-check-label small text-muted" for="renewCheck">
                            Saya menyetujui perpanjangan otomatis pada tanggal jatuh tempo.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Lanjutkan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal: Batalkan Langganan --}}
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-danger" id="cancelModalLabel">Batalkan Langganan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin membatalkan langganan Premium?</p>
                    <p class="text-muted small mb-3">Anda tetap dapat menggunakan fitur Premium hingga masa aktif berakhir.</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" required id="confirmCancel">
                        <label class="form-check-label small text-muted" for="confirmCancel">
                            Saya memahami bahwa pembatalan ini tidak dapat dibatalkan.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Konfirmasi Pembatalan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
