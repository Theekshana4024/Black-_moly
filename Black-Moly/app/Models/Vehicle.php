<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table  = 'vehicles';

    protected $fillable = [
        'title',
        'slug',
        'year',
        'price',
        'mileage',
        'fuel_type',
        'transmission',
        'condition',
        'location',
        'description',
        'status',
        'model_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function model(){
        return $this->belongsTo(CarModel::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this -> hasMany(VehicleImage::class,'vehicle_id','id');
    }

    public function history(){
        return $this -> hasOne(VehicleHistory::class,'vehicle_id','id');
    }

    public function aiRecommendations(){
        return $this -> hasMany(AiRecommendation::class,'vehicle_id','id');
    }

    public function transactions(){
        return $this -> hasMany(Transaction::class,'vehicle_id','id');
    }

    public function analytics(){
        return $this -> hasMany(Analytics::class,'vehicle_id','id');
    }

    public function service(){
        return $this -> hasMany(VehicleService::class,'vehicle_id','id');
    }
}
