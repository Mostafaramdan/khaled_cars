<?php
namespace App\Http\Controllers\Apis\Controllers\payInsurance;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class payInsuranceRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required|",
            'image'    =>'required|string',
            "insuranceSlideId"     =>"required|exists:insurances_slides,id",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "image.required"       =>400,

            "insuranceSlideId.required"       =>400,
            "insuranceSlideId.exists"         =>405,

        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "insuranceSlideId.exists"         =>"رقم الشريحة غير موجود",
            "insuranceSlideId.required"       =>"يجب ادخال رقم الشريحة",

            "image.required"       =>"يجب ادخال الصورة ",

        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
