<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    use HasFactory;
    public $fillable=['biddings_id','users_id','rate','comment'],$timestamps=false;
    public function user()
    {
        return $this->belongsTo(users::class,'users_id');
    }

}
