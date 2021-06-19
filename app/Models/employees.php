<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class employees extends  Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'employees';
    public $timestamps = ['created_at'];
    const UPDATED_AT   = null;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'is_active',
        'traders_id',
    ];

    public function trader(){
        return $this->belongsTo(traders::class,'traders_id');
    }

}
