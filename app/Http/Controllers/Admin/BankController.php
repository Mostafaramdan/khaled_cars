<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banks;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BankController extends Controller
{
    public function index(){
        $banks = banks::all();
        return view('admin.banks.index',compact('banks'));
    }

    public function destroy(Request $request){
        $bank = banks::findOrFail($request->id);
        $bank->delete();
        toastr()->success('تم حذف البنك بنجاح');
        return redirect()->route('banks.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:banks',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة البنك.');
            return redirect()->route('banks.index');
        }
        $bank = new banks();
        $bank->name                = $request->name;
        $bank->email               = $request->email;
        $bank->phone               = $request->phone;
        $bank->is_active           = 1;
        $bank->apiToken            = Str::random(10);
        $bank->password            = Hash::make($request->password);
        $bank->save();
        toastr()->success('تم اضافة البنك بنجاح!');
        return redirect()->route('banks.index');

    }

    public function edit($id)
    {
        $bank = banks::where('id', '=', $id)->first();
        return view('admin.banks.edit', compact('bank'));
    }

    public function updateStatus( Request $request, $id)
    {
        $bank = banks::where('id', '=', $id)->first();
        if($bank->is_active ==  1)
        {
            $bank->is_active   = 0;
            $bank->update();
            toastr()->success('تم تحديث حالة البنك بنجاح');
            return redirect()->route('banks.index');
        } elseif($bank->is_active == 0) {
            $bank->is_active = 1;
            $bank->update();
            toastr()->success('تم تحديث حالة البنك بنجاح');
            return redirect()->route('banks.index');
        }
    }

    public function update(Request $request,$id){

        $bank = banks::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل البنك.');
            return redirect()->route('banks.index');
        }
        $bank->name                = $request->name;
        $bank->email               = $request->email;
        $bank->phone               = $request->phone;
        $bank->password            = Hash::make($request->password);
        $bank->update();

        toastr()->success('تم تعديل البنك بنجاح!');
        return redirect()->route('banks.index');
    }

}
