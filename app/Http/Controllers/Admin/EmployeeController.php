<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\traders;
use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $type = (isset(\request()->type) && \request()->type != '') ? \request()->type : null;
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "show_employee") !== true) {
                abort('403', 'You don\'t have this permission');
            }
            $banks = traders::where('type', '=', 'bank')->get();
            $companies = traders::where('type', '=', 'company')->get();
            $employees = employees::with(['trader:id,name,type']);

            if ($keyword != null) {
                if ($type == null) {
                    $employees = employees::with(['trader']);
                    $employees->whereHas('trader', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%");
                    })
                        ->orWhere('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('phone', 'LIKE', "%{$keyword}%")
                        ->orWhere('email', 'LIKE', "%{$keyword}%");
                } elseif ($type != null) {
                    $employees = employees::whereHas('trader', function ($query) use ($keyword, $type) {
                        $query->where('type', '=', $type)->orwhere('name', 'LIKE', "%{$keyword}%");
                    });
                    $employees->where('name', 'LIKE', "%{$keyword}%")
                        ->whereHas('trader', function ($query) use ($keyword, $type) {
                            $query->where('type', '=', $type)->orwhere('name', 'LIKE', "%{$keyword}%");
                        })
                        ->orWhere('phone', 'LIKE', "%{$keyword}%")
                        ->whereHas('trader', function ($query) use ($keyword, $type) {
                            $query->where('type', '=', $type)->orwhere('name', 'LIKE', "%{$keyword}%");
                        })
                        ->orWhere('email', 'LIKE', "%{$keyword}%")
                        ->whereHas('trader', function ($query) use ($keyword, $type) {
                            $query->where('type', '=', $type)->orwhere('name', 'LIKE', "%{$keyword}%");
                        });
                }
            }
            if ($type != null && $keyword == null) {
                $employees = employees::whereHas('trader', function ($query) use ($type) {
                    $query->where('type', '=', $type);
                });
            }
            $employees = $employees->paginate($limit_by);
            return view('admin.employees.index', compact('employees', 'banks', 'companies'));
        } elseif (auth('trader')->check()) {
            $employees = employees::with(['trader'])
                ->where('traders_id', '=', auth('trader')->user()->id);

            if ($keyword != null) {
                $employees = employees::where('traders_id', '=', auth('trader')->user()->id)
                    ->where('name', 'LIKE', "%{$keyword}%")
                    ->where('traders_id', '=', auth('trader')->user()->id)
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->where('traders_id', '=', auth('trader')->user()->id)
                    ->orWhere('phone', 'LIKE', "%{$keyword}%")
                    ->where('traders_id', '=', auth('trader')->user()->id);
            }
            $employees = $employees->paginate($limit_by);
            return view('admin.employees.index', compact('employees'));
        }
    }

    public function destroy(Request $request)
    {
        if(auth('admin')->check()){
            if (str_contains(auth('admin')->user()->permissions, "delete_employee") !== true) {
                abort('403', 'You don\'t have this permission');
            }
        }
        $employee = employees::findOrFail($request->id);
        $employee->delete();
        toastr()->success('???? ?????? ???????????? ??????????');
        return redirect()->route('employees.index');
    }

    public function store(Request $request)
    {
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "add_employee") !== true) {
                abort('403', 'You don\'t have this permission');
            }
        }
        if (auth('admin')->check()){
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:employees',
                'phone' => 'required',
                'password' => 'required',
                'traders_id' => 'required',
            ]);
        }
        elseif (auth('trader')->check()) {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:employees',
                'phone' => 'required',
                'password' => 'required',
            ]);
        }
        if ($validate->fails()) {
            toastr()->error('???????? ?????? ???????????????? ?????????????? ?? ???? ?????? ?????????? ????????????.');
            return redirect()->route('employees.index');
        }
        $employee = new employees();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        if (auth('admin')->check()) {
            $employee->traders_id = $request->traders_id;
        } elseif (auth('trader')->check()) {
            $employee->traders_id = auth('trader')->user()->id;
        }

        $employee->apiToken = Str::random(64);
        $employee->password = Hash::make($request->password);
        $employee->save();
        toastr()->success('???? ?????????? ???????????? ??????????!');
        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $employee = employees::where('id', '=', $id)->first();
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "edit_employee") !== true) {
                abort('403', 'You don\'t have this permission');
            }
            $banks = traders::where('type', '=', 'bank')->get();
            $companies = traders::where('type', '=', 'company')->get();
            return view('admin.employees.edit', compact('employee', 'banks', 'companies'));
        }
        elseif(auth('trader')->check()){

            if($employee->traders_id == auth('trader')->user()->id){
                return view('admin.employees.edit', compact('employee'));
            }
            else{
                abort(403, 'Unauthorized');
            }
        }

    }

    public function update(Request $request, $id)
    {
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "edit_employee") !== true) {
                abort('403', 'You don\'t have this permission');
            }
        }
        $employee = employees::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|between:10000000,999999999999999|unique:employees,phone,' . $employee->id,
            'password' => 'nullable',
            'traders_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('???????? ?????? ???????????????? ?????????????? ?? ???? ?????? ?????????? ????????????.');
            return redirect()->route('employees.index');
        }
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        if (auth('admin')->check()) {
            if ($request->traders_id !== null) {
                $employee->traders_id = $request->traders_id;
            }
        }
        $employee->apiToken = Str::random(64);
        if ($request->password !== null) {
            $employee->password = Hash::make($request->password);
        }
        $employee->update();

        toastr()->success('???? ?????????? ???????????? ??????????!');
        return redirect()->route('employees.index');
    }
}
