<?php
namespace App\Http\Controllers\Apis\Controllers\getAddresses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\locations;

class getAddressesController extends index
{
    public static function api(){

        $records=  locations::where('users_id',self::$account->id)->where('type','!=',null)->get();
        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "locations"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"location"),
        ];
    }
}