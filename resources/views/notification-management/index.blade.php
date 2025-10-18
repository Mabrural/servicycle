@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-fluid p-0">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1"><strong>Manajemen Notifikasi</strong></h1>
                <p class="text-muted mb-0">Kelola dan kirim notifikasi penting kepada pengguna aplikasi.</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createNotificationModal">
                <i class="bi bi-plus-circle"></i> Buat Notifikasi
            </button>
        </div>

        {{-- Statistik Singkat --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Total Notifikasi</h6>
                        <h3 class="fw-bold">{{ $totalNotifications ?? '120' }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Terkirim</h6>
                        <h3 class="fw-bold text-success">{{ $sentCount ?? '108' }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Tertunda</h6>
                        <h3 class="fw-bold text-warning">{{ $pendingCount ?? '8' }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted mb-2">Dihapus</h6>
                        <h3 class="fw-bold text-danger">{{ $deletedCount ?? '4' }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select">
                            <option value="">Semua</option>
                            <option value="sent">Terkirim</option>
                            <option value="pending">Tertunda</option>
                            <option value="deleted">Dihapus</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Terapkan Filter</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Daftar Notifikasi --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">
                🔔 Daftar Notifikasi
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Pesan</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications ?? [] as $notification)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $notification->title }}</td>
                                <td>{{ Str::limit($notification->message, 60) }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($notification->category) }}</span></td>
                                <td>
                                    @if($notification->status == 'sent')
                                        <span class="badge bg-success">Terkirim</span>
                                    @elseif($notification->status == 'pending')
                                        <span class="badge bg-warning text-dark">Tertunda</span>
                                    @else
                                        <span class="badge bg-danger">Dihapus</span>
                                    @endif
                                </td>
                                <td>{{ $notification->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary btn-sm" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada notifikasi yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- Modal: Buat Notifikasi --}}
<div class="modal fade" id="createNotificationModal" tabindex="-1" aria-labelledby="createNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="#">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="createNotificationModalLabel">📝 Buat Notifikasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Notifikasi</label>
                    <input type="text" class="form-control" name="title" placeholder="Contoh: Pemeliharaan Sistem">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pesan</label>
                    <textarea class="form-control" rows="4" name="message" placeholder="Tulis pesan notifikasi di sini..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select class="form-select" name="category">
                        <option value="umum">Umum</option>
                        <option value="pemberitahuan">Pemberitahuan</option>
                        <option value="sistem">Sistem</option>
                        <option value="promo">Promo</option>
                    </select>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="send_now" id="send_now">
                    <label class="form-check-label" for="send_now">
                        Kirim notifikasi sekarang
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Simpan & Kirim</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal: Konfirmasi Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="#">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="deleteModalLabel">Hapus Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus notifikasi ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
            </div>
        </form>
    </div>
</div>
@endsection
