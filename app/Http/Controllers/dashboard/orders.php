<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\orders as model;

class orders extends dashboard
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
            $records->whereHas('carts', function ($query) {
                $query->whereHas('housing_unit',function ($query){
                    $query->where('estates_id',$this->account->estates_id);
                });
            });
        }

        if($request->search){
            $records->where('id','like','%'.$request->search.'%')
                    ->orWhere('status','like','%'.$request->search.'%');
        }
        $records->orderBy($request->filterBy??'id',$request->filterType??'DESC'); // filter
        if($request->status){
            $records->where('status',$request->status);
        }

        $itemPerPage= $request->itemPerPage??self::$itemPerPage;
        $totalPages= ceil($records->count()/$itemPerPage);
        $records= $records->forPage($request->page,$itemPerPage)->get();
        return response()->json([
            "status"=>$records->count()?200:204,
            "totalPages"=>$totalPages,
            "records"=>$records,
        ]);
    }
    public function show( $id)
    {
        return response()->json(['status'=>200, 'record'=>$this->model::with('carts')->where('id',$id)->first()]);
    }
}
