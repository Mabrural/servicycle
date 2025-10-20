<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Servis - ServiCycle</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            background-color: #f9fafb;
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

        /* Booking Styles */
        .booking-hero {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .service-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .service-card.selected {
            border-color: #4f46e5;
            background-color: #f0f4ff;
        }

        .time-slot {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .time-slot:hover {
            background-color: #e0e7ff;
        }

        .time-slot.selected {
            background-color: #4f46e5;
            color: white;
        }

        .step-indicator {
            transition: all 0.3s ease;
        }

        .step-indicator.active {
            background-color: #4f46e5;
            color: white;
        }

        .step-indicator.completed {
            background-color: #10b981;
            color: white;
        }

        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .flatpickr-input:focus {
            border-color: #4f46e5 !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <div class="bg-primary p-2 rounded-lg mr-3">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-primary">ServiCycle</h1>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav hidden md:flex space-x-8 items-center">
                <a href="/#workshops" class="nav-link text-gray-600 hover:text-primary">Bengkel</a>
                <a href="/#promo" class="nav-link text-gray-600 hover:text-primary">Promo</a>
                <a href="/#mitra" class="nav-link text-gray-600 hover:text-primary">Gabung Mitra</a>
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
        <a href="/#workshops" class="bottom-nav-item" data-section="workshops">
            <i class="fas fa-map-marker-alt"></i>
            <span>Bengkel</span>
        </a>
        <a href="/#promo" class="bottom-nav-item" data-section="promo">
            <i class="fas fa-tags"></i>
            <span>Promo</span>
        </a>
        <a href="/#mitra" class="bottom-nav-item" data-section="mitra">
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
    </div>

    <!-- Booking Hero -->
    <section class="booking-hero text-white py-12 md:py-16 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-10 left-10 w-52 h-52 bg-white rounded-full animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full animate-float"
                style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="/workshops/1" class="inline-flex items-center text-white/80 hover:text-white mb-6 transition-all duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Detail Bengkel</span>
            </a>
            
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-4">
                    Booking Servis
                </h1>
                <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto">
                    Pesan servis kendaraan Anda di Bengkel Maju Jaya dengan mudah dan cepat
                </p>
            </div>
        </div>
    </section>

    <!-- Booking Process -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Progress Steps -->
            <div class="mb-12">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="step-indicator w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                            1
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-800">Pilih Layanan</p>
                            <p class="text-sm text-gray-600">Jenis servis yang dibutuhkan</p>
                        </div>
                    </div>
                    
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    
                    <div class="flex items-center">
                        <div class="step-indicator w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold">
                            2
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-600">Jadwal & Kendaraan</p>
                            <p class="text-sm text-gray-500">Waktu dan detail kendaraan</p>
                        </div>
                    </div>
                    
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    
                    <div class="flex items-center">
                        <div class="step-indicator w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold">
                            3
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-600">Konfirmasi</p>
                            <p class="text-sm text-gray-500">Review dan selesaikan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Main Booking Form -->
                <div class="md:col-span-2">
                    <!-- Step 1: Service Selection -->
                    <div id="step1" class="booking-step">
                        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-tools text-primary mr-3"></i>
                                Pilih Layanan Servis
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <!-- Service Category Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Kategori Kendaraan</label>
                                    <div class="flex space-x-4">
                                        <button class="vehicle-type-btn flex-1 py-3 px-4 border-2 border-gray-200 rounded-lg text-center transition-all duration-300 hover:border-primary" data-type="mobil">
                                            <i class="fas fa-car text-2xl mb-2 block"></i>
                                            <span class="font-medium">Mobil</span>
                                        </button>
                                        <button class="vehicle-type-btn flex-1 py-3 px-4 border-2 border-gray-200 rounded-lg text-center transition-all duration-300 hover:border-primary" data-type="motor">
                                            <i class="fas fa-motorcycle text-2xl mb-2 block"></i>
                                            <span class="font-medium">Motor</span>
                                        </button>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Tipe Servis</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input">
                                        <option value="">Pilih tipe servis</option>
                                        <option value="ringan">Servis Ringan</option>
                                        <option value="berkala">Servis Berkala</option>
                                        <option value="besar">Servis Besar</option>
                                        <option value="emergency">Servis Emergency</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Service Packages -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-4">Paket Servis</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="service-card bg-white border-2 border-gray-200 rounded-xl p-6 cursor-pointer" data-service="basic">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="font-semibold text-gray-800 text-lg">Servis Ringan</h3>
                                                <p class="text-gray-600 text-sm mt-1">Ganti oli & pemeriksaan dasar</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-2xl font-bold text-primary">Rp 150.000</span>
                                            </div>
                                        </div>
                                        <ul class="text-sm text-gray-600 space-y-2">
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Ganti oli mesin
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Pemeriksaan ban
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Cek tekanan angin
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="service-card bg-white border-2 border-gray-200 rounded-xl p-6 cursor-pointer" data-service="standard">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="font-semibold text-gray-800 text-lg">Servis Berkala</h3>
                                                <p class="text-gray-600 text-sm mt-1">Servis lengkap 6 bulanan</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-2xl font-bold text-primary">Rp 350.000</span>
                                            </div>
                                        </div>
                                        <ul class="text-sm text-gray-600 space-y-2">
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Servis ringan +
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Ganti filter udara
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Tune-up mesin
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="service-card bg-white border-2 border-gray-200 rounded-xl p-6 cursor-pointer" data-service="premium">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="font-semibold text-gray-800 text-lg">Servis Besar</h3>
                                                <p class="text-gray-600 text-sm mt-1">Overhaul & perbaikan menyeluruh</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-2xl font-bold text-primary">Rp 750.000</span>
                                            </div>
                                        </div>
                                        <ul class="text-sm text-gray-600 space-y-2">
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Servis berkala +
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Ganti kampas rem
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-accent mr-2"></i>
                                                Servis sistem pengereman
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="service-card bg-white border-2 border-gray-200 rounded-xl p-6 cursor-pointer" data-service="custom">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="font-semibold text-gray-800 text-lg">Servis Kustom</h3>
                                                <p class="text-gray-600 text-sm mt-1">Pilih layanan sesuai kebutuhan</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-lg font-bold text-primary">Mulai Rp 100.000</span>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <p class="mb-3">Pilih layanan yang diinginkan:</p>
                                            <div class="space-y-2">
                                                <label class="flex items-center">
                                                    <input type="checkbox" class="rounded text-primary mr-2">
                                                    <span>Ganti oli - Rp 100.000</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="checkbox" class="rounded text-primary mr-2">
                                                    <span>Ganti ban - Rp 200.000</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="checkbox" class="rounded text-primary mr-2">
                                                    <span>Servis rem - Rp 150.000</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Notes -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Catatan Tambahan (Opsional)</label>
                                <textarea 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" 
                                    rows="3" 
                                    placeholder="Jelaskan keluhan atau permintaan khusus..."></textarea>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button id="nextToStep2" class="bg-primary text-white px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center">
                                Lanjut ke Jadwal
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Schedule & Vehicle -->
                    <div id="step2" class="booking-step hidden">
                        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-calendar-alt text-primary mr-3"></i>
                                Pilih Jadwal & Kendaraan
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Date Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Tanggal Servis</label>
                                    <input type="text" id="datePicker" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary flatpickr-input" placeholder="Pilih tanggal...">
                                </div>
                                
                                <!-- Time Slots -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Waktu Tersedia</label>
                                    <div class="grid grid-cols-3 gap-2">
                                        <div class="time-slot text-center py-2 border border-gray-300 rounded-lg">08:00</div>
                                        <div class="time-slot text-center py-2 border border-gray-300 rounded-lg">09:00</div>
                                        <div class="time-slot text-center py-2 border border-gray-300 rounded-lg">10:00</div>
                                        <div class="time-slot text-center py-2 border border-gray-300 rounded-lg">11:00</div>
                                        <div class="time-slot text-center py-2 border border-gray-300 rounded-lg">13:00</div>
                                        <div class="time-slot text-center py-2 border border-gray-300 rounded-lg">14:00</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vehicle Information -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-4">Informasi Kendaraan</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Merk Kendaraan</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" placeholder="Contoh: Toyota">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" placeholder="Contoh: Avanza">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                                        <input type="number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" placeholder="Contoh: 2020">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Plat</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" placeholder="Contoh: B 1234 ABC">
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-4">Informasi Kontak</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" placeholder="Nama lengkap Anda">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                        <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" placeholder="08xxxxxxxxxx">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input" placeholder="email@contoh.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button id="backToStep1" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </button>
                            <button id="nextToStep3" class="bg-primary text-white px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center">
                                Lanjut ke Konfirmasi
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Confirmation -->
                    <div id="step3" class="booking-step hidden">
                        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-clipboard-check text-primary mr-3"></i>
                                Konfirmasi Booking
                            </h2>
                            
                            <!-- Order Summary -->
                            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Bengkel</span>
                                        <span class="font-medium">Bengkel Maju Jaya</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Layanan</span>
                                        <span class="font-medium">Servis Berkala</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Tanggal & Waktu</span>
                                        <span class="font-medium">Senin, 15 Mar 2025 - 10:00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Kendaraan</span>
                                        <span class="font-medium">Toyota Avanza (B 1234 ABC)</span>
                                    </div>
                                    <div class="border-t pt-4">
                                        <div class="flex justify-between items-center text-lg">
                                            <span class="text-gray-800 font-semibold">Total Biaya</span>
                                            <span class="text-primary font-bold">Rp 350.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-4">Metode Pembayaran</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="payment-method flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary transition-all duration-300">
                                        <input type="radio" name="payment" class="text-primary mr-3" checked>
                                        <div>
                                            <p class="font-medium text-gray-800">Bayar di Tempat</p>
                                            <p class="text-sm text-gray-600">Bayar saat kendaraan diambil</p>
                                        </div>
                                    </label>
                                    <label class="payment-method flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary transition-all duration-300">
                                        <input type="radio" name="payment" class="text-primary mr-3">
                                        <div>
                                            <p class="font-medium text-gray-800">Transfer Bank</p>
                                            <p class="text-sm text-gray-600">Bayar via transfer bank</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="mb-6">
                                <label class="flex items-start">
                                    <input type="checkbox" class="mt-1 mr-3 text-primary rounded">
                                    <span class="text-sm text-gray-600">
                                        Saya menyetujui 
                                        <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> 
                                        dan 
                                        <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a> 
                                        ServiCycle
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button id="backToStep2" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </button>
                            <button id="confirmBooking" class="bg-accent text-white px-8 py-3 rounded-lg font-medium hover:bg-emerald-600 transition-all duration-300 btn-glow flex items-center">
                                <i class="fas fa-check mr-2"></i>
                                Konfirmasi Booking
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Summary -->
                <div class="space-y-6">
                    <!-- Workshop Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Bengkel Tujuan</h3>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tools text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Bengkel Maju Jaya</h4>
                                <p class="text-sm text-gray-600 mt-1">Jl. Ahmad Yani No. 45, Batam Center</p>
                                <div class="flex items-center mt-2">
                                    <div class="rating-stars text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">4.8 (124)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Biaya</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Servis Berkala</span>
                                <span class="font-medium">Rp 350.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Biaya Tambahan</span>
                                <span class="font-medium">Rp 0</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Diskon</span>
                                <span class="font-medium text-green-600">-Rp 0</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total</span>
                                    <span class="text-xl font-bold text-primary">Rp 350.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Butuh Bantuan?</h3>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone text-primary mr-3"></i>
                                <span>+62 812 3456 7890</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-envelope text-primary mr-3"></i>
                                <span>support@servicycle.com</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock text-primary mr-3"></i>
                                <span>24/7 Customer Service</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
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
                    <li><a href="/#features" class="hover:text-white">Fitur</a></li>
                    <li><a href="/#workshops" class="hover:text-white">Bengkel</a></li>
                    <li><a href="/#promo" class="hover:text-white">Promo</a></li>
                    <li><a href="/#mitra" class="hover:text-white">Gabung Mitra</a></li>
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
        <div class="text-center text-gray-500 mt-6 md:mt-10 pt-4 md:pt-6 border-t border-gray-800 text-sm md:text-base">
            © 2025 ServiCycle. All rights reserved.
        </div>
    </footer>

    <script>
        // Booking Process Logic
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date picker
            flatpickr("#datePicker", {
                minDate: "today",
                dateFormat: "d-m-Y",
                locale: "id"
            });

            // Step Navigation
            const steps = document.querySelectorAll('.booking-step');
            const stepIndicators = document.querySelectorAll('.step-indicator');
            
            document.getElementById('nextToStep2').addEventListener('click', function() {
                showStep(2);
            });
            
            document.getElementById('backToStep1').addEventListener('click', function() {
                showStep(1);
            });
            
            document.getElementById('nextToStep3').addEventListener('click', function() {
                showStep(3);
            });
            
            document.getElementById('backToStep2').addEventListener('click', function() {
                showStep(2);
            });

            function showStep(stepNumber) {
                // Hide all steps
                steps.forEach(step => step.classList.add('hidden'));
                
                // Show current step
                document.getElementById(`step${stepNumber}`).classList.remove('hidden');
                
                // Update step indicators
                stepIndicators.forEach((indicator, index) => {
                    indicator.classList.remove('active', 'completed');
                    if (index + 1 === stepNumber) {
                        indicator.classList.add('active');
                    } else if (index + 1 < stepNumber) {
                        indicator.classList.add('completed');
                    }
                });
            }

            // Service Selection
            const serviceCards = document.querySelectorAll('.service-card');
            serviceCards.forEach(card => {
                card.addEventListener('click', function() {
                    serviceCards.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });

            // Time Slot Selection
            const timeSlots = document.querySelectorAll('.time-slot');
            timeSlots.forEach(slot => {
                slot.addEventListener('click', function() {
                    timeSlots.forEach(s => s.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });

            // Vehicle Type Selection
            const vehicleTypeBtns = document.querySelectorAll('.vehicle-type-btn');
            vehicleTypeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    vehicleTypeBtns.forEach(b => b.classList.remove('border-primary', 'bg-blue-50'));
                    this.classList.add('border-primary', 'bg-blue-50');
                });
            });

            // Payment Method Selection
            const paymentMethods = document.querySelectorAll('.payment-method');
            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    paymentMethods.forEach(m => m.classList.remove('border-primary', 'bg-blue-50'));
                    this.classList.add('border-primary', 'bg-blue-50');
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;
                });
            });

            // Confirm Booking
            document.getElementById('confirmBooking').addEventListener('click', function() {
                // Here you would typically send the booking data to your backend
                alert('Booking berhasil! Anda akan menerima konfirmasi via email dan WhatsApp.');
                // Redirect to success page or dashboard
                window.location.href = '/booking/success';
            });

            // Mobile dropdown functionality
            (function() {
                const btn = document.getElementById('userMenuMobile');
                const menu = document.getElementById('dropdownMobileMenu');

                if (!btn || !menu) return;

                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = menu.classList.contains('hidden');
                    btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                    menu.classList.toggle('hidden');
                });

                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                document.addEventListener('click', function() {
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                        btn.setAttribute('aria-expanded', 'false');
                    }
                });

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                        btn.setAttribute('aria-expanded', 'false');
                        btn.focus();
                    }
                });
            })();
        });
    </script>
</body>

</html>