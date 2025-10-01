<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Profile | ServiCycle</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>
    <!-- Logo -->
    <div class="app-brand justify-content-center mt-5">
        <a href="{{ route('login') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img/favicon/favicon.ico') }}" alt="">
            </span>
            <span class="app-brand-text demo text-body fw-bolder">ServiCycle</span>
        </a>
    </div>
    <!-- /Logo -->
    <div class="container-xxl col-lg-6 flex-grow-1 container-p-y">

        <!-- Update Profile Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Perbarui Informasi Profil</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label" for="name">Nama</label>
                        <input id="name" type="text" class="form-control" name="name"
                            value="{{ old('name', auth()->user()->name) }}" required autofocus autocomplete="name" />
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email"
                            value="{{ old('email', auth()->user()->email) }}" required autocomplete="username" />
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Password -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Perbarui Kata Sandi</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="current_password">Kata Sandi Saat Ini</label>
                        <input id="current_password" type="password" class="form-control" name="current_password"
                            required autocomplete="current-password" />
                        @error('current_password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Kata Sandi Baru</label>
                        <input id="password" type="password" class="form-control" name="password" required
                            autocomplete="new-password" />
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Perbarui Kata Sandi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 text-danger">Hapus Akun</h5>
            </div>
            <div class="card-body">
                <p class="mb-3">Begitu akun Anda dihapus, semua sumber daya dan data yang terkait akan dihapus secara
                    permanen. Silakan unduh data atau informasi apa pun yang ingin Anda simpan sebelum menghapus akun
                    Anda.</p>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label class="form-label" for="password_delete">Kata Sandi</label>
                        <input id="password_delete" type="password" class="form-control" name="password" required
                            placeholder="Masukkan kata sandi untuk konfirmasi" />
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button class="btn btn-danger" type="submit">Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <center>
        <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary mb-2">
            <i class="bx bx-arrow-back me-1"></i> Kembali ke Dashboard
        </a>
    </center>
    <br><br>
    <!-- Core JS -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
