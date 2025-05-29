<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;
    protected $table = 'vehicle_images';
    protected $fillable = [
        'image_path',
        'is_primary',
        'vehicle_id',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function vehicles(){
        return $this -> belongsTo(Vehicle::class);
    }
}
