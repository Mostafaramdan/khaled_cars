<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tokens extends Model
{
    use HasFactory;
    public $guarded=[],$timestamps=false;
    function user()
    {
        return $this->belongsTo(users::class,'users_id');
    }
    function admin()
    {
        return $this->belongsTo(admin::class,'admins_id');
    }
}
