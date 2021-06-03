<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\offers as model;

class offers extends dashboard
{
    function __construct(Request $request)
    {
        $this->account= \App\Models\admins::where('apiToken',$request->header('Authorization'))->first();
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $records= $this->model::query();
        if($this->account->estates_id){
            $records->whereHas('housing_unit', function ($query) {
                $query->where('estates_id',$this->account->estates_id);
            });
        }

        if($request->housing_units_id){
            $records->where('housing_units_id',$request->housing_units_id);
        }
        if($request->search){
            $records->where('discount','like','%'.$request->search.'%')
            ->orWhere('name_ar','like','%'.$request->search.'%')
            ->orWhere('name_en','like','%'.$request->search.'%')
            ->orWhere('description_ar','like','%'.$request->search.'%')
            ->orWhere('description_en','like','%'.$request->search.'%')
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
