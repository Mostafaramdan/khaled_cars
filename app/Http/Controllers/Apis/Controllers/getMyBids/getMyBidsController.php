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
        $records=  biddings::whereHas('bidders',function($q){
                        return $q->where('users_id',self::$account->id);
                    });

        if(self::$request->type == 'open'){
            $records->whereHas('bidders',function($q){
                return $q->whereDoesntHave('orders');
            });
        }elseif(self::$request->type== 'win'){
            $records->whereHas('bidders',function($q){
                return $q->where('users_id',self::$account->id)
                    ->whereHas('orders');
            });
        }else{
            $records->whereHas('bidders',function($q){
                return $q->where('users_id','!=',self::$account->id)
                    ->whereHas('orders');
            });
        }
        $records = $records->get();

        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "bids"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"bid"),
        ];
    }
}
