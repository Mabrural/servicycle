<!-- Bengkel Section -->
<section id="workshops" class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">Cari Bengkel Terdekat</h3>
            <p class="text-gray-600 text-sm md:text-base">Temukan bengkel terpercaya di dekat lokasi Anda</p>
        </div>

        <!-- Tabs untuk Motor dan Mobil -->
        <div class="mt-8 flex justify-start">
            <div class="bg-gray-100 rounded-lg p-1 inline-flex">
                <button id="motorTab"
                    class="tab-button px-6 py-3 rounded-md font-medium text-sm md:text-base transition-all duration-300 bg-blue-600 text-white shadow-sm">
                    <i class="fas fa-motorcycle mr-2"></i>Bengkel Motor
                </button>
                <button id="mobilTab"
                    class="tab-button px-6 py-3 rounded-md font-medium text-sm md:text-base transition-all duration-300 text-gray-600 hover:text-gray-800">
                    <i class="fas fa-car mr-2"></i>Bengkel Mobil
                </button>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mt-6 max-w-md mx-auto">
            <div class="relative">
                <input type="text" id="workshopSearch" placeholder="Cari nama bengkel atau kota..."
                    class="w-full px-4 py-3 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <div id="searchClear" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hidden">
                    <i class="fas fa-times text-gray-400 hover:text-gray-600"></i>
                </div>
            </div>
        </div>

        <!-- Location Status -->
        <div id="locationStatus" class="mt-6 mb-6 md:mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-blue-700 text-center">Mengambil lokasi Anda...</p>
        </div>

        <!-- Workshops List -->
        <div class="workshop-list mt-6 md:mt-8" id="workshopList">
            @forelse ($workshops as $workshop)
                <div class="card" data-lat="{{ $workshop->latitude }}" data-lng="{{ $workshop->longitude }}"
                    data-id="{{ $workshop->id }}" data-type="{{ $workshop->type ?? 'motor' }}"
                    data-name="{{ strtolower($workshop->name) }}" data-city="{{ strtolower($workshop->city ?? '') }}">

                    <!-- Gambar Bengkel -->
                    <img src="{{ $workshop->primaryImage->image_url ?? asset('img/default-workshop.jpg') }}"
                        alt="Gambar Bengkel"
                        class="w-full h-44 object-cover object-center rounded-xl mb-2 bg-gray-100" />

                    <!-- Info Bengkel -->
                    <div class="name font-semibold text-lg text-gray-800">{{ $workshop->name }}
                        <!-- Badge Terverifikasi -->
                        <div class="flex items-center gap-1 text-blue-500 text-sm font-medium">
                            <i class="fas fa-check-circle"></i>
                            <span>Terverifikasi</span>
                        </div>
                    </div>
                    <br>
                    <div class="city text-sm text-gray-600">
                        <i class="fa-solid fa-location-dot text-red-500"></i> {{ $workshop->city ?? '-' }}
                    </div>
                    <div class="distance text-sm text-gray-500">Jarak: menghitung...</div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4 flex items-center justify-between">
                        <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                            <i class="fa-solid fa-map-location-dot"></i>Maps
                        </a>

                        <a href="{{ route('workshops.show', $workshop->id) }}"
                            class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                            <i class="fa-solid fa-info-circle"></i> Detail & Booking
                        </a>
                    </div>
                </div>
            @empty
                {{-- Tidak menampilkan apa pun di awal, pesan akan dimunculkan lewat JS --}}
            @endforelse
        </div>

        <!-- Pesan jika tidak ada bengkel -->
        <div id="noWorkshopsMessage"
            class="hidden flex flex-col items-center justify-center text-center py-20 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <i class="fa-solid fa-wrench text-gray-400 text-5xl mb-3"></i>
            <p class="text-gray-600 text-lg font-medium">Belum ada bengkel yang terdaftar di sekitar lokasi Anda.
            </p>
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
    /* Style untuk grid layout bengkel */
    .workshop-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Style untuk tab yang aktif */
    .tab-button.active {
        background-color: #2563eb;
        color: white;
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
    }

    .tab-button:not(.active) {
        background-color: transparent;
        color: #6b7280;
    }

    .tab-button:not(.active):hover {
        color: #374151;
        background-color: rgba(255, 255, 255, 0.5);
    }

    /* Pastikan teks tetap putih saat tab aktif */
    .tab-button.active,
    .tab-button.active:hover {
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const motorTab = document.getElementById('motorTab');
        const mobilTab = document.getElementById('mobilTab');
        const searchInput = document.getElementById('workshopSearch');
        const searchClear = document.getElementById('searchClear');
        const workshopList = document.getElementById('workshopList');
        const noWorkshopsMessage = document.getElementById('noWorkshopsMessage');
        const noSearchResults = document.getElementById('noSearchResults');
        const cards = document.querySelectorAll('.card');
        const locationStatus = document.getElementById('locationStatus');

        let currentType = 'motor'; // Default type
        let userLocation = null;
        let currentSearchTerm = '';

        /* ==========================
           FUNGSI UNTUK MENGUBAH TAB
           ========================== */
        function switchTab(type) {
            currentType = type;

            // Update tampilan tab
            if (type === 'motor') {
                motorTab.classList.add('active', 'bg-blue-600', 'text-white');
                motorTab.classList.remove('text-gray-600', 'hover:text-gray-800');
                mobilTab.classList.remove('active', 'bg-blue-600', 'text-white');
                mobilTab.classList.add('text-gray-600', 'hover:text-gray-800');
            } else {
                mobilTab.classList.add('active', 'bg-blue-600', 'text-white');
                mobilTab.classList.remove('text-gray-600', 'hover:text-gray-800');
                motorTab.classList.remove('active', 'bg-blue-600', 'text-white');
                motorTab.classList.add('text-gray-600', 'hover:text-gray-800');
            }

            // Filter bengkel berdasarkan type dan pencarian
            filterWorkshops();
        }

        /* ==========================
           FUNGSI UNTUK FILTER BENGKEL
           ========================== */
        function filterWorkshops() {
            let visibleCount = 0;

            cards.forEach(card => {
                const type = card.dataset.type;
                const name = card.dataset.name;
                const city = card.dataset.city;

                // Filter berdasarkan type (HANYA type yang sesuai dengan tab aktif)
                const typeMatch = type === currentType;

                // Filter berdasarkan pencarian
                const searchMatch = currentSearchTerm === '' ||
                    name.includes(currentSearchTerm) ||
                    city.includes(currentSearchTerm);

                // Tampilkan jika sesuai dengan filter type dan pencarian
                if (typeMatch && searchMatch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Tampilkan pesan yang sesuai
            updateVisibilityMessages(visibleCount);
        }

        /* ==========================
           FUNGSI UNTUK UPDATE PESAN VISIBILITAS
           ========================== */
        function updateVisibilityMessages(visibleCount) {
            if (currentSearchTerm === '') {
                // Mode normal - filter berdasarkan type saja
                noSearchResults.classList.add('hidden');
                if (visibleCount === 0) {
                    noWorkshopsMessage.classList.remove('hidden');
                    workshopList.classList.add('hidden');
                } else {
                    noWorkshopsMessage.classList.add('hidden');
                    workshopList.classList.remove('hidden');
                }
            } else {
                // Mode pencarian - filter berdasarkan type dan pencarian
                noWorkshopsMessage.classList.add('hidden');
                if (visibleCount === 0) {
                    noSearchResults.classList.remove('hidden');
                    workshopList.classList.add('hidden');
                } else {
                    noSearchResults.classList.add('hidden');
                    workshopList.classList.remove('hidden');
                }
            }
        }

        /* ==========================
           EVENT LISTENERS UNTUK TAB
           ========================== */
        motorTab.addEventListener('click', function() {
            switchTab('motor');
        });

        mobilTab.addEventListener('click', function() {
            switchTab('mobil');
        });

        /* ==========================
           EVENT LISTENERS UNTUK PENCARIAN
           ========================== */
        searchInput.addEventListener('input', function() {
            currentSearchTerm = this.value.toLowerCase().trim();

            // Tampilkan/sembunyikan tombol clear
            if (currentSearchTerm.length > 0) {
                searchClear.classList.remove('hidden');
            } else {
                searchClear.classList.add('hidden');
            }

            filterWorkshops();
        });

        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            currentSearchTerm = '';
            searchClear.classList.add('hidden');
            filterWorkshops();
            searchInput.focus();
        });

        // Support untuk tekan Escape untuk clear pencarian
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchInput.value = '';
                currentSearchTerm = '';
                searchClear.classList.add('hidden');
                filterWorkshops();
            }
        });



        /* ==========================
           INISIALISASI APLIKASI
           ========================== */
        // Set tab default ke motor
        switchTab('motor');

        // Inisialisasi lokasi dan perhitungan jarak
        initializeLocationAndDistances();

        // Inisialisasi tampilan awal
        if (cards.length === 0) {
            noWorkshopsMessage.classList.remove('hidden');
            workshopList.classList.add('hidden');
        } else {
            noWorkshopsMessage.classList.add('hidden');
            workshopList.classList.remove('hidden');
        }
    });
</script>
