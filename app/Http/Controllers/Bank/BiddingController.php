<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\biddings;
use Illuminate\Support\Facades\Validator;

class BiddingController extends Controller
{
    public function index(){
        $b_biddings = biddings::with(['products'])->where('banks_id','=',auth('bank')->user()->id)
            ->get();
        return view('bank.b_biddings.index',compact('b_biddings'));
    }

    public function show($id){

        $b_bidding = biddings::with(['products'])->where('biddings.id','=', $id)
            ->first();
        if($b_bidding->banks_id == auth('bank')->user()->id){
            return view('bank.b_biddings.show',compact('b_bidding'));
        }
        else{
            abort(403, 'Unauthorized');
        }

    }

    public function destroy(Request $request){
        $b_bidding = biddings::findOrFail($request->id);
        $b_bidding->delete();
        toastr()->success('تم حذف المزاد بنجاح');
        return redirect()->route('b_biddings.index');
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
            return redirect()->route('b_biddings.index');
        }
        $b_bidding = new biddings();
        $b_bidding->products_id          = $request->products_id;
        $b_bidding->Insurance            = $request->Insurance;
        $b_bidding->min_auction          = $request->min_auction;
        $b_bidding->type                 = $request->type;
        $b_bidding->banks_id         = auth('bank')->user()->id;


        $b_bidding->save();
        toastr()->success('تم اضافة المزاد بنجاح!');
        return redirect()->route('b_biddings.index');
    }

    public function edit($id)
    {
        $b_bidding = biddings::where('id', '=', $id)->first();
        if($b_bidding->banks_id == auth('bank')->user()->id){
            return view('bank.b_biddings.edit', compact('b_bidding'));
        }
        else{
            abort(403, 'Unauthorized');
        }
    }

    public function updateStatus( Request $request, $id)
    {
        $b_bidding = biddings::where('id', '=', $id)->first();
        if($b_bidding->type ==  'open')
        {
            $b_bidding->type   = 'close';
            $b_bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('b_biddings.index');
        } elseif($b_bidding->type == 'close') {
            $b_bidding->type = 'open';
            $b_bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('b_biddings.index');
        }
    }

    public function update(Request $request,$id){

        $b_bidding = biddings::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'products_id' => 'required',
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المزاد.');
            return redirect()->route('b_biddings.index');
        }

        $b_bidding->products_id          = $request->products_id;
        $b_bidding->Insurance            = $request->Insurance;
        $b_bidding->min_auction          = $request->min_auction;
        $b_bidding->type                 = $request->type;
        $b_bidding->banks_id         = auth('bank')->user()->id;
        $b_bidding->update();

        toastr()->success('تم تعديل المزاد بنجاح!');
        return redirect()->route('b_biddings.index');
    }

}
