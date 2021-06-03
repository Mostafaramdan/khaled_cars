<?php
namespace App\Http\Controllers\Apis\Controllers\getBid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\biddings;

class getBidController extends index
{
    public static function api(){

        $record=  biddings::findOrFail(self::$request->id);

        return [
            "status"=>200,
            "bid"=>objects::bid($record)
        ];
    }
}
