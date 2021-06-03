<?php
namespace App\Http\Controllers\Apis\Controllers\getMyLocation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\ModelName;

class getMyLocationController extends index
{
    public static function api(){

        $record = self::$account->location;
        return [
            "status"=>$record?200:204,
            "location"=>$record,
        ];
    }
}
