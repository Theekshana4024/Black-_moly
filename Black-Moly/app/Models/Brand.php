<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'description',
    ];

    public function CarModels(){
        return $this->hasMany(CarModel::class, 'brand_id', 'id');
    }
}
