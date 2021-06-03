<?php
namespace App\Http\Controllers\Apis\Controllers\getReviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\reviews;

class getReviewsController extends index
{
    public static function api()
    {
        $records=  reviews::where('biddings_id',self::$request->bidId)->get();
        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "reviews"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"review"),
        ];
    }
}
