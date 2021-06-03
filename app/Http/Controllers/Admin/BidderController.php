<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bidders;
use Illuminate\Support\Facades\Validator;

class BidderController extends Controller
{
    public function index(){
        $bidders = bidders::with(['users','biddings'])->get();
        return view('admin.bidders.index',compact('bidders'));
    }

    public function destroy(Request $request){
        $bidder = bidders::findOrFail($request->id);
        $bidder->delete();
        toastr()->success('تم حذف المزايدة بنجاح');
        return redirect()->route('bidders.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'biddings_id' => 'required',
            'users_id' => 'required',
            'price' => 'required|numeric',
        ]);
        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة المزايدة.');
            return redirect()->route('bidders.index');
        }
        $bidder = new bidders();
        $bidder->biddings_id          = $request->biddings_id;
        $bidder->users_id             = $request->users_id;
        $bidder->price                = $request->price;

        $bidder->save();
        toastr()->success('تم اضافة المزايدة بنجاح!');
        return redirect()->route('bidders.index');
    }

    public function edit($id)
    {
        $bidder = bidders::where('id', '=', $id)->first();
        return view('admin.bidders.edit', compact('bidder'));
    }


    public function update(Request $request,$id){
        $bidder = bidders::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'biddings_id' => 'required',
            'users_id' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المزايدة.');
            return redirect()->route('bidders.index');
        }
        $bidder->biddings_id          = $request->biddings_id;
        $bidder->users_id             = $request->users_id;
        $bidder->price                = $request->price;
        $bidder->update();

        toastr()->success('تم تعديل المزايدة بنجاح!');
        return redirect()->route('bidders.index');
    }

}
