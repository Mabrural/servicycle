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
                                            'menunggu_konfirmasi' => 'bg-warning text-dark',
                                            'diterima' => 'bg-success',
                                            'dikerjakan' => 'bg-info text-dark',
                                            'selesai' => 'bg-primary',
                                            'diambil' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status ?? 'Tidak Diketahui')) }}
                                    </span>
                                </td>
                                <td>
                                    @php $status = $booking->status; @endphp

                                    {{-- Bengkel menerima booking --}}
                                    @if ($status === 'menunggu_konfirmasi')
                                        <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="diterima">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check2-circle"></i> Terima
                                            </button>
                                        </form>

                                        <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-x-circle"></i> Tolak
                                            </button>
                                        </form>

                                        {{-- Setelah diterima, bengkel bisa ubah ke "dikerjakan" --}}
                                    @elseif ($status === 'diterima')
                                        <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="dikerjakan">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-hammer"></i> Mulai Dikerjakan
                                            </button>
                                        </form>

                                        {{-- Setelah dikerjakan, bengkel ubah ke "selesai" --}}
                                    @elseif ($status === 'dikerjakan')
                                        <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle"></i> Tandai Selesai
                                            </button>
                                        </form>

                                        {{-- Setelah selesai, user bisa menandai "diambil" --}}
                                    @elseif ($status === 'selesai')
                                        <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="diambil">
                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                <i class="bi bi-car-front"></i> Sudah Diambil
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">
                                            @switch($status)
                                                @case('ditolak')
                                                    Ditolak
                                                @break

                                                @case('dibatalkan')
                                                    Dibatalkan
                                                @break

                                                @case('diambil')
                                                    Selesai (Sudah Diambil)
                                                @break

                                                @default
                                                    Tidak ada aksi
                                            @endswitch
                                        </span>
                                    @endif
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
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                </script>
            @endif

        </div>
    @endsection
