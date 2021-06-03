<?php
namespace App\Http\Controllers\Apis\Controllers\addOrder;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class addOrderRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required|exists:users,apiToken",
            "housingUnitsIds"     =>"required|array",
            "housingUnitsIds.*"     =>"exists:housing_units,id",
            "price"      =>"required|numeric",
            'startAt'            =>'required',
            'endAt'            =>'required',
            'voucherId'        =>'nullable'
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "housingUnitsIds.required"   =>400,
            "housingUnitsIds.array"      =>405,
            "housingUnitsIds.*.exists"   =>405,

            "price.required"         =>400,
            "price.numeric"          =>405,

            "startAt.required"          =>405,

            "endAt.required"          =>405
        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "userId.exists"         =>"هذا الشخص غير موجود",
            "userId.required"       =>"يجب ادخال رقم الشخص",

            "page.required"         =>"يجب ادخال رقم الصفحة",
            "page.numeric"          =>"يجب ادخال رقم الصفحة بشكل صحيح",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
