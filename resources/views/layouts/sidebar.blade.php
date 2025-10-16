<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span>
                <img src="{{ asset('img/logo-servicycle.png') }}" alt="Logo ServiCycle"
                    style="max-width: 100%; height: auto; display: block;">
            </span>

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Route::is('dashboard.admin') || Route::is('dashboard.workshop') || Route::is('dashboard.user') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @if (Auth::check() && Auth::user()->role === 'admin')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Admin</span>
            </li>
            <!-- Manajemen Pengguna -->
            <li class="menu-item {{ Route::is('manajemen-pengguna.*') ? 'active' : '' }}">
                <a href="{{ route('manajemen-pengguna.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                    <div data-i18n="Analytics">Manajemen Pengguna</div>
                </a>
            </li>
            <!-- Manajemen Langganan -->
            <li class="menu-item">
                <a href="{{ route('manajemen-langganan') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-receipt"></i>
                    <div data-i18n="Analytics">Manajemen Langganan</div>
                </a>
            </li>
            <!-- Laporan & Analitik -->
            <li class="menu-item">
                <a href="{{ route('laporan-analitik') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bar-chart"></i>
                    <div data-i18n="Analytics">Laporan & Analitik</div>
                </a>
            </li>
            <!-- Manajemen Notifikasi Sistem -->
            <li class="menu-item">
                <a href="{{ route('manajemen-notifikasi') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bell"></i>
                    <div data-i18n="Analytics">Manajemen Notifikasi</div>
                </a>
            </li>

            <!-- Pengaturan Aplikasi -->
            <li class="menu-item">
                <a href="{{ route('pengaturan-aplikasi') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Analytics">Pengaturan Aplikasi</div>
                </a>
            </li>
        @endif

        @if (Auth::check() && Auth::user()->role === 'vehicle_owner')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pemilik Kendaraan</span>
            </li>

            <!-- Kendaraan Saya -->
            <li class="menu-item {{ Route::is('vehicles.*') ? 'active' : '' }}">
                <a href="{{ route('vehicles.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-car"></i>
                    <div data-i18n="Analytics">Kendaraan Saya</div>
                </a>
            </li>

            <!-- Riwayat Servis -->
            <li class="menu-item">
                <a href="{{ route('riwayat-servis') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-wrench"></i>
                    <div data-i18n="Analytics">Riwayat Servis</div>
                </a>
            </li>

            <!-- Jadwal Servis -->
            <li class="menu-item">
                <a href="{{ route('jadwal-servis') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-calendar"></i>
                    <div data-i18n="Analytics">Jadwal Servis</div>
                </a>
            </li>

            <!-- Notifikasi Servis -->
            <li class="menu-item">
                <a href="{{ route('notifikasi-servis') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bell"></i>
                    <div data-i18n="Analytics">Notifikasi Servis</div>
                </a>
            </li>

            <!-- Catatan Masalah -->
            <li class="menu-item">
                <a href="{{ route('catatan-masalah') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-error"></i>
                    <div data-i18n="Analytics">Catatan Masalah</div>
                </a>
            </li>

            <!-- Upgrade Premium -->
            <li class="menu-item">
                <a href="{{ route('upgrade-premium') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-crown"></i>
                    <div data-i18n="Analytics">Upgrade Premium</div>
                </a>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role === 'workshop')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Bengkel</span>
            </li>

            <!-- Profil Bengkel -->
            <li class="menu-item {{ Route::is('profile.*') ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-store"></i>
                    <div data-i18n="Analytics">Profil Bengkel</div>
                </a>
            </li>

            <!-- Booking Servis -->
            <li class="menu-item">
                <a href="{{ route('booking-servis') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                    <div data-i18n="Analytics">Booking Servis</div>
                </a>
            </li>

            <!-- Servis & Sparepart -->
            <li class="menu-item">
                <a href="{{ route('servis-dan-sparepart') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-wrench"></i>
                    <div data-i18n="Analytics">Servis & Sparepart</div>
                </a>
            </li>

            <!-- Invoice Servis -->
            <li class="menu-item">
                <a href="{{ route('invoice-servis') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-receipt"></i>
                    <div data-i18n="Analytics">Invoice Servis</div>
                </a>
            </li>

            <!-- Promosi Bengkel (Premium) -->
            <li class="menu-item">
                <a href="{{ route('promosi-bengkel') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-gift"></i>
                    <div data-i18n="Analytics">Promosi Bengkel </div>
                </a>
            </li>
        @endif
        <br>
        <br>

    </ul>
</aside>

<!-- / Menu -->
