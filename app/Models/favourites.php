<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favourites extends Model
{
    use HasFactory;
    protected $table = 'favourites';
    public $timestamps = false;
    protected $fillable = [
        'users_id',
        'biddings_id',
    ];
   

}
