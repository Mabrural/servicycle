<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Kelola Servis Kendaraan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        secondary: '#6366f1',
                        accent: '#10b981',
                        dark: '#1f2937',
                        light: '#f9fafb'
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
            padding-bottom: 0px;
            /* Space for bottom nav */
        }

        .hero-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .pricing-card {
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            transform: scale(1.03);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .nav-link {
            position: relative;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #4f46e5;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.6);
        }

        /* Bottom Navigation Styles */
        .bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 50;
            padding: 8px 0;
        }

        .bottom-nav.active {
            display: flex;
        }

        .bottom-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px 4px;
            text-decoration: none;
            color: #6b7280;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
        }

        .bottom-nav-item.active {
            color: #4f46e5;
        }

        .bottom-nav-item i {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .bottom-nav-item span {
            font-size: 10px;
            font-weight: 500;
        }

        .bottom-nav-item.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background-color: #4f46e5;
            border-radius: 0 0 3px 3px;
        }

        @media (max-width: 768px) {
            .desktop-nav {
                display: none;
            }

            .header-login {
                display: none;
            }

            .bottom-nav {
                display: flex;
            }
        }

        /* Improved Responsive Design */
        @media (max-width: 640px) {
            .container-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .hero-bg h2 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .feature-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .workshop-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .testimonial-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .workshop-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimonial-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
        }

        .overlay.active {
            display: block;
        }

        .workshop-card {
            transition: all 0.3s ease;
        }

        .workshop-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .tab-button.active {
            background-color: #4f46e5;
            color: white;
        }

        .location-permission-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 100;
            justify-content: center;
            align-items: center;
        }

        .location-permission-modal.active {
            display: flex;
        }

        .location-permission-content {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .location-icon {
            font-size: 48px;
            color: #4f46e5;
            margin-bottom: 20px;
        }

        /* Touch improvements for mobile */
        @media (max-width: 768px) {

            .nav-link,
            .bottom-nav-item {
                -webkit-tap-highlight-color: transparent;
            }

            .btn-glow:active {
                transform: scale(0.98);
            }
        }

        /* Loading spinner */
        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #4f46e5;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Workshop list styles from first example */
        .workshop-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .name {
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }

        .address {
            color: #555;
            font-size: 14px;
            margin: 5px 0;
        }

        .distance {
            font-weight: bold;
            color: #0066cc;
        }

        .map-link {
            display: inline-block;
            margin-top: 8px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        .map-link:hover {
            background: #0056b3;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-primary p-2 rounded-lg mr-3">
                    <i class="fas fa-tools text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-primary">ServiCycle</h1>
            </div>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav hidden md:flex space-x-8 items-center">
                <a href="#workshops" class="nav-link text-gray-600 hover:text-primary">Bengkel</a>
                <a href="#promo" class="nav-link text-gray-600 hover:text-primary">Promo</a>
                <a href="#mitra" class="nav-link text-gray-600 hover:text-primary">Gabung Mitra</a>
            </nav>

            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- Jika user sudah login -->
                    <div class="relative inline-block text-left">
                        <button id="userMenuButton"
                            class="bg-primary text-white px-5 py-2.5 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center gap-2">
                            <i class='bx bx-user-circle text-xl'></i>
                            {{ Auth::user()->name }}
                            <i class='bx bx-chevron-down text-lg'></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="userDropdownMenu"
                            class="hidden absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-100">
                            <a href="{{ url('/dashboard') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-b-lg">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika user belum login -->
                    <a href="/login"
                        class="bg-primary text-white px-5 py-2.5 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow">
                        Masuk
                    </a>
                @endauth

                <!-- Tambahkan Boxicons -->
                <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

                <!-- Script Dropdown -->
                <script>
                    document.addEventListener('click', function(e) {
                        const button = document.getElementById('userMenuButton');
                        const menu = document.getElementById('userDropdownMenu');

                        if (button && menu) {
                            if (button.contains(e.target)) {
                                menu.classList.toggle('hidden');
                            } else if (!menu.contains(e.target)) {
                                menu.classList.add('hidden');
                            }
                        }
                    });
                </script>

            </div>
        </div>
    </header>

    <!-- Bottom Navigation for Mobile -->
    <div class="bottom-nav" id="bottomNav">
        <a href="#workshops" class="bottom-nav-item active" data-section="workshops">
            <i class="fas fa-map-marker-alt"></i>
            <span>Bengkel</span>
        </a>
        <a href="#promo" class="bottom-nav-item" data-section="promo">
            <i class="fas fa-tags"></i>
            <span>Promo</span>
        </a>
        <a href="#mitra" class="bottom-nav-item" data-section="mitra">
            <i class="fas fa-handshake"></i>
            <span>Mitra</span>
        </a>
        @auth
            <div class="bottom-nav-item relative" id="userDropdownWrapper" style="z-index: 50;">
                <!-- Tombol yang menampilkan nama singkat -->
                <button id="userMenuMobile" type="button"
                    class="flex flex-col items-center text-center text-gray-700 focus:outline-none" aria-haspopup="true"
                    aria-expanded="false" aria-controls="dropdownMobileMenu">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span>{{ \Illuminate\Support\Str::limit(Auth::user()->name, 8) }}</span>
                </button>

                <!-- Dropdown untuk mobile -->
                <div id="dropdownMobileMenu"
                    class="hidden absolute bottom-14 left-1/2 transform -translate-x-1/2 bg-white shadow-lg rounded-lg w-44 border border-gray-100"
                    role="menu" aria-labelledby="userMenuMobile">
                    <a href="{{ url('/dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg text-sm" role="menuitem">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-b-lg text-sm"
                            role="menuitem">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="/login" class="bottom-nav-item" data-section="login">
                <i class="fas fa-user"></i>
                <span>Akun</span>
            </a>
        @endauth


        <!-- Script dropdown (perbaikan) -->
        <script>
            (function() {
                const btn = document.getElementById('userMenuMobile');
                const menu = document.getElementById('dropdownMobileMenu');

                if (!btn || !menu) return;

                // Toggle dropdown saat tombol diklik — stopPropagation supaya event tidak 'bocor' ke document
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = menu.classList.contains('hidden');
                    // Set aria-expanded untuk aksesibilitas
                    btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                    menu.classList.toggle('hidden');
                });

                // Stop propagation ketika klik di dalam menu agar document listener tidak langsung menutupnya
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // jika kamu mau menutup dropdown setelah klik link (mis. untuk SPA), uncomment:
                    // menu.classList.add('hidden');
                    // btn.setAttribute('aria-expanded', 'false');
                });

                // Klik di luar tombol/menu akan menutup dropdown
                document.addEventListener('click', function() {
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });

                // Tutup dropdown saat menekan Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                        btn.setAttribute('aria-expanded', 'false');
                        btn.focus();
                    }
                });

                // Optional: dukungan touch (beberapa browser mobile memicu pointerdown lebih cepat)
                btn.addEventListener('touchstart', function(e) {
                    e.stopPropagation();
                }, {
                    passive: true
                });
                menu.addEventListener('touchstart', function(e) {
                    e.stopPropagation();
                }, {
                    passive: true
                });
            })();
        </script>


    </div>

    <!-- Location Permission Modal -->
    <div class="location-permission-modal" id="locationPermissionModal">
        <div class="location-permission-content">
            <div class="location-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4">Izinkan Akses Lokasi</h3>
            <p class="text-gray-600 mb-6">ServiCycle memerlukan akses lokasi Anda untuk menampilkan bengkel terdekat dan
                memberikan rekomendasi yang lebih akurat.</p>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                <button id="allowLocation"
                    class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex-1">
                    Izinkan
                </button>
                <button id="denyLocation"
                    class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 flex-1">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-bg text-white py-16 md:py-20 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full animate-float"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-white rounded-full animate-float"
                style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center relative z-10">
            <div class="flex-1">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 inline-flex items-center mb-6">
                    <i class="fas fa-medal mr-2 text-yellow-300"></i>
                    <span class="text-sm md:text-base">Platform Terbaik untuk Perawatan Kendaraan</span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight">
                    Kelola Servis Kendaraan Jadi Lebih Mudah
                </h2>
                <p class="mt-4 text-base md:text-lg text-indigo-100 max-w-xl">
                    Catat, pantau, dan atur perawatan kendaraan Anda dengan ServiCycle.
                    Hemat biaya, terorganisir, dan selalu siap diingatkan servis berikutnya.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#workshops"
                        class="bg-white text-primary px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 flex items-center justify-center btn-glow text-sm md:text-base">
                        <i class="fas fa-map-marker-alt mr-2"></i> Cari Bengkel Terdekat
                    </a>
                    <a href="#features"
                        class="bg-transparent border-2 border-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-white hover:text-primary transition-all duration-300 flex items-center justify-center text-sm md:text-base">
                        <i class="fas fa-play-circle mr-2"></i> Lihat Demo
                    </a>
                </div>
                <div
                    class="mt-8 md:mt-10 flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-300 text-xl mr-2"></i>
                        <span class="text-sm md:text-base">Gratis untuk digunakan</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-300 text-xl mr-2"></i>
                        <span class="text-sm md:text-base">Tanpa kartu kredit</span>
                    </div>
                </div>
            </div>
            <div class="flex-1 mt-10 md:mt-0 animate-float">
                <img src="{{ asset('img/ilustrasi.png') }}" alt="Ilustrasi ServiCycle"
                    class="w-full rounded-xl shadow-2xl" />
            </div>
        </div>
    </section>

    <!-- Bengkel Section -->
    <section id="workshops" class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Cari Bengkel Terdekat</h3>
                <p class="text-gray-600 text-sm md:text-base">Temukan bengkel terpercaya di dekat lokasi Anda</p>
            </div>

            <!-- Location Status -->
            <div id="locationStatus" class="mt-6 md:mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-blue-700 text-center">Mengambil lokasi Anda...</p>
            </div>

            <!-- Workshops List -->
            <div class="workshop-list mt-6 md:mt-8" id="workshopList">
                <!-- Workshop cards will be populated by JavaScript -->
                @foreach ($workshops as $workshop)
                    <div class="card" data-lat="{{ $workshop->latitude }}" data-lng="{{ $workshop->longitude }}"
                        data-id="{{ $workshop->id }}">
                        <img src="{{ asset('img/bengkel-mobil.jpeg') }}" alt="Gambar Bengkel"
                            class="relative overflow-hidden rounded-xl mb-2">
                        <div class="name">{{ $workshop->name }}</div>
                        <div class="city"><i class="fa-solid fa-location-dot text-red-500"></i>
                            {{ $workshop->city ?? '-' }}</div>
                        <div class="distance">Jarak: menghitung...</div>
                        {{-- Tombol Aksi --}}
                        <div class="mt-4 flex items-center justify-between">
                            <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                                <i class="fa-solid fa-map-location-dot"></i> Lihat di Google Maps
                            </a>

                            <a href="{{ route('workshops.show', $workshop->id) }}"
                                class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                                <i class="fa-solid fa-info-circle"></i> Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section id="features" class="py-16 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Fitur Unggulan ServiCycle</h3>
                <p class="text-gray-600 text-sm md:text-base">Kami menyediakan segala yang Anda butuhkan untuk
                    mengelola perawatan kendaraan
                    dengan mudah</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-8 md:mt-12 feature-grid">
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg feature-card">
                    <div
                        class="bg-primary/10 w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clipboard-list text-2xl md:text-3xl text-primary"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-4">Catat Riwayat Servis</h4>
                    <p class="text-gray-600 text-sm md:text-base">Simpan detail servis, sparepart, dan biaya agar
                        selalu terkontrol dengan
                        rapi.</p>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg feature-card">
                    <div
                        class="bg-accent/10 w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bell text-2xl md:text-3xl text-accent"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-4">Notifikasi Otomatis</h4>
                    <p class="text-gray-600 text-sm md:text-base">Dapatkan pengingat jadwal servis kendaraan Anda
                        secara otomatis via email
                        &
                        notifikasi.</p>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg feature-card">
                    <div
                        class="bg-secondary/10 w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-check text-2xl md:text-3xl text-secondary"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-4">Booking Bengkel</h4>
                    <p class="text-gray-600 text-sm md:text-base">Pesan jadwal servis langsung dari aplikasi dengan
                        bengkel rekanan
                        terpercaya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    <section id="promo" class="py-16 md:py-20 bg-gradient-to-r from-primary to-secondary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">Promo Spesial</h3>
            <p class="text-indigo-100 mb-6 md:mb-8 text-sm md:text-base">Dapatkan penawaran menarik untuk servis
                kendaraan Anda</p>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-8 md:mt-12">
                <div class="bg-white/10 backdrop-blur-sm p-4 md:p-6 rounded-xl">
                    <div
                        class="bg-white/20 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tags text-xl md:text-2xl"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Diskon 20%</h4>
                    <p class="text-indigo-100 text-sm md:text-base">Servis pertama di bengkel mitra kami</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-4 md:p-6 rounded-xl">
                    <div
                        class="bg-white/20 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-gift text-xl md:text-2xl"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Gratis Pemeriksaan</h4>
                    <p class="text-indigo-100 text-sm md:text-base">Pemeriksaan gratis untuk kendaraan baru</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-4 md:p-6 rounded-xl">
                    <div
                        class="bg-white/20 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-xl md:text-2xl"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Cashback 10%</h4>
                    <p class="text-indigo-100 text-sm md:text-base">Untuk setiap transaksi melalui aplikasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gabung Mitra Section -->
    <section id="mitra" class="py-16 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Gabung Menjadi Mitra</h3>
                <p class="text-gray-600 text-sm md:text-base">Tingkatkan bisnis bengkel Anda dengan bergabung sebagai
                    mitra ServiCycle</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8 md:gap-12 mt-8 md:mt-12">
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg">
                    <h4 class="text-xl md:text-2xl font-semibold mb-4 md:mb-6 text-primary">Keuntungan Menjadi Mitra
                    </h4>
                    <ul class="space-y-3 md:space-y-4 text-gray-600 text-sm md:text-base">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Jangkauan pelanggan yang lebih luas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Sistem booking otomatis</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Manajemen inventaris yang mudah</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Laporan keuangan terintegrasi</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Dukungan teknis 24/7</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-primary text-white p-6 md:p-8 rounded-xl">
                    <h4 class="text-xl md:text-2xl font-semibold mb-4 md:mb-6">Daftar Sekarang</h4>
                    <p class="mb-4 md:mb-6 text-sm md:text-base">Isi formulir pendaftaran untuk bergabung sebagai mitra
                        ServiCycle</p>
                    <a href="/register"
                        class="bg-white text-primary px-4 py-3 md:px-6 md:py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 btn-glow inline-block text-sm md:text-base">
                        Daftar sebagai Mitra
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Cara Kerja ServiCycle</h3>
                <p class="text-gray-600 text-sm md:text-base">Hanya perlu 3 langkah mudah untuk mulai mengelola servis
                    kendaraan Anda</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6 md:gap-8 mt-12 md:mt-16">
                <div class="text-center">
                    <div
                        class="bg-primary/10 w-20 h-20 md:w-24 md:h-24 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6 relative">
                        <span
                            class="absolute -top-2 -left-2 bg-primary text-white rounded-full w-6 h-6 md:w-8 md:h-8 flex items-center justify-center text-xs md:text-sm">1</span>
                        <i class="fas fa-user-plus text-2xl md:text-3xl text-primary"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Buat Akun</h4>
                    <p class="text-gray-600 text-sm md:text-base">Daftar akun gratis dan tambahkan kendaraan Anda ke
                        dalam sistem</p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-accent/10 w-20 h-20 md:w-24 md:h-24 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6 relative">
                        <span
                            class="absolute -top-2 -left-2 bg-accent text-white rounded-full w-6 h-6 md:w-8 md:h-8 flex items-center justify-center text-xs md:text-sm">2</span>
                        <i class="fas fa-tools text-2xl md:text-3xl text-accent"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Catat Servis</h4>
                    <p class="text-gray-600 text-sm md:text-base">Tambahkan riwayat servis dan dapatkan rekomendasi
                        perawatan</p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-secondary/10 w-20 h-20 md:w-24 md:h-24 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6 relative">
                        <span
                            class="absolute -top-2 -left-2 bg-secondary text-white rounded-full w-6 h-6 md:w-8 md:h-8 flex items-center justify-center text-xs md:text-sm">3</span>
                        <i class="fas fa-chart-line text-2xl md:text-3xl text-secondary"></i>
                    </div>
                    <h4 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Pantau & Analisis</h4>
                    <p class="text-gray-600 text-sm md:text-base">Pantau kesehatan kendaraan dan analisis biaya
                        perawatan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Apa Kata Pengguna Kami</h3>
                <p class="text-gray-600 text-sm md:text-base">Dengarkan pengalaman langsung dari pengguna ServiCycle
                </p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-8 md:mt-12 testimonial-grid">
                <div class="p-4 md:p-6 bg-gray-50 rounded-xl shadow-lg testimonial-card">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 md:w-12 md:h-12 bg-primary/10 rounded-full flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm md:text-base">Andi, Mahasiswa</h4>
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base">"Saya jadi nggak pernah lupa servis motor.
                        Notifikasinya sangat membantu
                        dan mengingatkan saya tepat waktu!"</p>
                </div>
                <div class="p-4 md:p-6 bg-gray-50 rounded-xl shadow-lg testimonial-card">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 md:w-12 md:h-12 bg-accent/10 rounded-full flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-user text-accent"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm md:text-base">Budi, Pemilik Bengkel</h4>
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base">"Sebagai pemilik bengkel, saya bisa kelola booking
                        lebih rapi dengan
                        ServiCycle Premium. Pelanggan juga lebih puas!"</p>
                </div>
                <div class="p-4 md:p-6 bg-gray-50 rounded-xl shadow-lg testimonial-card">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 md:w-12 md:h-12 bg-secondary/10 rounded-full flex items-center justify-center mr-3 md:mr-4">
                            <i class="fas fa-user text-secondary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm md:text-base">Rina, Manager Operasional</h4>
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base">"Aplikasi ini membantu saya memantau biaya servis
                        mobil kantor, sangat
                        efisien dan menghemat waktu!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 md:py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Pertanyaan Umum</h3>
                <p class="text-gray-600 text-sm md:text-base">Temukan jawaban atas pertanyaan yang sering diajukan</p>
            </div>
            <div class="mt-8 md:mt-12 space-y-4 md:space-y-6">
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h4 class="font-semibold text-base md:text-lg mb-2 flex items-center">
                        <i class="fas fa-question-circle text-primary mr-3"></i>
                        Bagaimana cara mendaftar di ServiCycle?
                    </h4>
                    <p class="text-gray-600 text-sm md:text-base">Anda cukup klik tombol "Mulai Sekarang" di atas, isi
                        formulir pendaftaran,
                        dan verifikasi email Anda. Setelah itu, Anda bisa langsung mulai menggunakan layanan kami.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h4 class="font-semibold text-base md:text-lg mb-2 flex items-center">
                        <i class="fas fa-question-circle text-primary mr-3"></i>
                        Apakah benar-benar gratis?
                    </h4>
                    <p class="text-gray-600 text-sm md:text-base">Ya, paket gratis kami memberikan akses ke fitur dasar
                        tanpa biaya
                        selamanya. Untuk fitur premium seperti booking bengkel dan laporan detail, tersedia paket
                        berbayar.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h4 class="font-semibold text-base md:text-lg mb-2 flex items-center">
                        <i class="fas fa-question-circle text-primary mr-3"></i>
                        Bagaimana cara pembayaran paket premium?
                    </h4>
                    <p class="text-gray-600 text-sm md:text-base">Kami menerima pembayaran melalui transfer bank, kartu
                        kredit, dan dompet
                        digital. Setelah pembayaran dikonfirmasi, akun Anda akan langsung diupgrade ke premium.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 text-center stats-grid">
                <div class="p-4 md:p-6">
                    <div
                        class="bg-primary/10 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-xl md:text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-primary">10K+</h3>
                    <p class="text-gray-600 text-sm md:text-base">Pengguna Aktif</p>
                </div>
                <div class="p-4 md:p-6">
                    <div
                        class="bg-accent/10 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-car text-xl md:text-2xl text-accent"></i>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-accent">25K+</h3>
                    <p class="text-gray-600 text-sm md:text-base">Kendaraan Terdaftar</p>
                </div>
                <div class="p-4 md:p-6">
                    <div
                        class="bg-secondary/10 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-wrench text-xl md:text-2xl text-secondary"></i>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-secondary">15K+</h3>
                    <p class="text-gray-600 text-sm md:text-base">Servis Tercatat</p>
                </div>
                <div class="p-4 md:p-6">
                    <div
                        class="bg-purple-500/10 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-xl md:text-2xl text-purple-500"></i>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-purple-500">4.9/5</h3>
                    <p class="text-gray-600 text-sm md:text-base">Rating Pengguna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-20 bg-primary text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6">Siap Mengelola Servis Kendaraan Anda?</h3>
            <p class="text-indigo-100 mb-6 md:mb-10 text-sm md:text-base">Bergabunglah dengan ribuan pengguna lainnya
                dan rasakan kemudahan
                mengelola
                perawatan kendaraan</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="/register"
                    class="bg-white text-primary px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 btn-glow text-sm md:text-base">
                    Daftar Sekarang - Gratis
                </a>
                <a href="#contact"
                    class="bg-transparent border-2 border-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-white hover:text-primary transition-all duration-300 text-sm md:text-base">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-gray-300 py-8 md:py-12">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 footer-grid">
            <div>
                <div class="flex items-center mb-4">
                    <div class="bg-primary p-2 rounded-lg mr-3">
                        <i class="fas fa-tools text-white"></i>
                    </div>
                    <h4 class="text-white font-bold text-lg md:text-xl">ServiCycle</h4>
                </div>
                <p class="mb-4 text-sm md:text-base">Platform terdepan untuk manajemen perawatan kendaraan Anda.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3 md:mb-4 text-base md:text-lg">Navigasi</h4>
                <ul class="space-y-2 text-sm md:text-base">
                    <li><a href="#features" class="hover:text-white">Fitur</a></li>
                    <li><a href="#workshops" class="hover:text-white">Bengkel</a></li>
                    <li><a href="#promo" class="hover:text-white">Promo</a></li>
                    <li><a href="#mitra" class="hover:text-white">Gabung Mitra</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3 md:mb-4 text-base md:text-lg">Layanan</h4>
                <ul class="space-y-2 text-sm md:text-base">
                    <li><a href="#" class="hover:text-white">Blog</a></li>
                    <li><a href="#" class="hover:text-white">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-white">Status Server</a></li>
                    <li><a href="#" class="hover:text-white">Bengkel Rekanan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3 md:mb-4 text-base md:text-lg">Kontak</h4>
                <ul class="space-y-2 text-sm md:text-base">
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-primary"></i>
                        <span>support@servicycle.com</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-primary"></i>
                        <span>+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mr-3 text-primary mt-1"></i>
                        <span>Jl. Teknologi No. 123, Jakarta Selatan, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="text-center text-gray-500 mt-6 md:mt-10 pt-4 md:pt-6 border-t border-gray-800 text-sm md:text-base">
            © 2025 ServiCycle. All rights
            reserved.</div>
    </footer>

    <script>
        // Bottom Navigation Functionality
        const bottomNav = document.getElementById('bottomNav');
        const bottomNavItems = document.querySelectorAll('.bottom-nav-item');

        // Set active nav item based on scroll position
        function setActiveNavItem() {
            const sections = document.querySelectorAll('section');
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    currentSection = section.id;
                }
            });

            bottomNavItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('data-section') === currentSection) {
                    item.classList.add('active');
                }
            });
        }

        // Scroll to section when bottom nav item is clicked
        bottomNavItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const targetSection = this.getAttribute('data-section');

                if (targetSection === 'login') {
                    // Redirect to login page
                    window.location.href = '/login';
                } else {
                    // Scroll to section
                    const targetElement = document.getElementById(targetSection);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Update active nav item on scroll
        window.addEventListener('scroll', setActiveNavItem);

        // Location permission and workshops functionality
        const locationPermissionModal = document.getElementById('locationPermissionModal');
        const allowLocationBtn = document.getElementById('allowLocation');
        const denyLocationBtn = document.getElementById('denyLocation');
        const locationStatus = document.getElementById('locationStatus');
        const workshopList = document.getElementById('workshopList');

        // Show location permission modal when page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                locationPermissionModal.classList.add('active');
            }, 1000);
        });

        // Handle location permission
        allowLocationBtn.addEventListener('click', function() {
            locationPermissionModal.classList.remove('active');
            getLocation();
        });

        denyLocationBtn.addEventListener('click', function() {
            locationPermissionModal.classList.remove('active');
            locationStatus.innerHTML =
                '<p class="text-yellow-700 text-center">Akses lokasi ditolak. Anda masih dapat melihat daftar bengkel tanpa filter lokasi.</p>';
            // Calculate distances without location
            calculateDistances();
        });

        // Get user location
        function getLocation() {
            if (navigator.geolocation) {
                locationStatus.innerHTML = '<p class="text-blue-700 text-center">Mendapatkan lokasi Anda...</p>';

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        locationStatus.innerHTML =
                            '<p class="text-green-700 text-center">Lokasi berhasil didapatkan </p>';

                        // Calculate distances with user location
                        calculateDistances(userLat, userLng);
                    },
                    function(error) {
                        console.error("Error getting location:", error);
                        locationStatus.innerHTML =
                            '<p class="text-red-700 text-center">Gagal mendapatkan lokasi </p>';
                        // Calculate distances without location
                        calculateDistances();
                    }
                );
            } else {
                locationStatus.innerHTML =
                    '<p class="text-red-700 text-center">Browser Anda tidak mendukung geolokasi.</p>';
                // Calculate distances without location
                calculateDistances();
            }
        }

        // Hitung jarak menggunakan formula haversine (from first example)
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam KM
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) *
                Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // hasil km
        }

        // Calculate distances and sort workshops
        function calculateDistances(userLat = null, userLng = null) {
            const cards = Array.from(document.querySelectorAll('.card'));

            // Calculate distance for each workshop
            cards.forEach(card => {
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);

                if (userLat && userLng && lat && lng) {
                    const distance = calculateDistance(userLat, userLng, lat, lng);
                    card.querySelector('.distance').innerHTML =
                        `<i class="fa-solid fa-route text-green-500"></i> ${distance.toFixed(2)} km`;
                    card.dataset.distance = distance;
                } else {
                    card.querySelector('.distance').innerHTML =
                        `<i class="fa-solid fa-route text-gray-400"></i> Jarak: tidak tersedia`;
                    card.dataset.distance = 99999; // Large number for sorting
                }

            });

            // Sort by distance (nearest first) if location is available
            if (userLat && userLng) {
                const sorted = cards.sort((a, b) => a.dataset.distance - b.dataset.distance);

                // Re-append sorted cards
                workshopList.innerHTML = '';
                sorted.forEach(c => workshopList.appendChild(c));
            }
        }
    </script>
</body>

</html>
