<?php
namespace App\Http\Controllers\Apis\Controllers\setMyLocation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\locations;

class setMyLocationController extends index
{
    public static function api()
    {
        if(self::$account->locations_id){
            locations::destroy(self::$account->locations_id);
        }
        $record=  locations::createUpdate([
            'longitude'=>self::$request->location['longitude'],
            'latitude'=>self::$request->location['latitude'],
            'address'=>self::$request->location['address']??'',
            'description'=>self::$request->location['description'] ??'',
        ]);
        self::$account->locations_id=$record->id;
        self::$account->save();
        return [
            "status"=>200,
        ];
    }
}
