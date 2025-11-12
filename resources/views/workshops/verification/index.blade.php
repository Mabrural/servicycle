@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Manajemen /</span> Verifikasi Bengkel
            </h4>
            <button class="btn btn-outline-primary btn-sm rounded-pill shadow-sm" onclick="location.reload();">
                <i class="bx bx-refresh me-1"></i> Refresh
            </button>
        </div>

        {{-- Statistik Cards --}}
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <p class="card-text mb-0">Total Bengkel</p>
                            <h4 class="card-title mb-0">{{ $stats['total'] ?? 0 }}</h4>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-store-alt bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <p class="card-text mb-0">Menunggu Verifikasi</p>
                            <h4 class="card-title mb-0">{{ $stats['pending'] ?? 0 }}</h4>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="bx bx-time-five bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <p class="card-text mb-0">Disetujui</p>
                            <h4 class="card-title mb-0">{{ $stats['approved'] ?? 0 }}</h4>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class="bx bx-check-circle bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <p class="card-text mb-0">Ditolak</p>
                            <h4 class="card-title mb-0">{{ $stats['rejected'] ?? 0 }}</h4>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                            <i class="bx bx-x-circle bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('workshop-verification.index') }}" id="filterForm">
                    <div class="row g-3">
                        <div class="col-xl-4 col-lg-6">
                            <label class="form-label small fw-semibold">Cari Bengkel</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" name="search"
                                    placeholder="Cari nama bengkel atau pemilik..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <label class="form-label small fw-semibold">Status</label>
                            <select class="form-select" name="status"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui
                                </option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <label class="form-label small fw-semibold">Urutkan</label>
                            <select class="form-select" name="sort"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z
                                </option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A
                                </option>
                            </select>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 d-flex align-items-end">
                            <div class="d-flex gap-2 w-100">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="bx bx-filter-alt me-1"></i> Terapkan
                                </button>
                                <a href="{{ route('workshop-verification.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-reset me-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Bengkel --}}
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Bengkel</th>
                            <th>Pemilik</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($workshops as $index => $workshop)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <div class="fw-semibold">{{ $workshop->name }}</div>
                                    <small class="text-muted">{{ $workshop->address }}</small>
                                </td>
                                <td>{{ $workshop->creator->name ?? '-' }}</td>
                                <td>
                                    <div>{{ $workshop->phone ?? '-' }}</div>
                                    <small class="text-muted">{{ $workshop->email ?? '-' }}</small>
                                </td>
                                <td>
                                    @if ($workshop->status == 'approved')
                                        <span class="badge bg-success"><i class="bx bx-check-circle me-1"></i>
                                            Disetujui</span>
                                    @elseif($workshop->status == 'rejected')
                                        <span class="badge bg-danger"><i class="bx bx-x-circle me-1"></i> Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark"><i class="bx bx-time-five me-1"></i>
                                            Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $workshop->created_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $workshop->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    @if ($workshop->status == 'pending')
                                        <form action="{{ route('workshop-verification.update', $workshop->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-success btn-sm me-1"
                                                onclick="return confirm('Setujui bengkel ini?')">
                                                <i class="bx bx-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('workshop-verification.update', $workshop->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Tolak bengkel ini?')">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('workshop-verification.destroy', $workshop->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Hapus data bengkel ini?')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bx bx-wrench bx-lg mb-2"></i>
                                        <p class="mb-0">Belum ada data bengkel yang ditemukan.</p>
                                        <small>Coba ubah filter atau kata kunci pencarian.</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if (method_exists($workshops, 'hasPages') && $workshops->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan <strong>{{ $workshops->firstItem() ?? 0 }}–{{ $workshops->lastItem() ?? 0 }}</strong>
                    dari <strong>{{ $workshops->total() }}</strong> hasil
                </div>
                {{ $workshops->links() }}
            </div>
        @endif
    </div>

    <style>
        .card:hover {
            transform: translateY(-2px);
            transition: all 0.2s ease-in-out;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            font-size: 0.875rem;
        }
    </style>
@endsection
