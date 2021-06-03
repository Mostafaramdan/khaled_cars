<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regions extends Model
{
    use HasFactory;
    protected  $fillable=['name_ar','name_en','regions_id','countries_id']
    ;
    public $timestamps=false;

    public function regions(){
        return $this->hasMany(regions::class);
    }
    public static function allActive()
    {
        return self::orderBy('id','DESC')->get()->where('deleted_at',null)->where('is_active',1);
    }
}
