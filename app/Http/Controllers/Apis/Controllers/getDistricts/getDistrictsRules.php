<?php
namespace App\Http\Controllers\Apis\Controllers\getDistricts;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class getDistrictsRules extends index
{
    public static function rules (){

        $rules=[
            "cityId"     =>"required|exists:regions,id",
        ];

        $messages=[
            "cityId.required"       =>400,
            "cityId.exists"         =>405,
        ];

        $messagesAr=[
            "cityId.exists"         =>"رقم المدينة غير موجود",
            "cityId.required"       =>"يجب ادخال رقم المدينة",

        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

    }
}
