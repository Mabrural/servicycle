<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookingServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\WorkshopVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\WorkshopDashboardController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/', [HomepageController::class, 'index']);

Route::get('/workshop/{id}', [HomepageController::class, 'getWorkshopDetails'])->name('workshops.show');
Route::get('/workshop/{id}/booking', [HomepageController::class, 'bookingService'])->name('workshops.booking')->middleware(['auth', 'vehicle_owner']);
Route::get('/workshop/booking/syarat-ketentuan', [HomepageController::class, 'syaratKetentuan'])->name('workshops.syarat')->middleware(['auth', 'vehicle_owner']);
Route::get('/workshop/booking/kebijakan-privasi', [HomepageController::class, 'kebijakanPrivasi'])->name('workshops.kebijakan')->middleware(['auth', 'vehicle_owner']);
// simpan data booking
Route::post('/bookings/store', [HomepageController::class, 'store'])->name('save.booking')->middleware('auth');
Route::get('/bookings/success/{id}', [HomepageController::class, 'success'])->name('bookings.success')->middleware('auth');

// untuk terima/tolak servis oleh bengkel melalui email
Route::get('/workshops/booking/{id}/status/{status}', [BookingServiceController::class, 'updateStatusFromEmail'])
    ->name('booking.updateStatus.email');

// verify acc / reject via link email
Route::get('/booking/verify/{id}', [BookingServiceController::class, 'verifyFromEmail'])
    ->name('booking.verify');

// verify workshop by admin
Route::get('/workshop-verify/{id}', [WorkshopVerificationController::class, 'show'])
    ->name('workshop-verify.show');

// Jika ingin pakai PATCH (lebih sesuai RESTful)
Route::patch('/workshop-verify/{id}', [WorkshopVerificationController::class, 'update'])
    ->name('workshop-verify.update');

Route::resource('booking-services', BookingServiceController::class);

Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $allowedFolders = ['vehicle_images', 'workshop-images'];

    if (!in_array($folder, $allowedFolders)) {
        abort(403);
    }

    $path = storage_path('app/public/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');

Route::middleware(['auth', 'verified', 'is_set_role'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route pilih role TIDAK pakai middleware is_set_role
Route::middleware(['auth', 'verified', 'redirect_if_role_set'])->group(function () {
    Route::get('/pilih-role', [RoleController::class, 'selectRole'])->name('pilih-role');
    Route::post('/pilih-role', [RoleController::class, 'setRole'])->name('set.role');
});

// Route yang membutuhkan role baru dilindungi oleh is_set_role -> Admin
Route::middleware(['auth', 'verified', 'is_set_role', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');

    Route::resource('/admin/user-management', UserController::class);

    Route::patch('/admin/user-management/{id}/toggle-role', [UserController::class, 'toggleRole'])->name('user-management.toggleRole');
    Route::patch('/admin/user-management//{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('user-management.toggleStatus');


    Route::resource('/admin/workshop-verification', WorkshopVerificationController::class)
        ->names('workshop-verification')
        ->except(['create', 'edit', 'show']);

    Route::get('/admin/subscription-management', function () {
        return view('subscription-management.index');
    })->name('subscription-management');

    Route::get('/admin/report-analytic', function () {
        return view('report.admin');
    })->name('report');

    Route::get('/admin/notification-management', function () {
        return view('notification-management.index');
    })->name('notification.management');

    Route::get('admin/setting', function () {
        return view('setting.index');
    })->name('setting');
});

Route::middleware(['auth', 'verified', 'is_set_role', 'vehicle_owner'])->group(function () {
    // pemilik kendaraan
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.user');

    Route::resource('/user/vehicles', VehicleController::class);

    Route::get('/user/history', [BookingServiceController::class, 'historyService'])->name('history');
    Route::post('/user/history/{id}/cancel', [BookingServiceController::class, 'cancel'])
        ->name('booking.cancel');

    // start expert system
    Route::get('/user/expert-system/', function () {
        return view('expert-system.index');
    })->name('expert-system');

    Route::get('/user/expert-system/diagnosis', function () {
        return view('expert-system.diagnosis');
    })->name('diagnosis');

    Route::get('/user/expert-system/diagnosis/hasil', function () {
        return view('expert-system.result');
    })->name('diagnosis.result');
    // end expert system

    Route::get('/user/schedule', function () {
        return view('schedule.index');
    })->name('schedule');

    Route::get('/user/notification', function () {
        return view('notification.user');
    })->name('notification.user');

    Route::get('/user/record', function () {
        return view('record.index');
    })->name('record');

    Route::get('/user/upgrade-premium', function () {
        return view('upgrade-premium.user');
    })->name('upgrade-premium.user');
});

Route::middleware(['auth', 'verified', 'is_set_role', 'workshop'])->group(function () {
    // Bengkel

    Route::get('/workshops/dashboard', [WorkshopDashboardController::class, 'index'])->name('dashboard.workshop');

    Route::resource('workshops/my-workshop', WorkshopController::class);

    Route::get('/workshops/booking', [BookingServiceController::class, 'index'])->name('workshop.booking');
    Route::post('/workshops/booking/{id}/status', [BookingServiceController::class, 'updateStatus'])->name('booking.updateStatus');

    Route::get('/workshops/service-and-sparepart', function () {
        return view('service-and-sparepart.index');
    })->name('service-and-sparepart');

    Route::get('/workshops/invoice', function () {
        return view('invoice.index');
    })->name('invoice');

    Route::get('/workshops/promote', function () {
        return view('promote.index');
    })->name('promote');
});

// routes/web.php
Route::get('/my-workshop/{id}/edit', [WorkshopController::class, 'edit'])->name('my-workshop.edit');
Route::put('/my-workshop/{id}', [WorkshopController::class, 'update'])->name('my-workshop.update');
Route::get('/my-workshop/{id}', [WorkshopController::class, 'show'])->name('my-workshop.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
