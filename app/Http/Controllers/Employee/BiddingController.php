<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\biddings;

class BiddingController extends Controller
{
    public function index(){

        if(auth('employee')->user()->companies_id !== null){
            $c_biddings = biddings::with(['companies'])
                ->where('companies_id','=',auth('employee')->user()->companies_id)
                ->get();
            return view('employee.c_biddings.index',compact('c_biddings'));
        }
        elseif(auth('employee')->user()->banks_id !== null){
            $c_biddings = biddings::with(['companies'])
                ->where('banks_id','=',auth('employee')->user()->banks_id)
                ->get();

            return view('employee.c_biddings.index',compact('c_biddings'));
        }
        else{
            abort(403, 'Unauthorized');
        }
    }

    public function redirect(){
        return redirect()->route('e_biddings.index');
    }

}
