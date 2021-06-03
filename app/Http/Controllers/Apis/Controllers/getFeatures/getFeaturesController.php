<?php
namespace App\Http\Controllers\Apis\Controllers\getFeatures;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\features;

class getFeaturesController extends index
{
    public static function api(){

        $records=  features::all();
        return [
            "status"=>$records->count()?200:204,
            "features"=>objects::ArrayOfObjects($records,"feature"),
        ];
    }
}
