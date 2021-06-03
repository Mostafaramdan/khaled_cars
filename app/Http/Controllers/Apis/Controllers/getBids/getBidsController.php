<?php
namespace App\Http\Controllers\Apis\Controllers\getBids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\biddings;

class getBidsController extends index
{
    public static function api(){

        $records=  biddings::doesntHave('orders')
                           ->where('end_at','>',date('Y-m-d H:i:s'))
                           ->orderBy('id','DESC')
                           ->whereHas('product',function ($q){
                               $brandId=self::$request->brandId;
                                return $brandId ? $q->where('brands_id',$brandId):$q;
                           })
                           ->get();
        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "bids"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"bid"),
        ];
    }
}
