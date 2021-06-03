<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\biddings;
use Illuminate\Support\Facades\Validator;

class BiddingController extends Controller
{
    public function index(){
        $biddings = biddings::with(['products'])->get();
        return view('admin.biddings.index',compact('biddings'));
    }

    public function show($id){
        $bidding = biddings::with(['products','companies','banks'])
            ->where('biddings.id','=', $id)->first();
        return view('admin.biddings.show',compact('bidding'));
    }

    public function destroy(Request $request){
        $bidding = biddings::findOrFail($request->id);
        $bidding->delete();
        toastr()->success('تم حذف المزاد بنجاح');
        return redirect()->route('biddings.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'products_id' => 'required',
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
            'companies_id' => 'nullable',
            'banks_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة المزاد.');
            return redirect()->route('biddings.index');
        }
        $bidding = new biddings();
        $bidding->products_id          = $request->products_id;
        $bidding->Insurance            = $request->Insurance;
        $bidding->min_auction          = $request->min_auction;
        $bidding->type                 = $request->type;
        $bidding->companies_id         = $request->companies_id;
        $bidding->banks_id             = $request->banks_id;


        $bidding->save();
        toastr()->success('تم اضافة المزاد بنجاح!');
        return redirect()->route('biddings.index');
    }

    public function edit($id)
    {
        $bidding = biddings::where('id', '=', $id)->first();
        return view('admin.biddings.edit', compact('bidding'));
    }

    public function updateStatus( Request $request, $id)
    {
        $bidding = biddings::where('id', '=', $id)->first();
        if($bidding->type ==  'open')
        {
            $bidding->type   = 'close';
            $bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('biddings.index');
        } elseif($bidding->type == 'close') {
            $bidding->type = 'open';
            $bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('biddings.index');
        }
    }

    public function update(Request $request,$id){

        $bidding = biddings::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'products_id' => 'required',
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
            'companies_id' => 'nullable',
            'banks_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المزاد.');
            return redirect()->route('biddings.index');
        }
        $bidding->products_id          = $request->products_id;
        $bidding->Insurance            = $request->Insurance;
        $bidding->min_auction          = $request->min_auction;
        $bidding->type                 = $request->type;
        $bidding->companies_id         = $request->companies_id;
        $bidding->banks_id             = $request->banks_id;
        $bidding->update();

        toastr()->success('تم تعديل المزاد بنجاح!');
        return redirect()->route('biddings.index');
    }

}
