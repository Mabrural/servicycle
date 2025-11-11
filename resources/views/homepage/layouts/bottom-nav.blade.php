<!-- Bottom Navigation for Mobile -->
<div class="bottom-nav" id="bottomNav">
    <a href="#workshops" class="bottom-nav-item active" data-section="workshops">
        <i class="fas fa-map-marker-alt"></i>
        <span>Bengkel</span>
    </a>
    {{-- <a href="#promo" class="bottom-nav-item" data-section="promo">
        <i class="fas fa-tags"></i>
        <span>Promo</span>
    </a> --}}
    <a href="#mitra" class="bottom-nav-item" data-section="mitra">
        <i class="fas fa-handshake"></i>
        <span>Mitra</span>
    </a>
    @auth
        <div class="bottom-nav-item relative" id="userDropdownWrapper" style="z-index: 50;">
            <!-- Tombol yang menampilkan nama singkat -->
            <button id="userMenuMobile" type="button"
                class="flex flex-col items-center text-center text-gray-700 focus:outline-none" aria-haspopup="true"
                aria-expanded="false" aria-controls="dropdownMobileMenu">
                <i class="fas fa-user-circle text-xl"></i>
                <span>{{ \Illuminate\Support\Str::limit(Auth::user()->name, 8) }}</span>
            </button>

            <!-- Dropdown untuk mobile -->
            <div id="dropdownMobileMenu"
                class="hidden absolute bottom-14 left-1/2 transform -translate-x-1/2 bg-white shadow-lg rounded-lg w-44 border border-gray-100"
                role="menu" aria-labelledby="userMenuMobile">
                <a href="{{ url('/dashboard') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg text-sm" role="menuitem">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-b-lg text-sm"
                        role="menuitem">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    @else
        <a href="/login" class="bottom-nav-item" data-section="login">
            <i class="fas fa-user"></i>
            <span>Akun</span>
        </a>
    @endauth


    <!-- Script dropdown (perbaikan) -->
    <script>
        (function() {
            const btn = document.getElementById('userMenuMobile');
            const menu = document.getElementById('dropdownMobileMenu');

            if (!btn || !menu) return;

            // Toggle dropdown saat tombol diklik — stopPropagation supaya event tidak 'bocor' ke document
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = menu.classList.contains('hidden');
                // Set aria-expanded untuk aksesibilitas
                btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                menu.classList.toggle('hidden');
            });

            // Stop propagation ketika klik di dalam menu agar document listener tidak langsung menutupnya
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
                // jika kamu mau menutup dropdown setelah klik link (mis. untuk SPA), uncomment:
                // menu.classList.add('hidden');
                // btn.setAttribute('aria-expanded', 'false');
            });

            // Klik di luar tombol/menu akan menutup dropdown
            document.addEventListener('click', function() {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });

            // Tutup dropdown saat menekan Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                    btn.focus();
                }
            });

            // Optional: dukungan touch (beberapa browser mobile memicu pointerdown lebih cepat)
            btn.addEventListener('touchstart', function(e) {
                e.stopPropagation();
            }, {
                passive: true
            });
            menu.addEventListener('touchstart', function(e) {
                e.stopPropagation();
            }, {
                passive: true
            });
        })();
    </script>


</div>
