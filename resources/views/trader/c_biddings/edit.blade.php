@extends('layouts.master')

@section('title')
    تعديل المزاد
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المزادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                المزاد </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>خطا</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('c_biddings.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <form action="{{route('c_biddings.update',$c_bidding->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                        <div class="row row-sm">

                            <div class="col-lg-12 col-xl-12">
                                <div class="card card-dashboard-map-one">
                                    <div class="" style="width: 100%">
                                    </div>
                                    <label for="exampleInputEmail1"><h4><strong>بيانات المنتج</strong></h4></label>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">الأسم بالعربية : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('name_ar',$c_bidding->product->name_ar)}}" class="form-control" id="name_ar" name="name_ar" required>
                                        @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">الأسم بالأنجليزية : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('name_en',$c_bidding->product->name_en)}}" class="form-control" id="name_en" name="name_en" required>
                                        @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">حالة المنتج : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="status" id="status">
                                            <option value="" @if (old('status', $c_bidding->product->status == ''))  SELECTED @endif>--- اختر حالة المنتج ---</option>
                                            <option value="new" @if (old('status', $c_bidding->product->status == 'new'))  SELECTED @endif>جديد</option>
                                            <option value="antique" @if (old('status', $c_bidding->product->status == 'antique'))  SELECTED @endif>عتيق</option>
                                            <option value="rare" @if (old('status', $c_bidding->product->status == 'rare'))  SELECTED @endif>نادر</option>
                                            <option value="slight_damage" @if (old('status', $c_bidding->product->status == 'slight_damage'))  SELECTED @endif >ضرر طفيف</option>
                                            <option value="damage" @if (old('status', $c_bidding->product->status == 'damage'))  SELECTED @endif>محطم</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">السعر : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('price',$c_bidding->product->price)}}" class="form-control" id="price" name="price" required>
                                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">الموديل : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="models_id" id="models_id">
                                            <option value="" >--- اختر الموديل ---</option>
                                            @foreach( $models as $model)
                                                <option value="{{$model->id}}" @if (old('models_id', $c_bidding->product->model->id) == $model->id) selected @endif >{{$model->model}}</option>
                                            @endforeach
                                        </select>
                                        @error('models_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>

                                    <div>
                                        <label for="exampleInputEmail1">سنة الصنع : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="model_years_id" id="model_years_id">
                                            <option value="" >--- اختر سنة الصنع ---</option>
                                            @foreach( $model_years as $model_year)
                                                <option value="{{$model_year->id}}" @if (old('model_years_id', $c_bidding->product->model_year->id) == $model_year->id) selected @endif >{{$model_year->model_year}}</option>
                                            @endforeach
                                        </select>
                                        @error('model_years_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">الوصف بالعربية : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('description_ar',$c_bidding->product->description_ar)}}" class="form-control" id="description_ar" name="description_ar" required>
                                        @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">الوصف بالانجليزية : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('description_en',$c_bidding->product->description_en)}}" class="form-control" id="description_en" name="description_en" required>
                                        @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">العلامة التجارية : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="brands_id" id="brands_id">
                                            <option value="" >--- اختر العلامة التجارية ---</option>
                                            @foreach( $brands as $brand)
                                                <option value="{{$brand->id}}" >{{$brand->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <hr>
                                    <label for="exampleInputEmail1"><h4><strong>بيانات المزاد</strong></h4></label>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">الحد الأدني للمزاد : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('min_auction',$c_bidding->min_auction)}}" class="form-control" id="min_auction" name="min_auction" required>
                                        @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">مبلغ التأمين : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('Insurance',$c_bidding->Insurance)}}" class="form-control" id="Insurance" name="Insurance" required>
                                        @error('Insurance')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">نوع المزاد : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="type" id="type">
                                            <option value="" >--- اختر نوع المزاد ---</option>
                                            <option value="open" @if (old('type', $c_bidding->type == 'open'))  SELECTED @endif >مفتوح</option>
                                            <option value="close" @if (old('type', $c_bidding->type == 'close'))  SELECTED @endif>مغلق</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">تاريخ انتهاء المزاد : <span class="tx-danger">*</span> </label>
                                        <input type="date" class="form-control" id="end_at" name="end_at" >
                                        @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>

                <!-- main-content closed -->
@endsection
