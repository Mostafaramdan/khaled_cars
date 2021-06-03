<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyEmployeeController extends Controller
{
    public function index(){
        $companies_employees = employees::with(['companies:id,name'])
            ->where('companies_id','!=',null)
            ->get();
        return view('admin.companies_employees.index',compact('companies_employees'));
    }

    public function destroy(Request $request){
        $company_employee = employees::findOrFail($request->id);
        $company_employee->delete();
        toastr()->success('تم حذف الموظف بنجاح');
        return redirect()->route('companies_employees.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:employees',
            'phone' => 'required',
            'password' => 'required',
            'companies_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الموظف.');
            return redirect()->route('companies_employees.index');
        }
        $company_employee = new employees();
        $company_employee->name                = $request->name;
        $company_employee->email               = $request->email;
        $company_employee->phone               = $request->phone;
        $company_employee->companies_id        = $request->companies_id;
        $company_employee->apiToken            = Str::random(64);
        $company_employee->password            = Hash::make($request->password);
        $company_employee->save();
        toastr()->success('تم اضافة الموظف بنجاح!');
        return redirect()->route('companies_employees.index');
    }

    public function edit($id)
    {
        $company_employee = employees::where('id', '=', $id)->first();
        return view('admin.companies_employees.edit', compact('company_employee'));
    }

    public function update(Request $request,$id){

        $company_employee = employees::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
            'companies_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الموظف.');
            return redirect()->route('companies_employees.index');
        }
        $company_employee->name                = $request->name;
        $company_employee->email               = $request->email;
        $company_employee->phone               = $request->phone;
        $company_employee->companies_id        = $request->companies_id;
        $company_employee->apiToken            = Str::random(64);
        $company_employee->password            = Hash::make($request->password);
        $company_employee->update();

        toastr()->success('تم تعديل الموظف بنجاح!');
        return redirect()->route('companies_employees.index');
    }
}
