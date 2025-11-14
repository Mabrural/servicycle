<!DOCTYPE html>
<html lang="id">

@include('homepage.layouts.head')

<body class="bg-gray-50 text-gray-800">





    @yield('container')



    @include('homepage.layouts.footer')

    <script>
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

        // Location permission and workshops functionality
        const locationPermissionModal = document.getElementById('locationPermissionModal');
        const allowLocationBtn = document.getElementById('allowLocation');
        const denyLocationBtn = document.getElementById('denyLocation');
        const locationStatus = document.getElementById('locationStatus');
        const workshopList = document.getElementById('workshopList');

        // Show location permission modal when page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                locationPermissionModal.classList.add('active');
            }, 1000);
        });

        // Handle location permission
        allowLocationBtn.addEventListener('click', function() {
            locationPermissionModal.classList.remove('active');
            getLocation();
        });

        denyLocationBtn.addEventListener('click', function() {
            locationPermissionModal.classList.remove('active');
            locationStatus.innerHTML =
                '<p class="text-yellow-700 text-center">Akses lokasi ditolak. Anda masih dapat melihat daftar bengkel tanpa filter lokasi.</p>';
            // Calculate distances without location
            calculateDistances();
        });

        // Get user location
        function getLocation() {
            if (navigator.geolocation) {
                locationStatus.innerHTML = '<p class="text-blue-700 text-center">Mendapatkan lokasi Anda...</p>';

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        locationStatus.innerHTML =
                            '<p class="text-green-700 text-center">Lokasi berhasil didapatkan </p>';

                        // Calculate distances with user location
                        calculateDistances(userLat, userLng);
                    },
                    function(error) {
                        console.error("Error getting location:", error);
                        locationStatus.innerHTML =
                            '<p class="text-red-700 text-center">Gagal mendapatkan lokasi </p>';
                        // Calculate distances without location
                        calculateDistances();
                    }
                );
            } else {
                locationStatus.innerHTML =
                    '<p class="text-red-700 text-center">Browser Anda tidak mendukung geolokasi.</p>';
                // Calculate distances without location
                calculateDistances();
            }
        }

        // Hitung jarak menggunakan formula haversine (from first example)
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam KM
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) *
                Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // hasil km
        }

        // Calculate distances and sort workshops
        function calculateDistances(userLat = null, userLng = null) {
            const cards = Array.from(document.querySelectorAll('.card'));

            // Calculate distance for each workshop
            cards.forEach(card => {
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);

                if (userLat && userLng && lat && lng) {
                    const distance = calculateDistance(userLat, userLng, lat, lng);
                    card.querySelector('.distance').innerHTML =
                        `<i class="fa-solid fa-route text-green-500"></i> ${distance.toFixed(2)} km`;
                    card.dataset.distance = distance;
                } else {
                    card.querySelector('.distance').innerHTML =
                        `<i class="fa-solid fa-route text-gray-400"></i> Jarak: tidak tersedia`;
                    card.dataset.distance = 99999; // Large number for sorting
                }

            });

            // Sort by distance (nearest first) if location is available
            if (userLat && userLng) {
                const sorted = cards.sort((a, b) => a.dataset.distance - b.dataset.distance);

                // Re-append sorted cards
                workshopList.innerHTML = '';
                sorted.forEach(c => workshopList.appendChild(c));
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Coba dapatkan lokasi pengguna
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        console.log("Lokasi pengguna:", userLat, userLng);

                        // Setelah lokasi didapatkan, cek apakah ada bengkel
                        const workshopList = document.getElementById('workshopList');
                        const workshops = workshopList.querySelectorAll('.card');
                        const noWorkshopsMessage = document.getElementById('noWorkshopsMessage');

                        if (workshops.length === 0) {
                            noWorkshopsMessage.classList.remove('hidden');
                        } else {
                            noWorkshopsMessage.classList.add('hidden');
                        }

                        // Tambahkan logika perhitungan jarak di sini jika perlu
                    },
                    function(error) {
                        console.warn("Gagal mendapatkan lokasi:", error.message);
                        document.getElementById('noWorkshopsMessage').classList.remove('hidden');
                        document.getElementById('noWorkshopsMessage').querySelector('p').textContent =
                            "Tidak dapat menentukan lokasi Anda.";
                    }
                );
            } else {
                console.warn("Browser tidak mendukung geolocation.");
                document.getElementById('noWorkshopsMessage').classList.remove('hidden');
                document.getElementById('noWorkshopsMessage').querySelector('p').textContent =
                    "Browser Anda tidak mendukung deteksi lokasi.";
            }
        });

        // pencarian bengkel berdasarkan nama dan kota
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('workshopSearch');
            const searchClear = document.getElementById('searchClear');
            const workshopCards = document.querySelectorAll('.card');
            const noWorkshopsMessage = document.getElementById('noWorkshopsMessage');
            const workshopList = document.getElementById('workshopList');

            function filterWorkshops(term) {
                term = term.toLowerCase().trim();
                let found = false;

                workshopCards.forEach(card => {
                    const name = card.querySelector('.name').innerText.toLowerCase();
                    const city = card.querySelector('.city').innerText.toLowerCase();

                    if (term === "" || name.includes(term) || city.includes(term)) {
                        card.style.display = "block";
                        found = true;
                    } else {
                        card.style.display = "none";
                    }
                });

                if (!found) {
                    noWorkshopsMessage.classList.remove("hidden");
                    workshopList.classList.add("hidden");
                } else {
                    noWorkshopsMessage.classList.add("hidden");
                    workshopList.classList.remove("hidden");
                }
            }

            searchInput.addEventListener("input", () => {
                const value = searchInput.value;

                if (value.length > 0) {
                    searchClear.classList.remove("hidden");
                } else {
                    searchClear.classList.add("hidden");
                }

                filterWorkshops(value);
            });

            searchClear.addEventListener("click", () => {
                searchInput.value = "";
                searchClear.classList.add("hidden");
                filterWorkshops("");
            });
        });
    </script>

</body>

</html>
