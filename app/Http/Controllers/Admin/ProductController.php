<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brands;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $categories = categories::pluck('name_ar','id');
        $products = products::with(['brands:id,name_ar'])->get();
        return view('admin.products.index',compact('products','categories'));
    }

    public function gettype($id){
        $brands = brands::where('categories_id',$id)->pluck('name_ar','id');
         return json_encode($brands);
    }

    public function destroy(Request $request){
        $product = products::findOrFail($request->id);
        $product->delete();
        toastr()->success('تم حذف المنتج بنجاح');
        return redirect()->route('products.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'categories_id' => 'required',
            'brands_id' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'features' => 'nullable',
        ]);
        //dd($request->all());

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم اضافة المنتج.');
            return redirect()->route('products.index');
        }

        $product = new products();
        $product->name_ar             = $request->name_ar;
        $product->name_en             = $request->name_en;
        $product->categories_id       = $request->categories_id;
        $product->brands_id           = $request->brands_id;
        $product->description_ar      = $request->description_ar;
        $product->description_en      = $request->description_en;
        $product->features            = $request->features;

        $product->save();
        toastr()->success('تم اضافة المنتج بنجاح!');
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = products::where('id', '=', $id)->first();
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request,$id){

        $product = products::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'categories_id' => 'nullable',
            'brands_id' => 'nullable',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'features' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المنتج.');
            return redirect()->route('products.index');
        }
        if($request->categories_id == null && $request->brands_id == null){
        $product->name_ar             = $request->name_ar;
        $product->name_en             = $request->name_en;

        $product->description_ar      = $request->description_ar;
        $product->description_en      = $request->description_en;
        $product->features            = $request->features;
        $product->update();
        }else {
            $product->categories_id       = $request->categories_id;
            $product->brands_id           = $request->brands_id;
            $product->name_ar             = $request->name_ar;
            $product->name_en             = $request->name_en;
            $product->description_ar      = $request->description_ar;
            $product->description_en      = $request->description_en;
            $product->features            = $request->features;
        }
        toastr()->success('تم تعديل المنتج بنجاح!');
        return redirect()->route('products.index');
    }

}
