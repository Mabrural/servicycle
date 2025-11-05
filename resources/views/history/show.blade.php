<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riwayat Servis - {{ $bookingService->id ?? 'Loading...' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .loading-spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 fade-in">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Servis Kendaraan</h1>
                <p class="text-gray-600 mt-2">Informasi lengkap mengenai booking servis kendaraan Anda</p>
            </div>
            <a href="{{ url()->previous() }}" class="bg-white text-gray-700 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <!-- Loading State -->
        <div id="loadingState" class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="loading-spinner"></div>
            <p class="text-gray-600 mt-4">Memuat data servis...</p>
        </div>

        <!-- Content -->
        <div id="content" class="hidden fade-in">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border-l-4 
                @if($bookingService->status === 'selesai') border-green-500 
                @elseif($bookingService->status === 'dikerjakan') border-blue-500 
                @elseif($bookingService->status === 'ditolak') border-red-500 
                @elseif($bookingService->status === 'diambil') border-purple-500
                @else border-yellow-500 @endif">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Status Servis</h2>
                        <p class="text-gray-600 mt-1">Update terakhir: <span id="updatedAt">{{ $bookingService->updated_at ? $bookingService->updated_at->format('d M Y H:i') : '-' }}</span></p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="status-badge 
                            @if($bookingService->status === 'selesai') bg-green-100 text-green-800
                            @elseif($bookingService->status === 'dikerjakan') bg-blue-100 text-blue-800
                            @elseif($bookingService->status === 'ditolak') bg-red-100 text-red-800
                            @elseif($bookingService->status === 'diambil') bg-purple-100 text-purple-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            <i class="fas 
                                @if($bookingService->status === 'selesai') fa-check-circle 
                                @elseif($bookingService->status === 'dikerjakan') fa-tools 
                                @elseif($bookingService->status === 'ditolak') fa-times-circle 
                                @elseif($bookingService->status === 'diambil') fa-car
                                @else fa-clock @endif mr-2"></i>
                            {{ ucfirst(str_replace('_', ' ', $bookingService->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Informasi Booking -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-blue-500"></i>
                        Informasi Booking
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">ID Booking:</span>
                            <span class="text-gray-800 font-semibold">#{{ $bookingService->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Tanggal Booking:</span>
                            <span class="text-gray-800">{{ $bookingService->booking_date->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Dibuat Oleh:</span>
                            <span class="text-gray-800">{{ $bookingService->creator->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Dibuat Pada:</span>
                            <span class="text-gray-800">{{ $bookingService->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kendaraan -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-car text-green-500"></i>
                        Informasi Kendaraan
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Plat Nomor:</span>
                            <span class="text-gray-800 font-mono">{{ $bookingService->vehicle->license_plate ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Merek:</span>
                            <span class="text-gray-800">{{ $bookingService->vehicle->brand ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Model:</span>
                            <span class="text-gray-800">{{ $bookingService->vehicle->model ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Tahun:</span>
                            <span class="text-gray-800">{{ $bookingService->vehicle->year ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Bengkel -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-warehouse text-purple-500"></i>
                        Informasi Bengkel
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Nama Bengkel:</span>
                            <span class="text-gray-800">{{ $bookingService->workshop->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Alamat:</span>
                            <span class="text-gray-800 text-right">{{ $bookingService->workshop->address ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Telepon:</span>
                            <span class="text-gray-800">{{ $bookingService->workshop->phone ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Email:</span>
                            <span class="text-gray-800">{{ $bookingService->workshop->email ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Servis -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-tools text-orange-500"></i>
                        Detail Servis
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Jenis Servis:</span>
                            <span class="text-gray-800">{{ $bookingService->service_type ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Keluhan:</span>
                            <span class="text-gray-800 text-right">{{ $bookingService->issue_description ?? 'Tidak ada keluhan' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Estimasi Biaya:</span>
                            <span class="text-gray-800 font-semibold">
                                @if($bookingService->estimated_cost)
                                    Rp {{ number_format($bookingService->estimated_cost, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Biaya Akhir:</span>
                            <span class="text-gray-800 font-semibold 
                                @if($bookingService->actual_cost) text-green-600 @endif">
                                @if($bookingService->actual_cost)
                                    Rp {{ number_format($bookingService->actual_cost, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Tambahan -->
            @if($bookingService->notes)
            <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-sticky-note text-yellow-500"></i>
                    Catatan Tambahan
                </h3>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-gray-700">{{ $bookingService->notes }}</p>
                </div>
            </div>
            @endif

            <!-- Timeline Progress -->
            <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-history text-indigo-500"></i>
                    Timeline Progress
                </h3>
                <div class="space-y-4">
                    @php
                        $currentStatus = $bookingService->status;
                        
                        // Timeline untuk status normal (diterima)
                        $normalTimeline = [
                            'menunggu_konfirmasi' => ['icon' => 'clock', 'color' => 'yellow', 'label' => 'Menunggu Konfirmasi'],
                            'diterima' => ['icon' => 'check-circle', 'color' => 'green', 'label' => 'Diterima'],
                            'dikerjakan' => ['icon' => 'tools', 'color' => 'blue', 'label' => 'Dikerjakan'],
                            'selesai' => ['icon' => 'check-double', 'color' => 'green', 'label' => 'Selesai'],
                            'diambil' => ['icon' => 'car', 'color' => 'purple', 'label' => 'Diambil']
                        ];
                        
                        // Timeline untuk status ditolak
                        $rejectedTimeline = [
                            'menunggu_konfirmasi' => ['icon' => 'clock', 'color' => 'yellow', 'label' => 'Menunggu Konfirmasi'],
                            'ditolak' => ['icon' => 'times-circle', 'color' => 'red', 'label' => 'Ditolak']
                        ];
                        
                        // Pilih timeline berdasarkan status
                        $timeline = $currentStatus === 'ditolak' ? $rejectedTimeline : $normalTimeline;
                    @endphp

                    @foreach($timeline as $status => $info)
                        @php
                            $isActive = false;
                            $isCompleted = false;
                            
                            // Logika untuk timeline normal (diterima)
                            if ($currentStatus !== 'ditolak') {
                                if ($currentStatus === 'diambil') {
                                    $isCompleted = true;
                                } elseif ($currentStatus === 'selesai') {
                                    $isCompleted = in_array($status, ['menunggu_konfirmasi', 'diterima', 'dikerjakan', 'selesai']);
                                } elseif ($currentStatus === 'dikerjakan') {
                                    $isCompleted = in_array($status, ['menunggu_konfirmasi', 'diterima', 'dikerjakan']);
                                } elseif ($currentStatus === 'diterima') {
                                    $isCompleted = in_array($status, ['menunggu_konfirmasi', 'diterima']);
                                } else {
                                    $isCompleted = $status === 'menunggu_konfirmasi';
                                }
                            } 
                            // Logika untuk timeline ditolak
                            else {
                                $isCompleted = $status === 'menunggu_konfirmasi' || $status === 'ditolak';
                            }
                            
                            $isActive = $status === $currentStatus && !$isCompleted;
                        @endphp

                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                    @if($isCompleted) bg-{{ $info['color'] }}-500 text-white
                                    @elseif($isActive) border-2 border-{{ $info['color'] }}-500 bg-white text-{{ $info['color'] }}-500
                                    @else border-2 border-gray-300 bg-white text-gray-400 @endif">
                                    <i class="fas fa-{{ $info['icon'] }}"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 @if(!$isCompleted && !$isActive) text-gray-400 @endif">
                                    {{ $info['label'] }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    @if($isCompleted)
                                        Selesai
                                    @elseif($isActive)
                                        Sedang Berlangsung
                                    @else
                                        Menunggu
                                    @endif
                                </p>
                            </div>
                            @if(!$loop->last)
                                <div class="flex-shrink-0 w-6">
                                    <div class="h-0.5 w-full 
                                        @if($isCompleted) bg-{{ $info['color'] }}-500
                                        @else bg-gray-300 @endif">
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div id="errorState" class="hidden bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="text-red-500 text-6xl mb-4">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Gagal Memuat Data</h3>
            <p class="text-gray-600 mb-4">Terjadi kesalahan saat memuat data servis.</p>
            <button onclick="location.reload()" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                <i class="fas fa-redo mr-2"></i>
                Coba Lagi
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate loading for better UX
            setTimeout(() => {
                document.getElementById('loadingState').classList.add('hidden');
                document.getElementById('content').classList.remove('hidden');
            }, 1000);

            // Format dates if needed
            const formatDates = () => {
                const dateElements = document.querySelectorAll('[data-date]');
                dateElements.forEach(el => {
                    const date = new Date(el.getAttribute('data-date'));
                    if (!isNaN(date)) {
                        el.textContent = date.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }
                });
            };

            formatDates();
        });
    </script>
</body>
</html>