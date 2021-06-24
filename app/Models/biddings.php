<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biddings extends Model
{
    use HasFactory;
    protected $table = 'biddings';
    public $timestamps = false,$appends=['max_auction'];
    protected $fillable = [
        'products_id',
        'Insurance',
        'min_auction',
        'type',
        'traders_id',
    ];

    public function insurances(){
        return $this->hasMany(insurances::class);
    }

    function product()
    {
        return $this->belongsTo(products::class,'products_id');
    }

    public function trader(){
        return $this->belongsTo(traders::class,'traders_id');
    }

    function reviews()
    {
        return $this->hasMany(reviews::class,'biddings_id');
    }
    

    function bidders()
    {
        return $this->hasMany(bidders::class,'biddings_id');
    }

    public function favourites()
    {
        return $this->hasMany(favourites::class,'biddings_id');
    }
    function GetMaxAuctionAttribute()
    {
        return $this->bidders->max('price');
    }

}
