<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Edit Kendaraan</title>
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
            
            /* Hide next/prev buttons on mobile */
            .desktop-only {
                display: none !important;
            }
        }

        /* Show buttons on desktop */
        @media (min-width: 769px) {
            .desktop-only {
                display: flex !important;
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

        .step-content {
            transition: all 0.3s ease-in-out;
        }

        .current-photo {
            border: 2px solid #4f46e5;
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
                <a href="{{ route('vehicles.index') }}" class="text-gray-600 hover:text-primary font-medium text-sm sm:text-base">
                    <i class="fas fa-arrow-left mr-1 sm:mr-2"></i>
                    <span class="hidden sm:inline">Kembali ke Daftar Kendaraan</span>
                    <span class="sm:hidden">Kembali</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen py-4 sm:py-8">
        <div class="max-w-4xl mx-auto mobile-padding">

            <!-- Registration Form -->
            <div id="registrationForm">
                <div class="form-section text-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8 mb-6 sm:mb-8">
                    <div class="flex items-start sm:items-center mobile-stack sm:flex-row">
                        <div
                            class="bg-white/20 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center mr-3 sm:mr-4 mb-3 sm:mb-0">
                            <i class="fas fa-edit text-lg sm:text-xl"></i>
                        </div>
                        <div class="mobile-text-center sm:text-left flex-1">
                            <h1 class="text-2xl sm:text-3xl font-bold mb-2">Edit Kendaraan</h1>
                            <p class="text-white/90 text-sm sm:text-base">Perbarui data kendaraan Anda untuk memudahkan servis dan perawatan</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-yellow-300 mt-0.5 mr-2 sm:mr-3 text-sm sm:text-base"></i>
                            <div>
                                <h3 class="font-semibold text-yellow-300 text-sm sm:text-base">Penting!</h3>
                                <p class="text-xs sm:text-sm">Pastikan data kendaraan yang Anda perbarui sudah benar dan lengkap untuk memudahkan proses servis.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="vehicleForm" class="bg-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8" action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
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
                                    Spesifikasi<br>Teknis</p>
                            </div>

                            <div class="h-1 bg-gray-300 flex-1 mx-1 sm:mx-2 min-w-8"></div>

                            <!-- Step 3 -->
                            <div class="flex-shrink-0 flex flex-col items-center mx-2">
                                <div
                                    class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-sm">
                                    3</div>
                                <p class="font-semibold text-xs mt-2 mobile-step-indicator text-center">Foto &<br>Catatan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div id="step1" class="step-content">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Informasi Dasar Kendaraan</h2>

                        <div class="space-y-4 sm:space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Jenis Kendaraan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kendaraan *</label>
                                    <select name="vehicle_type" id="vehicle_type" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih jenis</option>
                                        <option value="mobil" {{ old('vehicle_type', $vehicle->vehicle_type) == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                        <option value="motor" {{ old('vehicle_type', $vehicle->vehicle_type) == 'motor' ? 'selected' : '' }}>Motor</option>
                                    </select>
                                    <div id="vehicle_type-error" class="error-message"></div>
                                </div>

                                <!-- Merek -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Merek *</label>
                                    <input type="text" name="brand" id="brand" value="{{ old('brand', $vehicle->brand) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Toyota, Honda, Yamaha">
                                    <div id="brand-error" class="error-message"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Model -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Model *</label>
                                    <input type="text" name="model" id="model" value="{{ old('model', $vehicle->model) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Avanza, Vario, Beat">
                                    <div id="model-error" class="error-message"></div>
                                </div>

                                <!-- Tahun -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun *</label>
                                    <input type="number" name="year" id="year" value="{{ old('year', $vehicle->year) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        min="1990" max="{{ date('Y') + 1 }}" placeholder="Contoh: 2023">
                                    <div id="year-error" class="error-message"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Plat Nomor -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Plat *</label>
                                    <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate', $vehicle->license_plate) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: BP 1234 XY">
                                    <div id="license_plate-error" class="error-message"></div>
                                </div>

                                <!-- Warna -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Warna *</label>
                                    <input type="text" name="color" id="color" value="{{ old('color', $vehicle->color) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: Hitam, Merah, Putih">
                                    <div id="color-error" class="error-message"></div>
                                </div>
                            </div>
                        </div>

                        <div class="desktop-only flex justify-end mt-6 sm:mt-8">
                            <button type="button" onclick="nextStep(2)"
                                class="bg-primary text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center mobile-touch-button mobile-full sm:mobile-auto">
                                Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Technical Specifications -->
                    <div id="step2" class="step-content hidden">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Spesifikasi Teknis</h2>

                        <div class="space-y-4 sm:space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Nomor Rangka (VIN) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Rangka (VIN)</label>
                                    <input type="text" name="vin" id="vin" value="{{ old('vin', $vehicle->vin) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Opsional">
                                    <div id="vin-error" class="error-message"></div>
                                </div>

                                <!-- Kapasitas Mesin -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Mesin (cc) *</label>
                                    <input type="number" name="engine_capacity" id="engine_capacity" value="{{ old('engine_capacity', $vehicle->engine_capacity) }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                        placeholder="Contoh: 1500, 250, 125">
                                    <div id="engine_capacity-error" class="error-message"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Transmisi -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi *</label>
                                    <select name="transmission" id="transmission" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih transmisi</option>
                                        <option value="manual" {{ old('transmission', $vehicle->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
                                        <option value="matic" {{ old('transmission', $vehicle->transmission) == 'matic' ? 'selected' : '' }}>Matic</option>
                                    </select>
                                    <div id="transmission-error" class="error-message"></div>
                                </div>

                                <!-- Jenis BBM -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis BBM *</label>
                                    <select name="fuel_type" id="fuel_type" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input">
                                        <option value="">Pilih jenis BBM</option>
                                        <option value="pertalite" {{ old('fuel_type', $vehicle->fuel_type) == 'pertalite' ? 'selected' : '' }}>Pertalite</option>
                                        <option value="pertamax" {{ old('fuel_type', $vehicle->fuel_type) == 'pertamax' ? 'selected' : '' }}>Pertamax</option>
                                        <option value="solar" {{ old('fuel_type', $vehicle->fuel_type) == 'solar' ? 'selected' : '' }}>Solar</option>
                                        <option value="listrik" {{ old('fuel_type', $vehicle->fuel_type) == 'listrik' ? 'selected' : '' }}>Listrik</option>
                                    </select>
                                    <div id="fuel_type-error" class="error-message"></div>
                                </div>
                            </div>
                        </div>

                        <div class="desktop-only flex mobile-stack sm:flex-row justify-between mt-6 sm:mt-8 space-y-3 sm:space-y-0">
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

                    <!-- Step 3: Photo & Notes -->
                    <div id="step3" class="step-content hidden">
                        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">Foto & Catatan</h2>

                        <div class="space-y-6">
                            <!-- Foto Kendaraan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-4">Foto Kendaraan</label>

                                <!-- Current Photo Preview -->
                                @if($vehicle->image)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                                    <div class="file-preview">
                                        <div class="file-preview-item current-photo">
                                            <img src="{{ asset('storage/vehicle_images/' . $vehicle->image) }}" alt="Foto kendaraan saat ini">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Foto yang saat ini tersimpan</p>
                                </div>
                                @endif

                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 sm:p-8 text-center">
                                    <i class="fas fa-camera text-3xl sm:text-4xl text-gray-400 mb-3 sm:mb-4"></i>
                                    <p class="text-lg font-medium text-gray-700 mb-2">Ubah Foto Kendaraan</p>
                                    <p class="text-sm text-gray-600 mb-4">Upload foto baru untuk mengganti foto saat ini (opsional)</p>

                                    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png"
                                        class="hidden">
                                    <button type="button" onclick="document.getElementById('image').click()"
                                        class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 mobile-touch-button inline-flex items-center">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i> Pilih Foto Baru
                                    </button>
                                    <p class="text-xs text-gray-500 mt-3">Format: JPG, PNG (Maks. 5MB)</p>
                                </div>

                                <!-- New Photo Preview -->
                                <div id="photoPreview" class="file-preview mt-6"></div>
                                <div id="image-error" class="error-message"></div>
                            </div>

                            <!-- Catatan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                                <textarea name="notes" id="notes" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input"
                                    placeholder="Tambahkan catatan tambahan tentang kendaraan Anda...">{{ old('notes', $vehicle->notes) }}</textarea>
                                <div id="notes-error" class="error-message"></div>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-lightbulb text-blue-500 mt-0.5 mr-3 text-lg"></i>
                                    <div>
                                        <h4 class="font-semibold text-blue-800 mb-2">Tips Foto yang Baik:</h4>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li>• Foto tampilan depan kendaraan</li>
                                            <li>• Foto tampilan samping kiri dan kanan</li>
                                            <li>• Foto bagian dalam (dashboard)</li>
                                            <li>• Foto nomor plat yang jelas</li>
                                            <li>• Foto area mesin (opsional)</li>
                                        </ul>
                                        <p class="text-xs text-gray-600 mt-2">Foto yang jelas akan memudahkan identifikasi kendaraan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="desktop-only flex mobile-stack sm:flex-row justify-between mt-8 space-y-3 sm:space-y-0">
                            <button type="button" onclick="prevStep(2)"
                                class="bg-gray-300 text-gray-700 px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-gray-400 transition-all duration-300 flex items-center justify-center mobile-touch-button mobile-full">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button type="submit" id="submitBtn"
                                class="bg-primary text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center justify-center mobile-touch-button mobile-full">
                                <i class="fas fa-save mr-2"></i> Perbarui Kendaraan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>

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
        let currentStep = 1;
        let uploadedPhoto = null;

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateMobileStepIndicator();
            updateProgress(1);
        });

        function setupEventListeners() {
            // Photo upload
            document.getElementById('image').addEventListener('change', function(e) {
                handlePhotoUpload(e.target.files);
            });

            // Form submission
            document.getElementById('vehicleForm').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            // Set max year to current year + 1
            const yearInput = document.getElementById('year');
            const currentYear = new Date().getFullYear();
            yearInput.setAttribute('max', currentYear + 1);
        }

        // Handle photo upload and preview
        function handlePhotoUpload(files) {
            const previewContainer = document.getElementById('photoPreview');
            previewContainer.innerHTML = '';

            if (files.length > 0) {
                const file = files[0];

                // Check file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File terlalu besar. Maksimal 5MB.');
                    document.getElementById('image').value = '';
                    return;
                }

                // Check file type
                if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                    alert('File harus berupa gambar JPG atau PNG.');
                    document.getElementById('image').value = '';
                    return;
                }

                // Add to uploaded photo
                uploadedPhoto = file;

                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'file-preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview foto kendaraan baru';

                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-btn';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = function() {
                        removePhoto(previewItem);
                    };

                    previewItem.appendChild(img);
                    previewItem.appendChild(removeBtn);
                    previewContainer.appendChild(previewItem);
                };

                reader.readAsDataURL(file);
            }
        }

        // Remove photo from preview
        function removePhoto(previewElement) {
            uploadedPhoto = null;
            document.getElementById('image').value = '';
            previewElement.remove();
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
                const vehicleType = document.getElementById('vehicle_type').value;
                const brand = document.getElementById('brand').value;
                const model = document.getElementById('model').value;
                const year = document.getElementById('year').value;
                const licensePlate = document.getElementById('license_plate').value;
                const color = document.getElementById('color').value;

                if (!vehicleType) {
                    errorMessage = 'Jenis kendaraan harus dipilih';
                    document.getElementById('vehicle_type').focus();
                } else if (!brand) {
                    errorMessage = 'Merek kendaraan harus diisi';
                    document.getElementById('brand').focus();
                } else if (!model) {
                    errorMessage = 'Model kendaraan harus diisi';
                    document.getElementById('model').focus();
                } else if (!year) {
                    errorMessage = 'Tahun kendaraan harus diisi';
                    document.getElementById('year').focus();
                } else if (!licensePlate) {
                    errorMessage = 'Nomor plat harus diisi';
                    document.getElementById('license_plate').focus();
                } else if (!color) {
                    errorMessage = 'Warna kendaraan harus diisi';
                    document.getElementById('color').focus();
                }
            } else if (step === 2) {
                const engineCapacity = document.getElementById('engine_capacity').value;
                const transmission = document.getElementById('transmission').value;
                const fuelType = document.getElementById('fuel_type').value;

                if (!engineCapacity) {
                    errorMessage = 'Kapasitas mesin harus diisi';
                    document.getElementById('engine_capacity').focus();
                } else if (!transmission) {
                    errorMessage = 'Transmisi harus dipilih';
                    document.getElementById('transmission').focus();
                } else if (!fuelType) {
                    errorMessage = 'Jenis BBM harus dipilih';
                    document.getElementById('fuel_type').focus();
                }
            }

            if (errorMessage) {
                alert(errorMessage);
                isValid = false;
            }

            return isValid;
        }

        // Submit form
        function submitForm() {
            if (!validateStep(3)) return;

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<div class="loading-spinner mr-2"></div> Memperbarui...';

            // Submit the form
            document.getElementById('vehicleForm').submit();
        }

        // Handle form errors from server
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const errors = @json($errors->getMessages());
                displayErrors(errors);
                
                // Determine which step has errors and navigate to it
                const errorFields = Object.keys(errors);
                let errorStep = 1;
                
                if (errorFields.some(field => ['vin', 'engine_capacity', 'transmission', 'fuel_type'].includes(field))) {
                    errorStep = 2;
                } else if (errorFields.some(field => ['image', 'notes'].includes(field))) {
                    errorStep = 3;
                }
                
                if (errorStep > 1) {
                    document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
                    document.getElementById('step' + errorStep).classList.remove('hidden');
                    currentStep = errorStep;
                    updateProgress(errorStep);
                    updateMobileStepIndicator();
                }
            });
        @endif
    </script>
</body>

</html>