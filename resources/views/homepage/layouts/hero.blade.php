<!-- Hero Section -->
<section class="hero-bg text-white py-16 md:py-20 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full animate-float"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-white rounded-full animate-float"
            style="animation-delay: 2s;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center relative z-10">
        <div class="flex-1">
            <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 inline-flex items-center mb-6">
                <i class="fas fa-medal mr-2 text-yellow-300"></i>
                <span class="text-sm md:text-base">Platform Terbaik untuk Perawatan Kendaraan</span>
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight">
                Kelola Servis Kendaraan Jadi Lebih Mudah
            </h2>
            <p class="mt-4 text-base md:text-lg text-indigo-100 max-w-xl">
                Catat, pantau, dan atur perawatan kendaraan Anda dengan ServiCycle.
                Hemat biaya, terorganisir, dan selalu siap diingatkan servis berikutnya.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="#workshops"
                    class="bg-white text-primary px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300 flex items-center justify-center btn-glow text-sm md:text-base">
                    <i class="fas fa-map-marker-alt mr-2"></i> Cari Bengkel Terdekat
                </a>
                <a href="#features"
                    class="bg-transparent border-2 border-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-medium hover:bg-white hover:text-primary transition-all duration-300 flex items-center justify-center text-sm md:text-base">
                    <i class="fas fa-play-circle mr-2"></i> Lihat Demo
                </a>
            </div>
            <div
                class="mt-8 md:mt-10 flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-300 text-xl mr-2"></i>
                    <span class="text-sm md:text-base">Gratis untuk digunakan</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-300 text-xl mr-2"></i>
                    <span class="text-sm md:text-base">Tanpa kartu kredit</span>
                </div>
            </div>
        </div>
        <div class="flex-1 mt-10 md:mt-0 animate-float">
            <img src="{{ asset('img/ilustrasi.png') }}" alt="Ilustrasi ServiCycle"
                class="w-full rounded-xl shadow-2xl" />
        </div>
    </div>
</section>
