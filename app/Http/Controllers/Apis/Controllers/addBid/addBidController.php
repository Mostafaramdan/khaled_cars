<?php
namespace App\Http\Controllers\Apis\Controllers\addBid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\bidders;
use App\Models\insurances;
use App\Models\biddings;

class addBidController extends index
{
    public static function api()
    {
        $insurance = insurances::where('users_id',self::$account->id)
                                ->orderBy('id','DESC')
                               ->where('status','accept')
                               ->first();

        $total_open_bids=  biddings::where(function($q){ 
                        return $q->whereHas('bidders',function($q){
                            return $q->where('users_id',self::$account->id)
                                    ->doesntHave('orders');
                            });
                        })
                        ->where('end_at','>',date('Y-m-d H:i:s'))
                        ->orderBy('id','DESC')
                        ->get()
                        ->sum('max_auction');

        if(!$insurance){
            return [
                "status"=>412,
                'message'=>'you should pay insurance first .'
            ];
        }
        if($total_open_bids > $insurance->insurances_slides->total_biddings){
            return [
                "status"=>412,
                'message'=>'you cannot do this.',
                'your_insurances_slides'=> objects::insurances_slide($insurance->insurances_slides),
                'your_total_open_bids'=> $total_open_bids,

            ];

        }
        $record=  bidders::create([
            'users_id'=>self::$account->id,
            'biddings_id'=>self::$request->bidId,
            'price'=>self::$request->price,
        ]);
        return [
            "status"=>200,
        ];
    }
}
