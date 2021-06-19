<?php
namespace App\Http\Controllers\Apis\Controllers\addBid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\bidders;
use App\Models\insurances;

class addBidController extends index
{
    public static function api()
    {

        $insurance = insurances::where('users_id',self::$account->id)
                               ->where('biddings_id',self::$request->bidId)
                               ->where('status','accept')
                               ->first();
        if(!$insurance){
            return [
                "status"=>412,
                'message'=>'you should pay insurance first .'
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
