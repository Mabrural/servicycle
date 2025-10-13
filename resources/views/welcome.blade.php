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
                <a href="/login"
                    class="bg-primary text-white px-5 py-2.5 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow">
                    Masuk
                </a>
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
        <a href="/login" class="bottom-nav-item" data-section="login">
            <i class="fas fa-user"></i>
            <span>Akun</span>
        </a>
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
            <div id="locationStatus"
                class="mt-6 md:mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center">
                <i class="fas fa-info-circle text-blue-500 text-xl mr-3"></i>
                <p class="text-blue-700 text-sm md:text-base">Klik tombol di bawah untuk mengizinkan akses lokasi dan
                    melihat bengkel
                    terdekat</p>
            </div>

            <!-- Location Controls -->
            <div class="mt-4 md:mt-6 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                <button id="getLocationBtn"
                    class="bg-primary text-white px-4 py-3 md:px-6 md:py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center justify-center text-sm md:text-base">
                    <i class="fas fa-map-marker-alt mr-2"></i> Dapatkan Lokasi Saya
                </button>
                <div class="flex-1">
                    <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                        <input type="text" id="searchWorkshop" placeholder="Cari bengkel..."
                            class="flex-1 px-4 py-3 focus:outline-none text-sm md:text-base">
                        <button class="bg-gray-100 px-4 hover:bg-gray-200 transition-colors">
                            <i class="fas fa-search text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vehicle Type Tabs -->
            <div class="mt-6 md:mt-8 flex border-b border-gray-200 overflow-x-auto">
                <button
                    class="tab-button active px-4 py-3 md:px-6 md:py-3 font-medium text-sm md:text-base whitespace-nowrap"
                    data-type="all">Semua</button>
                <button class="tab-button px-4 py-3 md:px-6 md:py-3 font-medium text-sm md:text-base whitespace-nowrap"
                    data-type="motor">Motor</button>
                <button class="tab-button px-4 py-3 md:px-6 md:py-3 font-medium text-sm md:text-base whitespace-nowrap"
                    data-type="mobil">Mobil</button>
            </div>

            <!-- Workshops List -->
            <div id="workshopsList"
                class="mt-6 md:mt-8 grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 workshop-grid">
                <!-- Static workshop cards will be populated here -->
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="mt-6 md:mt-8 text-center hidden">
                <div class="bg-gray-100 rounded-lg p-6 md:p-8">
                    <i class="fas fa-search text-gray-400 text-3xl md:text-4xl mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold text-gray-600">Tidak ada bengkel ditemukan</h4>
                    <p class="text-gray-500 mt-2 text-sm md:text-base">Coba ubah pencarian atau filter Anda</p>
                </div>
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
                    <a href="/login"
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
        const getLocationBtn = document.getElementById('getLocationBtn');
        const locationStatus = document.getElementById('locationStatus');
        const workshopsList = document.getElementById('workshopsList');
        const noResults = document.getElementById('noResults');
        const searchWorkshop = document.getElementById('searchWorkshop');
        const tabButtons = document.querySelectorAll('.tab-button');

        let userLocation = null;
        let workshops = [{
                id: 1,
                name: "Bengkel Motor Maju Jaya",
                type: "motor",
                address: "Jl. Sudirman No. 123, Jakarta",
                distance: 1.2,
                rating: 4.8,
                open: true,
                services: ["Ganti Oli", "Service Rutin", "Ganti Ban"]
            },
            {
                id: 2,
                name: "AutoCare Center",
                type: "mobil",
                address: "Jl. Thamrin No. 45, Jakarta",
                distance: 2.5,
                rating: 4.6,
                open: true,
                services: ["Tune Up", "Ganti Oli", "Service AC"]
            },
            {
                id: 3,
                name: "Bengkel Sejahtera Motor",
                type: "motor",
                address: "Jl. Gatot Subroto No. 78, Jakarta",
                distance: 3.1,
                rating: 4.9,
                open: false,
                services: ["Service Rutin", "Ganti Kampas Rem", "Ganti Aki"]
            },
            {
                id: 4,
                name: "Mobil Plus Service",
                type: "mobil",
                address: "Jl. Rasuna Said No. 99, Jakarta",
                distance: 4.7,
                rating: 4.7,
                open: true,
                services: ["Service Berkala", "Ganti Oli", "Perbaikan Mesin"]
            },
            {
                id: 5,
                name: "Bengkel Motor Andalan",
                type: "motor",
                address: "Jl. Kemang No. 56, Jakarta",
                distance: 5.3,
                rating: 4.5,
                open: true,
                services: ["Ganti Oli", "Service Rutin", "Ganti Ban"]
            },
            {
                id: 6,
                name: "Auto Service Pro",
                type: "mobil",
                address: "Jl. Kuningan No. 32, Jakarta",
                distance: 6.2,
                rating: 4.9,
                open: true,
                services: ["Tune Up", "Ganti Oli", "Service AC", "Perbaikan Body"]
            }
        ];

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
            locationStatus.innerHTML = `
                <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3"></i>
                <p class="text-yellow-700">Akses lokasi ditolak. Anda masih dapat melihat daftar bengkel tanpa filter lokasi.</p>
            `;
            displayWorkshops();
        });

        // Get user location
        getLocationBtn.addEventListener('click', getLocation);

        function getLocation() {
            if (navigator.geolocation) {
                locationStatus.innerHTML = `
                    <i class="fas fa-spinner fa-spin text-blue-500 text-xl mr-3"></i>
                    <p class="text-blue-700">Mendapatkan lokasi Anda...</p>
                `;

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        userLocation = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        };

                        locationStatus.innerHTML = `
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                            <p class="text-green-700">Lokasi berhasil didapatkan! Menampilkan bengkel terdekat.</p>
                        `;

                        displayWorkshops();
                    },
                    function(error) {
                        console.error("Error getting location:", error);
                        locationStatus.innerHTML = `
                            <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                            <p class="text-red-700">Gagal mendapatkan lokasi. Pastikan Anda mengizinkan akses lokasi.</p>
                        `;
                        displayWorkshops();
                    }
                );
            } else {
                locationStatus.innerHTML = `
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                    <p class="text-red-700">Browser Anda tidak mendukung geolokasi.</p>
                `;
                displayWorkshops();
            }
        }

        // Display workshops
        function displayWorkshops(filterType = 'all', searchTerm = '') {
            let filteredWorkshops = workshops;

            // Filter by type
            if (filterType !== 'all') {
                filteredWorkshops = filteredWorkshops.filter(workshop => workshop.type === filterType);
            }

            // Filter by search term
            if (searchTerm) {
                filteredWorkshops = filteredWorkshops.filter(workshop =>
                    workshop.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    workshop.address.toLowerCase().includes(searchTerm.toLowerCase())
                );
            }

            // Sort by distance if location is available
            if (userLocation) {
                filteredWorkshops.sort((a, b) => a.distance - b.distance);
            }

            // Clear workshops list
            workshopsList.innerHTML = '';

            // Show no results message if no workshops found
            if (filteredWorkshops.length === 0) {
                noResults.classList.remove('hidden');
                return;
            } else {
                noResults.classList.add('hidden');
            }

            // Display workshops
            filteredWorkshops.forEach(workshop => {
                const workshopCard = document.createElement('div');
                workshopCard.className = 'bg-white rounded-xl shadow-lg p-4 md:p-6 workshop-card';

                const statusClass = workshop.open ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                const statusText = workshop.open ? 'Buka' : 'Tutup';

                workshopCard.innerHTML = `
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-lg md:text-xl font-semibold">${workshop.name}</h4>
                            <div class="flex items-center mt-1">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                <span class="text-gray-600 text-xs md:text-sm">${workshop.address}</span>
                            </div>
                        </div>
                        <span class="px-2 py-1 md:px-3 md:py-1 rounded-full text-xs md:text-sm font-medium ${statusClass}">${statusText}</span>
                    </div>
                    
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="font-medium text-sm md:text-base">${workshop.rating}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-road text-gray-400 mr-1"></i>
                            <span class="font-medium text-sm md:text-base">${workshop.distance} km</span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="font-medium mb-2 text-sm md:text-base">Layanan:</h5>
                        <div class="flex flex-wrap gap-1 md:gap-2">
                            ${workshop.services.map(service => 
                                `<span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">${service}</span>`
                            ).join('')}
                        </div>
                    </div>
                    
                    <div class="flex space-x-2 md:space-x-3">
                        <button class="flex-1 bg-primary text-white py-2 rounded-lg font-medium hover:bg-secondary transition-all duration-300 text-sm md:text-base">
                            <i class="fas fa-calendar-alt mr-1 md:mr-2"></i> Booking
                        </button>
                        <button class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 text-sm md:text-base">
                            <i class="fas fa-info-circle mr-1 md:mr-2"></i> Detail
                        </button>
                    </div>
                `;

                workshopsList.appendChild(workshopCard);
            });
        }

        // Tab functionality
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                tabButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');

                // Get filter type
                const filterType = this.getAttribute('data-type');

                // Display workshops with filter
                displayWorkshops(filterType, searchWorkshop.value);
            });
        });

        // Search functionality
        searchWorkshop.addEventListener('input', function() {
            const activeTab = document.querySelector('.tab-button.active');
            const filterType = activeTab ? activeTab.getAttribute('data-type') : 'all';

            displayWorkshops(filterType, this.value);
        });

        // Initial display of workshops
        displayWorkshops();
    </script>
</body>

</html>
