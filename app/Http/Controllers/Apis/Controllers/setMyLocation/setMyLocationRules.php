<?php
namespace App\Http\Controllers\Apis\Controllers\setMyLocation;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class setMyLocationRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required|",
            "location"     =>"required",
            "location.longitude"     =>"required",
            "location.latitude"     =>"required",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "location.required"       =>400,
            "location.longitude.required"       =>400,
            "location.latitude.required"       =>400,

        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",


            "location.required"         =>"يجب ادخال اللوكيشن ",
            "location.longitude.required"         =>"يجب ادخال اللوكيشن ",
            "location.latitude.required"         =>"يجب ادخال اللوكيشن ",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
