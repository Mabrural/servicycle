<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type',
        'brand',
        'model',
        'year',
        'license_plate',
        'vin',
        'color',
        'engine_capacity',
        'transmission',
        'fuel_type',
        'notes',
        'image',
        'created_by',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function userHasVehicle($userId): bool
    {
        return self::where('created_by', $userId)->exists();
    }

    /**
     * Get the full URL to the vehicle image.
     */
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-vehicle.jpg');
    }

    /**
     * Get vehicle type in Indonesian.
     */
    public function getVehicleTypeIndoAttribute(): string
    {
        return $this->vehicle_type === 'motor' ? 'Motor' : 'Mobil';
    }

    /**
     * Get transmission type in Indonesian.
     */
    public function getTransmissionIndoAttribute(): string
    {
        return $this->transmission === 'manual' ? 'Manual' : 'Matic';
    }

    /**
     * Get fuel type in Indonesian.
     */
    public function getFuelTypeIndoAttribute(): string
    {
        $fuelTypes = [
            'pertalite' => 'Pertalite',
            'pertamax' => 'Pertamax',
            'solar' => 'Solar',
            'listrik' => 'Listrik'
        ];
        
        return $fuelTypes[$this->fuel_type] ?? $this->fuel_type;
    }

    /**
     * Get the full vehicle name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->brand} {$this->model} ({$this->year})";
    }
}