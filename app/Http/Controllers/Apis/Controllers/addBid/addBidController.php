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
use App\Models\users;

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
        $users = users::where('fireBaseToken','!=',null)
                    ->where('is_active',1)
                    ->whereHas('bidders',function($q){
                        return $q->where('biddings_id',self::$request->bidId);
                    })
                    ->where('id','!=',self::$account->id)
                    ->get();
        if($users->count() > 0){
            $product = biddings::find(self::$request->bidId)->product;
            $price = self::$request->price;
            $content_ar =" تم اضافة عرض جديد بقيمة  {$price} علي السيارة {$product->brand->name_ar} "; 
            $content_en =" A new offer has been added in {$price} at {$product->brand->name_en}"; 
            helper::newNotify($users, $content_ar , $content_en,null,self::$request->bidId);
        }

        // check if end date will end after 5 minutes ;
        $convertedTime = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))));
        if($record->bidding->end_at <= $convertedTime){
            $product = biddings::find(self::$request->bidId)->product;
            $content_ar =" تم مد فترة المزاد الي خمس دقائق إضافية علي السيارة {$product->brand->name_ar} "; 
            $content_en =" The auction period has been extended to an additional five minutes on the car {$product->brand->name_en}"; 
            $bidding = biddings::find(self::$request->bidId);
            $bidding->end_at =  date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($bidding->end_at)));
            $bidding->save();
            $users = users::where('fireBaseToken','!=',null)
                            ->where('is_active',1)->get();
            helper::newNotify($users, $content_ar , $content_en,null,self::$request->bidId,'updateEndDate');
            
        }
        return [
            "status"=>200,
        ];
    }
}
