<?php

namespace App\Http\Controllers\Trader;

use App\Http\Controllers\Controller;
use App\Models\brands;
use App\Models\model_years;
use App\Models\models;
use App\Models\products;
use Illuminate\Http\Request;
use App\Models\biddings;
use Illuminate\Support\Facades\Validator;

class BiddingController extends Controller
{
    public function index(){
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $type = (isset(\request()->type) && \request()->type != '') ? \request()->type : null;
        $sort_by = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'end_at';
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $brands = brands::all(['id','name_ar']);
        $model_years = model_years::all(['id','model_year']);
        $models = models::all(['id','model']);
        $c_biddings = biddings::with(['product'])
            ->where('traders_id','=',auth('trader')->user()->id);

        if ($keyword != null) {
            if ($type == null) {
                $c_biddings = biddings::with(['product'])
                    ->where('traders_id', '=', auth('trader')->user()->id);
                $c_biddings->whereHas('product', function ($query) use ($keyword) {
                    $query->where('name_ar', 'LIKE', "%{$keyword}%")
                        ->where('traders_id', '=', auth('trader')->user()->id);
                })
                    ->orWhere('min_auction', 'LIKE', "%{$keyword}%")
                    ->where('traders_id', '=', auth('trader')->user()->id)
                    ->orWhere('Insurance', 'LIKE', "%{$keyword}%")
                    ->where('traders_id', '=', auth('trader')->user()->id);
            }
            elseif ($type != null) {
                $c_biddings = biddings::with(['product'])
                    ->where('traders_id','=',auth('trader')->user()->id)
                    ->where('type', '=', $type);
                if ($keyword != null) {
                    $c_biddings = biddings::with(['product'])
                        ->where('traders_id','=',auth('trader')->user()->id);
                    $c_biddings->whereHas('product', function($query) use($keyword)
                    {
                        $query->where('name_ar', 'LIKE',"%{$keyword}%")
                            ->where('traders_id','=',auth('trader')->user()->id);
                    })
                        ->where('type', '=', $type)
                        ->orWhere('min_auction', 'LIKE', "%{$keyword}%")
                        ->where('traders_id','=',auth('trader')->user()->id)
                        ->where('type', '=', $type)
                        ->orWhere('Insurance', 'LIKE', "%{$keyword}%")
                        ->where('type', '=', $type)
                        ->where('traders_id','=',auth('trader')->user()->id);
                }
            }
        }

        if ($type != null && $keyword == null) {
            $c_biddings = biddings::with(['product'])
                ->where('traders_id','=',auth('trader')->user()->id)
                ->where('type', '=', $type);
        }
        $c_biddings = $c_biddings->orderBy($sort_by, $order_by);
        $c_biddings = $c_biddings->paginate($limit_by);
        return view('trader.c_biddings.index',compact('c_biddings','brands','model_years','models'));
    }

    public function show($id){

        $c_bidding = biddings::with(['product'])->where('biddings.id','=', $id)
            ->first();
        if($c_bidding->traders_id == auth('trader')->user()->id){
            return view('trader.c_biddings.show',compact('c_bidding'));
        }
        else{
            abort(403, 'Unauthorized');
        }
    }

    public function destroy(Request $request){
        $c_bidding = biddings::findOrFail($request->id);
        $c_bidding->delete();
        toastr()->success('تم حذف المزاد بنجاح');
        return redirect()->route('c_biddings.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            //Bidding
            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
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
            toastr()->error('يوجد بعض البيانات الخاطئة ، لم يتم إضافة المزاد.');
            return redirect()->route('c_biddings.index');
        }

        $product = new products();
        $product->name_ar             = $request->name_ar;
        $product->name_en             = $request->name_en;
        $product->brands_id           = $request->brands_id;
        $product->models_id               = $request->models_id;
        $product->price               = $request->price;
        $product->status              = $request->status;
        $product->model_years_id          = $request->model_years_id;
        $product->description_ar      = $request->description_ar;
        $product->description_en      = $request->description_en;
        $product->save();

        $c_bidding = new biddings();
        $c_bidding->products_id          = $product->id;
        $c_bidding->Insurance            = $request->Insurance;
        $c_bidding->min_auction          = $request->min_auction;
        $c_bidding->type                 = $request->type;
        $c_bidding->end_at               = $request->end_at;
        $c_bidding->traders_id           = auth('trader')->user()->id;
        $c_bidding->save();

        toastr()->success('تم اضافة المزاد بنجاح!');
        return redirect()->route('c_biddings.index');
    }

    public function edit($id)
    {
        $c_bidding = biddings::where('id', '=', $id)->first();
        $model_years = model_years::all(['id','model_year']);
        $models = models::all(['id','model']);
        $brands = brands::all(['id','name_ar']);
        if($c_bidding->traders_id == auth('trader')->user()->id){
            return view('trader.c_biddings.edit', compact('brands','models','model_years','c_bidding'));
        }
        else{
            abort(403, 'Unauthorized');
        }
    }

    public function updateStatus( Request $request, $id)
    {
        $c_bidding = biddings::where('id', '=', $id)->first();
        if($c_bidding->type ==  'open')
        {
            $c_bidding->type   = 'close';
            $c_bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('c_biddings.index');
        } elseif($c_bidding->type == 'close') {
            $c_bidding->type = 'open';
            $c_bidding->update();
            toastr()->success('تم تحديث حالة المزاد بنجاح');
            return redirect()->route('c_biddings.index');
        }
    }

    public function update(Request $request,$id){

        $c_bidding = biddings::where('id', '=', $id)->first();
        $c_product = products::where('id','=',$c_bidding->products_id)->first();
        $validate = Validator::make($request->all(), [

            'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'type' => 'required',
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
            toastr()->error($validate->errors());
            return redirect()->route('c_biddings.index');
        }

        $c_product->name_ar             = $request->name_ar;
        $c_product->name_en             = $request->name_en;
        if($request->brands_id !== null){
            $c_product->brands_id           = $request->brands_id;
        }

        $c_product->models_id           = $request->models_id;
        $c_product->price               = $request->price;
        $c_product->status              = $request->status;
        $c_product->model_years_id      = $request->model_years_id;
        $c_product->description_ar      = $request->description_ar;
        $c_product->description_en      = $request->description_en;
        $c_product->update();

        $c_bidding->Insurance            = $request->Insurance;
        $c_bidding->min_auction          = $request->min_auction;
        $c_bidding->type                 = $request->type;
        $c_bidding->traders_id         = auth('trader')->user()->id;
        if($request->end_at !== null){
            $c_bidding->end_at               = $request->end_at;
        }
        $c_bidding->update();

        toastr()->success('تم تعديل المزاد بنجاح!');
        return redirect()->route('c_biddings.index');
    }

}
