<?php
namespace App\Http\Controllers\Apis\Controllers\getBidsByATrader;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class getBidsByATraderRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required|exists:users,apiToken",
            "traderId"     =>"required|exists:traders,id",
            "page"      =>"required|numeric"
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "traderId.required"       =>400,
            "traderId.exists"         =>405,

            "page.required"         =>400,
            "page.numeric"          =>405
        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "traderId.exists"         =>"هذا التاجر غير موجود",
            "traderId.required"       =>"يجب ادخال رقم التاجر",

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