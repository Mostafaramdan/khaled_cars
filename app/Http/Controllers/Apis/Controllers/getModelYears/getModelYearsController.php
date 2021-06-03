<?php
namespace App\Http\Controllers\Apis\Controllers\getModelYears;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\model_years;

class getModelYearsController extends index
{
    public static function api(){

        $records=  model_years::where('brands_id',self::$request->brandId)
                        ->get();
        return [
            "status"=>$records->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "modelYears"=>objects::ArrayOfObjects($records,"model_year"),
        ];
    }
}
