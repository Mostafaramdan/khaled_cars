<?php
namespace App\Http\Controllers\Apis\Controllers\addBid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\bidders;
use App\Models\biddings;
use App\Models\insurances;

class addBidController extends index
{
    public static function api()
    {
        $insurance = insurances::where('users_id',self::$account->id)
                               ->where('status','accept')
                               ->orderBy('id','DESC')
                               ->first();
        if(!$insurance){
            return [
                "status"=>412,
                'message'=>'you should pay insurance first .'
            ];
        }
        $total = biddings::whereHas('bidders',function($q){
                    return $q->where('users_id',self::$account->id)
                                ->whereDoesntHave('orders');
                })
                ->withCount(['bidders AS max_biddings' => function($query) {
                    $query->select(\DB::raw('coalesce(MAX(price),0)'));
                }])
                ->get()
                ->sum('max_biddings');
        if($total > $insurance->insurances_slides->total_biddings){
            return [
                'status'=>410,
                'message'=>'you have been paid insurances before, but exceed  limit, your limit is '.$insurance->insurances_slides->total_biddings,
                'yourTotalOpenBiddings'=>$total
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
