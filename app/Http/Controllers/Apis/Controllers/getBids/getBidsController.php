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
    public static function api()
    {
        $records=  biddings::orderBy('id','DESC')
                            ->where(function($q){ 
                                return $q->where(function($q){
                                    return $q->whereHas('bidders',function($q){
                                        return $q->whereDoesntHave('orders');   
                                    });
                                })->orWhereDoesntHave('bidders');   
                            })
                           ->where('end_at','>',date('Y-m-d H:i:s'))
                           ->whereHas('product',function ($q){
                               $brandId=self::$request->brandId;
                                return $brandId ? $q->where('brands_id',$brandId):$q;
                           })
                           ->when(self::$request->traderId,function($q){
                               return $q->where('traders_id',self::$request->traderId);
                           })
                           ->get();
        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "bids"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"bid"),
        ];
    }
}
