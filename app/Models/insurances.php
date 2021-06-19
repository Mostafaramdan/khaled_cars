<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insurances extends Model
{
    use HasFactory;
    protected $table = 'insurances';
    protected $guarded = [];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(users::class,'users_id');
    }

    public function image(){
        return $this->belongsTo(images::class,'images_id');
    }

    public function users(){
        return $this->belongsTo(users::class);
    }

    public function insurances_slides(){
        return $this->belongsTo(insurances_slides::class,'insurances_slides_id');
    }

    public function insurances_slide(){
        return $this->belongsTo(insurances_slides::class,'insurances_slides_id');
    }

    public function images(){
        return $this->belongsTo(images::class);
    }

}
