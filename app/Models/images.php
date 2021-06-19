<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;
    protected $fillable=['image'];
    public $timestamps = false;

    public function brands(){
        return $this->hasMany(brands::class);
    }

    public function features(){
        return $this->hasMany(features::class);
    }

    function products(){
        return $this->hasMany(products::class);
    }

    public function insurances_slides(){
        return $this->hasMany(insurances_slides::class);
    }
}
