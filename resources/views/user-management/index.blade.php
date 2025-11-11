@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Manajemen /</span> Pengguna
            </h4>
            <a href="{{ route('user-management.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Tambah Pengguna
            </a>
        </div>

        {{-- Statistik Cards --}}
        <div class="row mb-4">
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text mb-0">Total</p>
                                <h4 class="card-title mb-0">{{ $userStats['total'] }}</h4>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded p-2">
                                    <i class="bx bx-user bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text mb-0">Admin</p>
                                <h4 class="card-title mb-0">{{ $userStats['admin'] }}</h4>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-danger rounded p-2">
                                    <i class="bx bx-shield-alt bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text mb-0">Bengkel</p>
                                <h4 class="card-title mb-0">{{ $userStats['workshop'] }}</h4>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-warning rounded p-2">
                                    <i class="bx bx-wrench bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text mb-0">Pemilik</p>
                                <h4 class="card-title mb-0">{{ $userStats['vehicle_owner'] }}</h4>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-info rounded p-2">
                                    <i class="bx bx-car bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text mb-0">Aktif</p>
                                <h4 class="card-title mb-0">{{ $userStats['active'] }}</h4>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-success rounded p-2">
                                    <i class="bx bx-check-circle bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text mb-0">Nonaktif</p>
                                <h4 class="card-title mb-0">{{ $userStats['inactive'] }}</h4>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-secondary rounded p-2">
                                    <i class="bx bx-x-circle bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Search Section --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('user-management.index') }}" id="filterForm">
                    <div class="row g-3">
                        {{-- Search --}}
                        <div class="col-xl-4 col-lg-6">
                            <label class="form-label small fw-semibold">Cari Pengguna</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" name="search"
                                    placeholder="Cari nama atau email..." value="{{ request('search') }}">
                            </div>
                        </div>

                        {{-- Role Filter --}}
                        <div class="col-xl-2 col-lg-3 col-md-4">
                            <label class="form-label small fw-semibold">Hak Akses</label>
                            <select class="form-select" name="role"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="all" {{ request('role') == 'all' || !request('role') ? 'selected' : '' }}>
                                    Semua Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="vehicle_owner" {{ request('role') == 'vehicle_owner' ? 'selected' : '' }}>
                                    Pemilik Kendaraan</option>
                                <option value="workshop" {{ request('role') == 'workshop' ? 'selected' : '' }}>Bengkel
                                </option>
                            </select>
                        </div>

                        {{-- Status Filter --}}
                        <div class="col-xl-2 col-lg-3 col-md-4">
                            <label class="form-label small fw-semibold">Status</label>
                            <select class="form-select" name="status"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="all"
                                    {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Semua Status
                                </option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </select>
                        </div>

                        {{-- Sort --}}
                        <div class="col-xl-2 col-lg-3 col-md-4">
                            <label class="form-label small fw-semibold">Urutkan</label>
                            <select class="form-select" name="sort"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama
                                </option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z
                                </option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A
                                </option>
                            </select>
                        </div>

                        {{-- Actions --}}
                        <div class="col-xl-2 col-lg-3 col-md-4 d-flex align-items-end">
                            <div class="d-flex gap-2 w-100">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="bx bx-filter-alt me-1"></i> Terapkan
                                </button>
                                <a href="{{ route('user-management.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-reset me-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results Info --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="text-muted small">
                Menampilkan <strong>{{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $users->total() }}</strong> pengguna
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">Tampilkan:</span>
                <select class="form-select form-select-sm w-auto" onchange="updatePerPage(this.value)">
                    <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
        </div>

        {{-- Users Table --}}
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Pengguna</th>
                            <th>Kontak</th>
                            <th>Hak Akses</th>
                            <th>Status</th>
                            <th>Terdaftar</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($users as $index => $user)
                            <tr>
                                <td><strong>{{ $users->firstItem() + $index }}</strong></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                            {{-- <small class="text-muted">ID: {{ $user->id }}</small> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-nowrap">{{ $user->email }}</div>
                                    @if ($user->google_id)
                                        <small class="text-success">
                                            <i class="bx bxl-google"></i> Google Account
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @switch($user->role)
                                        @case('admin')
                                            <span class="badge bg-danger me-1">
                                                <i class="bx bx-shield-alt me-1"></i>Admin
                                            </span>
                                        @break

                                        @case('vehicle_owner')
                                            <span class="badge bg-info me-1">
                                                <i class="bx bx-car me-1"></i>Pemilik Kendaraan
                                            </span>
                                        @break

                                        @case('workshop')
                                            <span class="badge bg-warning me-1">
                                                <i class="bx bx-wrench me-1"></i>Bengkel
                                            </span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary me-1">User</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge bg-success">
                                            <i class="bx bx-check-circle me-1"></i>Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bx bx-x-circle me-1"></i>Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-nowrap">
                                        <div>{{ $user->created_at->format('d M Y') }}</div>
                                        <small class="text-muted">{{ $user->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm btn-icon btn-light"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('user-management.edit', $user->id) }}">
                                                    <i class="bx bx-edit-alt me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('user-management.toggleRole', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mengubah hak akses {{ $user->name }}?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bx bx-shield-quarter me-2"></i>
                                                        {{ $user->role === 'admin' ? 'Cabut Admin' : 'Jadikan Admin' }}
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('user-management.toggleStatus', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mengubah status {{ $user->name }}?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i
                                                            class="bx {{ $user->is_active ? 'bx-user-x' : 'bx-user-check' }} me-2"></i>
                                                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('user-management.destroy', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus {{ $user->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bx bx-trash me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bx bx-user-x bx-lg mb-3"></i>
                                            <p class="mb-0">Tidak ada data pengguna yang ditemukan.</p>
                                            <small class="mt-0">Coba ubah filter atau kata kunci pencarian</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($users->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        Menampilkan <strong>{{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}</strong>
                        dari <strong>{{ $users->total() }}</strong> hasil
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mb-0">
                            {{-- Previous Page Link --}}
                            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                    <i class="bx bx-chevron-left"></i>
                                </a>
                            </li>

                            {{-- Pagination Elements --}}
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                @if ($page == $users->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                    <i class="bx bx-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>

        <script>
            function updatePerPage(perPage) {
                const url = new URL(window.location.href);
                url.searchParams.set('per_page', perPage);
                window.location.href = url.toString();
            }

            // Auto submit form when Enter is pressed in search field
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.querySelector('input[name="search"]');
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        document.getElementById('filterForm').submit();
                    }
                });
            });
        </script>

        <style>
            .avatar img {
                object-fit: cover;
            }

            .card {
                transition: transform 0.2s ease-in-out;
            }

            .card:hover {
                transform: translateY(-2px);
            }

            .table th {
                border-top: none;
                font-weight: 600;
                font-size: 0.875rem;
            }
        </style>
    @endsection
