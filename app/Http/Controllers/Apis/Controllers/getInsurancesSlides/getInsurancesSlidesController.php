<?php
namespace App\Http\Controllers\Apis\Controllers\getInsurancesSlides;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\insurances_slides as model;

class getInsurancesSlidesController extends index
{
    public static function api(){

        $records=  helper::get(model::where('is_active',1));
        return [
            "status"=>$records[2],
            "totalPages"=>$records[1],
            "insurancesSlides"=>objects::ArrayOfObjects($records[0],"insurances_slide"),
        ];
    }
}
