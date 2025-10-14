<?php
// app/Models/Workshop.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'types',
        'address',
        'province',
        'city',
        'district',
        'village',
        'postal_code',
        'latitude',
        'longitude',
        'phone',
        'email',
        'services',
        'specialization',
        'operating_hours',
        'description',
        'photos',
        'status',
        'created_by'
    ];

    protected $casts = [
        'types' => 'array',
        'services' => 'array',
        'photos' => 'array',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];

    /**
     * Relationship dengan user yang membuat workshop
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope untuk workshop yang sudah approved
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope untuk workshop pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Cek apakah user sudah memiliki workshop
     */
    public static function userHasWorkshop($userId): bool
    {
        return self::where('created_by', $userId)->exists();
    }

    /**
     * Get workshop by user ID
     */
    public static function getByUserId($userId)
    {
        return self::where('created_by', $userId)->first();
    }
}