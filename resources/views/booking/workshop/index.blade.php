@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manajemen Booking Servis</h3>
            <p class="text-muted mb-0">Pantau dan kelola semua booking servis kendaraan pelanggan.</p>
        </div>
        <button class="btn btn-outline-secondary btn-sm" id="refreshButton" onclick="location.reload()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
    </div>

    {{-- Filter & Search (opsional, masih sama seperti template awal) --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status Booking</label>
                    <select class="form-select" name="status">
                        <option value="">Semua</option>
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="accepted">Diterima</option>
                        <option value="in_progress">Dalam Proses</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Booking</label>
                    <input type="date" class="form-control" name="booking_date">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cari Nama / Plat Nomor</label>
                    <input type="text" class="form-control" name="keyword" placeholder="Contoh: Andi / BM 1234 XY">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Booking Servis --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">
            📅 Daftar Booking Servis
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Kendaraan</th>
                        <th>Plat Nomor</th>
                        <th>Catatan Servis</th>
                        <th>Waktu Booking</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $booking->creator->name ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $booking->creator->email ?? '-' }}</small>
                            </td>
                            <td>{{ $booking->vehicle->brand ?? '-' }} {{ $booking->vehicle->model ?? '' }}</td>
                            <td>{{ $booking->vehicle->license_plate ?? '-' }}</td>
                            <td>{{ $booking->notes ?? '-' }}</td>
                            <td>{{ $booking->booking_date ? $booking->booking_date->format('d M Y, H:i') : '-' }}</td>
                            <td>
                                @php
                                    $status = strtolower($booking->status);
                                    $badgeClass = match ($status) {
                                        'pending' => 'bg-warning text-dark',
                                        'accepted' => 'bg-success',
                                        'in_progress' => 'bg-info text-dark',
                                        'completed' => 'bg-primary',
                                        'cancelled' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $booking->status ?? 'Tidak Diketahui')) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @if ($booking->status === 'pending')
                                        <button class="btn btn-sm btn-outline-success" title="Terima Booking">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Tolak Booking">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    @elseif ($booking->status === 'accepted')
                                        <button class="btn btn-sm btn-outline-warning" title="Proses Servis">
                                            <i class="fas fa-tools"></i>
                                        </button>
                                    @elseif ($booking->status === 'in_progress')
                                        <button class="btn btn-sm btn-outline-success" title="Tandai Selesai">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    @endif

                                    <button class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Tidak ada data booking servis.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
