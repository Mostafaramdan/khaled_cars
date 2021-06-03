<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_settings extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'policyTerms_ar',
        'policyTerms_en',
        'aboutUs_ar',
        'aboutUs_en',
        'privacy_ar',
        'privacy_en',
        'emails',
        'phones',
        'fees',
        'min_days_to_paid',
    ];
    protected $table = 'app_settings',$appends=['emails','phones'];

    function GetPhonesAttribute()
    {
        return json_decode($this->attributes['phones'],true);
    }
    function GetEmailsAttribute()
    {
        return json_decode($this->attributes['emails'],true);
    }

}
