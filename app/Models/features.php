<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class features extends Model
{
    use HasFactory;
    protected $appends=['images'];
    protected  $fillable=['name_ar','name_en','images'];
    public $timestamps=false;

    function image()
    {
        return $this->belongsTo(images::class,'images_id');
    }
}

