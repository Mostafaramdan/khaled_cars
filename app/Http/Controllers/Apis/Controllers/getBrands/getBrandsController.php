<?php
namespace App\Http\Controllers\Apis\Controllers\getBrands;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\brands;

class getBrandsController extends index
{
    public static function api(){

        $records=  brands::all();
        return [
            "status"=>$records->count()?200:204,
            "brands"=>objects::ArrayOfObjects($records,"brand"),
        ];
    }
}
