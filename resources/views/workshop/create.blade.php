<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Daftar Bengkel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .form-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.6);
        }

        .success-card {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        /* Loading animation */
        .loading-spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #4f46e5;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Map container */
        #map {
            height: 300px;
            width: 100%;
            border-radius: 8px;
            z-index: 1;
        }

        /* Leaflet custom styles */
        .leaflet-container {
            font-family: 'Poppins', sans-serif;
        }

        .custom-marker {
            background-color: #4f46e5;
            border: 3px solid white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        /* GPS Loading Overlay */
        .gps-loading {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            border-radius: 8px;
        }

        .gps-loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #4f46e5;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .mobile-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .mobile-stack {
                flex-direction: column;
            }

            .mobile-full {
                width: 100%;
            }

            .mobile-text-center {
                text-align: center;
            }

            .mobile-space-y-4>*+* {
                margin-top: 1rem;
            }

            .mobile-step-indicator {
                font-size: 0.75rem;
            }

            .mobile-form-input {
                font-size: 16px;
            }

            #map {
                height: 250px;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 2px;
        }

        /* Touch-friendly buttons */
        @media (max-width: 768px) {
            .mobile-touch-button {
                min-height: 44px;
                padding: 12px 16px;
            }

            .mobile-touch-checkbox {
                min-width: 20px;
                min-height: 20px;
            }
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* File upload preview */
        .file-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .file-preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .file-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-preview-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }

        /* Form validation styles */
        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .border-error {
            border-color: #ef4444 !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto mobile-padding">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <div class="bg-primary p-2 rounded-lg mr-3">
                        <i class="fas fa-tools text-white text-lg sm:text-xl"></i>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-primary">ServiCycle</h1>
                </div>
                <a href="/" class="text-gray-600 hover:text-primary font-medium text-sm sm:text-base">
                    <i class="fas fa-arrow-left mr-1 sm:mr-2"></i>
                    <span class="hidden sm:inline">Kembali ke Beranda</span>
                    <span class="sm:hidden">Beranda</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen py-4 sm:py-8">
        <div class="max-w-4xl mx-auto mobile-padding">

            <!-- Success Message -->
            <div id="alreadyRegistered" class="hidden mb-6 sm:mb-8">
                <div class="success-card text-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8">
                    <div class="flex items-start sm:items-center mobile-stack sm:flex-row">
                        <div
                            class="bg-white/20 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center mr-3 sm:mr-4 mb-3 sm:mb-0">
                            <i class="fas fa-check text-lg sm:text-xl"></i>
                        </div>
                        <div class="mobile-text-center sm:text-left flex-1">
                            <h2 class="text-xl sm:text-2xl font-bold mb-1">Bengkel Sudah Terdaftar</h2>
                            <p class="text-white/90 text-sm sm:text-base">Anda sudah pernah mendaftarkan bengkel
                                sebelumnya</p>
                        </div>
                    </div>
                    <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                        <h3 class="font-semibold mb-2 text-sm sm:text-base">Informasi Bengkel Anda:</h3>
                        <div id="registeredWorkshopInfo" class="grid grid-cols-1 gap-3 sm:gap-4 text-sm">
                            <!-- Data bengkel akan diisi oleh JavaScript -->
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-6 flex mobile-stack sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="/mitra/dashboard"
                            class="bg-white text-green-600 px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 mobile-touch-button text-center mobile-full">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Mitra
                        </a>
                        <button id="editRequestBtn"
                            class="bg-white/20 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-white/30 transition-all duration-300 mobile-touch-button text-center mobile-full">
                            <i class="fas fa-edit mr-2"></i>Ajukan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div id="registrationForm">
                <div class="form-section text-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8 mb-6 sm:mb-8">
                    <div class="flex items-start sm:items-center mobile-stack sm:flex-row">
                        <div
                            class="bg-white/20 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center mr-3 sm:mr-4 mb-3 sm:mb-0">
                            <i class="fas fa-store text-lg sm:text-xl"></i>
                        </div>
                        <div class="mobile-text-center sm:text-left flex-1">
                            <h1 class="text-2xl sm:text-3xl font-bold mb-2">Daftarkan Bengkel Anda</h1>
                            <p class="text-white/90 text-sm sm:text-base">Bergabunglah dengan jaringan bengkel
                                terpercaya ServiCycle</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-yellow-300 mt-0.5 mr-2 sm:mr-3 text-sm sm:text-base"></i>
                            <div>
                                <h3 class="font-semibold text-yellow-300 text-sm sm:text-base">Penting!</h3>
                                <p class="text-xs sm:text-sm">Form pendaftaran bengkel hanya dapat diisi <strong>sekali
                                        saja</strong>. Pastikan data yang Anda masukkan sudah benar dan lengkap.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="workshopForm" class="bg-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Progress Steps -->
                    <div class="mb-6 sm:mb-8">
                        <div class="flex items-center justify-between mb-4 overflow-x-auto">
                            <!-- Step 1 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div
                                    class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    1</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">
                                    Informasi<br>Dasar</p>
                            </div>

                            <div class="h-1 bg-gray-300 flex-1 mx-1 sm:mx-2 min-w-8"></div>

                            <!-- Step 2 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div
                                    class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-sm">
                                    2</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">
                                    Detail<br>Layanan</p>
                            </div>

                            <div class="h-1 bg-gray-300 flex-1 mx-1 sm:mx-2 min-w-8"></div>

                            <!-- Step 3 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div
                                    class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-sm">
                                    3</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">Foto<br>Bengkel
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div id="step1" class="step-content">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Informasi Dasar Bengkel
                        </h2>

                        <div class="space-y-4 sm:space-y-6">
                            <div class="grid grid-cols-1 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Bengkel *</label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Bengkel Motor Maju Jaya">
                                    <div id="name-error" class="error-message"></div>
                                    <p class="text-xs text-gray-500 mt-1">Nama resmi bengkel Anda</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Bengkel *</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="type_motor" name="types[]" value="motor"
                                                class="mr-3 mobile-touch-checkbox">
                                            <label for="type_motor" class="text-gray-700 text-sm sm:text-base">Bengkel
                                                Motor</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="type_mobil" name="types[]" value="mobil"
                                                class="mr-3 mobile-touch-checkbox">
                                            <label for="type_mobil" class="text-gray-700 text-sm sm:text-base">Bengkel
                                                Mobil</label>
                                        </div>
                                    </div>
                                    <div id="types-error" class="error-message"></div>
                                </div>
                            </div>

                            <!-- Wilayah Indonesia Section -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Lokasi Bengkel
                                </h3>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                                        <div class="relative">
                                            <select id="province" name="province" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input appearance-none">
                                                <option value="">Memuat provinsi...</option>
                                            </select>
                                            <div id="provinceLoading"
                                                class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2">
                                            </div>
                                        </div>
                                        <div id="province-error" class="error-message"></div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten
                                            *</label>
                                        <div class="relative">
                                            <select id="city" name="city" required disabled
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input appearance-none bg-gray-100">
                                                <option value="">Pilih provinsi terlebih dahulu</option>
                                            </select>
                                            <div id="cityLoading"
                                                class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
                                            </div>
                                        </div>
                                        <div id="city-error" class="error-message"></div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan *</label>
                                        <div class="relative">
                                            <select id="district" name="district" required disabled
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input appearance-none bg-gray-100">
                                                <option value="">Pilih kota terlebih dahulu</option>
                                            </select>
                                            <div id="districtLoading"
                                                class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
                                            </div>
                                        </div>
                                        <div id="district-error" class="error-message"></div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan *</label>
                                        <div class="relative">
                                            <select id="village" name="village" required disabled
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input appearance-none bg-gray-100">
                                                <option value="">Pilih kecamatan terlebih dahulu</option>
                                            </select>
                                            <div id="villageLoading"
                                                class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
                                            </div>
                                        </div>
                                        <div id="village-error" class="error-message"></div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                    <input type="text" id="postal_code" name="postal_code"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="12345">
                                    <div id="postal_code-error" class="error-message"></div>
                                </div>

                                <!-- Alamat Lengkap -->
                                <div class="mt-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap
                                        *</label>
                                    <textarea id="address" name="address" required rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Jl. Contoh No. 123, RT/RW, Nama Jalan, dll."></textarea>
                                    <div id="address-error" class="error-message"></div>
                                </div>

                                <!-- Map Section -->
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pin Lokasi di
                                        Peta</label>
                                    <div class="bg-gray-100 p-4 rounded-lg relative">
                                        <!-- GPS Loading Overlay -->
                                        <div id="gpsLoading" class="gps-loading">
                                            <div class="gps-loading-spinner"></div>
                                            <p class="text-gray-600 font-medium">Mengambil lokasi Anda...</p>
                                            <p class="text-sm text-gray-500 mt-2">Pastikan GPS aktif dan berikan izin
                                                akses lokasi</p>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-3">Tentukan lokasi tepat bengkel Anda di
                                            peta:</p>
                                        <div id="map"></div>
                                        <div class="mt-3 flex items-center">
                                            <button type="button" id="locateMeBtn"
                                                class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-all duration-300 flex items-center">
                                                <i class="fas fa-crosshairs mr-2"></i> Gunakan Lokasi Saya
                                            </button>
                                            <p class="text-xs text-gray-500 ml-3">Klik pada peta untuk menandai lokasi
                                            </p>
                                        </div>
                                        <div class="mt-2 text-xs text-gray-500">
                                            <p>Koordinat: <span id="coordinates">Belum dipilih</span></p>
                                        </div>
                                        <input type="hidden" id="latitude" name="latitude">
                                        <input type="hidden" id="longitude" name="longitude">
                                        <div id="latitude-error" class="error-message"></div>
                                        <div id="longitude-error" class="error-message"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon / WhatsApp *</label>
                                    <input type="tel" id="phone" name="phone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="6281234567890">
                                    <div id="phone-error" class="error-message"></div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Bengkel</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="bengkel@example.com">
                                    <div id="email-error" class="error-message"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6 sm:mt-8">
                            <button type="button" onclick="nextStep(2)"
                                class="bg-primary text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center mobile-touch-button mobile-full sm:mobile-auto">
                                Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Service Details -->
                    <div id="step2" class="step-content hidden">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Detail Layanan</h2>

                        <div class="space-y-4 sm:space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3 sm:mb-4">Jenis Layanan yang
                                    Tersedia *</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_rutin" name="services[]"
                                            value="service_rutin" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_rutin" class="text-gray-700 text-sm sm:text-base">Service
                                            Rutin</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="ganti_oli" name="services[]" value="ganti_oli"
                                            class="mr-3 mobile-touch-checkbox">
                                        <label for="ganti_oli" class="text-gray-700 text-sm sm:text-base">Ganti Oli &
                                            Filter</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="tune_up" name="services[]" value="tune_up"
                                            class="mr-3 mobile-touch-checkbox">
                                        <label for="tune_up" class="text-gray-700 text-sm sm:text-base">Tune
                                            Up</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perbaikan_mesin" name="services[]"
                                            value="perbaikan_mesin" class="mr-3 mobile-touch-checkbox">
                                        <label for="perbaikan_mesin"
                                            class="text-gray-700 text-sm sm:text-base">Perbaikan Mesin</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="perbaikan_rem" name="services[]"
                                            value="perbaikan_rem" class="mr-3 mobile-touch-checkbox">
                                        <label for="perbaikan_rem" class="text-gray-700 text-sm sm:text-base">Servis
                                            Rem</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_tire" name="services[]" value="ganti_ban"
                                            class="mr-3 mobile-touch-checkbox">
                                        <label for="service_tire" class="text-gray-700 text-sm sm:text-base">Ganti
                                            Ban</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_ac" name="services[]" value="servis_ac"
                                            class="mr-3 mobile-touch-checkbox">
                                        <label for="service_ac" class="text-gray-700 text-sm sm:text-base">Servis
                                            AC</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_electrical" name="services[]"
                                            value="kelistrikan" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_electrical"
                                            class="text-gray-700 text-sm sm:text-base">Servis Kelistrikan</label>
                                    </div>
                                </div>
                                <div id="services-error" class="error-message"></div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi</label>
                                <input type="text" id="specialization" name="specialization"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                    placeholder="Contoh: Mesin Honda, Transmisi Matic, dll.">
                                <div id="specialization-error" class="error-message"></div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional
                                        *</label>
                                    <select id="operating_hours" name="operating_hours" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Jam Operasional</option>
                                        <option value="08:00-17:00">08:00 - 17:00</option>
                                        <option value="09:00-18:00">09:00 - 18:00</option>
                                        <option value="07:00-21:00">07:00 - 21:00</option>
                                        <option value="24jam">24 Jam</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                    <div id="operating_hours-error" class="error-message"></div>
                                </div>

                                <div id="customHours" class="hidden sm:col-span-2 lg:col-span-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Custom</label>
                                    <input type="text" id="custom_hours" name="custom_hours"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: 07:00-21:00">
                                    <div id="custom_hours-error" class="error-message"></div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Bengkel</label>
                                <textarea id="description" name="description" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                    placeholder="Ceritakan tentang bengkel Anda, pengalaman, keunggulan, dll."></textarea>
                                <div id="description-error" class="error-message"></div>
                            </div>
                        </div>

                        <div class="flex mobile-stack sm:flex-row justify-between mt-6 sm:mt-8 space-y-3 sm:space-y-0">
                            <button type="button" onclick="prevStep(1)"
                                class="bg-gray-300 text-gray-700 px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-gray-400 transition-all duration-300 flex items-center justify-center mobile-touch-button mobile-full">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button type="button" onclick="nextStep(3)"
                                class="bg-primary text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center justify-center mobile-touch-button mobile-full">
                                Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Foto Bengkel -->
                    <div id="step3" class="step-content hidden">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Foto Bengkel</h2>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-4">Upload Foto Bengkel</label>

                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 sm:p-8 text-center">
                                    <i class="fas fa-camera text-3xl sm:text-4xl text-gray-400 mb-3 sm:mb-4"></i>
                                    <p class="text-lg font-medium text-gray-700 mb-2">Tambahkan Foto Bengkel Anda</p>
                                    <p class="text-sm text-gray-600 mb-4">Upload beberapa foto untuk menunjukkan
                                        kondisi bengkel Anda</p>

                                    <input type="file" id="photos" name="photos[]" accept=".jpg,.jpeg,.png"
                                        class="hidden" multiple>
                                    <button type="button" onclick="document.getElementById('photos').click()"
                                        class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 mobile-touch-button inline-flex items-center">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i> Pilih Foto
                                    </button>
                                    <p class="text-xs text-gray-500 mt-3">Format: JPG, PNG (Maks. 5MB per file)</p>
                                </div>

                                <!-- Preview container -->
                                <div id="photoPreview" class="file-preview mt-6"></div>
                                <div id="photos-error" class="error-message"></div>

                                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-start">
                                        <i class="fas fa-lightbulb text-blue-500 mt-0.5 mr-3 text-lg"></i>
                                        <div>
                                            <h4 class="font-semibold text-blue-800 mb-2">Tips Foto yang Baik:</h4>
                                            <ul class="text-sm text-gray-700 space-y-1">
                                                <li>• Foto tampilan depan bengkel</li>
                                                <li>• Foto area kerja dan peralatan</li>
                                                <li>• Foto interior bengkel</li>
                                                <li>• Foto stok sparepart (jika ada)</li>
                                                <li>• Foto sertifikat atau penghargaan</li>
                                            </ul>
                                            <p class="text-xs text-gray-600 mt-2">Foto yang baik akan meningkatkan
                                                kepercayaan pelanggan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex mobile-stack sm:flex-row justify-between mt-8 space-y-3 sm:space-y-0">
                            <button type="button" onclick="prevStep(2)"
                                class="bg-gray-300 text-gray-700 px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-gray-400 transition-all duration-300 flex items-center justify-center mobile-touch-button mobile-full">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button type="submit" id="submitBtn"
                                class="bg-primary text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center justify-center mobile-touch-button mobile-full">
                                <i class="fas fa-paper-plane mr-2"></i> Daftarkan Bengkel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-2 px-4 sm:hidden z-50">
        <div class="flex justify-between items-center">
            <button type="button" onclick="handleMobileBack()" class="text-gray-600 p-2">
                <i class="fas fa-arrow-left text-lg"></i>
            </button>
            <div class="text-center">
                <div class="text-xs text-gray-500">Step</div>
                <div class="font-semibold text-primary" id="mobileStepIndicator">1/3</div>
            </div>
            <button type="button" onclick="handleMobileNext()" class="text-primary p-2">
                <i class="fas fa-arrow-right text-lg"></i>
            </button>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // API Configuration - Using Mabrural GitHub API
        const API_BASE_URL = 'https://mabrural.github.io/api-wilayah-indonesia/api';

        // Cache untuk menyimpan data yang sudah di-load
        const regionCache = {
            provinces: null,
            cities: {},
            districts: {},
            villages: {}
        };

        // Leaflet variables
        let map;
        let marker;
        let userLocationCircle;
        let userLocationObtained = false;

        let userHasRegistered = false;
        let registeredWorkshopData = {};

        let currentStep = 1;
        let uploadedPhotos = [];

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            checkRegistrationStatus();
            setupEventListeners();
            updateMobileStepIndicator();
            loadProvinces(); // Load provinces on page load
            initMap(); // Initialize Leaflet map
            getCurrentLocation(); // Get user's current location on page load
        });

        // Initialize Leaflet Map
        function initMap() {
            // Default location (Jakarta) - will be updated by GPS
            const defaultLocation = [-6.2088, 106.8456];

            // Create map
            map = L.map('map').setView(defaultLocation, 12);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add click listener to map
            map.on('click', function(e) {
                placeMarker(e.latlng);
                updateCoordinates(e.latlng);
            });
        }

        // Get current location using GPS
        function getCurrentLocation() {
            if (!navigator.geolocation) {
                alert('Browser Anda tidak mendukung geolocation. Silakan gunakan browser yang lebih modern.');
                hideGpsLoading();
                return;
            }

            // Show GPS loading overlay
            document.getElementById('gpsLoading').classList.remove('hidden');

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const userLocation = [
                        position.coords.latitude,
                        position.coords.longitude
                    ];

                    // Remove existing location circle
                    if (userLocationCircle) {
                        map.removeLayer(userLocationCircle);
                    }

                    // Add accuracy circle
                    userLocationCircle = L.circle(userLocation, {
                        color: '#4f46e5',
                        fillColor: '#4f46e5',
                        fillOpacity: 0.1,
                        radius: position.coords.accuracy
                    }).addTo(map);

                    // Place marker at user's location
                    placeMarker(L.latLng(userLocation));
                    map.setView(userLocation, 16);

                    // Update coordinates display
                    updateCoordinates(L.latLng(userLocation));

                    // Mark that we have obtained user location
                    userLocationObtained = true;

                    // Hide GPS loading overlay
                    hideGpsLoading();

                    console.log('Lokasi berhasil didapatkan:', userLocation);
                },
                function(error) {
                    hideGpsLoading();

                    let errorMessage = 'Tidak dapat mengakses lokasi Anda. ';

                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage +=
                                'Izin lokasi ditolak. Silakan aktifkan izin lokasi di browser Anda dan refresh halaman.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage += 'Informasi lokasi tidak tersedia. Pastikan GPS aktif.';
                            break;
                        case error.TIMEOUT:
                            errorMessage += 'Permintaan lokasi timeout. Coba lagi.';
                            break;
                        default:
                            errorMessage += 'Terjadi error yang tidak diketahui.';
                            break;
                    }

                    alert(errorMessage);
                    console.error('Geolocation error:', error);

                    // Fallback to default location (Jakarta)
                    const defaultLocation = [-6.2088, 106.8456];
                    placeMarker(L.latLng(defaultLocation));
                    map.setView(defaultLocation, 12);
                    updateCoordinates(L.latLng(defaultLocation));
                }, {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 60000
                }
            );
        }

        // Hide GPS loading overlay
        function hideGpsLoading() {
            document.getElementById('gpsLoading').classList.add('hidden');
        }

        // Place marker on map
        function placeMarker(location) {
            // Remove existing marker
            if (marker) {
                map.removeLayer(marker);
            }

            // Create custom marker icon
            const customIcon = L.divIcon({
                className: 'custom-marker',
                html: '',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });

            // Add new marker
            marker = L.marker(location, {
                icon: customIcon,
                draggable: true
            }).addTo(map);

            // Add drag listener to marker
            marker.on('dragend', function() {
                updateCoordinates(marker.getLatLng());
            });

            // Center map on marker
            map.setView(location, Math.max(map.getZoom(), 15));
        }

        // Update coordinates display
        function updateCoordinates(latlng) {
            const lat = latlng.lat.toFixed(6);
            const lng = latlng.lng.toFixed(6);

            document.getElementById('coordinates').textContent = `${lat}, ${lng}`;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }

        // Use current location (manual trigger)
        function locateUser() {
            if (userLocationObtained && userLocationCircle) {
                // If we already have location, just center on it
                const userLocation = userLocationCircle.getLatLng();
                placeMarker(userLocation);
                map.setView(userLocation, 16);
            } else {
                // Otherwise, get fresh location
                getCurrentLocation();
            }
        }

        // ===============================
        // API FUNCTIONS - MABRURAL GITHUB API
        // ===============================

        // Load semua provinsi
        async function loadProvinces() {
            const provinceSelect = document.getElementById('province');
            const loadingSpinner = document.getElementById('provinceLoading');

            try {
                // Show loading
                provinceSelect.innerHTML = '<option value="">Memuat provinsi...</option>';
                loadingSpinner.classList.remove('hidden');

                // Check cache first
                if (regionCache.provinces) {
                    populateProvinces(regionCache.provinces);
                    return;
                }

                // Using Mabrural GitHub API
                const response = await fetch(`${API_BASE_URL}/provinces.json`);

                if (!response.ok) {
                    throw new Error('Failed to fetch provinces');
                }

                const data = await response.json();

                // Transform data to store both ID and Name
                const provinces = data.map(province => ({
                    id: province.id,
                    name: province.name
                }));

                // Sort provinces alphabetically
                provinces.sort((a, b) => a.name.localeCompare(b.name));

                // Cache the data
                regionCache.provinces = provinces;

                populateProvinces(provinces);

            } catch (error) {
                console.error('Error loading provinces:', error);
                provinceSelect.innerHTML = '<option value="">Gagal memuat provinsi</option>';
                // Fallback to static data
                loadStaticProvinces();
            } finally {
                loadingSpinner.classList.add('hidden');
            }
        }

        // Load kota/kabupaten berdasarkan provinsi
        async function loadCities(provinceId) {
            const citySelect = document.getElementById('city');
            const loadingSpinner = document.getElementById('cityLoading');

            try {
                // Show loading
                citySelect.innerHTML = '<option value="">Memuat kota/kabupaten...</option>';
                citySelect.disabled = true;
                loadingSpinner.classList.remove('hidden');

                // Check cache first
                if (regionCache.cities[provinceId]) {
                    populateCities(regionCache.cities[provinceId]);
                    return;
                }

                // Using Mabrural GitHub API
                const response = await fetch(`${API_BASE_URL}/regencies/${provinceId}.json`);

                if (!response.ok) {
                    throw new Error('Failed to fetch cities');
                }

                const data = await response.json();

                // Transform data to store both ID and Name
                const cities = data.map(city => ({
                    id: city.id,
                    name: city.name
                }));

                // Sort cities alphabetically
                cities.sort((a, b) => a.name.localeCompare(b.name));

                // Cache the data
                regionCache.cities[provinceId] = cities;

                populateCities(cities);

            } catch (error) {
                console.error('Error loading cities:', error);
                citySelect.innerHTML = '<option value="">Gagal memuat kota/kabupaten</option>';
            } finally {
                loadingSpinner.classList.add('hidden');
            }
        }

        // Load kecamatan berdasarkan kota
        async function loadDistricts(cityId) {
            const districtSelect = document.getElementById('district');
            const loadingSpinner = document.getElementById('districtLoading');

            try {
                // Show loading
                districtSelect.innerHTML = '<option value="">Memuat kecamatan...</option>';
                districtSelect.disabled = true;
                loadingSpinner.classList.remove('hidden');

                // Check cache first
                if (regionCache.districts[cityId]) {
                    populateDistricts(regionCache.districts[cityId]);
                    return;
                }

                // Using Mabrural GitHub API
                const response = await fetch(`${API_BASE_URL}/districts/${cityId}.json`);

                if (!response.ok) {
                    throw new Error('Failed to fetch districts');
                }

                const data = await response.json();

                // Transform data to store both ID and Name
                const districts = data.map(district => ({
                    id: district.id,
                    name: district.name
                }));

                // Sort districts alphabetically
                districts.sort((a, b) => a.name.localeCompare(b.name));

                // Cache the data
                regionCache.districts[cityId] = districts;

                populateDistricts(districts);

            } catch (error) {
                console.error('Error loading districts:', error);
                districtSelect.innerHTML = '<option value="">Gagal memuat kecamatan</option>';
            } finally {
                loadingSpinner.classList.add('hidden');
            }
        }

        // Load kelurahan berdasarkan kecamatan
        async function loadVillages(districtId) {
            const villageSelect = document.getElementById('village');
            const loadingSpinner = document.getElementById('villageLoading');

            try {
                // Show loading
                villageSelect.innerHTML = '<option value="">Memuat kelurahan...</option>';
                villageSelect.disabled = true;
                loadingSpinner.classList.remove('hidden');

                // Check cache first
                if (regionCache.villages[districtId]) {
                    populateVillages(regionCache.villages[districtId]);
                    return;
                }

                // Using Mabrural GitHub API
                const response = await fetch(`${API_BASE_URL}/villages/${districtId}.json`);

                if (!response.ok) {
                    throw new Error('Failed to fetch villages');
                }

                const data = await response.json();

                // Transform data to store both ID and Name
                const villages = data.map(village => ({
                    id: village.id,
                    name: village.name
                }));

                // Sort villages alphabetically
                villages.sort((a, b) => a.name.localeCompare(b.name));

                // Cache the data
                regionCache.villages[districtId] = villages;

                populateVillages(villages);

            } catch (error) {
                console.error('Error loading villages:', error);
                villageSelect.innerHTML = '<option value="">Gagal memuat kelurahan</option>';
            } finally {
                loadingSpinner.classList.add('hidden');
            }
        }

        // ===============================
        // POPULATE DROPDOWN FUNCTIONS (MODIFIED)
        // ===============================

        function populateProvinces(provinces) {
            const provinceSelect = document.getElementById('province');

            provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';

            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.name; // Store the name instead of ID
                option.textContent = province.name;
                option.setAttribute('data-id', province.id); // Store ID as data attribute if needed
                provinceSelect.appendChild(option);
            });
        }

        function populateCities(cities) {
            const citySelect = document.getElementById('city');

            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';

            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name; // Store the name instead of ID
                option.textContent = city.name;
                option.setAttribute('data-id', city.id); // Store ID as data attribute if needed
                citySelect.appendChild(option);
            });

            citySelect.disabled = false;

            // Reset district and village when city changes
            resetDistrict();
            resetVillage();
        }

        function populateDistricts(districts) {
            const districtSelect = document.getElementById('district');

            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            districts.forEach(district => {
                const option = document.createElement('option');
                option.value = district.name; // Store the name instead of ID
                option.textContent = district.name;
                option.setAttribute('data-id', district.id); // Store ID as data attribute if needed
                districtSelect.appendChild(option);
            });

            districtSelect.disabled = false;

            // Reset village when district changes
            resetVillage();
        }

        function populateVillages(villages) {
            const villageSelect = document.getElementById('village');

            villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            villages.forEach(village => {
                const option = document.createElement('option');
                option.value = village.name; // Store the name instead of ID
                option.textContent = village.name;
                option.setAttribute('data-id', village.id); // Store ID as data attribute if needed
                villageSelect.appendChild(option);
            });

            villageSelect.disabled = false;
        }

        function resetDistrict() {
            const districtSelect = document.getElementById('district');
            districtSelect.innerHTML = '<option value="">Pilih kota terlebih dahulu</option>';
            districtSelect.disabled = true;
        }

        function resetVillage() {
            const villageSelect = document.getElementById('village');
            villageSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
            villageSelect.disabled = true;
        }

        // ===============================
        // FALLBACK STATIC DATA
        // ===============================

        function loadStaticProvinces() {
            const staticProvinces = [{
                    id: '11',
                    name: 'Aceh'
                },
                {
                    id: '12',
                    name: 'Sumatera Utara'
                },
                {
                    id: '13',
                    name: 'Sumatera Barat'
                },
                {
                    id: '14',
                    name: 'Riau'
                },
                {
                    id: '15',
                    name: 'Jambi'
                },
                {
                    id: '16',
                    name: 'Sumatera Selatan'
                },
                {
                    id: '17',
                    name: 'Bengkulu'
                },
                {
                    id: '18',
                    name: 'Lampung'
                },
                {
                    id: '19',
                    name: 'Kepulauan Bangka Belitung'
                },
                {
                    id: '21',
                    name: 'Kepulauan Riau'
                },
                {
                    id: '31',
                    name: 'DKI Jakarta'
                },
                {
                    id: '32',
                    name: 'Jawa Barat'
                },
                {
                    id: '33',
                    name: 'Jawa Tengah'
                },
                {
                    id: '34',
                    name: 'DI Yogyakarta'
                },
                {
                    id: '35',
                    name: 'Jawa Timur'
                },
                {
                    id: '36',
                    name: 'Banten'
                },
                {
                    id: '51',
                    name: 'Bali'
                },
                {
                    id: '52',
                    name: 'Nusa Tenggara Barat'
                },
                {
                    id: '53',
                    name: 'Nusa Tenggara Timur'
                },
                {
                    id: '61',
                    name: 'Kalimantan Barat'
                },
                {
                    id: '62',
                    name: 'Kalimantan Tengah'
                },
                {
                    id: '63',
                    name: 'Kalimantan Selatan'
                },
                {
                    id: '64',
                    name: 'Kalimantan Timur'
                },
                {
                    id: '65',
                    name: 'Kalimantan Utara'
                },
                {
                    id: '71',
                    name: 'Sulawesi Utara'
                },
                {
                    id: '72',
                    name: 'Sulawesi Tengah'
                },
                {
                    id: '73',
                    name: 'Sulawesi Selatan'
                },
                {
                    id: '74',
                    name: 'Sulawesi Tenggara'
                },
                {
                    id: '75',
                    name: 'Gorontalo'
                },
                {
                    id: '76',
                    name: 'Sulawesi Barat'
                },
                {
                    id: '81',
                    name: 'Maluku'
                },
                {
                    id: '82',
                    name: 'Maluku Utara'
                },
                {
                    id: '91',
                    name: 'Papua Barat'
                },
                {
                    id: '92',
                    name: 'Papua'
                },
                {
                    id: '93',
                    name: 'Papua Selatan'
                },
                {
                    id: '94',
                    name: 'Papua Tengah'
                },
                {
                    id: '95',
                    name: 'Papua Pegunungan'
                }
            ];

            populateProvinces(staticProvinces);
        }

        // ===============================
        // EVENT HANDLERS (MODIFIED)
        // ===============================

        function setupEventListeners() {
            // Province change event - MODIFIED
            document.getElementById('province').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const provinceId = selectedOption.getAttribute('data-id');

                if (provinceId) {
                    loadCities(provinceId);
                } else {
                    const citySelect = document.getElementById('city');
                    citySelect.innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                    citySelect.disabled = true;

                    resetDistrict();
                    resetVillage();
                }
            });

            // City change event - MODIFIED
            document.getElementById('city').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const cityId = selectedOption.getAttribute('data-id');

                if (cityId) {
                    loadDistricts(cityId);
                } else {
                    resetDistrict();
                    resetVillage();
                }
            });

            // District change event - MODIFIED
            document.getElementById('district').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const districtId = selectedOption.getAttribute('data-id');

                if (districtId) {
                    loadVillages(districtId);
                } else {
                    resetVillage();
                }
            });

            // Operating hours change
            document.getElementById('operating_hours').addEventListener('change', function() {
                const customHoursDiv = document.getElementById('customHours');
                if (this.value === 'custom') {
                    customHoursDiv.classList.remove('hidden');
                } else {
                    customHoursDiv.classList.add('hidden');
                }
            });

            // Locate me button
            document.getElementById('locateMeBtn').addEventListener('click', function() {
                locateUser();
            });

            // Photo upload
            document.getElementById('photos').addEventListener('change', function(e) {
                handlePhotoUpload(e.target.files);
            });

            // Form submission
            document.getElementById('workshopForm').addEventListener('submit', function(e) {
                e.preventDefault();
                registerWorkshop();
            });

            // Edit request button
            document.getElementById('editRequestBtn').addEventListener('click', function() {
                requestEdit();
            });
        }

        // Handle photo upload and preview
        function handlePhotoUpload(files) {
            const previewContainer = document.getElementById('photoPreview');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Check file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File ${file.name} terlalu besar. Maksimal 5MB.`);
                    continue;
                }

                // Check file type
                if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                    alert(`File ${file.name} harus berupa gambar JPG atau PNG.`);
                    continue;
                }

                // Add to uploaded photos array
                uploadedPhotos.push(file);

                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'file-preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview foto bengkel';

                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-btn';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = function() {
                        removePhoto(file, previewItem);
                    };

                    previewItem.appendChild(img);
                    previewItem.appendChild(removeBtn);
                    previewContainer.appendChild(previewItem);
                };

                reader.readAsDataURL(file);
            }

            // Reset file input to allow selecting the same file again
            document.getElementById('photos').value = '';
        }

        // Remove photo from preview and array
        function removePhoto(file, previewElement) {
            const index = uploadedPhotos.indexOf(file);
            if (index > -1) {
                uploadedPhotos.splice(index, 1);
            }
            previewElement.remove();
        }

        // ===============================
        // REST OF THE FUNCTIONS
        // ===============================

        function checkRegistrationStatus() {
            // Check if user already has a registered workshop
            fetch('/api/check-workshop-registration')
                .then(response => response.json())
                .then(data => {
                    if (data.registered) {
                        userHasRegistered = true;
                        registeredWorkshopData = data.workshop;
                        document.getElementById('registrationForm').classList.add('hidden');
                        document.getElementById('alreadyRegistered').classList.remove('hidden');
                        displayRegisteredWorkshopInfo();
                    }
                })
                .catch(error => {
                    console.error('Error checking registration status:', error);
                });
        }

        function displayRegisteredWorkshopInfo() {
            const infoContainer = document.getElementById('registeredWorkshopInfo');
            infoContainer.innerHTML = `
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Nama Bengkel</p>
                    <p class="font-semibold text-sm">${registeredWorkshopData.name}</p>
                </div>
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Jenis Bengkel</p>
                    <p class="font-semibold text-sm">${registeredWorkshopData.types.join(', ')}</p>
                </div>
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Alamat</p>
                    <p class="font-semibold text-sm">${registeredWorkshopData.address}</p>
                </div>
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Telepon</p>
                    <p class="font-semibold text-sm">${registeredWorkshopData.phone}</p>
                </div>
            `;
        }

        // Mobile navigation handlers
        function handleMobileBack() {
            if (currentStep > 1) {
                prevStep(currentStep - 1);
            } else {
                window.history.back();
            }
        }

        function handleMobileNext() {
            if (currentStep < 3) {
                nextStep(currentStep + 1);
            } else {
                if (validateStep(3)) {
                    document.getElementById('workshopForm').dispatchEvent(new Event('submit'));
                }
            }
        }

        // Step navigation
        function nextStep(step) {
            if (validateStep(currentStep)) {
                document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
                document.getElementById('step' + step).classList.remove('hidden');
                currentStep = step;
                updateProgress(step);
                updateMobileStepIndicator();
                scrollToTop();
            }
        }

        function prevStep(step) {
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('step' + step).classList.remove('hidden');
            currentStep = step;
            updateProgress(step);
            updateMobileStepIndicator();
            scrollToTop();
        }

        function updateProgress(currentStep) {
            const steps = document.querySelectorAll('.flex-shrink-0 .w-8');
            steps.forEach((step, index) => {
                if (index < currentStep) {
                    step.classList.remove('bg-gray-300', 'text-gray-600');
                    step.classList.add('bg-primary', 'text-white');
                } else {
                    step.classList.remove('bg-primary', 'text-white');
                    step.classList.add('bg-gray-300', 'text-gray-600');
                }
            });
        }

        function updateMobileStepIndicator() {
            document.getElementById('mobileStepIndicator').textContent = `${currentStep}/3`;
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Clear error messages
        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
            });
            document.querySelectorAll('.border-error').forEach(el => {
                el.classList.remove('border-error');
            });
        }

        // Display validation errors
        function displayErrors(errors) {
            clearErrors();

            for (const field in errors) {
                const errorElement = document.getElementById(field + '-error');
                const inputElement = document.querySelector(`[name="${field}"]`);

                if (errorElement && inputElement) {
                    errorElement.textContent = errors[field][0];
                    inputElement.classList.add('border-error');
                }
            }
        }

        // Step validation
        function validateStep(step) {
            let isValid = true;
            let errorMessage = '';

            if (step === 1) {
                const name = document.getElementById('name').value;
                const workshopTypes = document.querySelectorAll('input[name="types[]"]:checked');
                const address = document.getElementById('address').value;
                const phone = document.getElementById('phone').value;
                const province = document.getElementById('province').value;
                const city = document.getElementById('city').value;
                const district = document.getElementById('district').value;
                const village = document.getElementById('village').value;
                const latitude = document.getElementById('latitude').value;
                const longitude = document.getElementById('longitude').value;

                if (!name) {
                    errorMessage = 'Nama bengkel harus diisi';
                    document.getElementById('name').focus();
                } else if (workshopTypes.length === 0) {
                    errorMessage = 'Pilih minimal satu jenis bengkel';
                } else if (!address) {
                    errorMessage = 'Alamat lengkap harus diisi';
                    document.getElementById('address').focus();
                } else if (!phone) {
                    errorMessage = 'Nomor telepon harus diisi';
                    document.getElementById('phone').focus();
                } else if (!province) {
                    errorMessage = 'Provinsi harus dipilih';
                    document.getElementById('province').focus();
                } else if (!city) {
                    errorMessage = 'Kota/Kabupaten harus dipilih';
                    document.getElementById('city').focus();
                } else if (!district) {
                    errorMessage = 'Kecamatan harus dipilih';
                    document.getElementById('district').focus();
                } else if (!village) {
                    errorMessage = 'Kelurahan harus dipilih';
                    document.getElementById('village').focus();
                } else if (!latitude || !longitude) {
                    errorMessage = 'Tentukan lokasi bengkel di peta dengan mengeklik pada peta';
                }
            } else if (step === 2) {
                const services = document.querySelectorAll('input[name="services[]"]:checked');
                const operatingHours = document.getElementById('operating_hours').value;

                if (services.length === 0) {
                    errorMessage = 'Pilih minimal satu jenis layanan';
                } else if (!operatingHours) {
                    errorMessage = 'Jam operasional harus dipilih';
                    document.getElementById('operating_hours').focus();
                } else if (operatingHours === 'custom' && !document.getElementById('custom_hours').value) {
                    errorMessage = 'Jam custom harus diisi';
                    document.getElementById('custom_hours').focus();
                }
            }

            if (errorMessage) {
                alert(errorMessage);
                isValid = false;
            }

            return isValid;
        }

        // Register workshop
        function registerWorkshop() {
            if (!validateStep(3)) return;

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<div class="loading-spinner mr-2"></div> Mendaftarkan...';

            // Create FormData object
            const formData = new FormData(document.getElementById('workshopForm'));

            // Add uploaded photos to FormData
            uploadedPhotos.forEach((file, index) => {
                formData.append(`photos[${index}]`, file);
            });

            // Add types array properly
            const types = document.querySelectorAll('input[name="types[]"]:checked');
            types.forEach((type, index) => {
                formData.append(`types[${index}]`, type.value);
            });

            // Add services array properly
            const services = document.querySelectorAll('input[name="services[]"]:checked');
            services.forEach((service, index) => {
                formData.append(`services[${index}]`, service.value);
            });

            // Send data to server
            fetch("{{ route('my-workshop.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        alert(data.message || 'Pendaftaran bengkel berhasil! Data Anda sedang diverifikasi.');

                        // Update UI to show registered workshop
                        userHasRegistered = true;
                        registeredWorkshopData = data.workshop;
                        document.getElementById('registrationForm').classList.add('hidden');
                        document.getElementById('alreadyRegistered').classList.remove('hidden');
                        displayRegisteredWorkshopInfo();
                    } else {
                        // Display validation errors
                        if (data.errors) {
                            displayErrors(data.errors);
                        }
                        alert(data.message || 'Terjadi kesalahan. Silakan periksa kembali data yang Anda masukkan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mendaftarkan bengkel. Silakan coba lagi.');
                })
                .finally(() => {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
        }

        // Request edit
        function requestEdit() {
            const reason = prompt('Mohon jelaskan alasan perubahan data bengkel:');
            if (reason) {
                fetch('/api/request-edit', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            reason: reason
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(
                                'Permohonan perubahan telah dikirim. Tim kami akan menghubungi Anda dalam 1-2 hari kerja.');
                        } else {
                            alert('Gagal mengirim permohonan perubahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengirim permohonan perubahan.');
                    });
            }
        }
    </script>
</body>

</html>
