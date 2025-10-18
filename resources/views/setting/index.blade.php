@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1"><strong>Pengaturan Aplikasi</strong></h1>
                <p class="text-muted mb-0">Atur preferensi umum, sistem, dan konfigurasi tampilan aplikasi.</p>
            </div>
            <button type="submit" form="appSettingsForm" class="btn btn-primary btn-sm">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>

        {{-- Tabs Navigasi --}}
        <ul class="nav nav-pills mb-4" id="settingsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab">
                    ⚙️ Umum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="system-tab" data-bs-toggle="pill" data-bs-target="#system" type="button" role="tab">
                    🖥️ Sistem
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="appearance-tab" data-bs-toggle="pill" data-bs-target="#appearance" type="button" role="tab">
                    🎨 Tampilan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="notification-tab" data-bs-toggle="pill" data-bs-target="#notification" type="button" role="tab">
                    🔔 Notifikasi
                </button>
            </li>
        </ul>

        {{-- Tab Content --}}
        <form id="appSettingsForm" method="POST" action="#">
            @csrf
            <div class="tab-content" id="settingsTabsContent">

                {{-- Tab: Umum --}}
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold">⚙️ Pengaturan Umum</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Aplikasi</label>
                                <input type="text" class="form-control" name="app_name" value="{{ old('app_name', 'ServiCycle') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Singkat</label>
                                <textarea class="form-control" name="app_description" rows="3" placeholder="Deskripsi aplikasi singkat...">{{ old('app_description', 'Aplikasi pelacak dan manajemen servis kendaraan modern.') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Admin</label>
                                <input type="email" class="form-control" name="admin_email" value="{{ old('admin_email', 'admin@servicycle.com') }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Sistem --}}
                <div class="tab-pane fade" id="system" role="tabpanel">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold">🖥️ Pengaturan Sistem</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Zona Waktu</label>
                                    <select class="form-select" name="timezone">
                                        <option value="Asia/Jakarta" selected>Asia/Jakarta (GMT+7)</option>
                                        <option value="Asia/Singapore">Asia/Singapore (GMT+8)</option>
                                        <option value="Asia/Tokyo">Asia/Tokyo (GMT+9)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Bahasa Default</label>
                                    <select class="form-select" name="language">
                                        <option value="id" selected>Bahasa Indonesia</option>
                                        <option value="en">English</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="maintenanceMode" name="maintenance_mode">
                                <label class="form-check-label fw-semibold" for="maintenanceMode">Aktifkan Mode Pemeliharaan</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Tampilan --}}
                <div class="tab-pane fade" id="appearance" role="tabpanel">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold">🎨 Pengaturan Tampilan</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tema Warna</label>
                                <select class="form-select" name="theme_color">
                                    <option value="default" selected>Default (Biru)</option>
                                    <option value="dark">Gelap</option>
                                    <option value="light">Terang</option>
                                    <option value="pink">Lembut (Pink)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Logo Aplikasi</label>
                                <input type="file" class="form-control" name="app_logo" accept="image/*">
                                <small class="text-muted">Format: PNG/JPG, max 1MB</small>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="roundedCards" name="rounded_cards" checked>
                                <label class="form-check-label" for="roundedCards">Gunakan sudut membulat pada kartu</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab: Notifikasi --}}
                <div class="tab-pane fade" id="notification" role="tabpanel">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold">🔔 Pengaturan Notifikasi</div>
                        <div class="card-body">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="emailNotification" name="email_notification" checked>
                                <label class="form-check-label fw-semibold" for="emailNotification">
                                    Aktifkan notifikasi email untuk pengguna
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="pushNotification" name="push_notification">
                                <label class="form-check-label fw-semibold" for="pushNotification">
                                    Aktifkan notifikasi push di aplikasi
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Frekuensi Pemberitahuan Otomatis</label>
                                <select class="form-select" name="notification_frequency">
                                    <option value="daily">Harian</option>
                                    <option value="weekly">Mingguan</option>
                                    <option value="monthly">Bulanan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
