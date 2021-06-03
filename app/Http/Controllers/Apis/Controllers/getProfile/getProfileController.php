<?php

namespace App\Http\Controllers\Apis\Controllers\getProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper ;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

class getProfileController extends index
{
    public static function api()
    {
        return [
            "status"=>200,
            "user"=>objects::user(self::$account),
        ];
    }
}
