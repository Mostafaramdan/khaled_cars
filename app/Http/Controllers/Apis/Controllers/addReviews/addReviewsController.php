<?php
namespace App\Http\Controllers\Apis\Controllers\addReviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\reviews;

class addReviewsController extends index
{
    public static function api(){

        $record=  reviews::create([
            'biddings_id'=>self::$request->bidId,
            'users_id'=>self::$account->id,
            'rate'=>self::$request->rate,
            'comment'=>self::$request->comment,
        ]);
        return [
            "status"=>200,
            "review"=>objects::review($record),
        ];
    }
}
