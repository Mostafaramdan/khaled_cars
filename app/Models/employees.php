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
        'companies_id',
        'banks_id',
    ];
    public function companies(){
        return $this->belongsTo(companies::class);
    }

    public function banks(){
        return $this->belongsTo(banks::class);
    }
}
