<?php
namespace App\Http\Controllers\Apis\Controllers\getMyBids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\biddings;

class getMyBidsController extends index
{
    public static function api()
    {

        $records=  helper::get(
                        biddings::whereHas('bidders',function($q){
                                    return $q->where(function($q){
                                        if(self::$request->type == 'win'){
                                            return $q->where('users_id',self::$account->id)
                                                    ->whereHas('orders');
                                        }elseif(self::$request->type == 'lose'){
                                            return $q->whereHas('orders',function($q){
                                                return $q->whereHas('bidder',function($q){
                                                    return $q->where('users_id','!=',self::$account->id);
                                                });
                                            });
                                    }elseif(self::$request->type == 'open'){
                                        return $q->where('users_id',self::$account->id)
                                            ->where('biddings.has_order',null);
                                    }
                                });
                        })
                    );
        return [
            "status"=>$records[2],
            "totalPages"=>$records[1],
            "bids"=>objects::ArrayOfObjects($records[0],"bid"),
        ];
    }
}
