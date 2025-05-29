<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $table = 'models';

    protected $fillable = [
      'name','description','brand_id','category_id'
    ];

    public function brand(){
        return $this -> belongsTo(Brand::class);
    }

    public function category(){
        return $this -> belongsTo(Category::class);
    }

    public function vehicles(){
        return $this -> hasMany(Vehicle::class,'model_id','id');
    }
}
