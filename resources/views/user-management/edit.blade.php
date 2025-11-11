@extends('layouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y animate__animated animate__fadeIn">
        <!-- Judul Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Edit Pengguna</h4>
                <p class="text-muted mb-0">Perbarui data pengguna sesuai kebutuhan. Biarkan kata sandi kosong jika tidak
                    ingin mengubahnya.</p>
            </div>
            <a href="{{ route('user-management.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>

        <!-- Card Form -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('user-management.update', $user->id) }}" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Nama -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-user me-1 text-primary"></i> Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama pengguna" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-envelope me-1 text-primary"></i> Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="Masukkan email pengguna" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Kata Sandi (Opsional) -->
                        <div class="col-md-6 mb-3 position-relative">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-lock me-1 text-primary"></i> Kata Sandi
                                <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>
                            </label>
                            <div class="position-relative">
                                <input type="password" name="password"
                                    class="form-control form-control-lg pe-5 @error('password') is-invalid @enderror"
                                    placeholder="Masukkan kata sandi baru (opsional)" id="passwordField">
                                <i toggle="#passwordField" class="bx bx-show eye-toggle position-absolute text-muted"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Kata Sandi -->
                        <div class="col-md-6 mb-3 position-relative">
                            <label class="form-label fw-semibold">
                                <i class="bx bx-lock-alt me-1 text-primary"></i> Konfirmasi Kata Sandi
                            </label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation"
                                    class="form-control form-control-lg pe-5 @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Ulangi kata sandi baru (opsional)" id="confirmPasswordField">
                                <i toggle="#confirmPasswordField" class="bx bx-show eye-toggle position-absolute text-muted"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Hak Akses -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bx bx-shield-quarter me-1 text-primary"></i> Hak Akses
                        </label>
                        <select name="role" class="form-select form-select-lg @error('role') is-invalid @enderror"
                            required>
                            <option value="vehicle_owner"
                                {{ old('role', $user->role) == 'vehicle_owner' ? 'selected' : '' }}>Pemilik Kendaraan
                            </option>
                            <option value="workshop" {{ old('role', $user->role) == 'workshop' ? 'selected' : '' }}>Bengkel
                            </option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('user-management.index') }}" class="btn btn-light border me-2">
                            <i class="bx bx-x-circle me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Perbarui Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script toggle show/hide password --}}
    @push('scripts')
        <script>
            document.querySelectorAll('.eye-toggle').forEach(icon => {
                icon.addEventListener('click', function() {
                    const input = document.querySelector(this.getAttribute('toggle'));
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.classList.toggle('bx-show');
                    this.classList.toggle('bx-hide');
                });
            });
        </script>
    @endpush
@endsection
