<?php
namespace App\Http\Controllers\Apis\Controllers\getModels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\models;

class getModelsController extends index
{
    public static function api(){

        $records=  models::where('brands_id',self::$request->brandId)
                        ->get();
        return [
            "status"=>$records->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "models"=>objects::ArrayOfObjects($records,"model"),
        ];
    }
}
