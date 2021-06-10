<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;

class OrderController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_order") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sort_by = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'created_at';
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
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
        $order->delete();
        toastr()->success('تم حذف السيارة المباعة بنجاح');
        return redirect()->route('orders.index');
    }

    public function updateStatus( Request $request, $id)
    {
        $order = orders::where('id', '=', $id)->first();
        if($order->status ==  'waiting')
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

}
