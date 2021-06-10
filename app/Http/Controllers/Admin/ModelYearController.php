<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brands;
use App\Models\model_years;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelYearController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_model_year") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $brands = brands::all(['name_ar','id']);
        $model_years = model_years::with(['brand:id,name_ar']);

        if ($keyword != null) {
            $model_years = model_years::with(['brand']);
            $model_years->whereHas('brand', function($query) use($keyword)
            {
                $query->where('name_ar', 'LIKE',"%{$keyword}%");
            })
                ->orWhere('model_year', 'LIKE', "%{$keyword}%");
        }
        $model_years = $model_years->paginate($limit_by);
        return view('admin.model_years.index',compact('model_years', 'brands'));
    }


    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_model_year") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $model_year = model_years::findOrFail($request->id);
        $model_year->delete();
        toastr()->success('تم حذف سنة الموديل بنجاح');
        return redirect()->route('model_years.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_model_year") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'model_year' => 'required|numeric',
            'brands_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة سنة الموديل.');
            return redirect()->route('model_years.index');
        }
        $model_year = new model_years();
        $model_year->model_year             = $request->model_year;
        $model_year->brands_id        = $request->brands_id;

        $model_year->save();
        toastr()->success('تم اضافة سنة الموديل بنجاح!');
        return redirect()->route('model_years.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_model_year") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $brands = brands::all(['name_ar','id']);
        $model_year = model_years::where('id', '=', $id)->first();
        return view('admin.model_years.edit', compact('model_year','brands'));
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_model_year") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $model_year = model_years::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'model_year' => 'required|numeric',
            'brands_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل سنة الموديل.');
            return redirect()->route('model_years.index');
        }
        $model_year->model_year             = $request->model_year;
        if($request->brands_id != null){
            $model_year->brands_id        = $request->brands_id;
        }
        $model_year->update();

        toastr()->success('تم تعديل سنة الموديل بنجاح!');
        return redirect()->route('model_years.index');
    }
}
