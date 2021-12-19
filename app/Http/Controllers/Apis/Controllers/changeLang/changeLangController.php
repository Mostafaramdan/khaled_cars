<?php

namespace App\Http\Controllers\Apis\Controllers\changeLang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\users;
use App\Models\providers;

class changeLangController extends index
{
    public static function api()
    {
       self::$account->lang = self::$request->lang;
       self::$account->save(); 
        return [
            "status"=>200,
        ];
    }
}