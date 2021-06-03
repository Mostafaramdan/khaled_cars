<?php
namespace App\Http\Controllers\Apis\Controllers\search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\biddings;
use Illuminate\Support\Arr;

class searchController extends index
{
    public static  $records;
    public static function api()
    {
        self::$records=  biddings::query();
        self::$request->search? self::$records = self::search() :null;//search
        self::$request->brandId? self::$records = self::filterByBrand() :null;// filter by brand
        self::$request->productPrice? self::$records = self::filterByPrice() :null;// filter by price
        self::$request->rate? self::$records = self::filterByRate() :null;// filter by rate
        self::$request->featureIds? self::$records = self::filterByFeatures() :null;// filter by feature
        self::$request->model? self::$records = self::filterByModel() :null;// filter by model of car
        self::$request->modelYear? self::$records = self::filterByModelYear() :null;// filter by model'year of car
        self::$request->carStatus? self::$records = self::filterByCarStatus() :null;// filter by status of cars
        self::$request->type? self::$records = self::filterByType() :null;// filter by status of cars
        self::$records = self::sort() ;// sort by and sort type

        $response = self::get();
        return [
            "status"=>$response[1],
            "totalPages"=>$response[0],
            "bids"=>objects::ArrayOfObjects(self::$records,"bid"),

        ];
    }

    public static function search()
    {
        $search = self::$request->search;
        return self::$records->whereHas('product', function ($query) use ($search) {
            $query->where('name_ar',        'like', '%'.$search.'%')
                 ->orWhere('name_en',       'like', '%'.$search.'%')
                 ->orWhere('description_ar','like', '%'.$search.'%')
                 ->orWhere('description_en','like', '%'.$search.'%');
        });
    }

    public static function filterByFeatures()
    {
        $featureIds = array_map('intval', self::$request->featureIds);
        return self::$records->whereHas('product', function ($query) use ($featureIds) {
            $query->whereJsonContains('features',$featureIds );
        });
    }
    public static function filterByModel()
    {
        return self::$records->whereHas('product', function ($query)  {
            $query->where('model',self::$request->model );
        });
    }
    public static function filterByModelYear()
    {
        return self::$records->whereHas('product', function ($query)  {
            $query->where('model_year',self::$request->modelYear );
        });
    }
    public static function filterByCarStatus()
    {
        return self::$records->whereHas('product', function ($query)  {
            $query->whereIn('status',self::$request->carStatus );
        });
    }
    public static function filterByType()
    {
        return self::$records->where('type',self::$request->type );
    }

    public static function filterByRate()
    {
        return self::$records->whereHas('reviews', function ($query)  {
            $query->Where('rate',self::$request->rate);
        });
    }

    public static function filterByBrand()
    {
        return self::$records->whereHas('product', function ($query)  {
            $query->where('brands_id',self::$request->brandId);
        });
    }

    public static function filterByPrice()
    {
        return self::$records->whereHas('product',function ($q) {
            $start= self::$request->productPrice['start'];
            $end= self::$request->productPrice['end'];
            return $q->whereBetween('price',[$start,$end]);
        });
    }

    public static function sort()
    {
        if(self::$request->sortBy=='rate'){

            return self::$records->withCount(['reviews as average_rating' => function($query) {
                        $query->select(\DB::raw('coalesce(avg(rate),0)'));
                    }])
                    ->orderBy('average_rating',self::$request->sortType??"DESC");

        }elseif(self::$request->sortBy=='productPrice')
            return self::$records->join('products',  'products.id','=', 'biddings.products_id')
                ->orderBy('products.price', self::$request->sortType??"DESC");
        else
            return self::$records->orderBy('id', self::$request->sortType??"DESC");

    }

    public static function get()
    {
        $totalPages=ceil(self::$records->count()/self::$itemPerPage);
        self::$records = self::$records->forPage(self::$request->page+1,self::$itemPerPage)->get();
        $status = self::$records->count()?200:204;
        return [$totalPages,$status ];
    }
}
