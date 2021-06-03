<?php
namespace App\Http\Controllers\Apis\Controllers\makeOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\orders;
use App\Models\carts;
use App\Models\vouchers;
use App\Models\users_uses_vouchers;
use App\Models\locations;
use App\Models\products;
use App\Models\app_settings;
use App\Models\admins;
use App\Mail\sendEmailAfterOrder;
use Illuminate\Support\Facades\Mail;

class makeOrderController extends index
{
    
    public static function api()
    {
     
        $carts=  carts::where('users_id',self::$account->id)
                      ->where('orders_id',null)
                      ->get();
        if($carts->count()== 0){
            return [
                "status"=>404,
                "message"=>"you don/'t have any carts "
            ];
        }
        $total = 0;
        foreach($carts as $cart){
            $product = products::find($cart->products_id);
            if($product->quantity < $cart->quantity){
                return [
                    'status'=>407,
                    'product'=>objects::product($product),
                    'message'=>'This product is out of stock ',
                    "availbleQuantity"=>$product->quantity
                ];
            }
        }

        foreach($carts as $cart){
            if($cart->offers_id){
                $total += ($cart->product->price -( $cart->product->price/100 * $cart->product->discount) ) * $cart->quantity;
            }else{
                $total += $cart->product->price  * $cart->quantity;
            }
        }
        $discount = 0;
        $voucher= null ;
        if(self::$request->vouchers){
            $voucher = vouchers::where('code',self::$request->vouchers)->first();
            if($voucher->is_active == 0 || $voucher->startAt > date("Y-m-d H:i:s")){
                return [
                    'status'=>415,
                ];
            }
            if($voucher->endAt <= date("Y-m-d H:i:s")){
                return [
                    'status'=>416,
                ];
            }
            if($voucher->timeToUse == 0){
                return [
                    'status'=>417,
                ];
            }
            if(users_uses_vouchers::where('users_id',self::$account->id)->where('vouchers_id',$voucher->id)->count() > 0){
                return [
                    'status'=>418,
                ];
            }
            if(
                $voucher && $voucher->is_active && $voucher->timeToUse > 0 &&
                $voucher->startAt <= date("Y-m-d H:i") &&
                $voucher->endAt	 > date("Y-m-d H:i") && 
                users_uses_vouchers::where('users_id' ,self::$account->id)
                                   ->where('vouchers_id' , $voucher->id)
                                   ->count() ==0
            ){
                $discount = $total/100 * $voucher->discountPercentage;
                if($discount > $voucher->maximumDeduction ){
                    $discount= $voucher->maximumDeduction;
                }
                $total -= $discount ;
                users_uses_vouchers::createUpdate([
                    'users_id' =>self::$account->id,
                    'vouchers_id' => $voucher->id,
                ]);
                $voucher->timeToUse--;
                $voucher->save();
            }
           
           
        }
        $location = locations::createUpdate([
            'longitude'=>self::$request->location['longitude'],
            'latitude'=>self::$request->location['latitude'],
            'address'=>self::$request->location['address'],
            'is_default'=>self::$request->location['isDefault'],
            'users_id'=>self::$account->id
        ]);

        $tax = app_settings::first()->tax??0;
        $deliveryPrice = self::$account->region->deliveryPrice > 0 ? self::$account->region->deliveryPrice : self::$account->region->region->deliveryPrice;
        $order = orders::createUpdate([
            'users_id' =>self::$account->id,
            'totalPrice' =>$total+$tax/100 *$total ,
            'tax' =>$tax,
            'paymentType' =>self::$request->paymentMethod,
            'locations_id'=>$location->id,
            'currency' => self::$account->region->currency??self::$account->region->region->currency,
            'vouchers_id' => $voucher->id??null,
            'deliveryDate' =>self::$request->date,
            'delivery_time_id' =>self::$request->timeOfDeliveryId,
            'notes' =>self::$request->note,
            'deliveryPrice' => $deliveryPrice,
            'status'=>'waiting'
        ]);
        foreach($carts as $cart){
            $product= products::find($cart->products_id);
            $cart->orders_id= $order->id;
            $cart->price= $product->price;
            $cart->save();
            $product->quantity -= $cart->quantity;
            $product->save();
        }
        foreach(admins::where('send_sms_after_order',1)->where('phone','!=',null)->get() as $admin){
            $message = $order->id ."يوجد طلب جديد . كود الطلب :"  ;
            helper::sendSms($admin->phone, $message);
        }
        foreach(admins::where('send_email_after_order',1)->get() as $admin){
            $message = $order->id ."يوجد طلب جديد . كود الطلب :"  ;
            if($admin->email)
                Mail::to($admin->email)->send(new sendEmailAfterOrder($order));
        }

        if(app_settings::first()->is_send_sms_to_user){
            $message = " تم ارسال طلبك رقم "  . $order->id ." بنجاح ";
            helper::sendSms(self::$account->phone, $message);
        }

        return [
            "status"=>200,
            "orderId"=>$order->id,
        ];
    }
}