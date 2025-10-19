<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkshopController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth'])->group(function () {
    Route::get('/check-workshop-registration', [WorkshopController::class, 'checkRegistration']);
    Route::post('/request-edit', [WorkshopController::class, 'requestEdit']);
});
