<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class admins extends  Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'admins';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'is_active',
        'permissions'
    ];
}
