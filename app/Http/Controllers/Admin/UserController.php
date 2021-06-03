<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index(){
        $users = users::all();
        return view('admin.users.index',compact('users'));
    }

    public function show($id){
        $user = users::with(['currencies:id,name_ar'])->where('id','=', $id)->first();
        return view('admin.users.show',compact('user'));

    }

    public function destroy(Request $request){
        $user = users::findOrFail($request->id);
        $user->delete();
        toastr()->success('تم حذف المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'    => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'password' => 'required',
            'currencies_id' => 'required|numeric',
            'lang' => 'required|in:ar,en',
            'image'   => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة المستخدم.');
            return redirect()->route('users.index');
        }
        $user = new users();
        $user->is_active        = 1;
        $user->name             = $request->name;
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        $user->lang             = $request->lang;
        $user->currencies_id    = $request->currencies_id;
        $user->password         = Hash::make($request->currencies_id);

        if ($image = $request->file('image')) {
            if ($user->image != '') {
                if (File::exists('assets/upload/user_image/' . $user->image)) {
                    unlink('assets/upload/user_image/' . $user->image);
                }
            }
            $filename =  Str::random(10).'.'.$image->getClientOriginalExtension();
            $path = public_path("assets/upload/user_image/" . $filename);
            Image::make($image->getRealPath())->save($path, 100);
            $user->image       = $filename;
        }

        $user->save();
        toastr()->success('تم اضافة المستخدم بنجاح!');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = users::where('id', '=', $id)->first();
        return view('admin.users.edit', compact('user'));
    }

    public function updateStatus( Request $request, $id)
    {
        $user = users::where('id', '=', $id)->first();
        if($user->is_active ==  1)
        {
            $user->is_active   = 0;
            $user->update();
            toastr()->success('تم تحديث حالة المستخدم بنجاح');
            return redirect()->route('users.index');
        } elseif($user->is_active == 0) {
            $user->is_active = 1;
            $user->update();
            toastr()->success('تم تحديث حالة المستخدم بنجاح');
            return redirect()->route('users.index');
        }
    }

    public function update(Request $request,$id){

        $user = users::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name'    => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'password' => 'nullable',
            'currencies_id' => 'required|numeric',
            'lang' => 'required|in:ar,en',
            'image'   => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المستخدم.');
            return redirect()->route('users.index');
        }

        if ($image = $request->file('image')) {
            if ($user->image != '') {
                if (File::exists('assets/upload/user_image/' . $user->image)) {
                    unlink('assets/upload/user_image/' . $user->image);
                }
            }
            $filename =  $user->image;
            $path = public_path("assets/upload/user_image/" . $filename);
            Image::make($image->getRealPath())->save($path, 100);
            $user->image       = $filename;
        }

        $user->name             = $request->name;
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        $user->lang             = $request->lang;
        $user->currencies_id    = $request->currencies_id;
        $user->password         = Hash::make($request->currencies_id);
        $user->update();

        toastr()->success('تم تعديل المستخدم بنجاح!');
        return redirect()->route('users.index');
    }
}
