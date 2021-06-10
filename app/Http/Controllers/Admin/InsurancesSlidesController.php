<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use Illuminate\Http\Request;
use App\Models\insurances_slides;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class InsurancesSlidesController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_insurance_slide") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $insurances_slides = insurances_slides::where('id', '!=', null);

        if ($keyword != null) {
            $insurances_slides = insurances_slides::where('price', 'LIKE', "%{$keyword}%")
                ->orWhere('name_ar', 'LIKE', "%{$keyword}%")
                ->orWhere('name_en', 'LIKE', "%{$keyword}%")
                ->orWhere('created_at', 'LIKE', "%{$keyword}%")
                ->orWhere('total_biddings', 'LIKE', "%{$keyword}%");
        }
        $insurances_slides = $insurances_slides->paginate($limit_by);
        return view('admin.insurances_slides.index',compact('insurances_slides'));
    }


    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_insurance_slide") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $insurances_slide = insurances_slides::findOrFail($request->id);
        $insurances_slide->delete();
        toastr()->success('تم حذف الشريحة بنجاح');
        return redirect()->route('insurances_slides.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_insurance_slide") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'price'          => 'required',
            'total_biddings' => 'required',
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'image'          => 'required|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الشريحة.');
            return redirect()->route('insurances_slides.index');
        }

        $insurances_slides_image = new images();
        if ($image = $request->file('image')) {
            if ($insurances_slides_image->image != '') {
                if (File::exists('assets/upload/insurances_slides/' . $insurances_slides_image->image)) {
                    unlink('assets/upload/insurances_slides/' . $insurances_slides_image->image);
                }
            }
            $filename =  Str::random(10).'.'.$image->getClientOriginalExtension();
            $path = public_path("assets/upload/insurances_slides/" . $filename);
            Image::make($image->getRealPath())->save($path, 100);
            $insurances_slides_image->image       = $filename;
        }
        $insurances_slides_image->save();

        $insurances_slide = new insurances_slides();
        $insurances_slide->name_ar           = $request->name_ar;
        $insurances_slide->name_en           = $request->name_en;
        $insurances_slide->description_ar    = $request->description_ar;
        $insurances_slide->description_en    = $request->description_en;
        $insurances_slide->price             = $request->price;
        $insurances_slide->total_biddings    = $request->total_biddings;
        $insurances_slide->images_id         = $insurances_slides_image->id;
        $insurances_slide->save();
        toastr()->success('تم اضافة الشريحة بنجاح!');
        return redirect()->route('insurances_slides.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_insurance_slide") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $insurances_slide = insurances_slides::where('id', '=', $id)->first();
        return view('admin.insurances_slides.edit', compact('insurances_slide'));
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_insurance_slide") !== true)
        {
            abort('403','You don\'t have this permission');
        }

        $insurances_slide        = insurances_slides::where('id', '=', $id)->first();
        $insurances_slides_image = images::where('id','=',$insurances_slide->images_id)->first();

        $validate = Validator::make($request->all(), [
            'price'          => 'required',
            'total_biddings' => 'required',
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'image'          => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الشريحة.');
            return redirect()->route('insurances_slides.index');
        }
        if ($image = $request->file('image')) {
            if ($insurances_slides_image->image != '') {
                if (File::exists('assets/upload/insurances_slides/' . $insurances_slides_image->image)) {
                    unlink('assets/upload/insurances_slides/' . $insurances_slides_image->image);
                }
            }
            $filename =  $insurances_slides_image->image;
            $path = public_path("assets/upload/insurances_slides/" . $filename);
            Image::make($image->getRealPath())->save($path, 100);
            $insurances_slides_image->image       = $filename;

        }
        $insurances_slides_image->update();

        $insurances_slide->price             = $request->price;
        $insurances_slide->total_biddings    = $request->total_biddings;
        $insurances_slide->name_ar           = $request->name_ar;
        $insurances_slide->name_en           = $request->name_en;
        $insurances_slide->description_ar    = $request->description_ar;
        $insurances_slide->description_en    = $request->description_en;
        $insurances_slide->update();

        toastr()->success('تم تعديل الشريحة بنجاح!');
        return redirect()->route('insurances_slides.index');
    }
}
