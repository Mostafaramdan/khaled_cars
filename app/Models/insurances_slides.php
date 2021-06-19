<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insurances_slides extends Model
{
    use HasFactory;
    protected $table = 'insurances_slides';
    protected $guarded = [];
    public $timestamps = false;

    public function insurances(){
        return $this->hasMany(insurances::class);
    }

    public function image(){
        return $this->belongsTo(images::class,'images_id');
    }

}
