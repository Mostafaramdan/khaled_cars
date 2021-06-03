<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insurances extends Model
{
    use HasFactory;
    protected $table = 'insurances';
    protected $guarded = [];
    public $timestamps = ['created_at'];
    const UPDATED_AT   = null;

    public function users(){
        return $this->belongsTo(users::class);
    }

    public function images(){
        return $this->belongsTo(images::class);
    }

    public function biddings(){
        return $this->belongsTo(biddings::class);
    }
}
