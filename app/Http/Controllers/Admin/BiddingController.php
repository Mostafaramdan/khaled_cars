<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brands;
use App\Models\features;
use App\Models\images;
use App\Models\model_years;
use App\Models\models;
use App\Models\products;
use App\Models\users;
use App\Models\orders;
use App\Models\traders;
use App\Models\app_settings;
use Illuminate\Http\Request;
use App\Models\biddings;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Apis\Helper\helper;
use Mail;

class BiddingController extends Controller
{
    public function index()
    {
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $type = (isset(\request()->type) && \request()->type != '') ? \request()->type : null;
        $sort_by = \request()->sort_by??'id';
        $order_by = \request()->order_by?? 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : self::$itemPerPage;
        $brands = brands::all(['id', 'name_ar']);
        $model_years = model_years::all(['id', 'model_year']);
        $models = models::all(['id', 'model']);
        $features = features::all('name_ar', 'id');
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "show_bidding") !== true) {
                abort('403', 'You don\'t have this permission');
            }
            $banks = traders::where('type', '=', 'bank')->get();
            $companies = traders::where('type', '=', 'company')->get();
            $biddings = biddings::with(['product', 'trader']);

            if ($keyword != null) {
                if ($type == null) {
                    $biddings = biddings::with(['product', 'trader']);
                    $biddings->whereHas('trader', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%");
                    })
                        ->orWhereHas('product', function ($query) use ($keyword) {
                            $query->where('name_ar', 'LIKE', "%{$keyword}%");
                        })
                        ->orWhere('min_auction', 'LIKE', "%{$keyword}%");
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
                        ->where('type', '=', $type);
                }
            }
            if ($type != null && $keyword == null) {
                $biddings = biddings::with(['product', 'trader'])
                    ->where('type', '=', $type);
            }
            if(\request()->status){
                $eq = \request()->status == 'open' ? '>' : '<=';
                $biddings->where('end_at',$eq,date('Y-m-d H:i:s'));
            }
            $biddings = $biddings->orderBy($sort_by, $order_by);
            $biddings = $biddings->paginate($limit_by);

            return view('admin.biddings.index', compact('biddings', 'features', 'model_years', 'models', 'brands', 'banks', 'companies'));
        } elseif (auth('trader')->check()) {
            $biddings = biddings::with(['product'])
                ->where('traders_id', '=', auth('trader')->user()->id);

            if ($keyword != null) {
                if ($type == null) {
                    $biddings = biddings::with(['product'])
                        ->where('traders_id', '=', auth('trader')->user()->id);
                    $biddings->whereHas('product', function ($query) use ($keyword) {
                        $query->where('name_ar', 'LIKE', "%{$keyword}%")
                            ->where('traders_id', '=', auth('trader')->user()->id);
                    })
                        ->orWhere('min_auction', 'LIKE', "%{$keyword}%")
                        ->where('traders_id', '=', auth('trader')->user()->id);
                } elseif ($type != null) {
                    $biddings = biddings::with(['product'])
                        ->where('traders_id', '=', auth('trader')->user()->id)
                        ->where('type', '=', $type);
                    if ($keyword != null) {
                        $biddings = biddings::with(['product'])
                            ->where('traders_id', '=', auth('trader')->user()->id);
                        $biddings->whereHas('product', function ($query) use ($keyword) {
                            $query->where('name_ar', 'LIKE', "%{$keyword}%")
                                ->where('traders_id', '=', auth('trader')->user()->id);
                        })
                            ->where('type', '=', $type)
                            ->orWhere('min_auction', 'LIKE', "%{$keyword}%")
                            ->where('traders_id', '=', auth('trader')->user()->id)
                            ->where('type', '=', $type);
                    }
                }
            }

            if ($type != null && $keyword == null) {
                $biddings = biddings::with(['product'])
                    ->where('traders_id', '=', auth('trader')->user()->id)
                    ->where('type', '=', $type);
            }
            $biddings = $biddings->orderBy($sort_by, $order_by);
            $biddings = $biddings->paginate($limit_by);

            return view('admin.biddings.index', compact('biddings', 'features', 'model_years', 'models', 'brands'));
        } elseif (auth('employee')->check()) {
            if (auth('employee')->user()->traders_id !== null) {
                $biddings = biddings::with(['trader'])
                    ->where('traders_id', '=', auth('employee')->user()->traders_id)
                    ->paginate(self::$itemPerPage);
                return view('admin.biddings.index', compact('biddings'));
            } else {
                abort(403, 'Unauthorized');
            }
        }
    }

    public function show($id)
    {
        $bidding = biddings::with(['product', 'trader'])
            ->where('id', '=', $id)->first();
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "show_bidding") !== true) {
                abort('403', 'You don\'t have this permission');
            }
            return view('admin.biddings.show', compact('bidding'));
        } elseif (auth('trader')->check()) {
            if ($bidding->traders_id == auth('trader')->user()->id) {
                return view('admin.biddings.show', compact('bidding'));
            } else {
                abort(403, 'Unauthorized');
            }
        } elseif (auth('employee')->check()) {

            if ($bidding->traders_id == auth('employee')->user()->traders_id) {
                return view('admin.biddings.show', compact('bidding'));
            } else {
                abort(403, 'Unauthorized');
            }
        }
    }

    public function destroy(Request $request)
    {
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "delete_bidding") !== true) {
                abort('403', 'You don\'t have this permission');
            }
        }
        $bidding = biddings::findOrFail($request->id);
        $bidding->delete();
        toastr()->success('???? ?????? ???????????? ??????????');
        return redirect()->route('biddings.index');
    }

    public function store(Request $request)
    {
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "add_bidding") !== true) {
                abort('403', 'You don\'t have this permission');
            }
        }
        if (auth('admin')->check()) {
            $validate = Validator::make($request->all(), [
                //Bidding
                //'Insurance' => 'required|numeric',
                'min_auction' => 'required|numeric',
                'type' => 'required',
                'traders_id' => 'required',
                'end_at' => 'required',

                //Product
                // 'name_ar' => 'required',
                // 'name_en' => 'required',
                'models_id' => 'nullable',
                'model_years_id' => 'nullable',
                'status' => 'required',
                'images' => 'nullable',
                'brands_id' => 'required',
                'description_ar' => 'nullable',
                'description_en' => 'nullable',
                'features' => 'nullable',
            ]);
        } elseif (auth('trader')->check()) {
            $validate = Validator::make($request->all(), [
                //Bidding
                //'Insurance' => 'required|numeric',
                'min_auction' => 'required|numeric',
                'initial_auction' => 'required|numeric',
                'type' => 'required',
                'end_at' => 'required',

                //Product
                // 'name_ar' => 'required',
                // 'name_en' => 'required',
                'models_id' => 'nullable',
                'model_years_id' => 'nullable',
                'status' => 'required',
                'brands_id' => 'required',
                'description_ar' => 'nullable',
                'description_en' => 'nullable',
                'features' => 'nullable',
                'images' => 'nullable',
            ]);
        }

        if ($validate->fails()) {
            // dd($validate->errors());
            toastr()->error('???????? ?????? ???????????????? ?????????????? ?? ???? ?????? ?????????? ????????????.');
            return redirect()->route('biddings.index');
        }

        if ($request->hasfile('images')) {
            $images = $request->file('images');
            $i = [];
            foreach ($images as $image) {
                // $filename = Str::random(10) . '.' . $image->getClientOriginalExtension();
                // $path = public_path("assets/upload/product_images/" . $filename);
                // Image::make($image->getRealPath())->save($path, 100);
                $images_id = images::create([
                    'image' => helper::uploadPhoto($image,'biddings'),
                ]);
                array_push($i, $images_id->id);
            }
            if ($request->images !== null || $request->images != '') {
                $product_images = explode(',', implode(',', $i));
            }
        }
        $product = new products();
        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->brands_id = $request->brands_id;
        if($request->images !== null|| $request->images != '') {
            $product->images = $product_images;
        }
        $product->models_id = $request->models_id;
        $product->features = $request->features;
        $product->price = $request->initial_auction;
        $product->status = $request->status;
        $product->model_years_id = $request->model_years_id;
        $product->description_ar = $request->description_ar;
        $product->description_en = $request->description_en;
        $product->car_type = $request->car_type;
        $product->save();

        $bidding = new biddings();
        $bidding->products_id = $product->id;
        $bidding->Insurance = 0;
        $bidding->min_auction = $request->min_auction;
        $bidding->fees = $request->fees;
        $bidding->initial_auction = $request->initial_auction;
        $bidding->type = $request->type;
        $bidding->traders_id = $request->traders_id;
        

        $bidding->end_at = $request->end_at;
        $bidding->save();
        $users = users::where('fireBaseToken','!=',null)->where('is_active',1)->get();
        $model_ar= $product->brand->name_ar . ' '  .$product->model_year->model_year;
        $model_en= $product->brand->name_en . ' '  .$product->model_year->model_year;
        helper::newNotify($users,"???? ?????????? ???????? ???????? ?????????? {$model_ar}" , "A new auction has been added , {$model_en}",null,$bidding->id);
        toastr()->success('???? ?????????? ???????????? ??????????!');
        return redirect()->route('biddings.index');
    }

    public function edit($id)
    {
        $brands = brands::all(['id', 'name_ar']);
        $model_years = model_years::all(['id', 'model_year']);
        $models = models::all(['id', 'model']);
        $features = features::all('name_ar', 'id');
        $bidding = biddings::with(['product', 'trader'])
            ->where('id', '=', $id)->first();

        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "edit_bidding") !== true) {
                abort('403', 'You don\'t have this permission');
            }
            $banks = traders::where('type', '=', 'bank')->get();
            $companies = traders::where('type', '=', 'company')->get();
            return view('admin.biddings.edit', compact('companies', 'features', 'model_years', 'models', 'bidding', 'brands', 'banks'));
        } elseif (auth('trader')->check()) {
            if ($bidding->traders_id == auth('trader')->user()->id) {
                return view('admin.biddings.edit', compact('model_years', 'features', 'models', 'bidding', 'brands'));
            } else {
                abort(403, 'Unauthorized');
            }
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $bidding = biddings::where('id', '=', $id)->first();
        if ($bidding->type == 'open') {
            $bidding->type = 'close';
            $bidding->update();
            toastr()->success('???? ?????????? ???????? ???????????? ??????????');
            return redirect()->route('biddings.index');
        } elseif ($bidding->type == 'close') {
            $bidding->type = 'open';
            $bidding->update();
            toastr()->success('???? ?????????? ???????? ???????????? ??????????');
            return redirect()->route('biddings.index');
        }
    }

    public function update(Request $request, $id)
    {
        if (auth('admin')->check()) {
            if (str_contains(auth('admin')->user()->permissions, "edit_bidding") !== true) {
                abort('403', 'You don\'t have this permission');
            }
        }
        $bidding = biddings::where('id', '=', $id)->first();
        $product = products::where('id', '=', $bidding->products_id)->first();

        $validate = Validator::make($request->all(), [
            //'Insurance' => 'required|numeric',
            'min_auction' => 'required|numeric',
            'initial_auction' => 'required|numeric',
            'type' => 'required',
            // 'traders_id' => 'nullable',
            'end_at' => 'nullable',

            //Product
            // 'name_ar' => 'required',
            // 'name_en' => 'required',
            'models_id' => 'nullable',
            'model_years_id' => 'nullable',
            'status' => 'required',
            // 'price' => 'required',
            'brands_id' => 'nullable',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'features' => 'nullable',
        ]);
            // dd($validate->errors());
        if ($validate->fails()) {
            toastr()->error('???????? ?????? ???????????????? ?????????????? ?? ???? ?????? ?????????? ????????????.');
            return redirect()->route('biddings.index');
        }

        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        if ($request->brands_id !== null) {
            $product->brands_id = $request->brands_id;
        }
        if ($request->models_id !== null) {
            $product->models_id = $request->models_id;
        }
        $product->price = $request->initial_auction;
        $product->status = $request->status;
        if ($request->features !== null) {
            $product->features = $request->features;
        }
        if ($request->features !== null) {
            $product->model_years_id = $request->model_years_id;
        }
        $product->description_ar = $request->description_ar;
        $product->description_en = $request->description_en;
        $product->car_type = $request->car_type;
        $product->update();

        $bidding->Insurance = 0;
        $bidding->min_auction = $request->min_auction;
        $bidding->fees = $request->fees;
        $bidding->initial_auction = $request->initial_auction;

        $bidding->type = $request->type;
        if (auth('admin')->check()) {
            if ($request->traders_id !== null) {
                $bidding->traders_id = $request->traders_id;
            }
        }
        if ($request->end_at !== null ) {
            $bidding->end_at = $request->end_at;
        }
        if ($request->end_at !== null && $request->end_at > date('Y-m-d H:i:s')) {
            $bidding->has_order = 0;
            $users = users::where('fireBaseToken','!=',null)->where('is_active',1)->get();
            $model_ar= $product->brand->name_ar . ' '  .$product->model_year->model_year;
            $model_en= $product->brand->name_en . ' '  .$product->model_year->model_year;
            helper::newNotify($users,"???? ?????????? ?????? ???????????? ?????? ???????? ??????????   {$model_ar}" , "The auction has reopened again! at car  {$model_en}",null,$bidding->id);
        }
        $bidding->update();

        toastr()->success('???? ?????????? ???????????? ??????????!');
        return redirect()->route('biddings.index');
    }

    public function subBrand($id)
    {
        $models_id = models::where("brands_id", $id)->pluck("model", "id");
        return json_encode($models_id);
    }

    public function subBrand2($id)
    {
        $models_id = model_years::where("brands_id", $id)->pluck("model_year", "id");
        return json_encode($models_id);
    }
    public function confirm(biddings $bidding)
    {

        if($bidding->bidders->count() == 0){
            return response()->json(['status'=>409]);
        }
        if($bidding->has_order){
            return response()->json(['status'=>410]);
        }
        $bidding->has_order = 1;
        $bidding->end_at = date('Y-m-d H:i:s');
        $bidding->save();
        $bidder = $bidding->bidders->last();

        $order = orders::create([
            'has_order'=>1,
            'price'=>$bidding->bidders->max('price'),
            'bidders_id'=>$bidder->id,
            'fees'=>app_settings::first()->fees,
            'total'=>$bidder->price +app_settings::first()->fees/100 * $bidder->price ,
            'created_at'=>date('Y-m-d H:i:s'),
            'pdf'=>helper::UniqueRandomXChar(69,'pdf')
        ]);
        $content_ar =" ?????????? ! ???? ???????????????? ?????? ?????? ?????????????? {$bidder->bidding->product->brand->name_ar} ?????????? {$bidder->price} ";
        $content_en ="Congratulations ! Car sale approved with price  {$bidder->price} at {$bidder->bidding->product->brand->name_en}";
        helper::newNotify([$bidder->user], $content_ar , $content_en,null,$bidding->id);
        Mail::to($order->bidder->user->email)->send(new \App\Mail\OrderShipped($order));
        return response()->json(['status'=>200]);

    }
}
