<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class banks extends  Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'banks';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'is_active',
    ];

    public function employees(){
        return $this->hasMany(employees::class);
    }

    public function biddings(){
        return $this->hasMany(biddings::class);
    }
}
