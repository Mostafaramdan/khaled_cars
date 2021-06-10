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
        if (str_contains(auth('admin')->user()->permissions, "show_user") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $users = users::where('id', '!=', null);

        if ($keyword != null) {
            $users = users::where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('phone', 'LIKE', "%{$keyword}%");
        }
        $users = $users->paginate($limit_by);
        return view('admin.users.index',compact('users'));
    }

    public function show($id){
        $user = users::where('id','=', $id)->first();
        return view('admin.users.show',compact('user'));

    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_user") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $user = users::findOrFail($request->id);
        $user->delete();
        toastr()->success('تم حذف المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_user") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'name'    => 'required',
            'phone' => 'required|numeric|unique:users',
            'email' => 'required',
            'password' => 'required',
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
        $user->password         = Hash::make($request->password);

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
        if (str_contains(auth('admin')->user()->permissions, "edit_user") !== true)
        {
            abort('403','You don\'t have this permission');
        }
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
        if (str_contains(auth('admin')->user()->permissions, "edit_user") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $user = users::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name'    => 'required',
            'phone' => 'required|numeric|between:10000000,999999999999999|unique:users,phone,'. $user->id,
            'email' => 'required',
            'password' => 'nullable',
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
        if($request->password !==null) {
            $user->password = Hash::make($request->password);
        }
        $user->update();
        toastr()->success('تم تعديل المستخدم بنجاح!');
        return redirect()->route('users.index');
    }
}
