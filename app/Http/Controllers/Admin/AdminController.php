<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        if (str_contains(auth('admin')->user()->permissions, "show_admin") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $admins = admins::where('id', '!=', null);
        if ($keyword != null) {
            $admins = $admins->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('phone', 'LIKE', "%{$keyword}%");
        }
        $admins = $admins->paginate($limit_by);
        return view('admin.admins.index',compact('admins'));
    }


    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_admin") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $admin = admins::findOrFail($request->id);
        $admin->delete();
        toastr()->success('تم حذف المدير بنجاح');
        return redirect()->route('admins.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_admin") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'name' =>       'required',
            'email' =>      'required|unique:admins',
            'phone'    =>   'required|numeric|between:10000000,999999999999999|unique:admins',
            'password' =>   'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم اضافة المدير.');
            return redirect()->route('admins.index');
        }
        $admin = new admins();
        $admin->name                = $request->name;
        $admin->email               = $request->email;
        $admin->phone               = $request->phone;
        $admin->is_active           = 1;
        if($request->permissions !==null)
        {
            $permissions = implode(',', $request->permissions);
            $admin->permissions         = $permissions;
        } elseif ($request->permissions == null){
            $admin->permissions = 'show';
        }

        $admin->apiToken            = Str::random(64);
        $admin->password            = Hash::make($request->password);
        $admin->save();
        toastr()->success('تم اضافة المدير بنجاح!');
        return redirect()->route('admins.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_admin") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $admin = admins::where('id', '=', $id)->first();
        return view('admin.admins.edit', compact('admin'));
    }

    public function updateStatus( Request $request, $id)
    {
        $admin = admins::where('id', '=', $id)->first();
        if($admin->is_active ==  1)
        {
            $admin->is_active   = 0;
            $admin->update();
            toastr()->success('تم تحديث حالة المدير بنجاح');
            return redirect()->route('admins.index');
        } elseif($admin->is_active == 0) {
            $admin->is_active = 1;
            $admin->update();
            toastr()->success('تم تحديث حالة المدير بنجاح');
            return redirect()->route('admins.index');
        }
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_admin") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $admin = admins::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|between:10000000,999999999999999|unique:admins,phone,'. $admin->id,
            'password' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المدير.');
            return redirect()->route('admins.index');
        }
        $admin->name                = $request->name;
        $admin->email               = $request->email;
        $admin->phone               = $request->phone;
        if($request->permissions !==null)
        {
            $permissions = implode(',', $request->permissions);
            $admin->permissions         = $permissions;
        } elseif ($request->permissions == null){
            $admin->permissions = 'show';
        }
        if($request->password !==null) {
            $admin->password = Hash::make($request->password);
        }
        $admin->update();

        toastr()->success('تم تعديل المدير بنجاح!');
        return redirect()->route('admins.index');
    }
}
