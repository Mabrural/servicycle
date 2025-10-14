<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Daftar Bengkel</title>
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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Map container */
        #map {
            height: 300px;
            width: 100%;
            border-radius: 8px;
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
            
            .mobile-space-y-4 > * + * {
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            background: rgba(0,0,0,0.5);
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
                        <div class="bg-white/20 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center mr-3 sm:mr-4 mb-3 sm:mb-0">
                            <i class="fas fa-check text-lg sm:text-xl"></i>
                        </div>
                        <div class="mobile-text-center sm:text-left flex-1">
                            <h2 class="text-xl sm:text-2xl font-bold mb-1">Bengkel Sudah Terdaftar</h2>
                            <p class="text-white/90 text-sm sm:text-base">Anda sudah pernah mendaftarkan bengkel sebelumnya</p>
                        </div>
                    </div>
                    <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                        <h3 class="font-semibold mb-2 text-sm sm:text-base">Informasi Bengkel Anda:</h3>
                        <div id="registeredWorkshopInfo" class="grid grid-cols-1 gap-3 sm:gap-4 text-sm">
                            <!-- Data bengkel akan diisi oleh JavaScript -->
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-6 flex mobile-stack sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="/mitra/dashboard" class="bg-white text-green-600 px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 mobile-touch-button text-center mobile-full">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Mitra
                        </a>
                        <button id="editRequestBtn" class="bg-white/20 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-white/30 transition-all duration-300 mobile-touch-button text-center mobile-full">
                            <i class="fas fa-edit mr-2"></i>Ajukan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div id="registrationForm">
                <div class="form-section text-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8 mb-6 sm:mb-8">
                    <div class="flex items-start sm:items-center mobile-stack sm:flex-row">
                        <div class="bg-white/20 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center mr-3 sm:mr-4 mb-3 sm:mb-0">
                            <i class="fas fa-store text-lg sm:text-xl"></i>
                        </div>
                        <div class="mobile-text-center sm:text-left flex-1">
                            <h1 class="text-2xl sm:text-3xl font-bold mb-2">Daftarkan Bengkel Anda</h1>
                            <p class="text-white/90 text-sm sm:text-base">Bergabunglah dengan jaringan bengkel terpercaya ServiCycle</p>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-yellow-300 mt-0.5 mr-2 sm:mr-3 text-sm sm:text-base"></i>
                            <div>
                                <h3 class="font-semibold text-yellow-300 text-sm sm:text-base">Penting!</h3>
                                <p class="text-xs sm:text-sm">Form pendaftaran bengkel hanya dapat diisi <strong>sekali saja</strong>. Pastikan data yang Anda masukkan sudah benar dan lengkap.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="workshopForm" class="bg-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8">
                    <!-- Progress Steps -->
                    <div class="mb-6 sm:mb-8">
                        <div class="flex items-center justify-between mb-4 overflow-x-auto">
                            <!-- Step 1 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">Informasi<br>Dasar</p>
                            </div>
                            
                            <div class="h-1 bg-gray-300 flex-1 mx-1 sm:mx-2 min-w-8"></div>
                            
                            <!-- Step 2 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-sm">2</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">Detail<br>Layanan</p>
                            </div>
                            
                            <div class="h-1 bg-gray-300 flex-1 mx-1 sm:mx-2 min-w-8"></div>
                            
                            <!-- Step 3 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-sm">3</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">Dokumen &<br>Persetujuan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div id="step1" class="step-content">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Informasi Dasar Bengkel</h2>
                        
                        <div class="space-y-4 sm:space-y-6">
                            <div class="grid grid-cols-1 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Bengkel *</label>
                                    <input type="text" id="workshopName" name="workshopName" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Bengkel Motor Maju Jaya">
                                    <p class="text-xs text-gray-500 mt-1">Nama resmi bengkel Anda</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Bengkel *</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="type_motor" name="workshopType" value="motor" class="mr-3 mobile-touch-checkbox">
                                            <label for="type_motor" class="text-gray-700 text-sm sm:text-base">Bengkel Motor</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="type_mobil" name="workshopType" value="mobil" class="mr-3 mobile-touch-checkbox">
                                            <label for="type_mobil" class="text-gray-700 text-sm sm:text-base">Bengkel Mobil</label>
                                        </div>
                                    </div>
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
                                            <div id="provinceLoading" class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten *</label>
                                        <div class="relative">
                                            <select id="city" name="city" required disabled
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input appearance-none bg-gray-100">
                                                <option value="">Pilih provinsi terlebih dahulu</option>
                                            </select>
                                            <div id="cityLoading" class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2 hidden"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan *</label>
                                        <div class="relative">
                                            <select id="district" name="district" required disabled
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input appearance-none bg-gray-100">
                                                <option value="">Pilih kota terlebih dahulu</option>
                                            </select>
                                            <div id="districtLoading" class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2 hidden"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan *</label>
                                        <div class="relative">
                                            <select id="village" name="village" required disabled
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input appearance-none bg-gray-100">
                                                <option value="">Pilih kecamatan terlebih dahulu</option>
                                            </select>
                                            <div id="villageLoading" class="loading-spinner absolute right-3 top-1/2 transform -translate-y-1/2 hidden"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                    <input type="text" id="postalCode" name="postalCode"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="12345">
                                </div>
                                
                                <!-- Alamat Lengkap -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                                    <textarea id="address" name="address" required rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Jl. Contoh No. 123, RT/RW, Nama Jalan, dll."></textarea>
                                </div>
                                
                                <!-- Map Section -->
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pin Lokasi di Peta</label>
                                    <div class="bg-gray-100 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600 mb-3">Tentukan lokasi tepat bengkel Anda di peta:</p>
                                        <div id="map"></div>
                                        <div class="mt-3 flex items-center">
                                            <button type="button" id="locateMeBtn" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-all duration-300 flex items-center">
                                                <i class="fas fa-crosshairs mr-2"></i> Gunakan Lokasi Saya
                                            </button>
                                            <p class="text-xs text-gray-500 ml-3">Klik pada peta untuk menandai lokasi</p>
                                        </div>
                                        <div class="mt-2 text-xs text-gray-500">
                                            <p>Koordinat: <span id="coordinates">Belum dipilih</span></p>
                                        </div>
                                        <input type="hidden" id="latitude" name="latitude">
                                        <input type="hidden" id="longitude" name="longitude">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                                    <input type="tel" id="phone" name="phone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="081234567890">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Bengkel</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="bengkel@example.com">
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
                                <label class="block text-sm font-medium text-gray-700 mb-3 sm:mb-4">Jenis Layanan yang Tersedia *</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_oil" name="services" value="Ganti Oli" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_oil" class="text-gray-700 text-sm sm:text-base">Ganti Oli & Filter</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_tune" name="services" value="Tune Up" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_tune" class="text-gray-700 text-sm sm:text-base">Tune Up</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_brake" name="services" value="Rem" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_brake" class="text-gray-700 text-sm sm:text-base">Servis Rem</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_tire" name="services" value="Ban" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_tire" class="text-gray-700 text-sm sm:text-base">Ganti Ban</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_ac" name="services" value="AC" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_ac" class="text-gray-700 text-sm sm:text-base">Servis AC</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_body" name="services" value="Body Repair" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_body" class="text-gray-700 text-sm sm:text-base">Body Repair</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_electrical" name="services" value="Kelistrikan" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_electrical" class="text-gray-700 text-sm sm:text-base">Servis Kelistrikan</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service_transmission" name="services" value="Transmisi" class="mr-3 mobile-touch-checkbox">
                                        <label for="service_transmission" class="text-gray-700 text-sm sm:text-base">Servis Transmisi</label>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi</label>
                                <input type="text" id="specialization" name="specialization"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                    placeholder="Contoh: Mesin Honda, Transmisi Matic, dll.">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional *</label>
                                    <select id="operatingHours" name="operatingHours" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Jam Operasional</option>
                                        <option value="08:00-17:00">08:00 - 17:00</option>
                                        <option value="09:00-18:00">09:00 - 18:00</option>
                                        <option value="07:00-21:00">07:00 - 21:00</option>
                                        <option value="24jam">24 Jam</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                
                                <div id="customHours" class="hidden sm:col-span-2 lg:col-span-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Custom</label>
                                    <input type="text" id="customHoursInput" name="customHours"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: 07:00-21:00">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Bengkel</label>
                                <textarea id="description" name="description" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                    placeholder="Ceritakan tentang bengkel Anda, pengalaman, keunggulan, dll."></textarea>
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

                    <!-- Step 3: Documents -->
                    <div id="step3" class="step-content hidden">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Dokumen & Persetujuan</h2>
                        
                        <div class="space-y-4 sm:space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3 sm:mb-4">Upload Dokumen</label>
                                
                                <div class="space-y-4">
                                    <!-- SIUP Section -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 sm:p-6">
                                        <div class="text-center mb-4">
                                            <i class="fas fa-file-upload text-2xl sm:text-3xl text-gray-400 mb-2 sm:mb-3"></i>
                                            <p class="text-sm text-gray-600 mb-2">Upload SIUP (Surat Izin Usaha Perdagangan)</p>
                                            <input type="file" id="siup" name="siup" accept=".pdf,.jpg,.jpeg,.png" 
                                                class="hidden">
                                            <button type="button" onclick="document.getElementById('siup').click()" 
                                                class="bg-gray-100 text-gray-700 px-4 py-2 sm:py-3 rounded-lg font-medium hover:bg-gray-200 transition-all duration-300 mobile-touch-button">
                                                Pilih File
                                            </button>
                                            <p class="text-xs text-gray-500 mt-2">Format: PDF, JPG, PNG (Maks. 5MB)</p>
                                        </div>
                                        <div class="mt-3">
                                            <div class="flex items-start">
                                                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-2 text-sm"></i>
                                                <p class="text-xs text-gray-600">
                                                    <strong>Untuk bengkel kecil/tidak memiliki SIUP:</strong> Anda dapat mengupload surat keterangan usaha dari kelurahan atau dokumen identitas usaha lainnya.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Foto Bengkel Section -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 sm:p-6">
                                        <div class="text-center mb-4">
                                            <i class="fas fa-camera text-2xl sm:text-3xl text-gray-400 mb-2 sm:mb-3"></i>
                                            <p class="text-sm text-gray-600 mb-2">Upload Foto Bengkel</p>
                                            <input type="file" id="workshopPhoto" name="workshopPhoto" accept=".jpg,.jpeg,.png" 
                                                class="hidden" multiple>
                                            <button type="button" onclick="document.getElementById('workshopPhoto').click()" 
                                                class="bg-gray-100 text-gray-700 px-4 py-2 sm:py-3 rounded-lg font-medium hover:bg-gray-200 transition-all duration-300 mobile-touch-button">
                                                Pilih File
                                            </button>
                                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG (Maks. 5MB per file)</p>
                                        </div>
                                        
                                        <!-- Preview container -->
                                        <div id="photoPreview" class="file-preview"></div>
                                        
                                        <div class="mt-3">
                                            <div class="flex items-start">
                                                <i class="fas fa-lightbulb text-yellow-500 mt-0.5 mr-2 text-sm"></i>
                                                <p class="text-xs text-gray-600">
                                                    <strong>Tips:</strong> Upload beberapa foto yang menunjukkan kondisi bengkel, area kerja, peralatan, dan tampilan depan bengkel untuk meningkatkan kepercayaan pelanggan.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3 sm:mb-4">Persetujuan</label>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <input type="checkbox" id="agreement1" name="agreements" required class="mr-3 mt-1 mobile-touch-checkbox">
                                        <label for="agreement1" class="text-gray-700 text-xs sm:text-sm">
                                            Saya menyatakan bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan
                                        </label>
                                    </div>
                                    <div class="flex items-start">
                                        <input type="checkbox" id="agreement2" name="agreements" required class="mr-3 mt-1 mobile-touch-checkbox">
                                        <label for="agreement2" class="text-gray-700 text-xs sm:text-sm">
                                            Saya setuju dengan <a href="#" class="text-primary hover:underline">Syarat dan Ketentuan</a> ServiCycle
                                        </label>
                                    </div>
                                    <div class="flex items-start">
                                        <input type="checkbox" id="agreement3" name="agreements" required class="mr-3 mt-1 mobile-touch-checkbox">
                                        <label for="agreement3" class="text-gray-700 text-xs sm:text-sm">
                                            Saya memahami bahwa pendaftaran bengkel hanya dapat dilakukan sekali dan tidak dapat diubah kecuali melalui proses permohonan perubahan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex mobile-stack sm:flex-row justify-between mt-6 sm:mt-8 space-y-3 sm:space-y-0">
                            <button type="button" onclick="prevStep(2)" 
                                class="bg-gray-300 text-gray-700 px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-gray-400 transition-all duration-300 flex items-center justify-center mobile-touch-button mobile-full">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button type="submit" 
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

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA902AwIyLx2Y12VIuo3zDD5HyYAbQv2s&callback=initMap" async defer></script>

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

        // Google Maps variables
        let map;
        let marker;
        let geocoder;

        let userHasRegistered = false;
        let registeredWorkshopData = {
            name: "Bengkel Motor Maju Jaya",
            type: "motor",
            address: "Jl. Sudirman No. 123, Jakarta Pusat",
            phone: "081234567890",
            services: ["Ganti Oli", "Tune Up", "Servis Rem"],
            status: "Terverifikasi"
        };

        let currentStep = 1;
        let uploadedPhotos = [];

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            checkRegistrationStatus();
            setupEventListeners();
            updateMobileStepIndicator();
            loadProvinces(); // Load provinces on page load
        });

        // Initialize Google Maps
        function initMap() {
            // Default location (Jakarta)
            const defaultLocation = { lat: -6.2088, lng: 106.8456 };
            
            // Create map
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: defaultLocation,
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: true
            });
            
            // Create geocoder
            geocoder = new google.maps.Geocoder();
            
            // Add click listener to map
            map.addListener('click', function(event) {
                placeMarker(event.latLng);
                updateCoordinates(event.latLng);
                
                // Reverse geocode to get address
                geocodeLatLng(event.latLng);
            });
            
            // Create marker
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP
            });
            
            // Add drag listener to marker
            marker.addListener('dragend', function() {
                updateCoordinates(marker.getPosition());
                geocodeLatLng(marker.getPosition());
            });
        }

        // Place marker on map
        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    draggable: true
                });
            }
            
            map.panTo(location);
        }

        // Update coordinates display
        function updateCoordinates(latLng) {
            const lat = latLng.lat().toFixed(6);
            const lng = latLng.lng().toFixed(6);
            
            document.getElementById('coordinates').textContent = `${lat}, ${lng}`;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }

        // Geocode latlng to get address
        function geocodeLatLng(latLng) {
            geocoder.geocode({ location: latLng }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        // You can use the formatted address if needed
                        // console.log(results[0].formatted_address);
                    }
                }
            });
        }

        // Use current location
        function locateUser() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        
                        placeMarker(userLocation);
                        updateCoordinates(userLocation);
                        map.setZoom(16);
                    },
                    function(error) {
                        alert('Tidak dapat mengakses lokasi Anda. Pastikan izin lokasi sudah diberikan.');
                        console.error('Geolocation error:', error);
                    }
                );
            } else {
                alert('Browser Anda tidak mendukung geolocation.');
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
                
                // Transform data to match our needs
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
                
                // Transform data
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
                
                // Transform data
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
                
                // Transform data
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
        // POPULATE DROPDOWN FUNCTIONS
        // ===============================

        function populateProvinces(provinces) {
            const provinceSelect = document.getElementById('province');
            
            provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.id;
                option.textContent = province.name;
                provinceSelect.appendChild(option);
            });
        }

        function populateCities(cities) {
            const citySelect = document.getElementById('city');
            
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.name;
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
                option.value = district.id;
                option.textContent = district.name;
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
                option.value = village.id;
                option.textContent = village.name;
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
            const staticProvinces = [
                { id: '11', name: 'Aceh' },
                { id: '12', name: 'Sumatera Utara' },
                { id: '13', name: 'Sumatera Barat' },
                { id: '14', name: 'Riau' },
                { id: '15', name: 'Jambi' },
                { id: '16', name: 'Sumatera Selatan' },
                { id: '17', name: 'Bengkulu' },
                { id: '18', name: 'Lampung' },
                { id: '19', name: 'Kepulauan Bangka Belitung' },
                { id: '21', name: 'Kepulauan Riau' },
                { id: '31', name: 'DKI Jakarta' },
                { id: '32', name: 'Jawa Barat' },
                { id: '33', name: 'Jawa Tengah' },
                { id: '34', name: 'DI Yogyakarta' },
                { id: '35', name: 'Jawa Timur' },
                { id: '36', name: 'Banten' },
                { id: '51', name: 'Bali' },
                { id: '52', name: 'Nusa Tenggara Barat' },
                { id: '53', name: 'Nusa Tenggara Timur' },
                { id: '61', name: 'Kalimantan Barat' },
                { id: '62', name: 'Kalimantan Tengah' },
                { id: '63', name: 'Kalimantan Selatan' },
                { id: '64', name: 'Kalimantan Timur' },
                { id: '65', name: 'Kalimantan Utara' },
                { id: '71', name: 'Sulawesi Utara' },
                { id: '72', name: 'Sulawesi Tengah' },
                { id: '73', name: 'Sulawesi Selatan' },
                { id: '74', name: 'Sulawesi Tenggara' },
                { id: '75', name: 'Gorontalo' },
                { id: '76', name: 'Sulawesi Barat' },
                { id: '81', name: 'Maluku' },
                { id: '82', name: 'Maluku Utara' },
                { id: '91', name: 'Papua Barat' },
                { id: '92', name: 'Papua' },
                { id: '93', name: 'Papua Selatan' },
                { id: '94', name: 'Papua Tengah' },
                { id: '95', name: 'Papua Pegunungan' }
            ];
            
            populateProvinces(staticProvinces);
        }

        // ===============================
        // EVENT HANDLERS
        // ===============================

        function setupEventListeners() {
            // Province change event
            document.getElementById('province').addEventListener('change', function() {
                const provinceId = this.value;
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

            // City change event
            document.getElementById('city').addEventListener('change', function() {
                const cityId = this.value;
                if (cityId) {
                    loadDistricts(cityId);
                } else {
                    resetDistrict();
                    resetVillage();
                }
            });

            // District change event
            document.getElementById('district').addEventListener('change', function() {
                const districtId = this.value;
                if (districtId) {
                    loadVillages(districtId);
                } else {
                    resetVillage();
                }
            });

            // Operating hours change
            document.getElementById('operatingHours').addEventListener('change', function() {
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
            document.getElementById('workshopPhoto').addEventListener('change', function(e) {
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
            document.getElementById('workshopPhoto').value = '';
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
            if (userHasRegistered) {
                document.getElementById('registrationForm').classList.add('hidden');
                document.getElementById('alreadyRegistered').classList.remove('hidden');
                displayRegisteredWorkshopInfo();
            }
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
                    <p class="font-semibold text-sm">${registeredWorkshopData.type === 'motor' ? 'Bengkel Motor' : 'Bengkel Mobil'}</p>
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
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Step validation
        function validateStep(step) {
            let isValid = true;
            let errorMessage = '';

            if (step === 1) {
                const name = document.getElementById('workshopName').value;
                const workshopTypes = document.querySelectorAll('input[name="workshopType"]:checked');
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
                    document.getElementById('workshopName').focus();
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
                const services = document.querySelectorAll('input[name="services"]:checked');
                const operatingHours = document.getElementById('operatingHours').value;
                
                if (services.length === 0) {
                    errorMessage = 'Pilih minimal satu jenis layanan';
                } else if (!operatingHours) {
                    errorMessage = 'Jam operasional harus dipilih';
                    document.getElementById('operatingHours').focus();
                } else if (operatingHours === 'custom' && !document.getElementById('customHoursInput').value) {
                    errorMessage = 'Jam custom harus diisi';
                    document.getElementById('customHoursInput').focus();
                }
            } else if (step === 3) {
                const agreements = document.querySelectorAll('input[name="agreements"]:checked');
                
                if (agreements.length !== 3) {
                    errorMessage = 'Anda harus menyetujui semua persyaratan';
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

            // Collect form data
            const workshopTypes = Array.from(document.querySelectorAll('input[name="workshopType"]:checked')).map(cb => cb.value);
            
            const formData = {
                name: document.getElementById('workshopName').value,
                types: workshopTypes,
                address: document.getElementById('address').value,
                province: document.getElementById('province').selectedOptions[0].text,
                city: document.getElementById('city').selectedOptions[0].text,
                district: document.getElementById('district').selectedOptions[0].text,
                village: document.getElementById('village').selectedOptions[0].text,
                postalCode: document.getElementById('postalCode').value,
                latitude: document.getElementById('latitude').value,
                longitude: document.getElementById('longitude').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                services: Array.from(document.querySelectorAll('input[name="services"]:checked')).map(cb => cb.value),
                specialization: document.getElementById('specialization').value,
                operatingHours: document.getElementById('operatingHours').value === 'custom' ? 
                    document.getElementById('customHoursInput').value : document.getElementById('operatingHours').value,
                description: document.getElementById('description').value,
                photos: uploadedPhotos.length
            };

            // Simulate API call
            console.log('Registering workshop:', formData);
            
            // Show success message
            alert('Pendaftaran bengkel berhasil! Data Anda sedang diverifikasi.');
            
            // In real app, this would be set by backend
            userHasRegistered = true;
            registeredWorkshopData = formData;
            checkRegistrationStatus();
        }

        // Request edit
        function requestEdit() {
            const reason = prompt('Mohon jelaskan alasan perubahan data bengkel:');
            if (reason) {
                console.log('Edit request:', reason);
                alert('Permohonan perubahan telah dikirim. Tim kami akan menghubungi Anda dalam 1-2 hari kerja.');
            }
        }
    </script>
</body>

</html>