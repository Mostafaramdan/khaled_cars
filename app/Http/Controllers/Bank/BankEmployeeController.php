<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BankEmployeeController extends Controller
{
    public function index(){
        $b_employees = employees::with(['banks'])->where('banks_id','=',auth('bank')->user()->id)->get();
        return view('bank.b_employees.index',compact('b_employees'));
    }

    public function destroy(Request $request){
        $b_employee = employees::findOrFail($request->id);
        $b_employee->delete();
        toastr()->success('تم حذف الموظف بنجاح');
        return redirect()->route('b_employees.index');
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
            return redirect()->route('b_employees.index');
        }
        $b_employee = new employees();
        $b_employee->name                = $request->name;
        $b_employee->email               = $request->email;
        $b_employee->phone               = $request->phone;
        $b_employee->banks_id            = auth('bank')->user()->id;
        $b_employee->apiToken            = Str::random(64);
        $b_employee->password            = Hash::make($request->password);
        $b_employee->save();
        toastr()->success('تم اضافة الموظف بنجاح!');
        return redirect()->route('b_employees.index');
    }

    public function edit($id)
    {
        $b_employee = employees::where('id', '=', $id)->first();

        if($b_employee->banks_id == auth('bank')->user()->id){
            return view('bank.b_employees.edit', compact('b_employee'));
        }
        else{
            abort(403, 'Unauthorized');
        }
    }

    public function update(Request $request,$id){

        $b_employee = employees::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الموظف.');
            return redirect()->route('b_employees.index');
        }
        $b_employee->name                = $request->name;
        $b_employee->email               = $request->email;
        $b_employee->phone               = $request->phone;
        $b_employee->banks_id        = auth('bank')->user()->id;
        $b_employee->apiToken            = Str::random(64);
        $b_employee->password            = Hash::make($request->password);
        $b_employee->update();

        toastr()->success('تم تعديل الموظف بنجاح!');
        return redirect()->route('b_employees.index');
    }
}
