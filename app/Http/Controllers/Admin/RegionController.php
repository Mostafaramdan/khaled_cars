<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\regions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_region") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $cities = regions::where('countries_id', '!=', null)->get(['id','name_ar']);
        $regions = regions::with(['country','region'])->where('regions_id','!=',null);

        if ($keyword != null) {
            $regions = regions::with(['country','region'])
                ->where('regions_id','!=',null);
            $regions->where('name_ar', 'LIKE', "%{$keyword}%")
                  ->where('regions_id','!=',null)
                  ->orWhere('name_en', 'LIKE', "%{$keyword}%");
        }
        $regions = $regions->paginate($limit_by);
        return view('admin.regions.index',compact('regions' ,'cities'));
    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_region") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $region = regions::findOrFail($request->id);
        $region->delete();
        toastr()->success('تم حذف الحي بنجاح');
        return redirect()->route('regions.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_region") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'regions_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الحي.');
            return redirect()->route('regions.index');
        }
        $region = new regions();
        $region->is_active           = 1;
        $region->name_ar             = $request->name_ar;
        $region->name_en             = $request->name_en;
        $region->regions_id          = $request->regions_id;

        $region->save();
        toastr()->success('تم اضافة الحي بنجاح!');
        return redirect()->route('regions.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_region") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $cities = regions::where('countries_id', '!=', null)->get(['id','name_ar']);
        $region = regions::where('id', '=', $id)->first();
        return view('admin.regions.edit', compact('region','cities'));
    }

    public function updateStatus( Request $request, $id)
    {
        $region = regions::where('id', '=', $id)->first();
        if($region->is_active ==  1)
        {
            $region->is_active   = 0;
            $region->update();
            toastr()->success('تم تحديث حالة الحي بنجاح');
            return redirect()->route('regions.index');
        } elseif($region->is_active == 0) {
            $region->is_active = 1;
            $region->update();
            toastr()->success('تم تحديث حالة الحي بنجاح');
            return redirect()->route('regions.index');
        }
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_region") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $region = regions::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'regions_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الحي.');
            return redirect()->route('regions.index');
        }
        $region->name_ar             = $request->name_ar;
        $region->name_en             = $request->name_en;
        if($request->regions_id != null){
            $region->regions_id          = $request->regions_id;
        }

        $region->update();

        toastr()->success('تم تعديل الحي بنجاح!');
        return redirect()->route('regions.index');
    }
}
