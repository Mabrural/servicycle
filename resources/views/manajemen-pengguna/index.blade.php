@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            Manajemen Pengguna
        </h4>
        <div class="mb-3">
            <a href="{{ route('manajemen-pengguna.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Tambah Pengguna
            </a>
        </div>


        <!-- Hoverable Table rows -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Hak Akses</th>
                            <th>Status</th>
                            <th>Terdaftar Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @switch($user->role)
                                        @case('admin')
                                            <span class="badge bg-label-danger me-1">Admin</span>
                                        @break

                                        @case('vehicle_owner')
                                            <span class="badge bg-label-info me-1">Pemilik Kendaraan</span>
                                        @break

                                        @case('workshop')
                                            <span class="badge bg-label-warning me-1">Bengkel</span>
                                        @break

                                        @default
                                            <span class="badge bg-label-secondary me-1">User</span>
                                    @endswitch
                                </td>

                                <td>
                                    @if ($user->is_active)
                                        <span class="badge bg-label-success">Aktif</span>
                                    @else
                                        <span class="badge bg-label-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm btn-light p-1 shadow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded fs-5"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            {{-- Edit --}}
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('manajemen-pengguna.edit', $user->id) }}">
                                                    <i class="bx bx-edit-alt me-2 fs-5 text-primary"></i> Edit
                                                </a>
                                            </li>

                                            {{-- Hapus --}}
                                            <li>
                                                <form action="{{ route('manajemen-pengguna.destroy', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item d-flex align-items-center text-danger">
                                                        <i class="bx bx-trash me-2 fs-5"></i> Hapus
                                                    </button>
                                                </form>
                                            </li>

                                            {{-- Ubah Hak Akses --}}
                                            <li>
                                                <form action="{{ route('manajemen-pengguna.toggleRole', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mengubah hak akses pengguna ini?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                                        <i class="bx bx-shield-quarter me-2 fs-5 text-warning"></i>
                                                        {{ $user->role === 'admin' ? 'Cabut Admin' : 'Jadikan Admin' }}
                                                    </button>
                                                </form>
                                            </li>

                                            {{-- Aktifkan / Nonaktifkan --}}
                                            <li>
                                                <form action="{{ route('manajemen-pengguna.toggleStatus', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin mengubah status pengguna ini?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                                        <i
                                                            class="bx {{ $user->is_active ? 'bx-user-x text-danger' : 'bx-user-check text-success' }} me-2 fs-5"></i>
                                                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Hoverable Table rows -->

            <hr class="my-5" />
        </div>
    @endsection
