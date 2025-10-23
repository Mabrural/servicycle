<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'workshop_id',
        'vehicle_id',
        'booking_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
    ];

    // Relasi ke user (creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke workshop
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    // Relasi ke vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
