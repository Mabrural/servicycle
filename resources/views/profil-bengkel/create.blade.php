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
                font-size: 16px; /* Prevent zoom on iOS */
            }
        }

        /* Custom scrollbar for mobile */
        @media (max-width: 768px) {
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

        /* Hide number input spinners */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
            
            <!-- Success Message (akan muncul jika sudah pernah daftar) -->
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
                    <!-- Progress Steps - Mobile Optimized -->
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
                                    <select id="workshopType" name="workshopType" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Jenis Bengkel</option>
                                        <option value="motor">Bengkel Motor</option>
                                        <option value="mobil">Bengkel Mobil</option>
                                        <option value="motor-mobil">Bengkel Motor & Mobil</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                                <textarea id="address" name="address" required rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                    placeholder="Jl. Contoh No. 123, Kecamatan, Kota"></textarea>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                                    <select id="province" name="province" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Provinsi</option>
                                        <option value="dki-jakarta">DKI Jakarta</option>
                                        <option value="jawa-barat">Jawa Barat</option>
                                        <option value="jawa-tengah">Jawa Tengah</option>
                                        <option value="jawa-timur">Jawa Timur</option>
                                        <option value="banten">Banten</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten *</label>
                                    <select id="city" name="city" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                    <input type="text" id="postalCode" name="postalCode"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="12345">
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
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 sm:p-6 text-center">
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
                                    
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 sm:p-6 text-center">
                                        <i class="fas fa-file-upload text-2xl sm:text-3xl text-gray-400 mb-2 sm:mb-3"></i>
                                        <p class="text-sm text-gray-600 mb-2">Upload Foto Bengkel</p>
                                        <input type="file" id="workshopPhoto" name="workshopPhoto" accept=".jpg,.jpeg,.png" 
                                            class="hidden">
                                        <button type="button" onclick="document.getElementById('workshopPhoto').click()" 
                                            class="bg-gray-100 text-gray-700 px-4 py-2 sm:py-3 rounded-lg font-medium hover:bg-gray-200 transition-all duration-300 mobile-touch-button">
                                            Pilih File
                                        </button>
                                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG (Maks. 5MB)</p>
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

    <script>
        // Simulasi data - dalam implementasi nyata, ini akan diambil dari backend
        let userHasRegistered = false; // Ubah ke true untuk melihat tampilan sudah terdaftar
        let registeredWorkshopData = {
            name: "Bengkel Motor Maju Jaya",
            type: "motor",
            address: "Jl. Sudirman No. 123, Jakarta Pusat",
            phone: "081234567890",
            services: ["Ganti Oli", "Tune Up", "Servis Rem"],
            status: "Terverifikasi"
        };

        let currentStep = 1;

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            checkRegistrationStatus();
            setupEventListeners();
            updateMobileStepIndicator();
        });

        // Check if user has already registered a workshop
        function checkRegistrationStatus() {
            if (userHasRegistered) {
                document.getElementById('registrationForm').classList.add('hidden');
                document.getElementById('alreadyRegistered').classList.remove('hidden');
                displayRegisteredWorkshopInfo();
            }
        }

        // Display registered workshop information
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
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Layanan</p>
                    <p class="font-semibold text-sm">${registeredWorkshopData.services.join(', ')}</p>
                </div>
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Status</p>
                    <p class="font-semibold text-sm">
                        <span class="bg-white/20 px-2 py-1 rounded-full text-xs">${registeredWorkshopData.status}</span>
                    </p>
                </div>
            `;
        }

        // Setup event listeners
        function setupEventListeners() {
            // Operating hours change
            document.getElementById('operatingHours').addEventListener('change', function() {
                const customHoursDiv = document.getElementById('customHours');
                if (this.value === 'custom') {
                    customHoursDiv.classList.remove('hidden');
                } else {
                    customHoursDiv.classList.add('hidden');
                }
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

            // File input change handlers
            document.getElementById('siup').addEventListener('change', function(e) {
                handleFileSelect(e, 'SIUP');
            });

            document.getElementById('workshopPhoto').addEventListener('change', function(e) {
                handleFileSelect(e, 'Foto Bengkel');
            });
        }

        // Handle file selection
        function handleFileSelect(event, fileType) {
            const file = event.target.files[0];
            if (file) {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File ${fileType} terlalu besar. Maksimal 5MB.`);
                    event.target.value = '';
                    return;
                }
                
                // Show file name
                const button = event.target.previousElementSibling;
                button.innerHTML = `<i class="fas fa-check text-green-500 mr-2"></i>${file.name}`;
                button.classList.add('bg-green-100', 'text-green-700');
            }
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
            // Update step indicators
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
                const type = document.getElementById('workshopType').value;
                const address = document.getElementById('address').value;
                const phone = document.getElementById('phone').value;
                
                if (!name) {
                    errorMessage = 'Nama bengkel harus diisi';
                    document.getElementById('workshopName').focus();
                } else if (!type) {
                    errorMessage = 'Jenis bengkel harus dipilih';
                    document.getElementById('workshopType').focus();
                } else if (!address) {
                    errorMessage = 'Alamat lengkap harus diisi';
                    document.getElementById('address').focus();
                } else if (!phone) {
                    errorMessage = 'Nomor telepon harus diisi';
                    document.getElementById('phone').focus();
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
            const formData = {
                name: document.getElementById('workshopName').value,
                type: document.getElementById('workshopType').value,
                address: document.getElementById('address').value,
                province: document.getElementById('province').value,
                city: document.getElementById('city').value,
                postalCode: document.getElementById('postalCode').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                services: Array.from(document.querySelectorAll('input[name="services"]:checked')).map(cb => cb.value),
                specialization: document.getElementById('specialization').value,
                operatingHours: document.getElementById('operatingHours').value === 'custom' ? 
                    document.getElementById('customHoursInput').value : document.getElementById('operatingHours').value,
                description: document.getElementById('description').value
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
                // Simulate API call to request edit
                console.log('Edit request:', reason);
                alert('Permohonan perubahan telah dikirim. Tim kami akan menghubungi Anda dalam 1-2 hari kerja.');
            }
        }

        // Simple city data based on province
        const cityData = {
            'dki-jakarta': ['Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Barat', 'Jakarta Utara'],
            'jawa-barat': ['Bandung', 'Bekasi', 'Bogor', 'Depok', 'Cimahi'],
            'jawa-tengah': ['Semarang', 'Surakarta', 'Tegal', 'Pekalongan', 'Salatiga'],
            'jawa-timur': ['Surabaya', 'Malang', 'Sidoarjo', 'Mojokerto', 'Pasuruan'],
            'banten': ['Tangerang', 'Serang', 'Cilegon', 'Tangerang Selatan']
        };

        // Populate cities when province is selected
        document.getElementById('province').addEventListener('change', function() {
            const citySelect = document.getElementById('city');
            const cities = cityData[this.value] || [];
            
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.toLowerCase().replace(/ /g, '-');
                option.textContent = city;
                citySelect.appendChild(option);
            });
        });
    </script>
</body>

</html>