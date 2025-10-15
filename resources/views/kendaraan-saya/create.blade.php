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
            width: 200px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border: 2px solid #e5e7eb;
        }

        .file-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-preview-item .remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .file-preview-item .remove-btn:hover {
            background: rgba(220, 38, 38, 0.9);
            transform: scale(1.1);
        }

        .no-photo-placeholder {
            width: 200px;
            height: 150px;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #f9fafb;
            color: #6b7280;
        }

        .no-photo-placeholder i {
            font-size: 2rem;
            margin-bottom: 8px;
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
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary font-medium text-sm sm:text-base">
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
            
            <!-- Check if user already has vehicle -->
            @if(App\Models\Vehicle::userHasVehicle(Auth::id()))
                <div class="mb-6 sm:mb-8">
                    <div class="success-card text-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8">
                        <div class="flex items-start sm:items-center mobile-stack sm:flex-row">
                            <div class="bg-white/20 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center mr-3 sm:mr-4 mb-3 sm:mb-0">
                                <i class="fas fa-check text-lg sm:text-xl"></i>
                            </div>
                            <div class="mobile-text-center sm:text-left flex-1">
                                <h2 class="text-xl sm:text-2xl font-bold mb-1">Kendaraan Sudah Terdaftar</h2>
                                <p class="text-white/90 text-sm sm:text-base">Anda sudah pernah mendaftarkan kendaraan sebelumnya</p>
                            </div>
                        </div>
                        <div class="bg-white/10 rounded-lg p-3 sm:p-4 mt-4">
                            <h3 class="font-semibold mb-2 text-sm sm:text-base">Informasi Kendaraan Anda:</h3>
                            <div class="grid grid-cols-1 gap-3 sm:gap-4 text-sm">
                                @php
                                    $vehicle = Auth::user()->vehicles->first();
                                @endphp
                                @if($vehicle)
                                    <div class="bg-white/10 rounded p-2">
                                        <p class="text-white/70 text-xs">Jenis Kendaraan</p>
                                        <p class="font-semibold text-sm">{{ $vehicle->vehicle_type == 'motor' ? 'Motor' : 'Mobil' }}</p>
                                    </div>
                                    <div class="bg-white/10 rounded p-2">
                                        <p class="text-white/70 text-xs">Merek & Model</p>
                                        <p class="font-semibold text-sm">{{ $vehicle->brand }} {{ $vehicle->model }}</p>
                                    </div>
                                    <div class="bg-white/10 rounded p-2">
                                        <p class="text-white/70 text-xs">Tahun</p>
                                        <p class="font-semibold text-sm">{{ $vehicle->year }}</p>
                                    </div>
                                    <div class="bg-white/10 rounded p-2">
                                        <p class="text-white/70 text-xs">Nomor Polisi</p>
                                        <p class="font-semibold text-sm">{{ $vehicle->license_plate }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-6 flex mobile-stack sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('vehicles.index') }}" class="bg-white text-green-600 px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 mobile-touch-button text-center mobile-full">
                                <i class="fas fa-car mr-2"></i>Lihat Kendaraan Saya
                            </a>
                            <a href="{{ route('vehicles.edit', $vehicle->id ?? '') }}" class="bg-white/20 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-white/30 transition-all duration-300 mobile-touch-button text-center mobile-full">
                                <i class="fas fa-edit mr-2"></i>Edit Kendaraan
                            </a>
                        </div>
                    </div>
                </div>
            @else
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

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-red-800 mb-2">Terjadi Kesalahan</h4>
                                    <ul class="text-sm text-red-700 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                                <p class="text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <p class="text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form id="vehicleForm" action="{{ route('kendaraan-saya.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-4 sm:p-6 md:p-8">
                        @csrf
                        
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
                                        <label for="vehicleType" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kendaraan *</label>
                                        <select id="vehicleType" name="vehicleType" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('vehicleType') border-red-500 @enderror">
                                            <option value="">Pilih Jenis Kendaraan</option>
                                            <option value="motor" {{ old('vehicleType') == 'motor' ? 'selected' : '' }}>Motor</option>
                                            <option value="mobil" {{ old('vehicleType') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                        </select>
                                        @error('vehicleType')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Merek *</label>
                                        <input type="text" id="brand" name="brand" value="{{ old('brand') }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('brand') border-red-500 @enderror"
                                            placeholder="Contoh: Honda, Yamaha, Toyota">
                                        @error('brand')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                    <div>
                                        <label for="model" class="block text-sm font-medium text-gray-700 mb-2">Model *</label>
                                        <input type="text" id="model" name="model" value="{{ old('model') }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('model') border-red-500 @enderror"
                                            placeholder="Contoh: Civic, Vario, Avanza">
                                        @error('model')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Tahun Pembuatan *</label>
                                        <input type="number" id="year" name="year" value="{{ old('year') }}" min="1980" max="{{ date('Y') + 1 }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('year') border-red-500 @enderror"
                                            placeholder="Contoh: 2020">
                                        @error('year')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                    <div>
                                        <label for="licensePlate" class="block text-sm font-medium text-gray-700 mb-2">Nomor Polisi *</label>
                                        <input type="text" id="licensePlate" name="licensePlate" value="{{ old('licensePlate') }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('licensePlate') border-red-500 @enderror"
                                            placeholder="Contoh: B 1234 ABC">
                                        @error('licensePlate')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="vin" class="block text-sm font-medium text-gray-700 mb-2">Nomor Rangka (VIN) *</label>
                                        <input type="text" id="vin" name="vin" value="{{ old('vin') }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('vin') border-red-500 @enderror"
                                            placeholder="Contoh: MHKA123456789012">
                                        @error('vin')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
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
                                        <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna Kendaraan *</label>
                                        <input type="text" id="color" name="color" value="{{ old('color') }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('color') border-red-500 @enderror"
                                            placeholder="Contoh: Merah, Hitam, Putih">
                                        @error('color')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="engineCapacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Mesin (CC) *</label>
                                        <input type="number" id="engineCapacity" name="engineCapacity" value="{{ old('engineCapacity') }}" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('engineCapacity') border-red-500 @enderror"
                                            placeholder="Contoh: 150, 2000">
                                        @error('engineCapacity')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                    <div>
                                        <label for="transmission" class="block text-sm font-medium text-gray-700 mb-2">Transmisi *</label>
                                        <select id="transmission" name="transmission" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('transmission') border-red-500 @enderror">
                                            <option value="">Pilih Tipe Transmisi</option>
                                            <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                                            <option value="matic" {{ old('transmission') == 'matic' ? 'selected' : '' }}>Matic</option>
                                        </select>
                                        @error('transmission')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="fuelType" class="block text-sm font-medium text-gray-700 mb-2">Bahan Bakar *</label>
                                        <select id="fuelType" name="fuelType" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('fuelType') border-red-500 @enderror">
                                            <option value="">Pilih Jenis Bahan Bakar</option>
                                            <option value="pertalite" {{ old('fuelType') == 'pertalite' ? 'selected' : '' }}>Pertalite</option>
                                            <option value="pertamax" {{ old('fuelType') == 'pertamax' ? 'selected' : '' }}>Pertamax</option>
                                            <option value="solar" {{ old('fuelType') == 'solar' ? 'selected' : '' }}>Solar</option>
                                            <option value="listrik" {{ old('fuelType') == 'listrik' ? 'selected' : '' }}>Listrik</option>
                                        </select>
                                        @error('fuelType')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                                    <textarea id="notes" name="notes" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 mobile-form-input @error('notes') border-red-500 @enderror"
                                        placeholder="Catatan khusus tentang kendaraan Anda (opsional)">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
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
                                    
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 sm:p-8 text-center hover:border-primary transition-all duration-300">
                                        <i class="fas fa-camera text-3xl sm:text-4xl text-gray-400 mb-3 sm:mb-4"></i>
                                        <p class="text-lg font-medium text-gray-700 mb-2">Tambahkan Foto Kendaraan Anda</p>
                                        <p class="text-sm text-gray-600 mb-4">Upload <strong>satu foto</strong> untuk menunjukkan kendaraan Anda</p>
                                        
                                        <input type="file" id="vehiclePhoto" name="vehiclePhoto" accept=".jpg,.jpeg,.png" 
                                            class="hidden">
                                        <button type="button" onclick="document.getElementById('vehiclePhoto').click()" 
                                            class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 mobile-touch-button inline-flex items-center">
                                            <i class="fas fa-cloud-upload-alt mr-2"></i> Pilih Foto
                                        </button>
                                        <p class="text-xs text-gray-500 mt-3">Format: JPG, PNG (Maks. 5MB)</p>
                                        @error('vehiclePhoto')
                                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <!-- Preview container -->
                                    <div id="photoPreview" class="file-preview mt-6">
                                        <div class="no-photo-placeholder">
                                            <i class="fas fa-image"></i>
                                            <span class="text-sm">Belum ada foto</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                                        <div class="flex items-start">
                                            <i class="fas fa-lightbulb text-blue-500 mt-0.5 mr-3 text-lg"></i>
                                            <div>
                                                <h4 class="font-semibold text-blue-800 mb-2">Tips Foto yang Baik:</h4>
                                                <ul class="text-sm text-gray-700 space-y-1">
                                                    <li>• Foto tampilan depan kendaraan yang jelas</li>
                                                    <li>• Pastikan nomor polisi terbaca</li>
                                                    <li>• Pencahayaan yang cukup</li>
                                                    <li>• Background yang tidak ramai</li>
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
            @endif
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
    let currentStep = 1;
    let uploadedPhoto = null;

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        updateMobileStepIndicator();
        
        // Check if there are validation errors and show the appropriate step
        @if($errors->any())
            // If there are errors, show the first step that has errors
            const errorFields = [
                'vehicleType', 'brand', 'model', 'year', 'licensePlate', 'vin',
                'color', 'engineCapacity', 'transmission', 'fuelType', 'notes',
                'vehiclePhoto'
            ];
            
            for (let field of errorFields) {
                if (document.querySelector(`[name="${field}"]`)) {
                    const fieldElement = document.querySelector(`[name="${field}"]`);
                    if (fieldElement.closest('#step1')) {
                        showStep(1);
                        break;
                    } else if (fieldElement.closest('#step2')) {
                        showStep(2);
                        break;
                    } else if (fieldElement.closest('#step3')) {
                        showStep(3);
                        break;
                    }
                }
            }
        @endif
    });

    // Setup event listeners
    function setupEventListeners() {
        // Photo upload - only allow single file
        document.getElementById('vehiclePhoto').addEventListener('change', function(e) {
            handlePhotoUpload(e.target.files);
        });

        // Form submission - HAPUS event listener ini karena mengganggu submit native Laravel
        // document.getElementById('vehicleForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     registerVehicle();
        // });
    }

    // Handle photo upload and preview - modified for single photo
    function handlePhotoUpload(files) {
        const previewContainer = document.getElementById('photoPreview');
        const fileInput = document.getElementById('vehiclePhoto');
        
        if (files.length === 0) return;
        
        const file = files[0]; // Only take the first file
        
        // Check file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert(`File ${file.name} terlalu besar. Maksimal 5MB.`);
            return;
        }
        
        // Check file type
        if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
            alert(`File ${file.name} harus berupa gambar JPG atau PNG.`);
            return;
        }
        
        // Store the single photo
        uploadedPhoto = file;
        
        // Clear previous preview
        previewContainer.innerHTML = '';
        
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
            removeBtn.title = 'Hapus foto';
            removeBtn.type = 'button'; // Important: prevent form submission
            removeBtn.onclick = function() {
                removePhoto();
            };
            
            previewItem.appendChild(img);
            previewItem.appendChild(removeBtn);
            previewContainer.appendChild(previewItem);
        };
        
        reader.readAsDataURL(file);
        
        // Create a new FileList dengan file yang dipilih
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
    }

    // Remove photo from preview
    function removePhoto() {
        uploadedPhoto = null;
        const previewContainer = document.getElementById('photoPreview');
        const fileInput = document.getElementById('vehiclePhoto');
        
        // Clear file input
        fileInput.value = '';
        
        previewContainer.innerHTML = `
            <div class="no-photo-placeholder">
                <i class="fas fa-image"></i>
                <span class="text-sm">Belum ada foto</span>
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
            // Validasi step 3 sebelum submit
            if (validateStep(3)) {
                document.getElementById('vehicleForm').submit();
            }
        }
    }

    // Step navigation
    function nextStep(step) {
        if (validateStep(currentStep)) {
            showStep(step);
        }
    }

    function prevStep(step) {
        showStep(step);
    }

    function showStep(step) {
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

    // Step validation - HANYA untuk navigasi, bukan untuk final submission
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
            // Untuk step 3, hanya beri peringatan tapi biarkan form bisa di-submit
            // Validasi sebenarnya akan dilakukan oleh Laravel
            const fileInput = document.getElementById('vehiclePhoto');
            if (!fileInput.files || fileInput.files.length === 0) {
                errorMessage = 'Upload satu foto kendaraan sebelum melanjutkan';
            }
        }

        if (errorMessage) {
            alert(errorMessage);
            isValid = false;
        }

        return isValid;
    }

    // HAPUS function registerVehicle() karena tidak diperlukan lagi
    // Biarkan form submission native Laravel yang menangani
</script>
</body>

</html>