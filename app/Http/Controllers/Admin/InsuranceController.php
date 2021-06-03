<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\insurances;
use Illuminate\Support\Facades\Validator;

class InsuranceController extends Controller
{
    public function index(){
        $insurances = insurances::with(['users','biddings'])->get();
        return view('admin.insurances.index',compact('insurances'));
    }

    public function show($id){
        $insurance = insurances::with(['users','biddings','images'])
            ->where('id','=', $id)
            ->first();
        return view('admin.insurances.show',compact('insurance'));
    }

    public function destroy(Request $request){
        $insurance = insurances::findOrFail($request->id);
        $insurance->delete();
        toastr()->success('تم حذف طلب الدفع بنجاح');
        return redirect()->route('insurances.index');
    }

    public function edit($id)
    {
        $insurance = insurances::where('id', '=', $id)->first();
        return view('admin.insurances.edit', compact('insurance'));
    }

    public function update(Request $request,$id){

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
