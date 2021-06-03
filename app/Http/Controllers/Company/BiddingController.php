<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\biddings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BiddingController extends Controller
{
    public function index(){
        $c_biddings = biddings::with(['products'])->where('companies_id','=',auth('company')->user()->id)
            ->get();
        return view('company.c_biddings.index',compact('c_biddings'));
    }

    public function show($id){

        $c_bidding = biddings::with(['products'])->where('biddings.id','=', $id)
            ->first();
        if($c_bidding->companies_id == auth('company')->user()->id){
            return view('company.c_biddings.show',compact('c_bidding'));
        }
        else{
            abort(403, 'Unauthorized');
        }

    }

    public function destroy(Request $request){
        $c_bidding = biddings::findOrFail($request->id);
        $c_bidding->delete();
        toastr()->success('تم حذف المزاد بنجاح');
        return redirect()->route('c_biddings.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'products_id' => 'required',
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة المزاد.');
            return redirect()->route('c_biddings.index');
        }
        $c_bidding = new biddings();
        $c_bidding->products_id          = $request->products_id;
        $c_bidding->Insurance            = $request->Insurance;
        $c_bidding->min_auction          = $request->min_auction;
        $c_bidding->type                 = $request->type;
        $c_bidding->companies_id         = auth('company')->user()->id;


        $c_bidding->save();
        toastr()->success('تم اضافة المزاد بنجاح!');
        return redirect()->route('c_biddings.index');
    }

    public function edit($id)
    {
        $c_bidding = biddings::where('id', '=', $id)->first();
        if($c_bidding->companies_id == auth('company')->user()->id){
            return view('company.c_biddings.edit', compact('c_bidding'));
        }
        else{
            abort(403, 'Unauthorized');
        }
    }

    public function updateStatus( Request $request, $id)
    {
        $c_bidding = biddings::where('id', '=', $id)->first();
        if($c_bidding->type ==  'open')
        {
            $c_bidding->type   = 'close';
            $c_bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('c_biddings.index');
        } elseif($c_bidding->type == 'close') {
            $c_bidding->type = 'open';
            $c_bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('c_biddings.index');
        }
    }

    public function update(Request $request,$id){

        $c_bidding = biddings::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'products_id' => 'required',
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المزاد.');
            return redirect()->route('c_biddings.index');
        }

        $c_bidding->products_id          = $request->products_id;
        $c_bidding->Insurance            = $request->Insurance;
        $c_bidding->min_auction          = $request->min_auction;
        $c_bidding->type                 = $request->type;
        $c_bidding->companies_id         = auth('company')->user()->id;
        $c_bidding->update();

        toastr()->success('تم تعديل المزاد بنجاح!');
        return redirect()->route('c_biddings.index');
    }

}
