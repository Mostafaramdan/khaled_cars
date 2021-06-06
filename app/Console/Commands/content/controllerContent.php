<?php

namespace App\Console\Commands\content;

class controllerContent
{

public static function index ( $fileName){

return
'<?php
namespace App\Http\Controllers\Apis\Controllers\\'.$fileName.';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\ModelName as model;

class '.$fileName.'Controller extends index
{
    public static function api(){

        $records=  helper::get(model::where(\'is_active\',1));
        return [
            "status"=>$records[2],
            "totalPages"=>$records[1],
            "arrayobjectsNAme"=>objects::ArrayOfObjects($records[0],"objectsNAme"),
        ];
    }
}';
   }
}
