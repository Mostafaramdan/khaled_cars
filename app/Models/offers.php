<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offers extends Model
{
    use HasFactory;
    protected  $fillable=['discount','code','start_at','end_at','housing_units_id'
                ,'name_ar','name_en','description_ar','description_en']
                ;
    public $timestamps=false;

    public function housing_unit()
    {
        return $this->belongsTo(housing_units::class,'housing_units_id');
    }
}
