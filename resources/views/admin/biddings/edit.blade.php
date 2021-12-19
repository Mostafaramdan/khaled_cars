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
                            <a class="btn btn-primary" href="{{ route('biddings.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <form action="{{route('biddings.update',$bidding->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <label for="exampleInputEmail1"><h4><strong>بيانات المنتج</strong></h4></label>
                                <br>
                                <!-- <div>
                                    <label for="exampleInputEmail1">الأسم بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('name_ar',$bidding->product->name_ar)}}" class="form-control" id="name_ar" name="name_ar" required>
                                    @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">الأسم بالأنجليزية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('name_en',$bidding->product->name_en)}}" class="form-control" id="name_en" name="name_en" required>
                                    @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div> -->
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">حالة المنتج : <span class="tx-danger">*</span> </label>
                                    <select class="form-control"  name="status" id="status">
                                        <option value="" @if (old('status', $bidding->product->status == ''))  SELECTED @endif>--- اختر حالة المنتج ---</option>
                                        <option value="new" @if (old('status', $bidding->product->status == 'new'))  SELECTED @endif>سليم</option>
                                        <!-- <option value="antique" @if (old('status', $bidding->product->status == 'antique'))  SELECTED @endif>عتيق</option> -->
                                        <option value="rare" @if (old('status', $bidding->product->status == 'rare'))  SELECTED @endif>نادر</option>
                                        <option value="slight_damage" @if (old('status', $bidding->product->status == 'slight_damage'))  SELECTED @endif >مصدوم </option>
                                        <option value="damage" @if (old('status', $bidding->product->status == 'damage'))  SELECTED @endif>حطام</option>
                                    </select>
                                </div>
                                <div>
                            <label for="carType">نوع السيارة : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="car_type" id="car_type">
                                <option value="sedan" @if (old('status', $bidding->product->car_type == 'sedan'))  SELECTED @endif>سيدان </option>
                                <option value="Jeep"@if (old('status', $bidding->product->car_type == 'Jeep'))  SELECTED @endif >جيب</option>
                                <option value="hatchback"@if (old('status', $bidding->product->car_type == 'hatchback'))  SELECTED @endif >هاتشباك</option>
                                <option value="Pick-Up" @if (old('status', $bidding->product->car_type == 'Pick-Up'))  SELECTED @endif >بكب </option>
                            </select>
                        </div>
                        <br>

                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">المميزات : <span class="tx-danger">*</span> </label>
                                            <select class="form-control select-multiple-tags" name="features[]" id="features[]" multiple>
                                                @foreach( $features as $feature)
                                                    <option value="{{$feature->id}}" >{{$feature->name_ar}}</option>
                                                @endforeach
                                            </select>
                                            @error('features')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div>
                                    <label for="exampleInputEmail1">الوصف بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('description_ar',$bidding->product->description_ar)}}" class="form-control" id="description_ar" name="description_ar" required>
                                    @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">الوصف بالانجليزية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('description_en',$bidding->product->description_en)}}" class="form-control" id="description_en" name="description_en" required>
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
                                <div>
                                    <label for="exampleInputEmail1">الموديل : <span class="tx-danger">*</span> </label>
                                    <select class="form-control models_id"  name="models_id" id="models_id">
                                        <option value="" >--- اختر الموديل ---</option>
                                    </select>
                                    @error('models_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    <label for="exampleInputEmail1">سنة الصنع : <span class="tx-danger">*</span> </label>
                                    <select class="form-control model_years_id"  name="model_years_id" id="model_years_id">
                                        <option value="" >--- اختر سنة الصنع ---</option>
                                    </select>
                                    @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <hr>
                                <label for="exampleInputEmail1"><h4><strong>بيانات المزاد</strong></h4></label>
                                <br>

                                <div>
                                    <label for="exampleInputEmail12">   المبلع المبدأي للمزاد   : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('initial_auction',$bidding->initial_auction)}}" class="form-control" id="initial_auction" name="initial_auction" required>
                                    @error('initial_auction')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    <label for="exampleInputEmail1">الحد الأدني للمزاد : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('min_auction',$bidding->min_auction)}}" class="form-control" id="min_auction" name="min_auction" required>
                                    @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1"> الضريبة % : <span class="tx-danger">*</span> </label>
                                    <input type="number" class="form-control" id="fees" name="fees" required min=0 value="{{old('fees',$bidding->fees)}}">
                                    @error('fees')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

<!--                                <div>
                                    <label for="exampleInputEmail1">مبلغ التأمين : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('Insurance',$bidding->Insurance)}}" class="form-control" id="Insurance" name="Insurance" required>
                                    @error('Insurance')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>-->
                                <div>
                                    <label for="exampleInputEmail1">نوع المزاد : <span class="tx-danger">*</span> </label>
                                    <select class="form-control"  name="type" id="type">
                                        <option value="" >--- اختر نوع المزاد ---</option>
                                        <option value="open" @if (old('type', $bidding->type == 'open'))  SELECTED @endif >مفتوح</option>
                                        <option value="close" @if (old('type', $bidding->type == 'close'))  SELECTED @endif>مغلق</option>
                                    </select>
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">تاريخ انتهاء المزاد : ({{$bidding->end_at}})<span class="tx-danger">*</span> </label>
                                    <input type="datetime-local" class="form-control" id="end_at" name="end_at"  value="{{$bidding->end_at}}">
                                    @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <!-- @if (auth('admin')->check())
                                @if($bidding->trader->type == 'bank')
                                    <div>
                                        <label for="exampleInputEmail1">البنك : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="traders_id" id="traders_id">
                                            <option value="" >--- اختر البنك ---</option>
                                            @foreach( $banks as $bank)
                                                <option value="{{$bank->id}}" @if (old('id',$bank->id) == $bidding->traders_id)    SELECTED @endif>{{$bank->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                @else
                                    <div>
                                        <label for="exampleInputEmail1">الشركة : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="traders_id" id="traders_id">
                                            <option value="" >--- اختر الشركة ---</option>
                                            @foreach( $companies as $company)
                                                <option value="{{$company->id}}" @if (old('id',$company->id) == $bidding->traders_id)    SELECTED @endif >{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                @endif
                                @endif -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
@endsection
@section('js')
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('select[name="brands_id"]').on('change', function() {
                                var models_id = $(this).val();
                                console.log(models_id);
                                if(models_id) {
                                    $.ajax({
                                        url: '/admin/myform/ajax/'+models_id,
                                        type: "GET",
                                        dataType: "json",
                                        success:function(data) {
                                            $('select[name="models_id"]').empty();
                                            $.each(data, function(key, value) {
                                                $('select[name="models_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                            });
                                        }
                                    });
                                }else{
                                    $('select[name="models_id"]').empty();
                                }
                            });
                        });
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('select[name="brands_id"]').on('change', function() {
                                var model_years_id = $(this).val();
                                console.log(model_years_id);
                                if(model_years_id) {
                                    $.ajax({
                                        url: '/admin/myform2/ajax/'+model_years_id,
                                        type: "GET",
                                        dataType: "json",
                                        success:function(data) {
                                            $('select[name="model_years_id"]').empty();
                                            $.each(data, function(key, value) {
                                                $('select[name="model_years_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                            });
                                        }
                                    });
                                }else{
                                    $('select[name="model_years_id"]').empty();
                                }
                            });
                        });
                    </script>
@endsection
