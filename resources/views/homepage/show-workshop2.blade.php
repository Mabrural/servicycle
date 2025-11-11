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

        .rating-stars {
            color: #fbbf24;
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

        /* Improved Responsive Image Gallery Styles */
        .gallery-container {
            width: 100%;
            margin-bottom: 2rem;
        }

        /* Single Image Layout */
        .single-image-container {
            width: 100%;
            aspect-ratio: 16/9;
            max-height: 500px;
            border-radius: 12px;
            overflow: hidden;
        }

        .single-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .single-image:hover {
            transform: scale(1.02);
        }

        /* Multiple Images Layout */
        .multi-gallery-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .main-image-container {
            width: 100%;
            aspect-ratio: 16/9;
            max-height: 400px;
            border-radius: 12px;
            overflow: hidden;
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .main-image:hover {
            transform: scale(1.02);
        }

        .thumbnail-scroll-container {
            width: 100%;
            overflow-x: auto;
            padding: 8px 0;
        }

        .thumbnail-scroll-container::-webkit-scrollbar {
            height: 6px;
        }

        .thumbnail-scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .thumbnail-scroll-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .thumbnail-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .thumbnails-wrapper {
            display: flex;
            gap: 8px;
            min-width: min-content;
        }

        .thumbnail-item {
            flex: 0 0 auto;
            width: 120px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .thumbnail-item:hover {
            border-color: #4f46e5;
            transform: translateY(-2px);
        }

        .thumbnail-item.active {
            border-color: #4f46e5;
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .placeholder-thumbnail {
            width: 120px;
            height: 80px;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            flex: 0 0 auto;
        }

        /* No Images Fallback */
        .no-image-container {
            width: 100%;
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {

            .single-image-container,
            .main-image-container {
                aspect-ratio: 4/3;
                max-height: 400px;
            }

            .thumbnail-item {
                width: 100px;
                height: 70px;
            }
        }

        @media (max-width: 768px) {

            .single-image-container,
            .main-image-container {
                aspect-ratio: 4/3;
                max-height: 350px;
            }

            .thumbnail-item {
                width: 90px;
                height: 60px;
            }
        }

        @media (max-width: 480px) {

            .single-image-container,
            .main-image-container {
                aspect-ratio: 1/1;
                max-height: 300px;
            }

            .thumbnail-item {
                width: 80px;
                height: 60px;
            }

            .placeholder-thumbnail {
                width: 80px;
                height: 60px;
            }
        }

        /* Image Modal */
        .image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .close-modal {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 24px;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* WhatsApp Button Styles */
        .whatsapp-btn {
            background-color: #25D366;
            color: white;
        }

        .whatsapp-btn:hover {
            background-color: #128C7E;
        }
    </style>

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
                            @if ($workshop->rating)
                                Rating {{ number_format($workshop->rating, 1) }}/5 •
                            @else
                                Belum ada rating •
                            @endif
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
                        @if ($workshop->types && is_array($workshop->types))
                            @foreach ($workshop->types as $type)
                                <span
                                    class="bg-white/20 px-3 py-1 rounded-full text-sm capitalize">{{ $type }}</span>
                            @endforeach
                        @endif

                        @if ($workshop->specialization)
                            @foreach (explode(',', $workshop->specialization) as $spec)
                                <span class="bg-white/20 px-3 py-1 rounded-full text-sm">{{ trim($spec) }}</span>
                            @endforeach
                        @endif

                        @if (strpos(strtolower($workshop->operating_hours ?? ''), '24') !== false)
                            <span class="bg-white/20 px-3 py-1 rounded-full text-sm">24 Jam</span>
                        @endif
                    </div>
                </div>

                <div class="mt-6 md:mt-0 flex space-x-4">
                    <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                        target="_blank"
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
                    <div class="gallery-container">
                        @if ($workshop->images && $workshop->images->count() > 0)
                            @if ($workshop->images->count() == 1)
                                <!-- Single Image Layout -->
                                <div class="single-image-container">
                                    <img src="{{ $workshop->images->first()->image_url }}" alt="{{ $workshop->name }}"
                                        class="single-image"
                                        onclick="openImageModal('{{ $workshop->images->first()->image_url }}')">
                                </div>
                            @else
                                <!-- Multiple Images Layout -->
                                <div class="multi-gallery-container">
                                    <!-- Main Image -->
                                    <div class="main-image-container">
                                        <img id="mainGalleryImage" src="{{ $workshop->images->first()->image_url }}"
                                            alt="{{ $workshop->name }}" class="main-image"
                                            onclick="openImageModal(this.src)">
                                    </div>

                                    <!-- Thumbnails Scroll -->
                                    <div class="thumbnail-scroll-container">
                                        <div class="thumbnails-wrapper">
                                            @foreach ($workshop->images as $index => $image)
                                                <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}"
                                                    onclick="changeMainImage('{{ $image->image_url }}', this)">
                                                    <img src="{{ $image->image_url }}" alt="{{ $workshop->name }}"
                                                        class="thumbnail-image">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <!-- No Images Fallback -->
                            <div class="no-image-container">
                                <div class="text-center">
                                    <i class="fas fa-image text-4xl mb-2"></i>
                                    <p>Tidak ada gambar tersedia</p>
                                </div>
                            </div>
                        @endif
                    </div>

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
                            @if ($workshop->operating_hours)
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-accent mr-3"></i>
                                    <span class="text-gray-700">{{ $workshop->operating_hours }}</span>
                                </div>
                            @endif
                            @if ($workshop->created_at)
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
                            @if ($workshop->services && is_array($workshop->services))
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h3 class="font-semibold text-gray-800 mb-2 flex items-center">
                                        <i class="fas fa-list text-primary mr-2"></i>
                                        Semua Layanan
                                    </h3>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach ($workshop->services as $service)
                                            <span class="service-tag">{{ $service }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($workshop->specialization)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h3 class="font-semibold text-gray-800 mb-2 flex items-center">
                                        <i class="fas fa-star text-primary mr-2"></i>
                                        Spesialisasi
                                    </h3>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach (explode(',', $workshop->specialization) as $spec)
                                            <span
                                                class="service-tag bg-green-100 text-green-800">{{ trim($spec) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if (!$workshop->services && !$workshop->specialization)
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

                            @if ($workshop->phone)
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-700">Telepon</p>
                                        <p class="text-gray-600 text-sm">{{ $workshop->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($workshop->email)
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-gray-400 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-700">Email</p>
                                        <p class="text-gray-600 text-sm">{{ $workshop->email }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($workshop->operating_hours)
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
                                @if ($workshop->rating)
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($workshop->rating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $workshop->rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                @else
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                @endif
                            </div>
                            <p class="text-gray-600 text-sm">
                                @if ($workshop->review_count)
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
                            <button
                                onclick="window.location.href='{{ route('workshops.booking', ['id' => $workshop->id]) }}'"
                                class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-calendar-plus mr-2"></i> Booking Servis
                            </button>

                            @if ($workshop->phone)
                                <button onclick="openWhatsApp('{{ $workshop->phone }}', '{{ $workshop->name }}')"
                                    class="w-full whatsapp-btn py-3 rounded-lg font-medium hover:bg-[#128C7E] transition-all duration-300 flex items-center justify-center">
                                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                                </button>
                            @endif

                            <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                                target="_blank"
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
            <p class="text-indigo-100 mb-6 md:mb-10 text-sm md:text-base">Booking jadwal servis sekarang dan dapatkan
                penawaran spesial untuk pelanggan pertama</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <button onclick="window.location.href='{{ route('workshops.booking', ['id' => $workshop->id]) }}'"
                    class="bg-white text-primary px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 btn-glow text-sm md:text-base">
                    <i class="fas fa-calendar-alt mr-2"></i> Booking Sekarang
                </button>
                @if ($workshop->phone)
                    <button onclick="openWhatsApp('{{ $workshop->phone }}', '{{ $workshop->name }}')"
                        class="whatsapp-btn px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-[#128C7E] transition-all duration-300 text-sm md:text-base flex items-center justify-center">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </button>
                @endif
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeImageModal()">
                <i class="fas fa-times"></i>
            </span>
            <img id="modalImage" class="modal-image" src="" alt="">
        </div>
    </div>

    <script>
        // WhatsApp Function
        function openWhatsApp(phoneNumber, workshopName) {
            // Format nomor telepon (hapus karakter selain angka)
            const formattedPhone = phoneNumber.replace(/\D/g, '');

            // Pesan default yang akan dikirim
            const defaultMessage = `Halo, saya tertarik dengan layanan di ${workshopName}. Bisa info lebih lanjut?`;

            // Encode message untuk URL
            const encodedMessage = encodeURIComponent(defaultMessage);

            // Buat URL WhatsApp
            const whatsappUrl = `https://wa.me/${formattedPhone}?text=${encodedMessage}`;

            // Buka WhatsApp di tab baru
            window.open(whatsappUrl, '_blank');
        }

        // Gallery Functions
        function changeMainImage(imageUrl, element) {
            // Update main image
            document.getElementById('mainGalleryImage').src = imageUrl;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail-item').forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Image Modal Functions
        function openImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
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
@endsection
