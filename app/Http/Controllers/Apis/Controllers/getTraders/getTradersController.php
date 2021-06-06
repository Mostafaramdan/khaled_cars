<?php
namespace App\Http\Controllers\Apis\Controllers\getTraders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\traders as model;

class getTradersController extends index
{
    public static function api(){

        $records=  helper::get(model::where('is_active',1));
        return [
            "status"=>$records[2],
            "totalPages"=>$records[1],
            "traders"=>objects::ArrayOfObjects($records[0],"trader"),
        ];
    }
}
