<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pilih-role', function () {
    return view('pilih-role.index');
})->middleware(['auth', 'verified'])->name('pilih-role');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/manajemen-pengguna', function () {
    return view('manajemen-pengguna.index');
})->middleware(['auth', 'verified'])->name('manajemen-pengguna');

Route::get('/manajemen-langganan', function () {
    return view('manajemen-langganan.index');
})->middleware(['auth', 'verified'])->name('manajemen-langganan');

Route::get('/laporan-analitik', function () {
    return view('laporan-analitik.index');
})->middleware(['auth', 'verified'])->name('laporan-analitik');

Route::get('/manajemen-notifikasi', function () {
    return view('manajemen-notifikasi.index');
})->middleware(['auth', 'verified'])->name('manajemen-notifikasi');

Route::get('/pengaturan-aplikasi', function () {
    return view('pengaturan-aplikasi.index');
})->middleware(['auth', 'verified'])->name('pengaturan-aplikasi');

// pemilik kendaraan
Route::get('/kendaraan-saya', function () {
    return view('kendaraan-saya.index');
})->middleware(['auth', 'verified'])->name('kendaraan-saya');

Route::get('/riwayat-servis', function () {
    return view('riwayat-servis.index');
})->middleware(['auth', 'verified'])->name('riwayat-servis');

Route::get('/jadwal-servis', function () {
    return view('jadwal-servis.index');
})->middleware(['auth', 'verified'])->name('jadwal-servis');

Route::get('/notifikasi-servis', function () {
    return view('notifikasi-servis.index');
})->middleware(['auth', 'verified'])->name('notifikasi-servis');

Route::get('/catatan-masalah', function () {
    return view('catatan-masalah.index');
})->middleware(['auth', 'verified'])->name('catatan-masalah');

Route::get('/upgrade-premium', function () {
    return view('upgrade-premium.index');
})->middleware(['auth', 'verified'])->name('upgrade-premium');

// Bengkel
Route::get('/profil-bengkel', function () {
    return view('profil-bengkel.index');
})->middleware(['auth', 'verified'])->name('profil-bengkel');

Route::get('/booking-servis', function () {
    return view('booking-servis.index');
})->middleware(['auth', 'verified'])->name('booking-servis');

Route::get('/servis-dan-sparepart', function () {
    return view('servis-dan-sparepart.index');
})->middleware(['auth', 'verified'])->name('servis-dan-sparepart');

Route::get('/invoice-servis', function () {
    return view('invoice-servis.index');
})->middleware(['auth', 'verified'])->name('invoice-servis');

Route::get('/promosi-bengkel', function () {
    return view('promosi-bengkel.index');
})->middleware(['auth', 'verified'])->name('promosi-bengkel');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
