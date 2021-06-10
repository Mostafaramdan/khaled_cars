<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\countries;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_country") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;

        $countries = countries::where('id', '!=', null);

        if ($keyword != null) {
            $countries = countries::where('name_ar', 'LIKE', "%{$keyword}%")
                ->orWhere('name_en', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%")
                ->orWhere('mobile_ex', 'LIKE', "%{$keyword}%")
                ->orWhere('call_key', 'LIKE', "%{$keyword}%");
        }
        $countries = $countries->paginate($limit_by);
        return view('admin.countries.index',compact('countries'));
    }


    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_country") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $country = countries::findOrFail($request->id);
        $country->delete();
        toastr()->success('تم حذف البلد بنجاح');
        return redirect()->route('countries.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_country") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'code' => 'required|max:2',
            'mobile_ex' => 'required|max:20',
            'call_key' => 'required|max:5',
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة البلد.');
            return redirect()->route('countries.index');
        }
        $country = new countries();
        $country->code                = $request->code;
        $country->mobile_ex           = $request->mobile_ex;
        $country->call_key            = $request->call_key;
        $country->is_active           = 1;
        $country->name_ar             = $request->name_ar;
        $country->name_en             = $request->name_en;

        $country->save();
        toastr()->success('تم اضافة البلد بنجاح!');
        return redirect()->route('countries.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_country") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $country = countries::where('id', '=', $id)->first();
        return view('admin.countries.edit', compact('country'));
    }

    public function updateStatus( Request $request, $id)
    {
        $country = countries::where('id', '=', $id)->first();
        if($country->is_active ==  1)
        {
            $country->is_active   = 0;
            $country->update();
            toastr()->success('تم تحديث حالة البلد بنجاح');
            return redirect()->route('countries.index');
        } elseif($country->is_active == 0) {
            $country->is_active = 1;
            $country->update();
            toastr()->success('تم تحديث حالة البلد بنجاح');
            return redirect()->route('countries.index');
        }
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_country") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $country = countries::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'code' => 'required|max:2',
            'mobile_ex' => 'required|max:20',
            'call_key' => 'required|max:5',
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل البلد.');
            return redirect()->route('countries.index');
        }
        $country->code                = $request->code;
        $country->mobile_ex           = $request->mobile_ex;
        $country->call_key            = $request->call_key;
        $country->name_ar             = $request->name_ar;
        $country->name_en             = $request->name_en;
        $country->update();

        toastr()->success('تم تعديل البلد بنجاح!');
        return redirect()->route('countries.index');
    }
}
