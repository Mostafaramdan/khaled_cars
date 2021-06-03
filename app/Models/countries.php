<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class countries extends Model
{
    use HasFactory;
    protected $table = 'countries';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'mobile_ex',
        'call_key',
        'name_en',
        'name_ar',
    ];
    public function cities(){
        return $this->hasMany(regions::class);
    }

}
