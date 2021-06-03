<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\countries as model;

class countries extends dashboard
{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        if(\App\Models\admins::where('apiToken',$request->header('Authorization'))->first()->estates_id )
            abort(403);
            
        $records= $this->model::query();

        if($request->search){
            $records->where('name_ar','like','%'.$request->search.'%')
            ->orWhere('name_en','like','%'.$request->search.'%')
                    ;
        }
        $records->orderBy($request->filterBy??'id',$request->filterType??'DESC'); // filter

        $itemPerPage= $request->itemPerPage??self::$itemPerPage;
        $totalPages= ceil($records->count()/$itemPerPage);
        $records= $records->forPage($request->page,$itemPerPage)->get();
        return response()->json([
            "status"=>$records->count()?200:204,
            "totalPages"=>$totalPages,
            "records"=>$records,
            "request"=>$request->all(),
        ]);
    }
}
