<?php
namespace App\Http\Controllers\Apis\Controllers\addBidToFavourite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\favourites;

class addBidToFavouriteController extends index
{
    public static function api()
    {
        if(favourites::where('users_id',self::$account->id)->where('biddings_id',self::$request->bidId)->count()){
            favourites::where('users_id',self::$account->id)->where('biddings_id',self::$request->bidId)->delete();
            $action = 'unfavourite';
        }else{
            favourites::create([
                'users_id'=>self::$account->id,
                'biddings_id'=>self::$request->bidId
            ]);
            $action = 'favourite';
        }
        return [
            "status"=>200,
            'action'=>$action
        ];
    }
}
