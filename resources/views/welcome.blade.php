<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Kelola Servis Kendaraan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
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

        .mobile-menu {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 40;
            padding: 80px 20px 20px;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }

        .mobile-menu.active {
            transform: translateX(0);
            display: block;
        }

        .mobile-menu ul {
            list-style: none;
        }

        .mobile-menu ul li {
            margin-bottom: 15px;
        }

        .mobile-menu ul li a {
            display: block;
            padding: 12px 15px;
            color: #374151;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .mobile-menu ul li a:hover {
            background-color: #f3f4f6;
            color: #4f46e5;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
            cursor: pointer;
            z-index: 50;
        }

        .menu-toggle span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: #4f46e5;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            nav.desktop-nav {
                display: none;
            }

            .header-login {
                display: none;
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
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-primary p-2 rounded-lg mr-3">
                    <i class="fas fa-tools text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-primary">ServiCycle</h1>
            </div>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav hidden md:flex space-x-8">
                <a href="#features" class="nav-link text-gray-600 hover:text-primary">Fitur</a>
                <a href="#pricing" class="nav-link text-gray-600 hover:text-primary">Harga</a>
                <a href="#testimoni" class="nav-link text-gray-600 hover:text-primary">Testimoni</a>
                <a href="#faq" class="nav-link text-gray-600 hover:text-primary">FAQ</a>
                <a href="#contact" class="nav-link text-gray-600 hover:text-primary">Kontak</a>
            </nav>

            <!-- Mobile Menu Toggle -->
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <a href="/login"
                class="ml-6 bg-primary text-white px-5 py-2.5 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow hidden md:flex items-center header-login">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </a>
        </div>
    </header>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="#features" class="mobile-nav-link">Fitur</a></li>
            <li><a href="#pricing" class="mobile-nav-link">Harga</a></li>
            <li><a href="#testimoni" class="mobile-nav-link">Testimoni</a></li>
            <li><a href="#faq" class="mobile-nav-link">FAQ</a></li>
            <li><a href="#contact" class="mobile-nav-link">Kontak</a></li>
            <li><a href="/login"
                    class="bg-primary text-white px-5 py-2.5 rounded-lg font-medium hover:bg-secondary transition-all duration-300 flex items-center justify-center mt-4">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="hero-bg text-white py-20 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full animate-float"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-white rounded-full animate-float"
                style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center relative z-10">
            <div class="flex-1">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 inline-flex items-center mb-6">
                    <i class="fas fa-medal mr-2 text-yellow-300"></i>
                    <span>Platform Terbaik untuk Perawatan Kendaraan</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    Kelola Servis Kendaraan Jadi Lebih Mudah <span class="text-yellow-300">🚗🔧</span>
                </h2>
                <p class="mt-4 text-lg text-indigo-100 max-w-xl">
                    Catat, pantau, dan atur perawatan kendaraan Anda dengan ServiCycle.
                    Hemat biaya, terorganisir, dan selalu siap diingatkan servis berikutnya.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#pricing"
                        class="bg-white text-primary px-8 py-4 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 flex items-center justify-center btn-glow">
                        <i class="fas fa-rocket mr-2"></i> Mulai Sekarang
                    </a>
                    <a href="#features"
                        class="bg-transparent border-2 border-white px-8 py-4 rounded-lg font-medium hover:bg-white hover:text-primary transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-play-circle mr-2"></i> Lihat Demo
                    </a>
                </div>
                <div class="mt-10 flex items-center space-x-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-300 text-xl mr-2"></i>
                        <span>Gratis untuk digunakan</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-300 text-xl mr-2"></i>
                        <span>Tanpa kartu kredit</span>
                    </div>
                </div>
            </div>
            <div class="flex-1 mt-10 md:mt-0 animate-float">
                <img src="https://placehold.co/600x400/4f46e5/white?text=ServiCycle+Illustration"
                    alt="Ilustrasi ServiCycle" class="w-full rounded-xl shadow-2xl" />
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-primary">10K+</h3>
                    <p class="text-gray-600">Pengguna Aktif</p>
                </div>
                <div class="p-6">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-car text-2xl text-accent"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-accent">25K+</h3>
                    <p class="text-gray-600">Kendaraan Terdaftar</p>
                </div>
                <div class="p-6">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-wrench text-2xl text-secondary"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-secondary">15K+</h3>
                    <p class="text-gray-600">Servis Tercatat</p>
                </div>
                <div class="p-6">
                    <div class="bg-purple-500/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-2xl text-purple-500"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-purple-500">4.9/5</h3>
                    <p class="text-gray-600">Rating Pengguna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-3xl font-bold mb-4">Fitur Unggulan ServiCycle</h3>
                <p class="text-gray-600">Kami menyediakan segala yang Anda butuhkan untuk mengelola perawatan kendaraan
                    dengan mudah</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <div class="bg-white p-8 rounded-xl shadow-lg feature-card">
                    <div class="bg-primary/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clipboard-list text-3xl text-primary"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Catat Riwayat Servis</h4>
                    <p class="text-gray-600">Simpan detail servis, sparepart, dan biaya agar selalu terkontrol dengan
                        rapi.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg feature-card">
                    <div class="bg-accent/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bell text-3xl text-accent"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Notifikasi Otomatis</h4>
                    <p class="text-gray-600">Dapatkan pengingat jadwal servis kendaraan Anda secara otomatis via email &
                        notifikasi.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg feature-card">
                    <div class="bg-secondary/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-check text-3xl text-secondary"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Booking Bengkel</h4>
                    <p class="text-gray-600">Pesan jadwal servis langsung dari aplikasi dengan bengkel rekanan
                        terpercaya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-3xl font-bold mb-4">Cara Kerja ServiCycle</h3>
                <p class="text-gray-600">Hanya perlu 3 langkah mudah untuk mulai mengelola servis kendaraan Anda</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 mt-16">
                <div class="text-center">
                    <div
                        class="bg-primary/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                        <span
                            class="absolute -top-2 -left-2 bg-primary text-white rounded-full w-8 h-8 flex items-center justify-center">1</span>
                        <i class="fas fa-user-plus text-3xl text-primary"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Buat Akun</h4>
                    <p class="text-gray-600">Daftar akun gratis dan tambahkan kendaraan Anda ke dalam sistem</p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-accent/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                        <span
                            class="absolute -top-2 -left-2 bg-accent text-white rounded-full w-8 h-8 flex items-center justify-center">2</span>
                        <i class="fas fa-tools text-3xl text-accent"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Catat Servis</h4>
                    <p class="text-gray-600">Tambahkan riwayat servis dan dapatkan rekomendasi perawatan</p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-secondary/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                        <span
                            class="absolute -top-2 -left-2 bg-secondary text-white rounded-full w-8 h-8 flex items-center justify-center">3</span>
                        <i class="fas fa-chart-line text-3xl text-secondary"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Pantau & Analisis</h4>
                    <p class="text-gray-600">Pantau kesehatan kendaraan dan analisis biaya perawatan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="max-w-2xl mx-auto">
                <h3 class="text-3xl font-bold mb-4">Paket Berlangganan</h3>
                <p class="text-gray-600">Pilih paket yang sesuai dengan kebutuhan Anda, mulai dari gratis hingga premium
                </p>
            </div>
            <div class="grid md:grid-cols-2 gap-8 mt-12 max-w-4xl mx-auto">
                <div class="bg-white p-8 rounded-xl shadow-lg pricing-card border border-gray-200">
                    <div class="bg-gray-100 py-4 px-6 rounded-lg mb-6">
                        <h4 class="text-xl font-semibold text-gray-800">Gratis</h4>
                        <p class="text-gray-600">Cocok untuk pengguna individu</p>
                    </div>
                    <p class="text-4xl font-bold mt-4">Rp 0<span
                            class="text-base font-normal text-gray-600">/selamanya</span></p>
                    <ul class="mt-8 space-y-4 text-gray-600 text-left">
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Catat
                            riwayat servis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Notifikasi
                            servis otomatis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Maksimal 2
                            kendaraan</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Dukungan
                            email</li>
                        <li class="flex items-center"><i class="fas fa-times-circle text-gray-400 mr-3"></i> <span
                                class="text-gray-400">Booking bengkel</span></li>
                    </ul>
                    <a href="/register"
                        class="mt-8 inline-block w-full bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300">Mulai
                        Gratis</a>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-2xl pricing-card border-2 border-primary relative">
                    <div
                        class="absolute top-0 right-0 bg-primary text-white px-4 py-1 rounded-bl-lg rounded-tr-lg text-sm font-medium">
                        POPULER</div>
                    <div class="bg-primary/10 py-4 px-6 rounded-lg mb-6">
                        <h4 class="text-xl font-semibold text-primary">Premium</h4>
                        <p class="text-gray-600">Untuk perusahaan atau bengkel</p>
                    </div>
                    <p class="text-4xl font-bold mt-4">Rp 99.000<span
                            class="text-base font-normal text-gray-600">/bulan</span></p>
                    <ul class="mt-8 space-y-4 text-gray-600 text-left">
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Semua
                            fitur Gratis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Jumlah
                            kendaraan tanpa batas</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Booking &
                            promosi bengkel</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Laporan
                            detail & invoice</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Dukungan
                            prioritas 24/7</li>
                    </ul>
                    <a href="/register"
                        class="mt-8 inline-block w-full bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow">Upgrade
                        ke Premium</a>
                </div>
            </div>
            <p class="mt-8 text-gray-600">*Harga belum termasuk PPN</p>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-3xl font-bold mb-4">Apa Kata Pengguna Kami</h3>
                <p class="text-gray-600">Dengarkan pengalaman langsung dari pengguna ServiCycle</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <div class="p-6 bg-gray-50 rounded-xl shadow-lg testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Andi, Mahasiswa</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Saya jadi nggak pernah lupa servis motor. Notifikasinya sangat membantu
                        dan mengingatkan saya tepat waktu!"</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl shadow-lg testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-accent"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Budi, Pemilik Bengkel</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Sebagai pemilik bengkel, saya bisa kelola booking lebih rapi dengan
                        ServiCycle Premium. Pelanggan juga lebih puas!"</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl shadow-lg testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-secondary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Rina, Manager Operasional</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Aplikasi ini membantu saya memantau biaya servis mobil kantor, sangat
                        efisien dan menghemat waktu!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-3xl font-bold mb-4">Pertanyaan Umum</h3>
                <p class="text-gray-600">Temukan jawaban atas pertanyaan yang sering diajukan</p>
            </div>
            <div class="mt-12 space-y-6">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h4 class="font-semibold text-lg mb-2 flex items-center">
                        <i class="fas fa-question-circle text-primary mr-3"></i>
                        Bagaimana cara mendaftar di ServiCycle?
                    </h4>
                    <p class="text-gray-600">Anda cukup klik tombol "Mulai Sekarang" di atas, isi formulir pendaftaran,
                        dan verifikasi email Anda. Setelah itu, Anda bisa langsung mulai menggunakan layanan kami.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h4 class="font-semibold text-lg mb-2 flex items-center">
                        <i class="fas fa-question-circle text-primary mr-3"></i>
                        Apakah benar-benar gratis?
                    </h4>
                    <p class="text-gray-600">Ya, paket gratis kami memberikan akses ke fitur dasar tanpa biaya
                        selamanya. Untuk fitur premium seperti booking bengkel dan laporan detail, tersedia paket
                        berbayar.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h4 class="font-semibold text-lg mb-2 flex items-center">
                        <i class="fas fa-question-circle text-primary mr-3"></i>
                        Bagaimana cara pembayaran paket premium?
                    </h4>
                    <p class="text-gray-600">Kami menerima pembayaran melalui transfer bank, kartu kredit, dan dompet
                        digital. Setelah pembayaran dikonfirmasi, akun Anda akan langsung diupgrade ke premium.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-primary text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-6">Siap Mengelola Servis Kendaraan Anda?</h3>
            <p class="text-indigo-100 mb-10">Bergabunglah dengan ribuan pengguna lainnya dan rasakan kemudahan mengelola
                perawatan kendaraan</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="/register"
                    class="bg-white text-primary px-8 py-4 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 btn-glow">
                    Daftar Sekarang - Gratis
                </a>
                <a href="#contact"
                    class="bg-transparent border-2 border-white px-8 py-4 rounded-lg font-medium hover:bg-white hover:text-primary transition-all duration-300">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <div class="bg-primary p-2 rounded-lg mr-3">
                        <i class="fas fa-tools text-white"></i>
                    </div>
                    <h4 class="text-white font-bold text-xl">ServiCycle</h4>
                </div>
                <p class="mb-4">Platform terdepan untuk manajemen perawatan kendaraan Anda.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-lg">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="#features" class="hover:text-white">Fitur</a></li>
                    <li><a href="#pricing" class="hover:text-white">Harga</a></li>
                    <li><a href="#testimoni" class="hover:text-white">Testimoni</a></li>
                    <li><a href="#faq" class="hover:text-white">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-lg">Layanan</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white">Blog</a></li>
                    <li><a href="#" class="hover:text-white">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-white">Status Server</a></li>
                    <li><a href="#" class="hover:text-white">Bengkel Rekanan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-lg">Kontak</h4>
                <ul class="space-y-2">
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
        <div class="text-center text-gray-500 mt-10 pt-6 border-t border-gray-800">© 2025 ServiCycle. All rights
            reserved.</div>
    </footer>

    <script>
        // Toggle mobile menu
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', function () {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });

        // Close mobile menu when clicking on overlay
        overlay.addEventListener('click', function () {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            this.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Close mobile menu when clicking on a link
        const mobileLinks = document.querySelectorAll('.mobile-nav-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function () {
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    </script>
</body>

</html>