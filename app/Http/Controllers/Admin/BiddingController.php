<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\banks;
use App\Models\brands;
use App\Models\model_years;
use App\Models\models;
use App\Models\products;
use App\Models\traders;
use Illuminate\Http\Request;
use App\Models\biddings;
use Illuminate\Support\Facades\Validator;

class BiddingController extends Controller
{
    public function index(){
        if (str_contains(auth('admin')->user()->permissions, "show_bidding") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $type = (isset(\request()->type) && \request()->type != '') ? \request()->type : null;
        $sort_by = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'end_at';
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $brands = brands::all(['id','name_ar']);
        $model_years = model_years::all(['id','model_year']);
        $models = models::all(['id','model']);
        $banks = traders::where('type','=','bank')->get();
        $companies = traders::where('type','=','company')->get();
        $biddings = biddings::with(['product','trader']);

        if ($keyword != null) {
            if ($type == null) {
                $biddings = biddings::with(['product', 'trader']);
                $biddings->whereHas('trader', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })
                    ->orWhereHas('product', function ($query) use ($keyword) {
                        $query->where('name_ar', 'LIKE', "%{$keyword}%");
                    })
                    ->orWhere('min_auction', 'LIKE', "%{$keyword}%")
                    ->orWhere('Insurance', 'LIKE', "%{$keyword}%");
            } elseif ($type != null) {
                $biddings = biddings::with(['product', 'trader'])
                    ->where('type', '=', $type);
                $biddings->whereHas('trader', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })
                    ->orWhereHas('product', function ($query) use ($keyword) {
                        $query->where('name_ar', 'LIKE', "%{$keyword}%");
                    })
                    ->where('type', '=', $type)
                    ->orWhere('min_auction', 'LIKE', "%{$keyword}%")
                    ->where('type', '=', $type)
                    ->orWhere('Insurance', 'LIKE', "%{$keyword}%")
                    ->where('type', '=', $type);
            }
        }
        if ($type != null && $keyword == null) {
            $biddings = biddings::with(['product','trader'])
                ->where('type', '=', $type);
        }
        $biddings = $biddings->orderBy($sort_by, $order_by);
        $biddings = $biddings->paginate($limit_by);

        return view('admin.biddings.index',compact('biddings','model_years','models','brands','banks','companies'));
    }

    public function show($id){
        if (str_contains(auth('admin')->user()->permissions, "show_bidding") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $bidding = biddings::with(['product','trader'])
            ->where('id','=', $id)->first();
        return view('admin.biddings.show',compact('bidding'));
    }

    public function destroy(Request $request){
        if (str_contains(auth('admin')->user()->permissions, "delete_bidding") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $bidding = biddings::findOrFail($request->id);
        $bidding->delete();
        toastr()->success('تم حذف المزاد بنجاح');
        return redirect()->route('biddings.index');
    }

    public function store(Request $request)
    {
        if (str_contains(auth('admin')->user()->permissions, "add_bidding") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $validate = Validator::make($request->all(), [
            //Bidding
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
            'traders_id' => 'required',
            'end_at' =>'required',

            //Product
            'name_ar' => 'required',
            'name_en' => 'required',
            'models_id' => 'required',
            'model_years_id' => 'required',
            'status' => 'required',
            'price' => 'required',
            'brands_id' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'features' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم اضافة المزاد.');
            return redirect()->route('biddings.index');
        }
        $product = new products();
        $product->name_ar             = $request->name_ar;
        $product->name_en             = $request->name_en;
        $product->brands_id           = $request->brands_id;
        $product->models_id           = $request->models_id;
        $product->price               = $request->price;
        $product->status              = $request->status;
        $product->model_years_id      = $request->model_years_id;
        $product->description_ar      = $request->description_ar;
        $product->description_en      = $request->description_en;
        $product->save();

        $bidding = new biddings();
        $bidding->products_id          = $product->id;
        $bidding->Insurance            = $request->Insurance;
        $bidding->min_auction          = $request->min_auction;
        $bidding->type                 = $request->type;
        $bidding->traders_id           = $request->traders_id;
        $bidding->end_at               = $request->end_at;
        $bidding->save();
        toastr()->success('تم اضافة المزاد بنجاح!');
        return redirect()->route('biddings.index');
    }

    public function edit($id)
    {
        if (str_contains(auth('admin')->user()->permissions, "edit_bidding") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $brands = brands::all(['id','name_ar']);
        $banks = traders::where('type','=','bank')->get();
        $companies = traders::where('type','=','company')->get();
        $model_years = model_years::all(['id','model_year']);
        $models = models::all(['id','model']);
        if (str_contains(auth('admin')->user()->permissions, "edit") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $bidding = biddings::with(['product','trader'])
            ->where('id', '=', $id)->first();
        return view('admin.biddings.edit', compact('companies','model_years','models','bidding','brands','banks'));
    }

    public function updateStatus( Request $request, $id)
    {
        $bidding = biddings::where('id', '=', $id)->first();
        if($bidding->type ==  'open')
        {
            $bidding->type   = 'close';
            $bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('biddings.index');
        } elseif($bidding->type == 'close') {
            $bidding->type = 'open';
            $bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('biddings.index');
        }
    }

    public function update(Request $request,$id){
        if (str_contains(auth('admin')->user()->permissions, "edit_bidding") !== true)
        {
            abort('403','You don\'t have this permission');
        }
        $bidding = biddings::where('id', '=', $id)->first();
        $product = products::where('id','=',$bidding->products_id)->first();

        $validate = Validator::make($request->all(), [
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
            'traders_id' => 'nullable',
            'end_at' =>'nullable',

            //Product
            'name_ar' => 'required',
            'name_en' => 'required',
            'models_id' => 'required',
            'model_years_id' => 'required',
            'status' => 'required',
            'price' => 'required',
            'brands_id' => 'nullable',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'features' => 'nullable',
        ]);

        if ($validate->fails()) {
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم تعديل المزاد.');
            return redirect()->route('biddings.index');
        }

        $product->name_ar             = $request->name_ar;
        $product->name_en             = $request->name_en;
        if($request->brands_id !== null){
            $product->brands_id       = $request->brands_id;
        }
        $product->models_id           = $request->models_id;
        $product->price               = $request->price;
        $product->status              = $request->status;
        $product->model_years_id      = $request->model_years_id;
        $product->description_ar      = $request->description_ar;
        $product->description_en      = $request->description_en;
        $product->update();

        $bidding->Insurance            = $request->Insurance;
        $bidding->min_auction          = $request->min_auction;
        $bidding->type                 = $request->type;
        if($request->traders_id !== null) {
            $bidding->traders_id = $request->traders_id;
        }
        if($request->end_at !== null){
            $bidding->end_at           = $request->end_at;
        }
        $bidding->update();

        toastr()->success('تم تعديل المزاد بنجاح!');
        return redirect()->route('biddings.index');
    }

}
