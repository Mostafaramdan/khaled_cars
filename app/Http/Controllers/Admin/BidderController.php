<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bidders;

class BidderController extends Controller
{
    public function index(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "show_bidder") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $bidders = bidders::with(['user','bidding'])->when($request->biddings_id,function($q) use ($request){
            return $q->where('biddings_id',$request->biddings_id);
        }); 
        $bidders->orderBy('id','DESC');
        if($request->biddings_id){
            $bidders =  $bidders->get();
        }else{
            $bidders = $bidders->paginate(self::$itemPerPage);
        }
        return view('admin.bidders.index',['bidders'=>$bidders,'biddings_id'=>$request->biddings_id]);
    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_bidder") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $bidder = bidders::findOrFail($request->id);
        $bidder->delete();
        toastr()->success('تم حذف المزايدة بنجاح');
        return redirect()->route('bidders.index');
    }

}
