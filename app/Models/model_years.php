<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_years extends Model
{
    use HasFactory;
    protected $table = 'model_years';
    public $timestamps = false;
    public function brand(){
        return $this->belongsTo(brands::class,'brands_id');
    }
}
