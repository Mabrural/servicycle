 <!-- Bengkel Section -->
 <section id="workshops" class="py-16 md:py-20 bg-white">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         <div class="text-center max-w-2xl mx-auto">
             <h3 class="text-2xl md:text-3xl font-bold mb-4">Cari Bengkel Terdekat</h3>
             <p class="text-gray-600 text-sm md:text-base">Temukan bengkel terpercaya di dekat lokasi Anda</p>
         </div>

         <!-- Location Status -->
         <div id="locationStatus" class="mt-6 md:mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
             <p class="text-blue-700 text-center">Mengambil lokasi Anda...</p>
         </div>

         <!-- Workshops List -->
         <div class="workshop-list mt-6 md:mt-8" id="workshopList">
             @forelse ($workshops as $workshop)
                 <div class="card" data-lat="{{ $workshop->latitude }}" data-lng="{{ $workshop->longitude }}"
                     data-id="{{ $workshop->id }}">

                     <!-- Gambar Bengkel -->
                     <img src="{{ $workshop->primaryImage->image_url ?? asset('img/default-workshop.jpg') }}"
                         alt="Gambar Bengkel"
                         class="w-full h-44 object-cover object-center rounded-xl mb-2 bg-gray-100" />

                     <!-- Info Bengkel -->
                     <div class="name font-semibold text-lg text-gray-800">{{ $workshop->name }}</div>
                     <div class="city text-sm text-gray-600">
                         <i class="fa-solid fa-location-dot text-red-500"></i> {{ $workshop->city ?? '-' }}
                     </div>
                     <div class="distance text-sm text-gray-500">Jarak: menghitung...</div>

                     <!-- Tombol Aksi -->
                     <div class="mt-4 flex items-center justify-between">
                         <a href="https://www.google.com/maps?q={{ $workshop->latitude }},{{ $workshop->longitude }}"
                             target="_blank"
                             class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                             <i class="fa-solid fa-map-location-dot"></i> Lihat di Google Maps
                         </a>

                         <a href="{{ route('workshops.show', $workshop->id) }}"
                             class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                             <i class="fa-solid fa-info-circle"></i> Detail
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

     </div>
 </section>
