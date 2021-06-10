<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\biddings;

class BiddingController extends Controller
{
    public function index(){

        if(auth('employee')->user()->traders_id !== null){
            $c_biddings = biddings::with(['trader'])
                ->where('traders_id','=',auth('employee')->user()->traders_id)
                ->paginate(self::$itemPerPage);
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
