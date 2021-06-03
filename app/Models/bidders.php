<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bidders extends Model
{
    use HasFactory;
    protected $table = 'bidders';
    public $timestamps = ['created_at'];
    const UPDATED_AT   = null;
    protected $fillable = [
        'users_id',
        'biddings_id',
        'price',
        'created_at'
    ];

    public function user(){
        return $this->belongsTo(users::class,'users_id');
    }
    public function bidding(){
        return $this->belongsTo(biddings::class);
    }
    public function orders(){
        return $this->hasMany(orders::class,'bidders_id');
    }

}
