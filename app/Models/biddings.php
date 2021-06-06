<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biddings extends Model
{
    use HasFactory;
    protected $table = 'biddings';
    public $timestamps = false;
    protected $fillable = [
        'products_id',
        'Insurance',
        'min_auction',
        'type',
        'companies_id',
        'banks_id',
    ];

    public function insurances(){
        return $this->hasMany(insurances::class);
    }

    public function products()
    {
        return $this->belongsTo(products::class);
    }

    public function companies(){
        return $this->belongsTo(companies::class);
    }

    public function banks(){
        return $this->belongsTo(banks::class);
    }
    function product()
    {
        return $this->belongsTo(products::class,'products_id');
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

}
