<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\orders as model;
use App\Models\housing_units;

class statistics extends dashboard
{
    function __construct(Request $request)
    {
        $this->model= model::class;
        $this->account= \App\Models\admins::where('apiToken',$request->header('Authorization'))->first();
    }
    public function index(Request $request)
    {
        $record=[
            'waiting'=> $this->model::admin($this->account->estates_id)->where('status','waiting')->count(),
            'coming'=> $this->model::admin($this->account->estates_id)->where('status','coming')->count(),
            'resident'=> $this->model::admin($this->account->estates_id)->where('status','resident')->count(),
            'finished'=> $this->model::admin($this->account->estates_id)->where('status','finished')->count(),
            'cancelled'=> $this->model::admin($this->account->estates_id)->where('status','cancelled')->count(),
            'refused'=> $this->model::admin($this->account->estates_id)->where('status','refused')->count(),
            'orders'=> $this->model::admin($this->account->estates_id)->whereIn('status',['waiting','coming','resident','finished'])->count(),
            'total'=> $this->model::admin($this->account->estates_id)->whereIn('status',['waiting','coming','resident','finished'])->sum('total'),
            'fees'=> $this->model::admin($this->account->estates_id)->whereIn('status',['waiting','coming','resident','finished'])->sum('fees'),
            'housing_units'=> housing_units::admin($this->account->estates_id)->count(),
        ];

        return response()->json([
            "status"=>200,
            "record"=>$record,
        ]);
    }
}
