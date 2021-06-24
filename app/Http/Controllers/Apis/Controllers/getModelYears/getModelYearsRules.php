<?php
namespace App\Http\Controllers\Apis\Controllers\getModelYears;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class getModelYearsRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required|",
            "brandId"     =>"required|exists:brands,id",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "brandId.required"       =>400,
            "brandId.exists"         =>405,
        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "brandId.exists"         =>"  العلامة التجارية غير موجود",
            "brandId.required"       =>"يجب ادخال رقم العلامة التجارية",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
