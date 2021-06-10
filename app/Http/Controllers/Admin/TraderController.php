<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\traders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TraderController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_trader") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $type = (isset(\request()->type) && \request()->type != '') ? \request()->type : null;

        $traders = traders::where('id', '!=', null);
        if ($keyword != null) {
            if ($type == null) {
                $traders = traders::where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$keyword}%");
            } elseif ($type != null) {
                $traders = traders::where('type','=', $type)->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")->where('type','=', $type)
                    ->orWhere('phone', 'LIKE', "%{$keyword}%")->where('type','=', $type);
            }
        }
        if ($type != null && $keyword == null) {
            $traders = traders::where('type', '=', $type);
        }
        $traders = $traders->paginate($limit_by);
        return view('admin.traders.index',compact('traders'));
    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_trader") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $trader = traders::findOrFail($request->id);
        $trader->delete();
        toastr()->success('تم حذف التاجر بنجاح');
        return redirect()->route('traders.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_trader") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|unique:traders',
            'phone'    => 'required',
            'password' => 'required',
            'type'     => 'required|in:company,bank',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة التاجر.');
            return redirect()->route('traders.index');
        }
        $trader = new traders();
        $trader->name                = $request->name;
        $trader->email               = $request->email;
        $trader->phone               = $request->phone;
        $trader->type                = $request->type;
        $trader->is_active           = 1;
        $trader->apiToken            = Str::random(64);
        $trader->password            = Hash::make($request->password);
        $trader->save();
        toastr()->success('تم اضافة التاجر بنجاح!');
        return redirect()->route('traders.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_trader") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $trader = traders::where('id', '=', $id)->first();
        return view('admin.traders.edit', compact('trader'));
    }

    public function updateStatus( Request $request, $id)
    {

        $trader = traders::where('id', '=', $id)->first();
        if($trader->is_active ==  1)
        {
            $trader->is_active   = 0;
            $trader->update();
            toastr()->success('تم تحديث حالة التاجر بنجاح');
            return redirect()->route('traders.index');
        } elseif($trader->is_active == 0) {
            $trader->is_active = 1;
            $trader->update();
            toastr()->success('تم تحديث حالة التاجر بنجاح');
            return redirect()->route('traders.index');
        }
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_trader") !== true)
        {
            abort('403','You don\'t have this permission');
        }

        $trader = traders::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'type' => 'required|in:company,bank',
            'phone' => 'required|numeric|between:10000000,999999999999999|unique:traders,phone,'. $trader->id,
            'password' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل التاجر.');
            return redirect()->route('traders.index');
        }

        $trader->name                = $request->name;
        $trader->email               = $request->email;
        $trader->phone               = $request->phone;
        $trader->type                = $request->type;
        if($request->password !==null) {
            $trader->password = Hash::make($request->password);
        }
        $trader->update();

        toastr()->success('تم تعديل التاجر بنجاح!');
        return redirect()->route('traders.index');
    }
}
