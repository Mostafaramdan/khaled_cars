<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    public $timestamps = false;
    protected  $atble=['orders'];
    function bidder()
    {
        return $this->belongsTo(bidders::class,'bidders_id');
    }


}
