<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\admins as model;
use Illuminate\Support\Facades\Hash;

class admins extends dashboard

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
            $records->where('name','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
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
        ]);
    }
    public function store(Request $request)
    {
        if($this->model::where('email',$request->email)->count()){
            return response()->json(['status'=>403]);
        }
        if($this->model::where('phone',$request->phone)->count()){
            return response()->json(['status'=>404]);
        }
        $this->model::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'apiToken'=>\App\Http\Controllers\Apis\Helper\helper::UniqueRandomXChar(70,['admins'])
        ]);
        return response()->json(['status'=>200]);
    }

}
