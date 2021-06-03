<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BankEmployeeController extends Controller
{
    public function index(){
        $banks_employees = employees::with(['banks:id,name'])
            ->where('banks_id','!=',null)
            ->get();
        return view('admin.banks_employees.index',compact('banks_employees'));
    }

    public function destroy(Request $request){
        $bank_employee = employees::findOrFail($request->id);
        $bank_employee->delete();
        toastr()->success('تم حذف الموظف بنجاح');
        return redirect()->route('banks_employees.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:banks',
            'phone' => 'required',
            'password' => 'required',
            'banks_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الموظف.');
            return redirect()->route('banks_employees.index');
        }
        $bank_employee = new employees();
        $bank_employee->name                = $request->name;
        $bank_employee->email               = $request->email;
        $bank_employee->phone               = $request->phone;
        $bank_employee->banks_id            = $request->banks_id;
        $bank_employee->apiToken            = Str::random(64);
        $bank_employee->password            = Hash::make($request->password);
        $bank_employee->save();
        toastr()->success('تم اضافة الموظف بنجاح!');
        return redirect()->route('banks_employees.index');
    }

    public function edit($id)
    {
        $bank_employee = employees::where('id', '=', $id)->first();
        return view('admin.banks_employees.edit', compact('bank_employee'));
    }

    public function update(Request $request,$id){

        $bank_employee = employees::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
            'banks_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الموظف.');
            return redirect()->route('banks_employees.index');
        }
        $bank_employee->name                = $request->name;
        $bank_employee->email               = $request->email;
        $bank_employee->phone               = $request->phone;
        $bank_employee->banks_id        = $request->banks_id;
        $bank_employee->apiToken            = Str::random(64);
        $bank_employee->password            = Hash::make($request->password);
        $bank_employee->update();

        toastr()->success('تم تعديل الموظف بنجاح!');
        return redirect()->route('banks_employees.index');
    }
}
