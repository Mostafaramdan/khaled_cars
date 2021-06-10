<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\insurances;
use Illuminate\Support\Facades\Validator;

class InsuranceController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_insurance") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $insurances = insurances::with(['user','insurances_slide'])->paginate(self::$itemPerPage);
        return view('admin.insurances.index',compact('insurances'));
    }

    public function show($id){
        if (str_contains(auth('admin')->user()->permissions, "show_insurance") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $insurance = insurances::with(['user','insurances_slide','image'])
            ->where('id','=', $id)
            ->first();
        return view('admin.insurances.show',compact('insurance'));
    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_insurance") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $insurance = insurances::findOrFail($request->id);
        $insurance->delete();
        toastr()->success('تم حذف طلب الدفع بنجاح');
        return redirect()->route('insurances.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_insurance") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $insurance = insurances::where('id', '=', $id)->first();
        return view('admin.insurances.edit', compact('insurance'));
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_insurance") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $insurance = insurances::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'status'    => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل طلب الدفع.');
            return redirect()->route('insurances.index');
        }

        $insurance->status    = $request->status;
        $insurance->update();

        toastr()->success('تم تعديل طلب الدفع بنجاح!');
        return redirect()->route('insurances.index');
    }

}
