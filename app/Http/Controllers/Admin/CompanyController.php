<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\companies;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(){
        $companies = companies::all();
        return view('admin.companies.index',compact('companies'));
    }

    public function destroy(Request $request){
        $company = companies::findOrFail($request->id);
        $company->delete();
        toastr()->success('تم حذف الشركة بنجاح');
        return redirect()->route('companies.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:companies',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الشركة.');
            return redirect()->route('companies.index');
        }
        $company = new companies();
        $company->name                = $request->name;
        $company->email               = $request->email;
        $company->phone               = $request->phone;
        $company->is_active           = 1;
        $company->apiToken            = Str::random(64);
        $company->password            = Hash::make($request->password);
        $company->save();
        toastr()->success('تم اضافة الشركة بنجاح!');
        return redirect()->route('companies.index');
    }

    public function edit($id)
    {
        $company = companies::where('id', '=', $id)->first();
        return view('admin.companies.edit', compact('company'));
    }

    public function updateStatus( Request $request, $id)
    {
        $company = companies::where('id', '=', $id)->first();
        if($company->is_active ==  1)
        {
            $company->is_active   = 0;
            $company->update();
            toastr()->success('تم تحديث حالة الشركة بنجاح');
            return redirect()->route('companies.index');
        } elseif($company->is_active == 0) {
            $company->is_active = 1;
            $company->update();
            toastr()->success('تم تحديث حالة الشركة بنجاح');
            return redirect()->route('companies.index');
        }
    }

    public function update(Request $request,$id){

        $company = companies::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الشركة.');
            return redirect()->route('companies.index');
        }
        $company->name                = $request->name;
        $company->email               = $request->email;
        $company->phone               = $request->phone;
        $company->password            = Hash::make($request->password);
        $company->update();

        toastr()->success('تم تعديل الشركة بنجاح!');
        return redirect()->route('companies.index');
    }
}
