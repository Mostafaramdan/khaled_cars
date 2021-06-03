<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index(){
        $categories = categories::all();
        return view('admin.categories.index',compact('categories'));
    }


    public function destroy(Request $request){
        $category = categories::findOrFail($request->id);
        $category->delete();
        toastr()->success('تم حذف القسم بنجاح');
        return redirect()->route('categories.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة القسم.');
            return redirect()->route('categories.index');
        }
        $category = new categories();
        $category->is_active           = 1;
        $category->name_ar             = $request->name_ar;
        $category->name_en             = $request->name_en;

        if ($image = $request->file('image')) {
            if ($category->image != '') {
                if (File::exists('assets/upload/category_image/' . $category->image)) {
                    unlink('assets/upload/category_image/' . $category->image);
                }
            }
            $filename =  Str::random(10).'.'.$image->getClientOriginalExtension();
            $path = public_path("assets/upload/category_image/" . $filename);
            Image::make($image->getRealPath())->save($path, 100);
            $category->image       = $filename;
        }

        $category->save();
        toastr()->success('تم اضافة القسم بنجاح!');
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = categories::where('id', '=', $id)->first();
        return view('admin.categories.edit', compact('category'));
    }

    public function updateStatus( Request $request, $id)
    {
        $category = categories::where('id', '=', $id)->first();
        if($category->is_active ==  1)
        {
            $category->is_active   = 0;
            $category->update();
            toastr()->success('تم تحديث حالة القسم بنجاح');
            return redirect()->route('categories.index');
        } elseif($category->is_active == 0) {
            $category->is_active = 1;
            $category->update();
            toastr()->success('تم تحديث حالة القسم بنجاح');
            return redirect()->route('categories.index');
        }
    }

    public function update(Request $request,$id){

        $category = categories::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل القسم.');
            return redirect()->route('categories.index');
        }

        if ($image = $request->file('image')) {
            if ($category->image != '') {
                if (File::exists('assets/upload/category_image/' . $category->image)) {
                    unlink('assets/upload/category_image/' . $category->image);
                }
            }
            $filename =  $category->image;
            $path = public_path("assets/upload/category_image/" . $filename);
            Image::make($image->getRealPath())->save($path, 100);
            $category->image       = $filename;
        }

        $category->name_ar             = $request->name_ar;
        $category->name_en             = $request->name_en;
        $category->update();

        toastr()->success('تم تعديل القسم بنجاح!');
        return redirect()->route('categories.index');
    }
}
