<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use Illuminate\Http\Request;
use App\Models\features;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Apis\Helper\helper;

class FeatureController extends Controller
{
    public function index()
    {
        if (str_contains(auth('admin')->user()->permissions, "show_feature") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $features = features::where('id', '!=', null);

        if ($keyword != null) {
            $features = features::where('name_ar', 'LIKE', "%{$keyword}%")
                ->orWhere('name_en', 'LIKE', "%{$keyword}%");
        }
        $features = $features->paginate($limit_by);
        return view('admin.features.index',compact('features'));
    }

    public function updateStatus( Request $request, $id)
    {
        $feature = features::where('id', '=', $id)->first();
        if($feature->is_active ==  1)
        {
            $feature->is_active   = 0;
            $feature->update();
            toastr()->success('تم تحديث حالة المدير بنجاح');
            return redirect()->route('features.index');
        } elseif($feature->is_active == 0) {
            $feature->is_active = 1;
            $feature->update();
            toastr()->success('تم تحديث حالة المدير بنجاح');
            return redirect()->route('features.index');
        }
    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_feature") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $feature = features::findOrFail($request->id);
        $feature->delete();
        toastr()->success('تم حذف الميزة بنجاح');
        return redirect()->route('features.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_feature") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الميزة.');
            return redirect()->route('features.index');
        }

        $feature = new features();
        $feature->name_ar             = $request->name_ar;
        $feature->name_en             = $request->name_en;
        $feature->is_active           = 1;
        if($request->image)
            $feature->images_id           = images::create(['image' => helper::uploadPhoto($request->image,'brands'),])->id;
        $feature->save();



        toastr()->success('تم اضافة الميزة بنجاح!');
        return redirect()->route('features.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_feature") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $feature = features::where('id', '=', $id)->first();
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_feature") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $feature = features::where('id', '=', $id)->first();

        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الميزة.');
            return redirect()->route('features.index');
        }

        if ($request->file('image')) 
            images::where('id',$feature->images_id)->update(['image' => helper::uploadPhoto($request->image,'brands'),]);
        $feature->name_ar             = $request->name_ar;
        $feature->name_en             = $request->name_en;
        $feature->update();

        toastr()->success('تم تعديل الميزة بنجاح!');
        return redirect()->route('features.index');
    }

}
