 <!-- Navbar -->

 <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
     id="layout-navbar">
     <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
         <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
             <i class="bx bx-menu bx-sm"></i>
         </a>
     </div>

     <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
         <!-- Search -->
         <div class="navbar-nav align-items-center">
             <div class="nav-item d-flex align-items-center">
                 <i class="bx bx-search fs-4 lh-0"></i>
                 <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                     aria-label="Search..." />
             </div>
         </div>
         <!-- /Search -->

         <ul class="navbar-nav flex-row align-items-center ms-auto">
             <!-- Notifikasi Bell Dropdown -->
             {{-- <li class="nav-item dropdown lh-1 me-3">
                 <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button"
                     data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="bx bx-bell fs-4"></i>
                     <!-- Badge jumlah notifikasi -->
                     <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                         3
                     </span>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown"
                     style="min-width: 300px;">
                     <li class="dropdown-header fw-semibold text-center">Notifikasi</li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-start" href="#">
                             <i class="bx bx-wrench me-2 text-primary fs-5"></i>
                             <div>
                                 <div class="fw-semibold">Servis kendaraan selesai</div>
                                 <small class="text-muted">2 jam lalu</small>
                             </div>
                         </a>
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-start" href="#">
                             <i class="bx bx-user-plus me-2 text-success fs-5"></i>
                             <div>
                                 <div class="fw-semibold">Pengguna baru terdaftar</div>
                                 <small class="text-muted">5 jam lalu</small>
                             </div>
                         </a>
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-start" href="#">
                             <i class="bx bx-error me-2 text-warning fs-5"></i>
                             <div>
                                 <div class="fw-semibold">Perlu perawatan mesin</div>
                                 <small class="text-muted">1 hari lalu</small>
                             </div>
                         </a>
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     <li class="text-center">
                         <a class="dropdown-item text-primary fw-semibold" href="#">Lihat semua notifikasi</a>
                     </li>
                 </ul>
             </li> --}}


             <!-- User -->
             <li class="nav-item navbar-dropdown dropdown-user dropdown">
                 <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                     <div class="avatar avatar-online">
                         <div class="avatar avatar-online d-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-bold"
                             style="width: 40px; height: 40px; font-size: 16px;">
                             {{ collect(explode(' ', Auth::user()->name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->join('') }}
                         </div>
                     </div>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end">
                     <li>
                         <a class="dropdown-item" href="#">
                             <div class="d-flex">
                                 <div class="flex-shrink-0 me-3">
                                     <div class="avatar avatar-online d-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-bold"
                                         style="width: 40px; height: 40px; font-size: 16px;">
                                         {{ collect(explode(' ', Auth::user()->name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->join('') }}
                                     </div>
                                 </div>
                                 <div class="flex-grow-1">
                                     <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                     <small class="text-muted">
                                         @if (Auth::user()->role === 'admin')
                                             Admin
                                         @elseif(Auth::user()->role === 'vehicle_owner')
                                             Pemilik Kendaraan
                                         @elseif(Auth::user()->role === 'workshop')
                                             Bengkel
                                         @else
                                             User
                                         @endif
                                     </small>

                                 </div>
                             </div>

                         </a>
                     </li>
                     <li>
                         <div class="dropdown-divider"></div>
                     </li>
                     <li>
                         <a class="dropdown-item" href="{{ route('profile.edit') }}">
                             <i class="bx bx-user me-2"></i>
                             <span class="align-middle">Profil</span>
                         </a>
                     </li>
                     <li>
                         <a class="dropdown-item" href="/">
                             <i class="bx bx-home me-2"></i>
                             <span class="align-middle">Homepage</span>
                         </a>
                     </li>
                     <li>
                         <div class="dropdown-divider"></div>
                     </li>
                     <li>
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf
                             <button type="submit" class="dropdown-item"
                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                 <i class="bx bx-power-off me-2"></i>
                                 Keluar
                             </button>
                         </form>
                     </li>
                 </ul>
             </li>
             <!--/ User -->
         </ul>
     </div>
 </nav>

 <!-- / Navbar -->
