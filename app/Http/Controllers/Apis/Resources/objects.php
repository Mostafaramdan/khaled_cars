<?php
namespace App\Http\Controllers\Apis\Resources;

use App\Http\Controllers\Apis\Helper\helper ;
use  App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Controller;
use App\Models\phones;
use App\Models\emails;
use App\Models\favourites;
use App\Models\biddings;
use App\Models\bidders;
use App\Models\carts;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class objects extends index
{
    public static function account ($record)
    {
        if($record == null  ) {return null;}
        $object = [];
        $object['apiToken'] = $record->apiToken;
        $object['phone'] = $record->phone;
        $object['user'] = self::user($record);

        return $object;
    }

    public static function user ($record)
    {
        if($record == null  ) {return null;}
        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->name;
        $record->currency ? $object['currency'] = self::currency($record->currency) : null ;
        $record->image?$object['image'] =Request()->root().$record->image:$object['image'] =null;
        $object['email'] = $record->email;
        $object['phone'] = $record->phone;
        $object['winnerBids'] =bidders::where('users_id',$record->id)->whereHas('orders')->count();
        $object['currentOpenBids'] = bidders::where('users_id',$record->id)->whereDoesntHave('orders')->count();
        $object['phone'] = $record->phone;
        $object['lang'] = $record->lang;
        return $object;
    }

    public static function userMin ($record)
    {
        if($record == null  ) {return null;}
        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->name;
        $record->image?$object['image'] =Request()->root().$record->image:$object['image'] =null;
        return $object;
    }

    public static function brand ($record)
    {

        $object = [];
        $object['id'] = $record->id;
        $object['name']=$record['name_'.self::$lang];
        $object['image'] = self::image($record->image);

        return $object;
    }
    public static function location ($record)
    {
        if($record == null  ) {return null;}
        $object = [];
        $object['id']=$record->id;
        $object['longitude']=$record->longitude;
        $object['latitude']=$record->latitude;
        $object['address']=$record->address;
        $object['description']=$record['description_'.self::$lang];
        return $object;
    }

    public static function notification  ($record){
        // this object take record from notify table ;
        if($record == null  ) {return null;}
        $object['id'] = $record->id;
        $object['type'] = $record->notification->type;
        $object['content']=$record->notification['content_'.self::$lang];
        $record->orders? $object['order'] = self::order($record->orders):false;
        $object['isSeen'] = $record->isSeen == 1 ? true : false ;
        $object['createdAt'] = $record->created_at;
        return $object;
    }

    public static function info ($record)
    {

        $object = [];
        $object['aboutUs']=$record['aboutUs_'.self::$lang];
        $object['policyTerms']=$record['policyTerms_'.self::$lang];
        $object['privacy']=$record['privacy_'.self::$lang];
        $object['emails'] = $record->emails;
        $object['phones'] = $record->phones;
        return $object;
    }


    public static function countryInRegion ($record)
    {

        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->{'name_'.self::$lang};
        $record->cities->count()?$object['cities'] = self::ArrayOfObjects($record->cities,'region'):null;
        return $object;
    }
    public static function region ($record)
    {

        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->{'name_'.self::$lang};
        $record->regions->count()?$object['districts'] = self::ArrayOfObjects($record->regions,'region'):null;
        return $object;
    }

    public static function country ($record)
    {

        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->{'name_'.self::$lang};
        return $object;
    }

    public static function city ($record)
    {
        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->{'name_'.self::$lang};
        return $object;
    }
    public static function product ($record)
    {
        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->{'name_'.self::$lang};
        $object['description'] = $record->{'description_'.self::$lang};
        $object['price'] = $record->price;
        $object['features'] = self::ArrayOfObjects($record->features??[],'feature');
        $object['images'] = self::ArrayOfObjects($record->images??[],'image');
        $object['model'] = $record->model;
        $object['status'] = $record->status;
        $object['model'] = $record->model;
        $object['modelYear'] = $record->model_year;
        $object['brand'] = self::brand($record->brand);
        return $object;
    }

    public static function image ($record)
    {
        $object = [];
        $object['id'] = $record->id;
        $object['image'] = Str::contains($record->image,'http') ? $record->image :Request()->root().$record->image;
        return $object;
    }
    public static function feature ($record)
    {
        $object = [];
        $object['id'] = $record->id;
        $object['name'] = $record->{'name_'.self::$lang};
        $object['images'] = self::ArrayOfObjects($record->images??[],'image');
        return $object;
    }


    public static function order ($record)
    {
        $object = [];
        $object['id'] = (double)$record->id;
        $object['startAt'] = (double)$record->start_at;
        $object['endAt'] = (double)$record->end_at;
        $object['status'] = $record->status;
        $object['price'] = (double)$record->price;
        $record->voucher ? $object['discount'] = (double)$record->voucher->discount : null ;
        $object['fees'] = $record->fees;
        $object['priceAfterDiscount'] = (double)$record->priceAfterDiscount;
        $object['total'] = (double)$record->total;
        $object['carts']  = self::ArrayOfObjects($record->carts,'cart');
        return $object;
    }

    public static function bid ($record)
    {
        $object = [];
        $object['id'] = (double)$record->id;
        $object['endAt'] = (double) strtotime($record->end_at);
        $object['createdAt'] =  (int)strtotime( $record->created_at );
        $object['type'] = $record->type;
        $object['minAuction'] = $record->min_auction;
        $object['Insurance'] = (double)$record->Insurance;
        $object['isFav'] = favourites::where('users_id',self::$account->id)->where('biddings_id',$record->id)->count()?true: false;;
        $object['biddersCount'] = bidders::where('biddings_id',$record->id)->count();
        $object['product']  = self::product($record->product);
        $object['bidders']  = self::ArrayOfObjects($record->bidders, 'bidder');
        $object['rate'] = self::rate($record);
        return $object;
    }

    public static function rate ($record)
    {
        // accept bid object
        $object = [];
        $object['totalRate'] =round( $record->reviews->avg('rate') , 2);
        $object['five'] =round( $record->reviews->whereBetween('rate',[4.1,5])->count() , 2);
        $object['four'] =round($record->reviews->whereBetween('rate',[3.1,4])->count() , 2);
        $object['three'] =round($record->reviews->whereBetween('rate',[2.1,3])->count() , 2);
        $object['two'] =round($record->reviews->whereBetween('rate',[1.1,2])->count() , 2);
        $object['one'] =round($record->reviews->whereBetween('rate',[0,1])->count() , 2);

        return $object;
    }

    public static function bidder ($record)
    {
        $object = [];
        $object['id'] = (double)$record->id;
        $object['createdAt'] =  (int)strtotime( $record->created_at );
        $object['user']  = self::user($record->user);
        $object['price']  = $record->price;

        return $object;
    }

    public static function review ($record)
    {
        $object = [];
        $object['id'] = $record->id;
        $object['user'] = self::userMin($record->user);
        $object['rate'] = $record->rate;
        $object['comment'] = $record->comment;
        return $object;
    }
    public static function model ($record)
    {
        $object = [];
        $object['id'] = $record->id;
        $object['model'] = $record->model;
        return $object;
    }
    public static function model_year ($record)
    {
        $object = [];
        $object['id'] = $record->id;
        $object['modelYear'] = $record->model_year;
        return $object;
    }



    public static function ArrayOfObjects ($Items, $objectname)
    {
        if(count($Items)==0) return $Items;
        $Array = [];
        foreach ($Items as $Item) {
            $Item ? $Array[] = self::$objectname($Item) :null;
        }
        return $Array;
    }
}
