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

// routes/api.php
Route::get('/workshops', function() {
    $workshops = \App\Models\Workshop::with('creator')
        ->where('status', 'pending')
        ->get()
        ->map(function($workshop) {
            return [
                'id' => $workshop->id,
                'name' => $workshop->name,
                'types' => json_decode($workshop->types, true) ?? [],
                'address' => $workshop->address,
                'province' => $workshop->province,
                'city' => $workshop->city,
                'district' => $workshop->district,
                'village' => $workshop->village,
                'postal_code' => $workshop->postal_code,
                'latitude' => $workshop->latitude,
                'longitude' => $workshop->longitude,
                'phone' => $workshop->phone,
                'email' => $workshop->email,
                'services' => json_decode($workshop->services, true) ?? [],
                'operating_hours' => $workshop->operating_hours,
                'description' => $workshop->description,
                'rating' => $workshop->rating,
                'created_at' => $workshop->created_at,
                'updated_at' => $workshop->updated_at,
            ];
        });
    
    return response()->json($workshops);
});
