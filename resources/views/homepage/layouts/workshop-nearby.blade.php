<!-- Bengkel Section -->
<section id="workshops" class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">Cari Bengkel Terdekat</h3>
            <p class="text-gray-600 text-sm md:text-base">Temukan bengkel terpercaya di dekat lokasi Anda</p>
        </div>

        <!-- Search Bar -->
        <div class="mt-6 md:mt-8 max-w-md mx-auto">
            <div class="relative">
                <input type="text" id="workshopSearch" placeholder="Cari nama bengkel atau lokasi..."
                    class="w-full px-4 py-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <div id="searchClear" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hidden">
                    <i class="fas fa-times text-gray-400 hover:text-gray-600"></i>
                </div>
            </div>
        </div>

        <!-- Location Status -->
        <div id="locationStatus" class="mt-6 md:mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-blue-700 text-center">Mengambil lokasi Anda...</p>
        </div>

        <!-- Workshops List -->
        <div class="workshop-list mt-6 md:mt-8" id="workshopList">
            <div class="flex overflow-x-auto pb-4 gap-4 scrollbar-hide scroll-smooth px-4 md:px-0" id="workshopContainer">
                @forelse ($workshops as $workshop)
                    <div class="card flex-shrink-0 w-[280px] md:w-80 bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 mx-auto md:mx-0"
                        data-lat="{{ $workshop->latitude }}" data-lng="{{ $workshop->longitude }}"
                        data-id="{{ $workshop->id }}" data-name="{{ strtolower($workshop->name) }}"
                        data-city="{{ strtolower($workshop->city ?? '') }}">

                        <!-- Gambar Bengkel -->
                        <img src="{{ $workshop->primaryImage->image_url ?? asset('img/default-workshop.jpg') }}"
                            alt="Gambar Bengkel"
                            class="w-full h-44 object-cover object-center rounded-t-xl bg-gray-100" />

                        <!-- Info Bengkel -->
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="name font-bold text-lg text-gray-800 pr-2">{{ $workshop->name }}</h4>
                            </div>

                            <!-- Badge Terverifikasi -->
                            <div class="flex items-center gap-1 text-blue-500 text-sm font-medium mb-2">
                                <i class="fas fa-check-circle"></i>
                                <span>Terverifikasi</span>
                            </div>

                            <div class="space-y-2 mb-3">
                                <div class="city text-sm text-gray-600 flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-red-500 text-xs"></i>
                                    <span>{{ $workshop->city ?? '-' }}</span>
                                </div>
                                <div class="distance text-sm text-gray-500 flex items-center gap-2">
                                    <i class="fa-solid fa-route text-blue-500 text-xs"></i>
                                    <span>Jarak: menghitung...</span>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-map-location-dot"></i> Maps
                                </a>

                                <a href="{{ route('workshops.show', $workshop->id) }}"
                                    class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                                    <i class="fa-solid fa-info-circle"></i> Detail & Booking
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Tidak menampilkan apa pun di awal, pesan akan dimunculkan lewat JS --}}
                @endforelse
            </div>
        </div>

        <!-- Pesan jika tidak ada bengkel -->
        <div id="noWorkshopsMessage"
            class="hidden flex flex-col items-center justify-center text-center py-20 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <i class="fa-solid fa-wrench text-gray-400 text-5xl mb-3"></i>
            <p class="text-gray-600 text-lg font-medium">Belum ada bengkel yang terdaftar di sekitar lokasi Anda.</p>
        </div>

        <!-- Pesan pencarian tidak ditemukan -->
        <div id="noSearchResults"
            class="hidden flex flex-col items-center justify-center text-center py-20 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <i class="fa-solid fa-search text-gray-400 text-5xl mb-3"></i>
            <p class="text-gray-600 text-lg font-medium">Tidak ada bengkel yang sesuai dengan pencarian Anda.</p>
        </div>

    </div>
</section>

<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .card {
        scroll-snap-align: center;
    }

    /* Untuk mobile - pastikan card pertama tidak terlalu ke kiri */
    @media (max-width: 768px) {
        #workshopContainer {
            padding-left: calc(50vw - 140px);
            padding-right: 16px;
        }
        
        #workshopContainer::after {
            content: '';
            flex: 0 0 16px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('workshopSearch');
        const searchClear = document.getElementById('searchClear');
        const workshopContainer = document.getElementById('workshopContainer');
        const cards = document.querySelectorAll('.card');
        const noWorkshopsMessage = document.getElementById('noWorkshopsMessage');
        const noSearchResults = document.getElementById('noSearchResults');

        let searchTimeout;
        const DEBOUNCE_DELAY = 300; // ms

        // Fungsi untuk filter bengkel
        function filterWorkshops(searchTerm) {
            const term = searchTerm.toLowerCase().trim();
            let hasVisibleCards = false;

            cards.forEach(card => {
                const name = card.dataset.name;
                const city = card.dataset.city;

                if (term === '' || name.includes(term) || city.includes(term)) {
                    card.style.display = 'block';
                    hasVisibleCards = true;
                } else {
                    card.style.display = 'none';
                }
            });

            // Tampilkan pesan yang sesuai
            if (term === '') {
                noSearchResults.classList.add('hidden');
                if (cards.length === 0) {
                    noWorkshopsMessage.classList.remove('hidden');
                    workshopContainer.classList.add('hidden');
                } else {
                    noWorkshopsMessage.classList.add('hidden');
                    workshopContainer.classList.remove('hidden');
                }
            } else {
                noWorkshopsMessage.classList.add('hidden');
                if (hasVisibleCards) {
                    noSearchResults.classList.add('hidden');
                    workshopContainer.classList.remove('hidden');
                } else {
                    noSearchResults.classList.remove('hidden');
                    workshopContainer.classList.add('hidden');
                }
            }

            // Scroll ke kiri setelah filter
            if (workshopContainer.classList.contains('hidden') === false) {
                workshopContainer.scrollLeft = 0;
            }
        }

        // Event listener untuk input search
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value;

            // Tampilkan/hilangkan tombol clear
            if (searchTerm.length > 0) {
                searchClear.classList.remove('hidden');
            } else {
                searchClear.classList.add('hidden');
            }

            // Debounce untuk performa
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterWorkshops(searchTerm);
            }, DEBOUNCE_DELAY);
        });

        // Event listener untuk clear search
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            searchClear.classList.add('hidden');
            filterWorkshops('');
            searchInput.focus();
        });

        // Event listener untuk Enter key (prevent form submission)
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        // Optimasi performa dengan Intersection Observer untuk lazy loading
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, {
            threshold: 0.1
        });

        // Terapkan observer ke semua card
        cards.forEach(card => {
            card.style.opacity = '0.8';
            card.style.transition = 'opacity 0.3s ease';
            observer.observe(card);
        });

        // Inisialisasi tampilan awal
        filterWorkshops('');

        // Handle resize untuk mobile centering
        function handleResize() {
            if (window.innerWidth < 768) {
                workshopContainer.scrollLeft = 0;
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Panggil sekali saat load
    });
</script>