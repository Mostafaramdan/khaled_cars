<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboard extends Controller
{
    protected $model;
    public  $admin;
    
    public function index(Request $request)
    {
        $records= $this->model::query();
        if($request->search){
            // $records->where()
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


    public function store(Request $request)
    {
        $this->model::create($request->all());
        return response()->json(['status'=>200]);
    }

    public function show( $id)
    {
        return response()->json(['status'=>200, 'record'=>$this->model::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $record= $this->model::where('id',$id)->update( ($request->all()));
        return response()->json(['status'=>200]);
    }

    public function destroy($id)
    {
        $this->model::destroy($id);
        return response()->json(['status'=>200]);
    }
    public static function toggle ($model, $column, $id)
    {
        $model = "\App\Models\\".$model ;
        $record = $model::findOrFail($id);
        if($record->$column){
            $record->$column=0;
        }else{
            $record->$column=1;
        }
        $record->save();
        return response()->json(['status'=>200,$record]);
    }
}
