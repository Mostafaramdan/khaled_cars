<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\countries;
use App\Models\regions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_city") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $countries = countries::all(['name_ar','id']);
        $cities = regions::with(['country'])
            ->where('countries_id','!=',null);

        if ($keyword != null) {
            $cities = regions::with(['country'])
                ->where('countries_id','!=',null);
            $cities->whereHas('country', function($query) use($keyword)
            {
                $query->where('name_ar', 'LIKE',"%{$keyword}%")
                    ->where('countries_id','!=',null);
            })
                ->orWhere('name_ar', 'LIKE', "%{$keyword}%")->where('countries_id','!=',null)
                ->orWhere('name_en', 'LIKE', "%{$keyword}%");
        }
        $cities = $cities->paginate($limit_by);
        return view('admin.cities.index',compact('cities', 'countries'));
    }


    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_city") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $city = regions::findOrFail($request->id);
        $city->delete();
        toastr()->success('تم حذف المحافظة بنجاح');
        return redirect()->route('cities.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_city") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'countries_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة المحافظة.');
            return redirect()->route('cities.index');
        }
        $city = new regions();
        $city->is_active           = 1;
        $city->name_ar             = $request->name_ar;
        $city->name_en             = $request->name_en;
        $city->countries_id        = $request->countries_id;

        $city->save();
        toastr()->success('تم اضافة المحافظة بنجاح!');
        return redirect()->route('cities.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_city") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $countries = countries::all(['name_ar','id']);
        $city = regions::where('id', '=', $id)->first();
        return view('admin.cities.edit', compact('city','countries'));
    }

    public function updateStatus( Request $request, $id)
    {
        $city = regions::where('id', '=', $id)->first();
        if($city->is_active ==  1)
        {
            $city->is_active   = 0;
            $city->update();
            toastr()->success('تم تحديث حالة المحافظة بنجاح');
            return redirect()->route('cities.index');
        } elseif($city->is_active == 0) {
            $city->is_active = 1;
            $city->update();
            toastr()->success('تم تحديث حالة المحافظة بنجاح');
            return redirect()->route('cities.index');
        }
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_city") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $city = regions::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'countries_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المحافظة.');
            return redirect()->route('cities.index');
        }
        $city->name_ar             = $request->name_ar;
        $city->name_en             = $request->name_en;
        if($request->countries_id != null){
            $city->countries_id        = $request->countries_id;
        }
        $city->update();

        toastr()->success('تم تعديل المحافظة بنجاح!');
        return redirect()->route('cities.index');
    }
}
