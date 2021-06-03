<?php
namespace App\Http\Controllers\Apis\Controllers\contactUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\contacts;

class contactUsController extends index
{
    public static function api()
    {
        $records=  contacts::create([
            'message'=>self::$request->message,
            'users_id'=>self::$account->id??null,
            'name'=>self::$request->name,
            'phone'=>self::$request->phone,
        ]);
        return [
            "status"=>200,
        ];
    }
}
