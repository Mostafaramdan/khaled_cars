<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    use HasFactory;
    protected $table = 'brands';
    public $timestamps = false;
    protected $fillable = [
        'name_ar',
        'name_en',
        'categories_id',
    ];
    public function categories(){
        return $this->belongsTo(categories::class);
    }
    public function image(){
        return $this->belongsTo(images::class,'images_id');
    }

    public function products(){
        return $this->hasMany(products::class);
    }

}
