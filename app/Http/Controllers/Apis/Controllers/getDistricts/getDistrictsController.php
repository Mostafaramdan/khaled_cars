<?php
namespace App\Http\Controllers\Apis\Controllers\getDistricts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\regions;

class getDistrictsController extends index
{
    public static function api()
    {
        $records=  regions::where('is_active',1)
                          ->where('regions_id',self::$request->cityId)
                          ->get();
        return [
            "status"=>$records->count()?200:204,
            "districts"=>objects::ArrayOfObjects($records,"city"),
        ];
    }
}
