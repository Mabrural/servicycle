@extends('homepage.layouts.main')

@section('container')
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

        .vehicle-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .vehicle-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .vehicle-card.selected {
            border-color: #4f46e5;
            background-color: #f0f4ff;
        }
    </style>

    <!-- Booking Hero -->
    <section class="booking-hero text-white py-12 md:py-16 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-10 left-10 w-52 h-52 bg-white rounded-full animate-float"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full animate-float"
                style="animation-delay: 2s;"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="javascript:void(0);" onclick="window.history.back();"
                class="inline-flex items-center text-white/80 hover:text-white mb-6 transition-all duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Detail Bengkel</span>
            </a>

            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-4">
                    Booking Servis
                </h1>
                <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto">
                    Pesan servis kendaraan Anda di {{ $workshop->name }} dengan mudah dan cepat
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
                        <div
                            class="step-indicator w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                            1
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-800">Pilih Kendaraan</p>
                            <p class="text-sm text-gray-600">Pilih kendaraan yang akan diservis</p>
                        </div>
                    </div>

                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>

                    <div class="flex items-center">
                        <div
                            class="step-indicator w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold">
                            2
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-600">Jadwal Servis</p>
                            <p class="text-sm text-gray-500">Pilih tanggal servis</p>
                        </div>
                    </div>

                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>

                    <div class="flex items-center">
                        <div
                            class="step-indicator w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold">
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
                    <!-- Step 1: Vehicle Selection -->
                    <div id="step1" class="booking-step">
                        <form id="bookingForm" action="" method="POST">
                            @csrf
                            <input type="hidden" name="workshop_id" value="{{ $workshop->id }}">

                            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                    <i class="fas fa-car text-primary mr-3"></i>
                                    Pilih Kendaraan
                                </h2>

                                <!-- Vehicle List -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-4">Pilih Kendaraan Anda</label>

                                    <div class="space-y-4" id="vehicleList">
                                        @forelse ($vehicles as $vehicle)
                                            <div class="vehicle-card bg-white border-2 border-gray-200 rounded-xl p-6 cursor-pointer hover:border-primary transition"
                                                data-vehicle-id="{{ $vehicle->id }}">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-4">
                                                        <div
                                                            class="w-12 h-12 
                                                        @if ($vehicle->type === 'Mobil') bg-primary 
                                                        @elseif($vehicle->type === 'Motor') bg-green-500 
                                                        @else bg-gray-400 @endif
                                                        rounded-lg flex items-center justify-center">
                                                            @if ($vehicle->type === 'Mobil')
                                                                <i class="fas fa-car text-white"></i>
                                                            @elseif($vehicle->type === 'Motor')
                                                                <i class="fas fa-motorcycle text-white"></i>
                                                            @else
                                                                <img src="{{ $vehicle->image ? url('/storage/vehicle_images/' . $vehicle->image) : asset('img/no-vehicle.jpg') }}"
                                                                    alt="{{ $vehicle->name ?? 'Vehicle Image' }}"
                                                                    class="w-10 h-10 object-cover rounded-lg" />
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <h3 class="font-semibold text-gray-800">{{ $vehicle->brand }}
                                                                {{ $vehicle->model }}</h3>
                                                            <p class="text-sm text-gray-600">
                                                                {{ $vehicle->license_plate }} • {{ $vehicle->year }} •
                                                                {{ $vehicle->color }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <span class="text-sm text-gray-500">
                                                            @if ($vehicle->vehicle_type === 'mobil')
                                                                Mobil
                                                            @elseif($vehicle->vehicle_type === 'motor')
                                                                Motor
                                                            @else
                                                                {{ $vehicle->vehicle_type }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-gray-500 text-sm">Belum ada kendaraan terdaftar. Silakan
                                                tambahkan
                                                kendaraan terlebih dahulu.</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Add New Vehicle Button -->
                                <div class="mb-6">
                                    <a href="{{ route('vehicles.create') }}"
                                        class="w-full py-4 border-2 border-dashed border-gray-300 rounded-xl text-gray-600 hover:text-primary hover:border-primary transition-all duration-300 flex items-center justify-center gap-2">
                                        <i class="fas fa-plus"></i>
                                        <span>Tambah Kendaraan Baru</span>
                                    </a>
                                </div>

                                <!-- Notes -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Catatan Servis
                                        (Opsional)</label>
                                    <textarea name="notes"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary form-input"
                                        rows="3" placeholder="Jelaskan keluhan atau permintaan khusus servis..." id="notes">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="button" id="nextToStep2"
                                    class="bg-primary text-white px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center">
                                    Lanjut ke Jadwal
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Step 2: Schedule Selection -->
                    <div id="step2" class="booking-step hidden">
                        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-calendar-alt text-primary mr-3"></i>
                                Pilih Jadwal Servis
                            </h2>

                            <div class="grid grid-cols-1 gap-6 mb-6">
                                <!-- Date Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Tanggal Servis</label>
                                    <input type="text" name="booking_date" id="datePicker"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary flatpickr-input"
                                        placeholder="Pilih tanggal..." value="{{ old('booking_date') }}">
                                    @error('booking_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Workshop Information -->
                                <div class="bg-blue-50 rounded-xl p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">Informasi Bengkel</h4>
                                    <p class="text-sm text-gray-600">{{ $workshop->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $workshop->address }}</p>
                                    <p class="text-sm text-gray-600">Jam Operasional:
                                        {{ $workshop->operating_hours ?? '08:00 - 17:00' }}</p>
                                </div>
                            </div>

                            <!-- Selected Vehicle Preview -->
                            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                                <h4 class="font-semibold text-gray-800 mb-2">Kendaraan Terpilih</h4>
                                <div id="selectedVehiclePreview" class="text-sm text-gray-600">
                                    Pilih kendaraan terlebih dahulu
                                </div>
                            </div>

                            <!-- Notes Preview -->
                            <div class="bg-yellow-50 rounded-xl p-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Catatan Servis</h4>
                                <p id="notesPreview" class="text-sm text-gray-600">-</p>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" id="backToStep1"
                                class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </button>
                            <button type="button" id="nextToStep3"
                                class="bg-primary text-white px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center">
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

                            <!-- Booking Summary -->
                            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Booking</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Bengkel</span>
                                        <span class="font-medium">{{ $workshop->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Kendaraan</span>
                                        <span id="confirmVehicle" class="font-medium">-</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Tanggal Servis</span>
                                        <span id="confirmDate" class="font-medium">-</span>
                                    </div>
                                    <div class="flex justify-between items-start">
                                        <span class="text-gray-600">Catatan</span>
                                        <span id="confirmNotes" class="font-medium text-right">-</span>
                                    </div>
                                    <div class="border-t pt-3">
                                        <div class="flex justify-between items-center text-lg">
                                            <span class="text-gray-800 font-semibold">Status</span>
                                            <span
                                                class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">Menunggu
                                                Konfirmasi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="mb-6">
                                <label class="flex items-start">
                                    <input type="checkbox" id="termsAgreement" class="mt-1 mr-3 text-primary rounded"
                                        required>
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
                            <button type="button" id="backToStep2"
                                class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </button>
                            <button type="submit" id="confirmBooking" form="bookingForm"
                                class="bg-accent text-white px-8 py-3 rounded-lg font-medium hover:bg-emerald-600 transition-all duration-300 btn-glow flex items-center">
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
                                <h4 class="font-semibold text-gray-800">
                                    {{ $workshop->name }}
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $workshop->address }}
                                </p>

                                @if ($workshop->rating)
                                    <div class="flex items-center mt-2">
                                        <div class="rating-stars text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($workshop->rating))
                                                    <i class="fas fa-star"></i>
                                                @elseif ($i - $workshop->rating < 1)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">
                                            {{ number_format($workshop->rating, 1) }}
                                            ({{ $workshop->review_count ?? 0 }})
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Booking</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kendaraan</span>
                                <span id="sidebarVehicle" class="font-medium text-right">Belum dipilih</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal</span>
                                <span id="sidebarDate" class="font-medium">Belum dipilih</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Status</span>
                                    <span
                                        class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">Draft</span>
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
                                <span>{{ $workshop->phone ?? '+62 812 3456 7890' }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-envelope text-primary mr-3"></i>
                                <span>{{ $workshop->email ?? 'support@servicycle.com' }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock text-primary mr-3"></i>
                                <span>{{ $workshop->service_hours ?? '24/7 Customer Service' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date picker
            flatpickr("#datePicker", {
                minDate: "today",
                dateFormat: "d-m-Y",
                locale: "id"
            });

            // State management
            let bookingData = {
                vehicle_id: null,
                workshop_id: {{ $workshop->id }},
                booking_date: null,
                notes: '',
                status: 'pending'
            };

            // Step Navigation
            const steps = document.querySelectorAll('.booking-step');
            const stepIndicators = document.querySelectorAll('.step-indicator');

            // Next to Step 2
            document.getElementById('nextToStep2').addEventListener('click', function() {
                if (!bookingData.vehicle_id) {
                    alert('Silakan pilih kendaraan terlebih dahulu');
                    return;
                }
                showStep(2);
            });

            // Back to Step 1
            document.getElementById('backToStep1').addEventListener('click', function() {
                showStep(1);
            });

            // Next to Step 3
            document.getElementById('nextToStep3').addEventListener('click', function() {
                const bookingDate = document.getElementById('datePicker').value;
                if (!bookingDate) {
                    alert('Silakan pilih tanggal servis terlebih dahulu');
                    return;
                }
                bookingData.booking_date = bookingDate;
                showStep(3);
            });

            // Back to Step 2
            document.getElementById('backToStep2').addEventListener('click', function() {
                showStep(2);
            });

            function showStep(stepNumber) {
                console.log('Showing step:', stepNumber);

                // Hide all steps
                steps.forEach(step => {
                    step.classList.add('hidden');
                    console.log('Hiding step:', step.id);
                });

                // Show current step
                const currentStep = document.getElementById(`step${stepNumber}`);
                if (currentStep) {
                    currentStep.classList.remove('hidden');
                    console.log('Showing step:', currentStep.id);
                }

                // Update step indicators
                stepIndicators.forEach((indicator, index) => {
                    indicator.classList.remove('active', 'completed');
                    if (index + 1 === stepNumber) {
                        indicator.classList.add('active');
                    } else if (index + 1 < stepNumber) {
                        indicator.classList.add('completed');
                    }
                });

                // Update previews
                updatePreviews();
            }

            // Vehicle Selection
            const vehicleCards = document.querySelectorAll('.vehicle-card');
            vehicleCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selected class from all cards
                    vehicleCards.forEach(c => c.classList.remove('selected', 'border-primary'));

                    // Add selected class to clicked card
                    this.classList.add('selected', 'border-primary');

                    // Get vehicle data
                    const vehicleId = this.getAttribute('data-vehicle-id');
                    const vehicleName = this.querySelector('h3').textContent;
                    const vehicleDetails = this.querySelector('p').textContent;

                    // Update booking data
                    bookingData.vehicle_id = vehicleId;

                    // Update hidden input in form
                    const vehicleInput = document.querySelector('input[name="vehicle_id"]');
                    if (!vehicleInput) {
                        // Create hidden input if it doesn't exist
                        const form = document.getElementById('bookingForm');
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'vehicle_id';
                        hiddenInput.value = vehicleId;
                        form.appendChild(hiddenInput);
                    } else {
                        vehicleInput.value = vehicleId;
                    }

                    // Update sidebar and previews
                    document.getElementById('sidebarVehicle').textContent = vehicleName;
                    updatePreviews();

                    console.log('Vehicle selected:', vehicleId, vehicleName);
                });
            });

            // Date Selection
            document.getElementById('datePicker').addEventListener('change', function() {
                bookingData.booking_date = this.value;
                document.getElementById('sidebarDate').textContent = this.value;
                updatePreviews();
            });

            // Notes
            document.getElementById('notes').addEventListener('input', function() {
                bookingData.notes = this.value;
                updatePreviews();
            });

            // Update all previews
            function updatePreviews() {
                // Step 2 previews
                const selectedVehicle = document.querySelector('.vehicle-card.selected');
                if (selectedVehicle) {
                    const vehicleName = selectedVehicle.querySelector('h3').textContent;
                    const vehicleDetails = selectedVehicle.querySelector('p').textContent;
                    document.getElementById('selectedVehiclePreview').innerHTML = `
                        <strong>${vehicleName}</strong><br>
                        ${vehicleDetails}
                    `;
                    document.getElementById('confirmVehicle').textContent = vehicleName;
                }

                // Notes preview
                const notes = document.getElementById('notes').value;
                document.getElementById('notesPreview').textContent = notes || '-';
                document.getElementById('confirmNotes').textContent = notes || '-';

                // Date preview
                const bookingDate = document.getElementById('datePicker').value;
                if (bookingDate) {
                    document.getElementById('confirmDate').textContent = bookingDate;
                }
            }

            // Form submission handling
            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                if (!document.getElementById('termsAgreement')?.checked) {
                    e.preventDefault();
                    alert('Harap setujui syarat dan ketentuan terlebih dahulu');
                    return;
                }

                // Validate all required data
                if (!bookingData.vehicle_id || !bookingData.booking_date) {
                    e.preventDefault();
                    alert('Harap lengkapi semua data yang diperlukan');
                    return;
                }

                // Show loading state
                const submitBtn = document.getElementById('confirmBooking');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                submitBtn.disabled = true;

                // Form will submit normally
                console.log('Submitting booking data:', bookingData);
            });

            // Initialize the first step
            showStep(1);
        });
    </script>
@endsection
