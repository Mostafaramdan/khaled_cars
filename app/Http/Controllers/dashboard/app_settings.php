<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\app_settings as model;

class app_settings extends dashboard
{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        if(\App\Models\admins::where('apiToken',$request->header('Authorization'))->first()->estates_id )
            abort(403);
        $record= $this->model::first();

        return response()->json([
            "status"=>200,
            "record"=>$record,
        ]);
    }
}
