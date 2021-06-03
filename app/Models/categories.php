<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        'image',
        'is_active',
        'name_en',
        'name_ar',
    ];

    public function brands(){
        return $this->hasMany(brands::class);
    }

    public function products()
    {
        return $this->hasManyThrough(products::class, brands::class);
    }

}
