<?php
namespace App\Http\Controllers\Apis\Controllers\getAttachments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\attachments;

class getAttachmentsController extends index
{
    public static function api()
    {
       
        $records=  attachments::all();
        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "attachments"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"attachment"),
        ];
    }
}
