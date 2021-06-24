<?php
namespace App\Http\Controllers\Apis\Controllers\addReviews;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class addReviewsRules extends index
{
    public static function rules ()
    {
        $rules=[
            "apiToken"   =>"required|",
            "bidId"     =>"required|exists:biddings,id",
            "rate"      =>"required|numeric|min:0|max:5",
            "comment"      =>"required",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "bidId.required" =>400,
            "bidId.exists"   =>405,

            "rate.required"         =>400,
            "rate.numeric"          =>405,
            "rate.min"              =>405,
            "rate.max"              =>405,

            "comment.required"      =>400,
        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "bidId.exists"         =>"رقم المزايدة غير موجود",
            "bidId.required"       =>"يجب ادخال رقم المزايدة",

            "rate.required"         =>"يجب ادخال التقييم",
            "rate.numeric"          =>"يجب ادخال التقييم بشكل صحيح",

            "comment.required"         =>'يجب إدخال التعليق',

        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
