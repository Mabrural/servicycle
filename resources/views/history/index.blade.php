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
                <form class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Periode</label>
                        <select class="form-select">
                            <option>Semua</option>
                            <option>Bulan ini</option>
                            <option>3 bulan terakhir</option>
                            <option>6 bulan terakhir</option>
                            <option>Tahun ini</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Status Servis</label>
                        <select class="form-select">
                            <option>Semua</option>
                            <option>Selesai</option>
                            <option>Proses</option>
                            <option>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Cari Kendaraan / Plat</label>
                        <input type="text" class="form-control" placeholder="Contoh: BM 1234 XY atau Avanza">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Riwayat Servis --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">
                <span>🧾 Daftar Riwayat Servis</span>
                <a href="{{ route('history') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </a>
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
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->vehicle->brand ?? '-' }} {{ $booking->vehicle->model ?? '' }}</td>
                                <td>{{ $booking->vehicle->license_plate ?? '-' }}</td>
                                <td>{{ $booking->workshop->name ?? '-' }}</td>
                                <td>
                                    @php
                                        $status = strtolower($booking->status);
                                        $badgeClass = match ($status) {
                                            'menunggu_konfirmasi' => 'bg-warning text-dark',
                                            'diterima' => 'bg-success',
                                            'dikerjakan' => 'bg-info',
                                            'selesai' => 'bg-primary',
                                            'diambil' => 'bg-info',
                                            default => 'bg-danger',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status ?? 'Tidak Diketahui')) }}
                                    </span>
                                </td>
                                <td>{{ $booking->booking_date ? $booking->booking_date->translatedFormat('d M Y h:i') : '-' }}
                                </td>
                                <td>{{ $booking->notes ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('booking-services.show', $booking->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada riwayat servis kendaraan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
