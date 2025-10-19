@extends('layouts.main')

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Pengguna</h4>

    <div class="card p-4">
        <form action="{{ route('user-management.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Masukkan nama pengguna" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Masukkan email pengguna" 
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div class="mb-3">
                <label class="form-label">Kata Sandi <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Masukkan password baru (opsional)"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label class="form-label">Konfirmasi Kata Sandi</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    placeholder="Ulangi password baru (opsional)"
                >
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hak Akses -->
            <div class="mb-3">
                <label class="form-label">Hak Akses</label>
                <select 
                    name="role" 
                    class="form-select @error('role') is-invalid @enderror" 
                    required
                >
                <option value="vehicle_owner" {{ old('role', $user->role) == 'vehicle_owner' ? 'selected' : '' }}>Pemilik Kendaraan</option>
                <option value="workshop" {{ old('role', $user->role) == 'workshop' ? 'selected' : '' }}>Bengkel</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('user-management.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
