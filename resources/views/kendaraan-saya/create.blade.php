<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Daftar Kendaraan</title>
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
                        <i class="fas fa-car text-white text-lg sm:text-xl"></i>
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
                            <h2 class="text-xl sm:text-2xl font-bold mb-1">Kendaraan Sudah Terdaftar</h2>
                            <p class="text-white/90 text-sm sm:text-base">Anda sudah pernah mendaftarkan kendaraan ini sebelumnya</p>
                        </div>
                    </div>
                    <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                        <h3 class="font-semibold mb-2 text-sm sm:text-base">Informasi Kendaraan Anda:</h3>
                        <div id="registeredVehicleInfo" class="grid grid-cols-1 gap-3 sm:gap-4 text-sm">
                            <!-- Data kendaraan akan diisi oleh JavaScript -->
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-6 flex mobile-stack sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="/profil/kendaraan" class="bg-white text-green-600 px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 mobile-touch-button text-center mobile-full">
                            <i class="fas fa-car mr-2"></i>Lihat Kendaraan Saya
                        </a>
                        <button id="editRequestBtn" class="bg-white/20 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-white/30 transition-all duration-300 mobile-touch-button text-center mobile-full">
                            <i class="fas fa-edit mr-2"></i>Edit Kendaraan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div id="registrationForm">
                <div class="form-section text-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8 mb-6 sm:mb-8">
                    <div class="flex items-start sm:items-center mobile-stack sm:flex-row">
                        <div class="bg-white/20 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center mr-3 sm:mr-4 mb-3 sm:mb-0">
                            <i class="fas fa-car text-lg sm:text-xl"></i>
                        </div>
                        <div class="mobile-text-center sm:text-left flex-1">
                            <h1 class="text-2xl sm:text-3xl font-bold mb-2">Daftarkan Kendaraan Anda</h1>
                            <p class="text-white/90 text-sm sm:text-base">Daftarkan kendaraan Anda untuk mendapatkan layanan terbaik dari ServiCycle</p>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-yellow-300 mt-0.5 mr-2 sm:mr-3 text-sm sm:text-base"></i>
                            <div>
                                <h3 class="font-semibold text-yellow-300 text-sm sm:text-base">Penting!</h3>
                                <p class="text-xs sm:text-sm">Pastikan data yang Anda masukkan sudah benar dan sesuai dengan dokumen kendaraan Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="vehicleForm" class="bg-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8">
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
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">Detail<br>Kendaraan</p>
                            </div>
                            
                            <div class="h-1 bg-gray-300 flex-1 mx-1 sm:mx-2 min-w-8"></div>
                            
                            <!-- Step 3 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-sm">3</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">Foto<br>Kendaraan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div id="step1" class="step-content">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Informasi Dasar Kendaraan</h2>
                        
                        <div class="space-y-4 sm:space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kendaraan *</label>
                                    <select id="vehicleType" name="vehicleType" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Jenis Kendaraan</option>
                                        <option value="motor">Motor</option>
                                        <option value="mobil">Mobil</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Merek *</label>
                                    <input type="text" id="brand" name="brand" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Honda, Yamaha, Toyota">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Model *</label>
                                    <input type="text" id="model" name="model" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Civic, Vario, Avanza">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Pembuatan *</label>
                                    <input type="number" id="year" name="year" min="1980" max="2024" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: 2020">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Polisi *</label>
                                    <input type="text" id="licensePlate" name="licensePlate" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: B 1234 ABC">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Rangka (VIN) *</label>
                                    <input type="text" id="vin" name="vin" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: MHKA123456789012">
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

                    <!-- Step 2: Vehicle Details -->
                    <div id="step2" class="step-content hidden">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Detail Kendaraan</h2>
                        
                        <div class="space-y-4 sm:space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Warna Kendaraan *</label>
                                    <input type="text" id="color" name="color" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Merah, Hitam, Putih">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Mesin (CC) *</label>
                                    <input type="number" id="engineCapacity" name="engineCapacity" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: 150, 2000">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi *</label>
                                    <select id="transmission" name="transmission" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Tipe Transmisi</option>
                                        <option value="manual">Manual</option>
                                        <option value="matic">Matic</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Bahan Bakar *</label>
                                    <select id="fuelType" name="fuelType" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih Jenis Bahan Bakar</option>
                                        <option value="pertalite">Pertalite</option>
                                        <option value="pertamax">Pertamax</option>
                                        <option value="solar">Solar</option>
                                        <option value="listrik">Listrik</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                                <textarea id="notes" name="notes" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                    placeholder="Catatan khusus tentang kendaraan Anda (opsional)"></textarea>
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

                    <!-- Step 3: Foto Kendaraan -->
                    <div id="step3" class="step-content hidden">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Foto Kendaraan</h2>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-4">Upload Foto Kendaraan *</label>
                                
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 sm:p-8 text-center">
                                    <i class="fas fa-camera text-3xl sm:text-4xl text-gray-400 mb-3 sm:mb-4"></i>
                                    <p class="text-lg font-medium text-gray-700 mb-2">Tambahkan Foto Kendaraan Anda</p>
                                    <p class="text-sm text-gray-600 mb-4">Upload beberapa foto untuk menunjukkan kondisi kendaraan Anda</p>
                                    
                                    <input type="file" id="vehiclePhoto" name="vehiclePhoto" accept=".jpg,.jpeg,.png" 
                                        class="hidden" multiple>
                                    <button type="button" onclick="document.getElementById('vehiclePhoto').click()" 
                                        class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 mobile-touch-button inline-flex items-center">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i> Pilih Foto
                                    </button>
                                    <p class="text-xs text-gray-500 mt-3">Format: JPG, PNG (Maks. 5MB per file)</p>
                                </div>
                                
                                <!-- Preview container -->
                                <div id="photoPreview" class="file-preview mt-6"></div>
                                
                                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-start">
                                        <i class="fas fa-lightbulb text-blue-500 mt-0.5 mr-3 text-lg"></i>
                                        <div>
                                            <h4 class="font-semibold text-blue-800 mb-2">Tips Foto yang Baik:</h4>
                                            <ul class="text-sm text-gray-700 space-y-1">
                                                <li>• Foto tampilan depan kendaraan</li>
                                                <li>• Foto tampilan belakang kendaraan</li>
                                                <li>• Foto sisi kanan dan kiri</li>
                                                <li>• Foto interior dan dashboard</li>
                                                <li>• Foto nomor polisi</li>
                                            </ul>
                                            <p class="text-xs text-gray-600 mt-2">Foto yang baik akan memudahkan identifikasi kendaraan</p>
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
                            <button type="submit" 
                                class="bg-primary text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center justify-center mobile-touch-button mobile-full">
                                <i class="fas fa-paper-plane mr-2"></i> Daftarkan Kendaraan
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
        let userHasRegistered = false;
        let registeredVehicleData = {
            type: "motor",
            brand: "Honda",
            model: "Vario 150",
            year: "2022",
            licensePlate: "B 1234 ABC",
            color: "Hitam",
            status: "Terverifikasi"
        };

        let currentStep = 1;
        let uploadedPhotos = [];

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            checkRegistrationStatus();
            setupEventListeners();
            updateMobileStepIndicator();
        });

        // Setup event listeners
        function setupEventListeners() {
            // Photo upload
            document.getElementById('vehiclePhoto').addEventListener('change', function(e) {
                handlePhotoUpload(e.target.files);
            });

            // Form submission
            document.getElementById('vehicleForm').addEventListener('submit', function(e) {
                e.preventDefault();
                registerVehicle();
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
                    img.alt = 'Preview foto kendaraan';
                    
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
            document.getElementById('vehiclePhoto').value = '';
        }

        // Remove photo from preview and array
        function removePhoto(file, previewElement) {
            const index = uploadedPhotos.indexOf(file);
            if (index > -1) {
                uploadedPhotos.splice(index, 1);
            }
            previewElement.remove();
        }

        function checkRegistrationStatus() {
            if (userHasRegistered) {
                document.getElementById('registrationForm').classList.add('hidden');
                document.getElementById('alreadyRegistered').classList.remove('hidden');
                displayRegisteredVehicleInfo();
            }
        }

        function displayRegisteredVehicleInfo() {
            const infoContainer = document.getElementById('registeredVehicleInfo');
            infoContainer.innerHTML = `
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Jenis Kendaraan</p>
                    <p class="font-semibold text-sm">${registeredVehicleData.type === 'motor' ? 'Motor' : 'Mobil'}</p>
                </div>
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Merek & Model</p>
                    <p class="font-semibold text-sm">${registeredVehicleData.brand} ${registeredVehicleData.model}</p>
                </div>
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Tahun</p>
                    <p class="font-semibold text-sm">${registeredVehicleData.year}</p>
                </div>
                <div class="bg-white/10 rounded p-2">
                    <p class="text-white/70 text-xs">Nomor Polisi</p>
                    <p class="font-semibold text-sm">${registeredVehicleData.licensePlate}</p>
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
                    document.getElementById('vehicleForm').dispatchEvent(new Event('submit'));
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
                const vehicleType = document.getElementById('vehicleType').value;
                const brand = document.getElementById('brand').value;
                const model = document.getElementById('model').value;
                const year = document.getElementById('year').value;
                const licensePlate = document.getElementById('licensePlate').value;
                const vin = document.getElementById('vin').value;
                
                if (!vehicleType) {
                    errorMessage = 'Jenis kendaraan harus dipilih';
                    document.getElementById('vehicleType').focus();
                } else if (!brand) {
                    errorMessage = 'Merek kendaraan harus diisi';
                    document.getElementById('brand').focus();
                } else if (!model) {
                    errorMessage = 'Model kendaraan harus diisi';
                    document.getElementById('model').focus();
                } else if (!year) {
                    errorMessage = 'Tahun pembuatan harus diisi';
                    document.getElementById('year').focus();
                } else if (!licensePlate) {
                    errorMessage = 'Nomor polisi harus diisi';
                    document.getElementById('licensePlate').focus();
                } else if (!vin) {
                    errorMessage = 'Nomor rangka (VIN) harus diisi';
                    document.getElementById('vin').focus();
                }
            } else if (step === 2) {
                const color = document.getElementById('color').value;
                const engineCapacity = document.getElementById('engineCapacity').value;
                const transmission = document.getElementById('transmission').value;
                const fuelType = document.getElementById('fuelType').value;
                
                if (!color) {
                    errorMessage = 'Warna kendaraan harus diisi';
                    document.getElementById('color').focus();
                } else if (!engineCapacity) {
                    errorMessage = 'Kapasitas mesin harus diisi';
                    document.getElementById('engineCapacity').focus();
                } else if (!transmission) {
                    errorMessage = 'Tipe transmisi harus dipilih';
                    document.getElementById('transmission').focus();
                } else if (!fuelType) {
                    errorMessage = 'Jenis bahan bakar harus dipilih';
                    document.getElementById('fuelType').focus();
                }
            } else if (step === 3) {
                // Validasi untuk foto kendaraan
                if (uploadedPhotos.length === 0) {
                    errorMessage = 'Upload minimal satu foto kendaraan';
                }
            }

            if (errorMessage) {
                alert(errorMessage);
                isValid = false;
            }

            return isValid;
        }

        // Register vehicle
        function registerVehicle() {
            if (!validateStep(3)) return;

            // Collect form data
            const formData = {
                type: document.getElementById('vehicleType').value,
                brand: document.getElementById('brand').value,
                model: document.getElementById('model').value,
                year: document.getElementById('year').value,
                licensePlate: document.getElementById('licensePlate').value,
                vin: document.getElementById('vin').value,
                color: document.getElementById('color').value,
                engineCapacity: document.getElementById('engineCapacity').value,
                transmission: document.getElementById('transmission').value,
                fuelType: document.getElementById('fuelType').value,
                notes: document.getElementById('notes').value,
                photos: uploadedPhotos.length
            };

            // Simulate API call
            console.log('Registering vehicle:', formData);
            
            // Show success message
            alert('Pendaftaran kendaraan berhasil!');
            
            // In real app, this would be set by backend
            userHasRegistered = true;
            registeredVehicleData = formData;
            checkRegistrationStatus();
        }

        // Request edit
        function requestEdit() {
            const reason = prompt('Mohon jelaskan alasan perubahan data kendaraan:');
            if (reason) {
                console.log('Edit request:', reason);
                alert('Permohonan perubahan telah dikirim.');
            }
        }
    </script>
</body>

</html>