<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ServiCycle - Kendaraan Saya</title>
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
        
        .vehicle-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .vehicle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .vehicle-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        
        .vehicle-type-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .info-item i {
            width: 20px;
            margin-right: 8px;
            color: #6b7280;
        }
        
        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.6);
        }
        
        .empty-state {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            
            .mobile-touch-button {
                min-height: 44px;
                padding: 12px 16px;
            }
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
        <div class="max-w-6xl mx-auto mobile-padding">
            <!-- Page Header -->
            <div class="mb-6 sm:mb-8">
                <div class="flex items-center justify-between mobile-stack sm:flex-row">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Kendaraan Saya</h1>
                        <p class="text-gray-600 text-sm sm:text-base">Kelola informasi kendaraan Anda di ServiCycle</p>
                    </div>
                    <a href="{{ route('kendaraan-saya.create') }}" class="bg-primary text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center mobile-touch-button mobile-full sm:mobile-auto mt-4 sm:mt-0">
                        <i class="fas fa-plus mr-2"></i> Tambah Kendaraan
                    </a>
                </div>
            </div>

            <!-- Vehicle Cards Section -->
            <div id="vehicleCards">
                <!-- Vehicle Card -->
                <div class="bg-white rounded-xl shadow-md vehicle-card mb-6">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                             alt="Honda Beat" class="vehicle-image">
                        <span class="vehicle-type-badge bg-green-500 text-white">Motor</span>
                    </div>
                    
                    <div class="p-4 sm:p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Honda Beat</h2>
                                <p class="text-gray-600 text-sm">2020 • Merah</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-primary">B 1234 ABC</p>
                                <p class="text-xs text-gray-500">Nomor Polisi</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div class="space-y-2">
                                <div class="info-item">
                                    <i class="fas fa-cog"></i>
                                    <span class="text-gray-700">110 CC</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-gas-pump"></i>
                                    <span class="text-gray-700">Pertalite</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-barcode"></i>
                                    <span class="text-gray-700">MH3JC123456789012</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="info-item">
                                    <i class="fas fa-exchange-alt"></i>
                                    <span class="text-gray-700">Matic</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="text-gray-700">Servis: 10 Sep 2025</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-sticky-note"></i>
                                    <span class="text-gray-700">Catatan: Oli perlu diganti</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex mobile-stack sm:flex-row justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm text-gray-500 mb-3 sm:mb-0">
                                <i class="fas fa-clock mr-1"></i>
                                <span>Terdaftar: 15 Jan 2023</span>
                            </div>
                            <div class="flex space-x-2 mobile-full sm:mobile-auto mobile-space-y-4 sm:space-y-0">
                                <a href="{{ route('kendaraan-saya.edit', 1) }}" class="bg-blue-50 text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-100 transition-all duration-300 flex items-center justify-center mobile-touch-button mobile-full">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </a>
                                <button onclick="confirmDelete(1)" class="bg-red-50 text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-100 transition-all duration-300 flex items-center justify-center mobile-touch-button mobile-full">
                                    <i class="fas fa-trash mr-2"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State (akan ditampilkan jika tidak ada kendaraan) -->
                <!--
                <div class="empty-state text-white rounded-xl shadow-lg p-6 sm:p-8 md:p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="bg-white/20 w-16 h-16 sm:w-20 sm:h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-car text-2xl sm:text-3xl"></i>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold mb-2">Belum Ada Kendaraan</h2>
                        <p class="text-white/90 text-sm sm:text-base mb-6">Daftarkan kendaraan Anda untuk mendapatkan layanan terbaik dari ServiCycle</p>
                        <a href="{{ route('kendaraan-saya.create') }}" class="bg-white text-primary px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 btn-glow inline-flex items-center mobile-touch-button">
                            <i class="fas fa-plus mr-2"></i> Daftarkan Kendaraan Pertama
                        </a>
                    </div>
                </div>
                -->
            </div>

            <!-- Service History Section -->
            <div class="mt-8 sm:mt-12">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Riwayat Servis</h2>
                    <a href="#" class="text-primary hover:text-secondary font-medium text-sm flex items-center">
                        Lihat Semua <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
                
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Servis</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bengkel</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-800">10 Sep 2025</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">Servis Rutin</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">AHASS Merdeka</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">Rp 250.000</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-800">15 Jul 2025</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">Ganti Oli</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">AHASS Merdeka</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">Rp 120.000</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-800">20 Mei 2025</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">Tune-up Mesin</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">Bengkel Jaya</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">Rp 180.000</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 sm:mt-12 flex mobile-stack sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('dashboard') }}" class="bg-gray-200 text-gray-700 px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300 flex items-center justify-center mobile-touch-button mobile-full">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                <a href="#" class="bg-primary text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center justify-center mobile-touch-button mobile-full">
                    <i class="fas fa-calendar-alt mr-2"></i> Jadwalkan Servis
                </a>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-md w-full mx-4">
            <div class="flex items-center mb-4">
                <div class="bg-red-100 p-3 rounded-full mr-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Hapus Kendaraan</h3>
                    <p class="text-gray-600 text-sm">Apakah Anda yakin ingin menghapus kendaraan ini?</p>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button id="cancelDelete" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-300 transition-all duration-300">
                    Batal
                </button>
                <button id="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition-all duration-300">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let vehicleToDelete = null;
        
        function confirmDelete(vehicleId) {
            vehicleToDelete = vehicleId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeDeleteModal() {
            vehicleToDelete = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }
        
        function deleteVehicle() {
            if (vehicleToDelete) {
                // In a real application, you would send a DELETE request to the server here
                console.log('Deleting vehicle with ID:', vehicleToDelete);
                alert('Kendaraan berhasil dihapus!');
                closeDeleteModal();
                
                // In a real app, you would reload the page or remove the vehicle card
                // For demo purposes, we'll just show a message
            }
        }
        
        // Event listeners for the modal
        document.getElementById('cancelDelete').addEventListener('click', closeDeleteModal);
        document.getElementById('confirmDelete').addEventListener('click', deleteVehicle);
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>