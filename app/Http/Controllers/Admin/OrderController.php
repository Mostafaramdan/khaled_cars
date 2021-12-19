<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\tokens;
use PDF;
use Mail;

class OrderController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_order") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sort_by = \request()->sort_by??'id';
        $order_by = \request()->order_by?? 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;

        $orders = orders::with(['bidder']);
        if ($status != null ) {
            $orders = orders::with(['bidder'])
                ->where('status', '=', $status);
        }
        $orders = $orders->orderBy($sort_by, $order_by);
        $orders = $orders->paginate($limit_by);

        return view('admin.orders.index',compact('orders'));
    }

    public function show($id){
        if (str_contains(auth('admin')->user()->permissions, "show_order") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $order = orders::with(['bidder'])
            ->where('id','=', $id)->first();
        return view('admin.orders.show',compact('order'));
    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_order") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $order = orders::findOrFail($request->id);
        $bidding= $order->bidder->bidding;
        $bidding->has_order= null;
        $bidding->save();
        $order->delete();
        toastr()->success('تم حذف السيارة المباعة بنجاح');
        return redirect()->route('orders.index');
    }

    public function updateStatus( Request $request, $id)
    {
        $order = orders::where('id', '=', $id)->first();
        if($order->status ==  'waiting' ||  $order->status == null)
        {
            $order->status   = 'coming';
            $order->update();
            toastr()->success('تم تحديث حالة السيارة المباعة بنجاح');
            return redirect()->route('orders.index');
        } elseif($order->status == 'coming') {
            $order->status = 'waiting';
            $order->update();
            toastr()->success('تم تحديث حالة السيارة المباعة بنجاح');
            return redirect()->route('orders.index');
        }
    }
    public static function pdf( $orderpdf  )
    {
        $order = orders::where('pdf',$orderpdf)->first();        
        if(!$order)abort(404);
        if(\request()->has('download'))
        {
            $pdf = PDF::loadView('pdf',compact('order'));
            return $pdf->download('order.pdf');
        }

        return view('pdf',compact('order'));
    }
}
