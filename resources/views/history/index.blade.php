@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Riwayat Servis Kendaraan</h3>
                <p class="text-muted mb-0">Lihat daftar riwayat perawatan dan servis kendaraan Anda.</p>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('history') }}" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="periode" class="form-label fw-semibold">Periode</label>
                        <select name="periode" id="periode" class="form-select">
                            <option value="semua" {{ ($filters['periode'] ?? '') === 'semua' ? 'selected' : '' }}>Semua
                            </option>
                            <option value="bulan_ini" {{ ($filters['periode'] ?? '') === 'bulan_ini' ? 'selected' : '' }}>
                                Bulan ini</option>
                            <option value="3_bulan_terakhir"
                                {{ ($filters['periode'] ?? '') === '3_bulan_terakhir' ? 'selected' : '' }}>3 bulan terakhir
                            </option>
                            <option value="6_bulan_terakhir"
                                {{ ($filters['periode'] ?? '') === '6_bulan_terakhir' ? 'selected' : '' }}>6 bulan terakhir
                            </option>
                            <option value="tahun_ini" {{ ($filters['periode'] ?? '') === 'tahun_ini' ? 'selected' : '' }}>
                                Tahun ini</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label fw-semibold">Status Servis</label>
                        <select name="status" id="status" class="form-select">
                            <option value="semua" {{ ($filters['status'] ?? '') === 'semua' ? 'selected' : '' }}>Semua
                            </option>
                            <option value="menunggu_konfirmasi"
                                {{ ($filters['status'] ?? '') === 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu
                                Konfirmasi</option>
                            <option value="diterima" {{ ($filters['status'] ?? '') === 'diterima' ? 'selected' : '' }}>
                                Diterima</option>
                            <option value="dikerjakan" {{ ($filters['status'] ?? '') === 'dikerjakan' ? 'selected' : '' }}>
                                Proses</option>
                            <option value="selesai" {{ ($filters['status'] ?? '') === 'selesai' ? 'selected' : '' }}>
                                Selesai</option>
                            <option value="diambil" {{ ($filters['status'] ?? '') === 'diambil' ? 'selected' : '' }}>
                                Diambil</option>
                            <option value="ditolak" {{ ($filters['status'] ?? '') === 'ditolak' ? 'selected' : '' }}>
                                Ditolak</option>
                            <option value="dibatalkan" {{ ($filters['status'] ?? '') === 'dibatalkan' ? 'selected' : '' }}>
                                Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="search" class="form-label fw-semibold">Cari Kendaraan / Plat</label>
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Contoh: BM 1234 XY atau Avanza" value="{{ $filters['search'] ?? '' }}">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>

                {{-- Reset Filter --}}
                @if (!empty(array_filter($filters ?? [])))
                    <div class="mt-3">
                        <a href="{{ route('history') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Reset Filter
                        </a>
                        <small class="text-muted ms-2">
                            Menampilkan {{ $bookings->count() }} hasil
                        </small>
                    </div>
                @endif
            </div>
        </div>

        {{-- Tabel Riwayat Servis --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">
                <span>🧾 Daftar Riwayat Servis</span>
                <div>
                    @if (!empty(array_filter($filters ?? [])))
                        <a href="{{ route('history') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    @endif
                    <a href="{{ route('history') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i> Refresh
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Kendaraan</th>
                            <th>Plat Nomor</th>
                            <th>Bengkel</th>
                            <th>Status</th>
                            <th>Tanggal Servis</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $index => $booking)
                            <tr>
                                <td>{{ $bookings->firstItem() + $loop->index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-car-front-fill text-muted me-2"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-medium">{{ $booking->vehicle->brand ?? '-' }}
                                                {{ $booking->vehicle->model ?? '' }}</div>
                                            <small class="text-muted">{{ $booking->vehicle->year ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-dark">{{ $booking->vehicle->license_plate ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <span>{{ $booking->workshop->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $status = strtolower($booking->status);
                                        $badgeClass = match ($status) {
                                            'menunggu_konfirmasi' => 'bg-warning text-dark',
                                            'diterima' => 'bg-success',
                                            'dikerjakan' => 'bg-info',
                                            'selesai' => 'bg-primary',
                                            'diambil' => 'bg-info',
                                            'ditolak' => 'bg-danger',
                                            'dibatalkan' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status ?? 'Tidak Diketahui')) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($booking->booking_date)
                                        <div class="text-nowrap">
                                            <div class="fw-medium">{{ $booking->booking_date->translatedFormat('d M Y') }}
                                            </div>
                                            <small
                                                class="text-muted">{{ $booking->booking_date->translatedFormat('H:i') }}</small>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->notes)
                                        <span class="d-inline-block text-truncate" style="max-width: 150px;"
                                            title="{{ $booking->notes }}">
                                            {{ $booking->notes }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->status === 'menunggu_konfirmasi')
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan servis ini?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-x-circle"></i> Batalkan
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('booking-services.show', $booking->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <div class="py-3">
                                        <i class="bi bi-calendar-x display-4 text-muted"></i>
                                        <h5 class="mt-3">Belum ada riwayat servis</h5>
                                        <p class="text-muted">
                                            @if (!empty(array_filter($filters ?? [])))
                                                Tidak ada data yang sesuai dengan filter yang dipilih.
                                                <a href="{{ route('history') }}" class="text-primary">Reset filter</a>
                                            @else
                                                Anda belum memiliki riwayat servis kendaraan.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($bookings->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        {{-- Info hasil --}}
                        <div class="mb-2 mb-md-0">
                            <p class="small text-muted mb-0">
                                Menampilkan
                                <span class="fw-semibold">{{ $bookings->firstItem() ?? 0 }}</span>
                                sampai
                                <span class="fw-semibold">{{ $bookings->lastItem() ?? 0 }}</span>
                                dari
                                <span class="fw-semibold">{{ $bookings->total() }}</span>
                                hasil
                            </p>
                        </div>

                        {{-- Navigation --}}
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Previous Page Link --}}
                                <li class="page-item {{ $bookings->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $bookings->previousPageUrl() }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                {{-- Pagination Elements --}}
                                @foreach ($bookings->links()->elements[0] as $page => $url)
                                    @if ($page == $bookings->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                <li class="page-item {{ !$bookings->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $bookings->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto submit form ketika select berubah (opsional)
        document.addEventListener('DOMContentLoaded', function() {
            const periodeSelect = document.getElementById('periode');
            const statusSelect = document.getElementById('status');

            [periodeSelect, statusSelect].forEach(select => {
                select.addEventListener('change', function() {
                    this.form.submit();
                });
            });

            // Debounce untuk search input
            let searchTimeout;
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.form.submit();
                }, 500);
            });
        });
    </script>
@endpush
