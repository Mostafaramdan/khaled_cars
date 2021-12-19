<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    public $timestamps = ['created_at'];
    const UPDATED_AT   = null;
    protected $fillable = [
        'status',
        'price',
        'fees',
        'total',
        'bidders_id',
        'pdf'
    ];


    public function bidder()
    {
        return $this->belongsTo(bidders::class,'bidders_id');
    }
   

}
