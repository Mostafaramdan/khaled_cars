<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\app_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "setting") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $settings = app_settings::find(2);
        return view('admin.settings.index',compact('settings'));
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "setting") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        if (str_contains(auth('admin')->user()->permissions, "edit") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $settings = app_settings::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'policyTerms_ar'   => 'nullable',
            'policyTerms_en'   => 'nullable',
            'aboutUs_ar'       => 'nullable',
            'aboutUs_en'       => 'nullable',
            'privacy_ar'       => 'nullable',
            'privacy_en'       => 'nullable',
            'emails'           => 'nullable',
            'phones'           => 'nullable',
            'fees'             => 'nullable|numeric',
            'min_days_to_paid' => 'nullable|numeric',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الاعدادات.');
            return redirect()->route('settings.index');
        }
        $em = explode(',', $request->emails);
        $ph = explode(',', $request->phones);

        $settings->policyTerms_ar     = $request->policyTerms_ar;
        $settings->policyTerms_en     = $request->policyTerms_en;
        $settings->aboutUs_ar         = $request->aboutUs_ar;
        $settings->aboutUs_en         = $request->aboutUs_en;
        $settings->privacy_ar         = $request->privacy_ar;
        $settings->privacy_en         = $request->privacy_en;
        if($request->emails !== null){$settings->emails = $em;}
        if($request->phones !== null){$settings->phones = $ph;}
        $settings->fees               = $request->fees;
        $settings->min_days_to_paid   = $request->min_days_to_paid;

        $settings->update();

        toastr()->success('تم تعديل الاعدادات بنجاح!');
        return redirect()->route('settings.index');

    }
}
