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
            "apiToken"   =>"required|exists:users,apiToken",
            'image'    =>'required|string',
            "bidId"     =>"required|exists:biddings,id",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "image.required"       =>400,

            "bidId.required"       =>400,
            "bidId.exists"         =>405,

        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "bidId.exists"         =>"رقم المزايدة غير موجود",
            "bidId.required"       =>"يجب ادخال رقم المزايدة",

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
