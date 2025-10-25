<!-- Navbar -->
<header class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <div class="bg-primary p-2 rounded-lg mr-3">
                <i class="fas fa-tools text-white text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-primary">ServiCycle</h1>
        </div>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav hidden md:flex space-x-8 items-center">
            <a href="#workshops" class="nav-link text-gray-600 hover:text-primary">Bengkel</a>
            <a href="#promo" class="nav-link text-gray-600 hover:text-primary">Promo</a>
            <a href="#mitra" class="nav-link text-gray-600 hover:text-primary">Gabung Mitra</a>
        </nav>

        <div class="hidden md:flex items-center space-x-4">
            @auth
                <!-- Jika user sudah login -->
                <div class="relative inline-block text-left">
                    <button id="userMenuButton"
                        class="bg-primary text-white px-5 py-2.5 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow flex items-center gap-2">
                        <i class='bx bx-user-circle text-xl'></i>
                        {{ Auth::user()->name }}
                        <i class='bx bx-chevron-down text-lg'></i>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="userDropdownMenu"
                        class="hidden absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-100">
                        <a href="{{ url('/dashboard') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-b-lg">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Jika user belum login -->
                <a href="/login"
                    class="bg-primary text-white px-5 py-2.5 rounded-lg font-medium hover:bg-secondary transition-all duration-300 btn-glow">
                    Masuk
                </a>
            @endauth

            <!-- Tambahkan Boxicons -->
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

            <!-- Script Dropdown -->
            <script>
                document.addEventListener('click', function(e) {
                    const button = document.getElementById('userMenuButton');
                    const menu = document.getElementById('userDropdownMenu');

                    if (button && menu) {
                        if (button.contains(e.target)) {
                            menu.classList.toggle('hidden');
                        } else if (!menu.contains(e.target)) {
                            menu.classList.add('hidden');
                        }
                    }
                });
            </script>

        </div>
    </div>
</header>
