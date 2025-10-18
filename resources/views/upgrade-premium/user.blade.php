@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Upgrade ke ServiCycle Premium</h3>
            <p class="text-muted mb-0">Nikmati fitur eksklusif untuk pengalaman servis kendaraan yang lebih cepat, mudah, dan terintegrasi.</p>
        </div>
    </div>

    {{-- Section: Benefit --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">✨ Keuntungan Pengguna Premium</h5>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="display-5 text-primary mb-2"><i class="bi bi-lightning-charge-fill"></i></div>
                        <h6 class="fw-semibold">Prioritas Servis</h6>
                        <p class="text-muted small mb-0">Nikmati antrean servis prioritas tanpa menunggu lama.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="display-5 text-warning mb-2"><i class="bi bi-bell-fill"></i></div>
                        <h6 class="fw-semibold">Notifikasi Real-Time</h6>
                        <p class="text-muted small mb-0">Dapatkan update langsung tentang status servis kendaraan Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="display-5 text-success mb-2"><i class="bi bi-shield-check"></i></div>
                        <h6 class="fw-semibold">Garansi Perawatan</h6>
                        <p class="text-muted small mb-0">Setiap servis dilindungi garansi perawatan hingga 30 hari.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section: Paket Premium --}}
    <div class="row g-4">
        {{-- Paket Bulanan --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-calendar2-heart display-4 text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Paket Bulanan</h5>
                    <p class="text-muted mb-4">Cocok untuk pengguna aktif yang ingin mencoba fitur premium dalam jangka pendek.</p>
                    <h3 class="fw-bold mb-3 text-primary">Rp49.000<span class="fs-6 text-muted">/bulan</span></h3>
                    <ul class="list-unstyled text-start small mb-4">
                        <li><i class="bi bi-check-circle text-success me-2"></i> Prioritas Servis</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Notifikasi Real-Time</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Laporan Servis Bulanan</li>
                    </ul>
                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#upgradeModal" data-plan="Bulanan">
                        Pilih Paket Ini
                    </button>
                </div>
            </div>
        </div>

        {{-- Paket Tahunan --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 position-relative">
                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3">🔥 Paling Populer</span>
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-gem display-4 text-warning"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Paket Tahunan</h5>
                    <p class="text-muted mb-4">Hemat lebih dari 20% dan dapatkan pengalaman penuh ServiCycle Premium sepanjang tahun.</p>
                    <h3 class="fw-bold mb-3 text-warning">Rp499.000<span class="fs-6 text-muted">/tahun</span></h3>
                    <ul class="list-unstyled text-start small mb-4">
                        <li><i class="bi bi-check-circle text-success me-2"></i> Semua fitur Premium Bulanan</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Garansi Servis 30 Hari</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Akses Laporan Tahunan</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Dukungan Prioritas 24/7</li>
                    </ul>
                    <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#upgradeModal" data-plan="Tahunan">
                        Pilih Paket Ini
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Modal Upgrade --}}
<div class="modal fade" id="upgradeModal" tabindex="-1" aria-labelledby="upgradeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="upgradeModalLabel">Konfirmasi Upgrade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form>
                <div class="modal-body">
                    <p>Anda akan melakukan upgrade ke <span id="planName" class="fw-bold text-primary">Paket Premium</span>.</p>
                    <p class="mb-3">Pastikan metode pembayaran Anda aktif dan saldo mencukupi.</p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pembayaran</label>
                        <select class="form-select" required>
                            <option selected disabled>Pilih metode pembayaran...</option>
                            <option>Transfer Bank</option>
                            <option>GoPay</option>
                            <option>OVO</option>
                            <option>DANA</option>
                            <option>Kartu Kredit</option>
                        </select>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="termsCheck" required>
                        <label class="form-check-label small text-muted" for="termsCheck">
                            Saya menyetujui syarat dan ketentuan layanan ServiCycle Premium.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script: Menampilkan nama paket di modal --}}
<script>
    const upgradeModal = document.getElementById('upgradeModal');
    upgradeModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const plan = button.getAttribute('data-plan');
        const planName = upgradeModal.querySelector('#planName');
        planName.textContent = `Paket ${plan}`;
    });
</script>
@endsection
