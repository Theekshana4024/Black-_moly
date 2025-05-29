<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleHistory extends Model
{
    use HasFactory;

    public $timestamps = false; // because only created_at is used

    protected $fillable = [
        'vehicle_id',
        'accidents',
        'service_records',
        'ownership_count',
        'actual_mileage',
        'has_flood_damage',
        'has_salvage_title',
        'notes',
    ];

    protected $casts = [
        'service_records' => 'array',
        'has_flood_damage' => 'boolean',
        'has_salvage_title' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Relationship: VehicleHistory belongs to a Vehicle
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
