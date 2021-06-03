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
    public function index(){
        $admins = admins::all();
        return view('admin.admins.index',compact('admins'));
    }


    public function destroy(Request $request){
        $admin = admins::findOrFail($request->id);
        $admin->delete();
        toastr()->success('تم حذف المدير بنجاح');
        return redirect()->route('admins.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:admins',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة المدير.');
            return redirect()->route('admins.index');
        }
        $admin = new admins();
        $admin->name                = $request->name;
        $admin->email               = $request->email;
        $admin->phone               = $request->phone;
        $admin->is_active           = 1;
        $admin->permissions         = $request->permissions;
        $admin->apiToken            = Str::random(64);
        $admin->password            = Hash::make($request->password);
        $admin->save();
        toastr()->success('تم اضافة المدير بنجاح!');
        return redirect()->route('admins.index');
    }

    public function edit($id)
    {
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

        $admin = admins::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المدير.');
            return redirect()->route('admins.index');
        }
        $admin->name                = $request->name;
        $admin->email               = $request->email;
        $admin->phone               = $request->phone;
        $admin->permissions         = $request->permissions;
        $admin->password            = Hash::make($request->password);
        $admin->update();

        toastr()->success('تم تعديل المدير بنجاح!');
        return redirect()->route('admins.index');
    }
}
