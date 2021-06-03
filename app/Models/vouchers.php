<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vouchers extends Model
{
    use HasFactory;
    protected  $fillable=['discount','code','start_at','end_at','max_dudction'];
    public $timestamps=false;

    public function scopeFindCode($query, $code)
    {
        return $query->where('code', $code)->first();
    }
    public function scopEqualOrGreaterNow($query, $code)
    {
        return $query->where('code', $code)->first();
    }
    public function setFirstNameAttribute()
    {
        $this->attributes['code'] ='asdasdasdasd';
    }
}
