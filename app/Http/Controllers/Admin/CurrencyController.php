<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\currencies;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function index(){
        $currencies = currencies::all();
        return view('admin.currencies.index',compact('currencies'));
    }


    public function destroy(Request $request){
        $currency = currencies::findOrFail($request->id);
        $currency->delete();
        toastr()->success('تم حذف العملة بنجاح');
        return redirect()->route('currencies.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code'            => 'required|max:10',
            'value_in_dollar' => 'required|numeric',
            'name_ar'         => 'required',
            'name_en'         => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة العملة.');
            return redirect()->route('currencies.index');
        }
        $currency = new currencies();
        $currency->code                = $request->code;
        $currency->value_in_dollar     = $request->value_in_dollar;
        $currency->is_active           = 1;
        $currency->name_ar             = $request->name_ar;
        $currency->name_en             = $request->name_en;

        $currency->save();
        toastr()->success('تم اضافة العملة بنجاح!');
        return redirect()->route('currencies.index');
    }

    public function edit($id)
    {
        $currency = currencies::where('id', '=', $id)->first();
        return view('admin.currencies.edit', compact('currency'));
    }

    public function updateStatus( Request $request, $id)
    {
        $currency = currencies::where('id', '=', $id)->first();
        if($currency->is_active ==  1)
        {
            $currency->is_active   = 0;
            $currency->update();
            toastr()->success('تم تحديث حالة العملة بنجاح');
            return redirect()->route('currencies.index');
        } elseif($currency->is_active == 0) {
            $currency->is_active = 1;
            $currency->update();
            toastr()->success('تم تحديث حالة العملة بنجاح');
            return redirect()->route('currencies.index');
        }
    }

    public function update(Request $request,$id){

        $currency = currencies::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'code'            => 'required|max:10',
            'value_in_dollar' => 'required|numeric',
            'name_ar'         => 'required',
            'name_en'         => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل العملة.');
            return redirect()->route('currencies.index');
        }
        $currency->code                = $request->code;
        $currency->value_in_dollar     = $request->value_in_dollar;
        $currency->is_active           = 1;
        $currency->name_ar             = $request->name_ar;
        $currency->name_en             = $request->name_en;
        $currency->update();

        toastr()->success('تم تعديل العملة بنجاح!');
        return redirect()->route('currencies.index');
    }
}
