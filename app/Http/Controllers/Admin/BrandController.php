<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use Illuminate\Http\Request;
use App\Models\brands;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Apis\Helper\helper;

class BrandController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_brand") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $brands = brands::where('id', '!=', null);

        if ($keyword != null) {
            $brands = brands::where('name_ar', 'LIKE', "%{$keyword}%")
                ->orWhere('name_en', 'LIKE', "%{$keyword}%");
        }
        $brands = $brands->paginate($limit_by);
        return view('admin.brands.index',compact('brands'));
    }


    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_brand") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $brand = brands::findOrFail($request->id);
        $brand->delete();
        toastr()->success('تم حذف العلامة التجارية بنجاح');
        return redirect()->route('brands.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_brand") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'required|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة العلامة التجارية.');
            return redirect()->route('brands.index');
        }
        if ($image=$request->file('image')) 
            $images_id = images::create([
                'image' => helper::uploadPhoto($image,'brands'),
            ])->id;

        $brand = new brands();
        $brand->name_ar             = $request->name_ar;
        $brand->name_en             = $request->name_en;
        $brand->images_id           = $images_id??null;
        $brand->save();



        toastr()->success('تم اضافة العلامة التجارية بنجاح!');
        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_brand") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $brand = brands::where('id', '=', $id)->first();
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_brand") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $brand = brands::where('id', '=', $id)->first();

        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل العلامة التجارية.');
            return redirect()->route('brands.index');
        }

        if ($image=$request->file('image')) 
            $images_id = images::where('id',$brand->images_id)->update([
                'image' => helper::uploadPhoto($image,'brands'),
            ]);
        $brand->name_ar             = $request->name_ar;
        $brand->name_en             = $request->name_en;
        $brand->update();

        toastr()->success('تم تعديل العلامة التجارية بنجاح!');
        return redirect()->route('brands.index');
    }

}
