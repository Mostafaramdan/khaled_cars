<?php
namespace App\Http\Controllers\Apis\Controllers\getOrderInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\orders;

class getOrderInfoController extends index
{
    public static function api()
    {
        $record = orders::findOrFail(self::$request->id);
        return [
            "status"=>200,
            "order"=>objects::order($record),
        ];
    }
}
