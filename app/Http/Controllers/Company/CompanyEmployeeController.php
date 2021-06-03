<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyEmployeeController extends Controller
{
    public function index(){
        $c_employees = employees::with(['banks'])->where('companies_id','=',auth('company')->user()->id)
            ->get();
        return view('company.c_employees.index',compact('c_employees'));
    }

    public function destroy(Request $request){
        $c_employee = employees::findOrFail($request->id);
        $c_employee->delete();
        toastr()->success('تم حذف الموظف بنجاح');
        return redirect()->route('c_employees.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:employees',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الموظف.');
            return redirect()->route('c_employees.index');
        }
        $c_employee = new employees();
        $c_employee->name                = $request->name;
        $c_employee->email               = $request->email;
        $c_employee->phone               = $request->phone;
        $c_employee->companies_id        = auth('company')->user()->id;
        $c_employee->apiToken            = Str::random(64);
        $c_employee->password            = Hash::make($request->password);
        $c_employee->save();
        toastr()->success('تم اضافة الموظف بنجاح!');
        return redirect()->route('c_employees.index');
    }

    public function edit($id)
    {
        $c_employee = employees::where('id', '=', $id)->first();

        if($c_employee->companies_id == auth('company')->user()->id){
            return view('company.c_employees.edit', compact('c_employee'));
        }
        else{
            abort(403, 'Unauthorized');
        }
    }

    public function update(Request $request,$id){

        $c_employee = employees::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الموظف.');
            return redirect()->route('c_employees.index');
        }
        $c_employee->name                = $request->name;
        $c_employee->email               = $request->email;
        $c_employee->phone               = $request->phone;
        $c_employee->companies_id        = auth('company')->user()->id;
        $c_employee->apiToken            = Str::random(64);
        $c_employee->password            = Hash::make($request->password);
        $c_employee->update();

        toastr()->success('تم تعديل الموظف بنجاح!');
        return redirect()->route('c_employees.index');
    }
}
