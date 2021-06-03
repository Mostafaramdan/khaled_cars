<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = 'products' , $appends=['images','features'];

    public $timestamps = false;

    protected $fillable = [
        'brands_id',
        'features',
        'description_ar',
        'description_en',
        'name_en',
        'name_ar',
    ];
    function brand()
    {
        return $this->belongsTo(brands::class,'brands_id');
    }
    function model()
    {
        return $this->belongsTo(models::class,'models_id');
    }
    function model_year()
    {
        return $this->belongsTo(model_years::class,'model_years_id');
    }
    function GetFeaturesAttribute()
    {
        return features::find(json_decode($this->attributes['features'],true));
    }
    function GetImagesAttribute()
    {
        return images::find(json_decode($this->attributes['images'],true));
    }
    public function brands(){
        return $this->belongsTo(brands::class);
    }

    public function biddings(){
        return $this->hasMany(biddings::class);
    }
}
