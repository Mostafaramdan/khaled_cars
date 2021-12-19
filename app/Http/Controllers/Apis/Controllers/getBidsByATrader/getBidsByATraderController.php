<?php
namespace App\Http\Controllers\Apis\Controllers\getBidsByATrader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\biddings as model;

class getBidsByATraderController extends index
{
    public static function api()
    {

        $records=  helper::get(
                        model::where('traders_id',self::$request->traderId)
                                ->where(function($q){
                                    if(self::$request->type == 'close'){
                                        return $q->where('biddings.has_order',1);
                                    }elseif(self::$request->type == 'open'){
                                        return $q->where('biddings.has_order',null);
                                }
                            })
                            ->orderBy('id','DESC')
                    );
        return [
            "status"=>$records[2],
            "totalPages"=>$records[1],
            "bids"=>objects::ArrayOfObjects($records[0],"bid"),
        ];
    }
}