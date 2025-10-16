<!-- resources/views/profile/create.blade.php -->
@extends('layouts.main')

@section('title', 'Tambah Bengkel Baru')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Bengkel Baru</h4>
                </div>
                <div class="card-body">
                    <form id="workshopForm" action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Informasi Dasar Bengkel -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Informasi Dasar Bengkel</h5>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Bengkel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="specialization" class="form-label">Spesialisasi</label>
                                <input type="text" class="form-control @error('specialization') is-invalid @enderror" 
                                       id="specialization" name="specialization" value="{{ old('specialization') }}">
                                @error('specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Deskripsi Bengkel</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Jenis dan Layanan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Jenis dan Layanan</h5>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Bengkel <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="types[]" value="motor" id="type_motor">
                                    <label class="form-check-label" for="type_motor">Motor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="types[]" value="mobil" id="type_mobil">
                                    <label class="form-check-label" for="type_mobil">Mobil</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="types[]" value="sepeda" id="type_sepeda">
                                    <label class="form-check-label" for="type_sepeda">Sepeda</label>
                                </div>
                                @error('types')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Layanan yang Tersedia <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="service_rutin" id="service_rutin">
                                    <label class="form-check-label" for="service_rutin">Service Rutin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="ganti_oli" id="ganti_oli">
                                    <label class="form-check-label" for="ganti_oli">Ganti Oli</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="tune_up" id="tune_up">
                                    <label class="form-check-label" for="tune_up">Tune Up</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="perbaikan_mesin" id="perbaikan_mesin">
                                    <label class="form-check-label" for="perbaikan_mesin">Perbaikan Mesin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="perbaikan_rem" id="perbaikan_rem">
                                    <label class="form-check-label" for="perbaikan_rem">Perbaikan Rem</label>
                                </div>
                                @error('services')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Informasi Kontak -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Informasi Kontak</h5>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="operating_hours" class="form-label">Jam Operasional <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('operating_hours') is-invalid @enderror" 
                                       id="operating_hours" name="operating_hours" 
                                       placeholder="Contoh: Senin - Jumat: 08:00 - 17:00, Sabtu: 08:00 - 15:00" 
                                       value="{{ old('operating_hours') }}" required>
                                @error('operating_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Alamat Lengkap</h5>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" 
                                       id="province" name="province" value="{{ old('province') }}" required>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="city" class="form-label">Kota <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="district" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" 
                                       id="district" name="district" value="{{ old('district') }}" required>
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="village" class="form-label">Kelurahan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('village') is-invalid @enderror" 
                                       id="village" name="village" value="{{ old('village') }}" required>
                                @error('village')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                       id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Koordinat -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Koordinat Lokasi</h5>
                                <p class="text-muted small">Koordinat latitude dan longitude untuk penanda di peta</p>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label">Latitude <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" 
                                       id="latitude" name="latitude" value="{{ old('latitude') }}" required>
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label">Longitude <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror" 
                                       id="longitude" name="longitude" value="{{ old('longitude') }}" required>
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Foto Bengkel -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Foto Bengkel</h5>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="photos" class="form-label">Upload Foto</label>
                                <input type="file" class="form-control @error('photos') is-invalid @enderror" 
                                       id="photos" name="photos[]" multiple accept="image/*">
                                <div class="form-text">Anda dapat memilih multiple file. Format yang didukung: JPG, PNG, JPEG.</div>
                                @error('photos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('photos.*')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Bengkel
                                    </button>
                                    <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Validasi form sebelum submit
    document.getElementById('workshopForm').addEventListener('submit', function(e) {
        const types = document.querySelectorAll('input[name="types[]"]:checked');
        const services = document.querySelectorAll('input[name="services[]"]:checked');
        
        if (types.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu jenis bengkel');
            return false;
        }
        
        if (services.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu layanan');
            return false;
        }
    });

    // Format phone number
    document.getElementById('phone').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });
</script>
@endpush