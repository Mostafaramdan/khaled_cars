<?php
namespace App\Http\Controllers\Apis\Controllers\getCountries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\countries;

class getCountriesController extends index
{
    public static function api(){

        $records=  countries::where('is_active',1)->get();
        return [
            "status"=>$records->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "countries"=>objects::ArrayOfObjects($records,"country"),
        ];
    }
}
