<?php
namespace App\Http\Controllers\Apis\Controllers\getCategories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\categories;

class getCategoriesController extends index
{
    public static function api()
    {
        $records=  categories::allActive();
        if(self::$request->categoryId){
            $records= $records->where('id',self::$request->categoryId);
        }
        return [
            "status"=>$records->count()?200:204,
            "categories"=>objects::ArrayOfObjects($records,"category"),
        ];
    }
}
