<?php

namespace App\Http\Controllers\Trader;

use App\Http\Controllers\Controller;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(){
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $c_employees = employees::with(['trader'])
            ->where('traders_id','=',auth('trader')->user()->id);

        if ($keyword != null) {
            $c_employees = employees::where('traders_id','=',auth('bank')->user()->id)
                ->where('name', 'LIKE', "%{$keyword}%")
                ->where('traders_id','=',auth('bank')->user()->id)
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->where('traders_id','=',auth('bank')->user()->id)
                ->orWhere('phone', 'LIKE', "%{$keyword}%")
                ->where('traders_id','=',auth('bank')->user()->id);
        }
        $c_employees = $c_employees->paginate($limit_by);
        return view('trader.c_employees.index',compact('c_employees'));
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
        $c_employee->traders_id        = auth('trader')->user()->id;
        $c_employee->apiToken            = Str::random(64);
        $c_employee->password            = Hash::make($request->password);
        $c_employee->save();
        toastr()->success('تم اضافة الموظف بنجاح!');
        return redirect()->route('c_employees.index');
    }

    public function edit($id)
    {
        $c_employee = employees::where('id', '=', $id)->first();

        if($c_employee->traders_id == auth('trader')->user()->id){
            return view('trader.c_employees.edit', compact('c_employee'));
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
        $c_employee->traders_id        = auth('trader')->user()->id;
        $c_employee->apiToken            = Str::random(64);
        if($request->password !== null){
            $c_employee->password            = Hash::make($request->password);
        }
        $c_employee->update();

        toastr()->success('تم تعديل الموظف بنجاح!');
        return redirect()->route('c_employees.index');
    }
}
