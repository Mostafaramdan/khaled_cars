<?php
namespace App\Http\Controllers\Apis\Controllers\payInsurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\images;
use App\Models\insurances;

class payInsuranceController extends index
{
    public static function api()
    {
        $insurance = insurances::where('users_id',self::$account->id)
                               ->where('insurances_slides_id',self::$request->insuranceSlide)
                               ->orderBy('id', 'desc')
                               ->first();
        if($insurance && $insurance->status== 'accept'){
            return [
                'status'=>201,
                'message'=>'you have been paid insurances before'
            ];
        }
        if($insurance && $insurance->status== 'waiting'){
            return [
                'status'=>202,
                'message'=>'you have been paid insurances before, and Awaiting review'
            ];
        }

        $path= helper::base64_image(self::$request->image,'images/insurance');
        $image=  images::create([
            'image'=>$path
        ]);
        insurances::create([
           'images_id'=>$image->id,
           'insurances_slides_id'=>self::$request->insuranceSlide,
           'users_id'=>self::$account->id,
           'created_at'=>date('Y-m-d H:i:s'),
        ]);

        return [
            "status"=>200,

        ];
    }
}
