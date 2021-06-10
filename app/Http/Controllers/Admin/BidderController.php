<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bidders;

class BidderController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_bidder") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $bidders = bidders::with(['user','bidding'])->paginate(self::$itemPerPage);
        return view('admin.bidders.index',compact('bidders'));
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
