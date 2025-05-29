<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_compared',
    ];

    protected $casts = [
        'vehicle_compared' => 'array', // Cast JSON to PHP array
    ];

    /**
     * Relationship: A comparison belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

