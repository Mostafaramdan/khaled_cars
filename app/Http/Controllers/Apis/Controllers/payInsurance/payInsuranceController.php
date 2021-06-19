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
                            ->where('biddings_id',self::$request->bidId)
                            ->where('status','accept')
                            ->first();
        if($insurance){
            return [
                'status'=>201
            ];
        }

        $path= helper::base64_image(self::$request->image,'images/insurance');
        $image=  images::create([
            'image'=>$path
        ]);
        insurances::create([
           'images_id'=>$image->id,
           'biddings_id'=>self::$request->bidId,
           'users_id'=>self::$account->id,
        ]);

        return [
            "status"=>200,

        ];
    }
}
