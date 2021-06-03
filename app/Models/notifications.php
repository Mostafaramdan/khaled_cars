<?php

namespace App\Models;

use App\Http\Controllers\Apis\Controllers\index;
use Illuminate\Database\Eloquent\Model;

class notifications extends Model
{
    protected $table = 'notifications', $fillable = ['content_ar','content_en','type','created_at'];
    public $timestamps=false;

    public function notify(){
        return $this->hasMany('\App\Models\notify','notifications_id');
    }
}
