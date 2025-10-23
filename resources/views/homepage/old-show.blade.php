<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $workshop->name }} - ServiCycle</title>
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

        /* Workshop Detail Styles */
        .detail-hero {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .service-tag {
            display: inline-block;
            background-color: #e0e7ff;
            color: #4f46e5;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            margin: 4px;
        }

        .info-card {
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .rating-stars {
            color: #fbbf24;
        }

        .back-btn:hover {
            transform: translateX(-3px);
        }

        /* Image Gallery Styles */
        .image-gallery {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 8px;
            height: 400px;
        }

        .main-image {
            grid-row: span 2;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .image-gallery {
                grid-template-columns: 1fr;
                height: auto;
            }
            .main-image {
                grid-row: auto;
            }
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
    {{-- <div class="bottom-nav" id="bottomNav">
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
    </div> --}}

    <!-- Workshop Detail Hero -->
    <section class="detail-hero text-white py-12 md:py-16 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-10 left-10 w-52 h-52 bg-white rounded-full animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full animate-float"
                style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="/#workshops"
                class="inline-flex items-center text-white/80 hover:text-white mb-6 transition-all duration-300 back-btn">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Daftar Bengkel</span>
            </a>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                <div class="flex-1">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 inline-flex items-center mb-4">
                        <i class="fas fa-star mr-2 text-yellow-300"></i>
                        <span class="text-sm md:text-base">
                            @if($workshop->rating)
                                Rating {{ number_format($workshop->rating, 1) }}/5 • 
                            @else
                                Belum ada rating • 
                            @endif
                            {{-- Untuk jarak, Anda bisa menambahkan logika perhitungan jarak di controller --}}
                            Lokasi: {{ $workshop->district }}, {{ $workshop->city }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-4">
                        {{ $workshop->name }}
                    </h1>
                    <p class="text-lg md:text-xl text-indigo-100 max-w-2xl">
                        {{ $workshop->description ?: 'Bengkel terpercaya dengan layanan servis mobil dan motor lengkap.' }}
                    </p>

                    <div class="mt-6 flex flex-wrap gap-2">
                        @if($workshop->types && is_array($workshop->types))
                            @foreach($workshop->types as $type)
                                <span class="bg-white/20 px-3 py-1 rounded-full text-sm capitalize">{{ $type }}</span>
                            @endforeach
                        @endif
                        
                        @if($workshop->specialization)
                            @foreach(explode(',', $workshop->specialization) as $spec)
                                <span class="bg-white/20 px-3 py-1 rounded-full text-sm">{{ trim($spec) }}</span>
                            @endforeach
                        @endif
                        
                        {{-- Anda bisa menambahkan logika untuk menampilkan status 24 jam jika ada --}}
                        @if(strpos(strtolower($workshop->operating_hours ?? ''), '24') !== false)
                            <span class="bg-white/20 px-3 py-1 rounded-full text-sm">24 Jam</span>
                        @endif
                    </div>
                </div>

                <div class="mt-6 md:mt-0 flex space-x-4">
                    <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}" target="_blank"
                        class="bg-white text-primary px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 btn-glow flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i> Lihat di Maps
                    </a>
                    <button onclick="window.location.href='{{ route('workshops.booking', ['id' => $workshop->id]) }}'"
                        class="bg-accent text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-600 transition-all duration-300 btn-glow flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i> Booking Servis
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshop Details -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="md:col-span-2">
                    <!-- Workshop Image Gallery -->
                    @if($workshop->images && $workshop->images->count() > 0)
                    <div class="image-gallery mb-8">
                        @php
                            $primaryImage = $workshop->images->where('is_primary', true)->first() ?? $workshop->images->first();
                            $otherImages = $workshop->images->where('id', '!=', $primaryImage->id)->take(4);
                        @endphp
                        
                        <div class="main-image">
                            <img src="{{ $primaryImage->image_url }}" 
                                 alt="{{ $workshop->name }}" 
                                 class="gallery-image w-full h-full"
                                 onclick="openImageModal('{{ $primaryImage->image_url }}')">
                        </div>
                        
                        @foreach($otherImages as $image)
                        <div>
                            <img src="{{ $image->image_url }}" 
                                 alt="{{ $workshop->name }}" 
                                 class="gallery-image w-full h-full"
                                 onclick="openImageModal('{{ $image->image_url }}')">
                        </div>
                        @endforeach
                        
                        @if($workshop->images->count() < 5)
                            @for($i = $workshop->images->count(); $i < 5; $i++)
                            <div>
                                <div class="gallery-image w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                    @else
                    <div class="rounded-2xl overflow-hidden shadow-lg mb-8">
                        <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    </div>
                    @endif

                    <!-- About Section -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 info-card mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-primary mr-3"></i>
                            Tentang Bengkel
                        </h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $workshop->description ?: 'Bengkel ini menyediakan berbagai layanan servis kendaraan dengan teknisi berpengalaman dan peralatan modern.' }}
                        </p>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-accent mr-3"></i>
                                <span class="text-gray-700">{{ $workshop->village }}, {{ $workshop->district }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-city text-accent mr-3"></i>
                                <span class="text-gray-700">{{ $workshop->city }}, {{ $workshop->province }}</span>
                            </div>
                            @if($workshop->operating_hours)
                            <div class="flex items-center">
                                <i class="fas fa-clock text-accent mr-3"></i>
                                <span class="text-gray-700">{{ $workshop->operating_hours }}</span>
                            </div>
                            @endif
                            @if($workshop->created_at)
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-accent mr-3"></i>
                                <span class="text-gray-700">Bergabung {{ $workshop->created_at->format('M Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Services Section -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 info-card">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-tools text-primary mr-3"></i>
                            Layanan yang Tersedia
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($workshop->services && is_array($workshop->services))
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-list text-primary mr-2"></i>
                                    Semua Layanan
                                </h3>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach($workshop->services as $service)
                                    <span class="service-tag">{{ $service }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($workshop->specialization)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-star text-primary mr-2"></i>
                                    Spesialisasi
                                </h3>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach(explode(',', $workshop->specialization) as $spec)
                                    <span class="service-tag bg-green-100 text-green-800">{{ trim($spec) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        @if(!$workshop->services && !$workshop->specialization)
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-tools text-4xl mb-4"></i>
                            <p>Informasi layanan belum tersedia</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Contact Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 info-card">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-primary mr-3"></i>
                            Informasi Kontak
                        </h3>

                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-location-dot text-gray-400 mt-1 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-700">Alamat</p>
                                    <p class="text-gray-600 text-sm">
                                        {{ $workshop->address }}<br>
                                        {{ $workshop->village }}, {{ $workshop->district }}<br>
                                        {{ $workshop->city }}, {{ $workshop->province }} {{ $workshop->postal_code }}
                                    </p>
                                </div>
                            </div>

                            @if($workshop->phone)
                            <div class="flex items-center">
                                <i class="fas fa-phone text-gray-400 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-700">Telepon</p>
                                    <p class="text-gray-600 text-sm">{{ $workshop->phone }}</p>
                                </div>
                            </div>
                            @endif

                            @if($workshop->email)
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-gray-400 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-700">Email</p>
                                    <p class="text-gray-600 text-sm">{{ $workshop->email }}</p>
                                </div>
                            </div>
                            @endif

                            @if($workshop->operating_hours)
                            <div class="flex items-center">
                                <i class="fas fa-clock text-gray-400 mr-3"></i>
                                <div>
                                    <p class="font-medium text-gray-700">Jam Operasional</p>
                                    <p class="text-gray-600 text-sm">{{ $workshop->operating_hours }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Rating & Reviews -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 info-card">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-star text-primary mr-3"></i>
                            Rating & Ulasan
                        </h3>

                        <div class="text-center mb-4">
                            <div class="text-4xl font-bold text-gray-800 mb-2">
                                {{ $workshop->rating ? number_format($workshop->rating, 1) : '0.0' }}
                            </div>
                            <div class="rating-stars text-2xl mb-2">
                                @if($workshop->rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($workshop->rating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $workshop->rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                @else
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                @endif
                            </div>
                            <p class="text-gray-600 text-sm">
                                @if($workshop->review_count)
                                    Berdasarkan {{ $workshop->review_count }} ulasan
                                @else
                                    Belum ada ulasan
                                @endif
                            </p>
                        </div>

                        <button
                            class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-200 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-comment-dots mr-2"></i> Lihat Semua Ulasan
                        </button>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 info-card">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h3>

                        <div class="space-y-3">
                            <button onclick="window.location.href='{{ route('workshops.booking', ['id' => $workshop->id]) }}'"
                                class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-calendar-plus mr-2"></i> Booking Servis
                            </button>

                            @if($workshop->phone)
                            <button onclick="window.location.href='tel:{{ $workshop->phone }}'"
                                class="w-full bg-accent text-white py-3 rounded-lg font-medium hover:bg-emerald-600 transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-phone mr-2"></i> Telepon Sekarang
                            </button>
                            @endif

                            <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}" target="_blank"
                                class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-200 transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-directions mr-2"></i> Dapatkan Petunjuk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-20 bg-primary text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6">Siap Servis Kendaraan Anda?</h3>
            <p class="text-indigo-100 mb-6 md:mb-10 text-sm md:text-base">Booking jadwal servis sekarang dan dapatkan penawaran spesial untuk pelanggan pertama</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <button onclick="window.location.href='{{ route('workshops.booking', ['id' => $workshop->id]) }}'"
                    class="bg-white text-primary px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 btn-glow text-sm md:text-base">
                    <i class="fas fa-calendar-alt mr-2"></i> Booking Sekarang
                </button>
                @if($workshop->phone)
                <a href="tel:{{ $workshop->phone }}"
                    class="bg-transparent border-2 border-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-white hover:text-primary transition-all duration-300 text-sm md:text-base">
                    <i class="fas fa-phone mr-2"></i> Hubungi Kami
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
        </div>
    </div>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-gray-300 py-8 md:py-12">
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
        <div
            class="text-center text-gray-500 mt-6 md:mt-10 pt-4 md:pt-6 border-t border-gray-800 text-sm md:text-base">
            © 2025 ServiCycle. All rights reserved.
        </div>
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

        // Image Modal Functions
        function openImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
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
    </script>
</body>

</html>