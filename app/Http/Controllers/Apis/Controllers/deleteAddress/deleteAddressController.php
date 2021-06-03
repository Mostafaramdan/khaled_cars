<?php
namespace App\Http\Controllers\Apis\Controllers\deleteAddress;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\locations;

class deleteAddressController extends index
{
    public static function api(){

        locations::destroy(self::$request->locationId);
        return [
            "status"=>200
        ];
    }
}