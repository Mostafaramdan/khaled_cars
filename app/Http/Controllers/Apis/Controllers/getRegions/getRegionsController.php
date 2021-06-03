<?php
namespace App\Http\Controllers\Apis\Controllers\getRegions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Http\Controllers\Apis\Resources\objects;
use  App\Http\Controllers\Apis\Controllers\index;
use App\Models\countries;

class getRegionsController extends index
{
    public static function api()
    {
        $records=  countries::where('is_active',1)
                            ->whereHas('cities')
                            ->get();
        return [
            "status"=>$records->count()?200:204,
            "countries"=>objects::ArrayOfObjects($records,"countryInRegion"),
        ];
    }
}
