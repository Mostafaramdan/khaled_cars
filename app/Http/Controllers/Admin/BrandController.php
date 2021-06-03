<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brands;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){
        $brands = brands::with('categories:id,name_ar')->get();

        return view('admin.brands.index',compact('brands'));
    }


    public function destroy(Request $request){
        $brand = brands::findOrFail($request->id);
        $brand->delete();
        toastr()->success('تم حذف العلامة التجارية بنجاح');
        return redirect()->route('brands.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة العلامة التجارية.');
            return redirect()->route('brands.index');
        }
        $brand = new brands();
        $brand->name_ar             = $request->name_ar;
        $brand->name_en             = $request->name_en;

        $brand->save();
        toastr()->success('تم اضافة العلامة التجارية بنجاح!');
        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $brand = brands::where('id', '=', $id)->first();
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request,$id){

        $brand = brands::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'categories_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل العلامة التجارية.');
            return redirect()->route('brands.index');
        }

        $brand->name_ar             = $request->name_ar;
        $brand->name_en             = $request->name_en;
        $brand->categories_id       = $request->categories_id;
        $brand->update();

        toastr()->success('تم تعديل العلامة التجارية بنجاح!');
        return redirect()->route('brands.index');
    }

}
