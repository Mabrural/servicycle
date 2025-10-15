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
}
