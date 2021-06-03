<?php

namespace App\Http\Controllers\Apis\Controllers\resendCode;
use  App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sessions;
use App\Http\Controllers\Apis\Helper\helper ;

class resendCodeController extends index
{
    public static function api(){

        if(helper::chkifSendTwominute(self::$account->session)){
            // self::$account->session->code=helper::RandomXDigits(5);
            self::$account->session->code=12345;
            self::$account->session->created_at=date("Y-m-d H:i:s");
            self::$account->session->save();
            return [
                'status'=>200,
                'message'=>self::$messages['resendCode']["200"],
            ];
        }else{
            return [
                'status'=>416,
                'message'=>self::$messages['resendCode']["416"],
            ];

        }
    }
}
