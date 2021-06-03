<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\estates as model;
use App\Models\locations;
use App\Models\admins;
use App\Models\attachments;
use Illuminate\Support\Facades\Hash;

class estates extends dashboard
{
    function __construct(Request $request)
    {
        $this->model= model::class;
        $this->account= \App\Models\admins::where('apiToken',$request->header('Authorization'))->first();
    }
    public function index(Request $request)
    {
        $records= $this->model::query()->with(['category','city']);
        if($this->account->estates_id )
            $records->where('id',$this->account->estates_id);

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
    public function store(Request $request)
    {
        if(admins::where('email',$request->email)->count()){
            return response()->json(['status'=>403]);
        }
        if(admins::where('phone',$request->phone)->count()){
            return response()->json(['status'=>404]);
        }
        $location = locations::createUpdate(['latitude'=>$request->location['lat'],'longitude'=>$request->location['lng']]);
        $request->offsetSet('locations_id',$location->id);
        $estate = $this->model::create($request->all());
        admins::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'estates_id'=>$estate->id,
            'apiToken'=>\App\Http\Controllers\Apis\Helper\helper::UniqueRandomXChar(70,['admins'])
        ]);
        return response()->json(['status'=>200]);
    }
    public function update(Request $request, $id)
    {
        // locations::createUpdate(['latitude'=>$request->location['lat'],'longitude'=>$request->location['lng']]);
        $record= $this->model::where('id',$id)->update( ($request->all()));
        return response()->json(['status'=>200]);
    }

    public function show( $id)
    {
        $record= $this->model::with(['category','city'])->findOrFail($id);
        if($this->account->estates_id )
            $record=  $record->where('id',$this->account->estates_id)->first();

        $record['attachs']= $record->attachments;
        return response()->json([
                'status'=>200,
                 'record'=>$record]);
    }

}
