<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brands;
use App\Models\models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_model") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $brands = brands::all(['name_ar','id']);
        $models = models::with(['brand:id,name_ar']);

        if ($keyword != null) {
            $models = models::with(['brand']);
            $models->whereHas('brand', function($query) use($keyword)
            {
                $query->where('name_ar', 'LIKE',"%{$keyword}%");
            })
                ->orWhere('model', 'LIKE', "%{$keyword}%");
        }
        $models = $models->paginate($limit_by);
        return view('admin.models.index',compact('models', 'brands'));
    }


    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_model") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $model = models::findOrFail($request->id);
        $model->delete();
        toastr()->success('تم حذف الموديل بنجاح');
        return redirect()->route('models.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_model") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            'model' => 'required',
            'brands_id' => 'required',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة الموديل.');
            return redirect()->route('models.index');
        }
        $model = new models();
        $model->model             = $request->model;
        $model->brands_id        = $request->brands_id;

        $model->save();
        toastr()->success('تم اضافة الموديل بنجاح!');
        return redirect()->route('models.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_model") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $brands = brands::all(['name_ar','id']);
        $model = models::where('id', '=', $id)->first();
        return view('admin.models.edit', compact('model','brands'));
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_model") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $model = models::where('id', '=', $id)->first();
        $validate = Validator::make($request->all(), [
            'model' => 'required',
            'brands_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل الموديل.');
            return redirect()->route('models.index');
        }
        $model->model             = $request->model;
        if($request->brands_id != null){
            $model->brands_id        = $request->brands_id;
        }
        $model->update();

        toastr()->success('تم تعديل الموديل بنجاح!');
        return redirect()->route('models.index');
    }
}
