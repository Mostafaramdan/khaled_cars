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
                            <a class="btn btn-primary" href="{{ route('biddings.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    {!! Form::model($bidding,['route' => ['biddings.update' , $bidding->id], 'method' => 'put']) !!}
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                {!! Html::decode(Form::label('products_id', '<h4><strong>بيانات المنتج</strong></h4>'))!!}
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('name_ar', 'الأسم بالعربية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('name_ar', $bidding->product->name_ar,['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('name_en', 'الأسم بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('name_en', $bidding->product->name_en,['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('status', 'حالة المنتج : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('status',
        array("new"=>"جديد","antique" => "عتيق","rare"=>"نادر","slight_damage"=>"ضرر طفيف","damage"=>"محطم"), $bidding->product->status,
         array( 'class' => 'form-control  nice-select  custom-select', 'tabindex' => '2',)) !!}
                                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('price', 'السعر : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('price',  $bidding->product->price,['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('model', 'الموديل : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('model',  $bidding->product->model,['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('model')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('model_year', 'سنة الصنع : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('model_year',  $bidding->product->model_year,['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('description_ar', 'الوصف بالعربية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('description_ar',  $bidding->product->description_ar,['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('description_en', 'الوصف بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('description_en',  $bidding->product->description_en,['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('brands_id', 'العلامة التجارية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('brands_id', App\Models\brands::pluck('name_ar', 'id'), $bidding->product->brands->name_ar,[
                                        'name'=>'brands_id','class'=>'form-control mg-b-20"
                                                           data-parsley-class-handler="#lnWrapper' ]) !!}
                                </div>
                                <br>


                                <hr>
                                {!! Html::decode(Form::label('products_id', '<h4><strong>بيانات المزاد</strong></h4>'))!!}
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('Insurance', 'مبلغ التأمين : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('Insurance', old('Insurance'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('Insurance')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('min_auction', 'الحد الأدني للمزاد : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('min_auction', old('min_auction'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>


                                <div>
                                    {!! Html::decode(Form::label('type', 'نوع المزاد : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('type',  array("open"=>"مفتوح","close" => "مغلق"),old('type'), array( 'class' => 'form-control  nice-select  custom-select', 'tabindex' => '2',)) !!}
                                    @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('companies_id', 'الشركة ( يمكن تركها فارغة ) : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('companies_id', App\Models\companies::pluck('name', 'id'),old('companies_id'),['placeholder'=>'--- اختر الشركة ---','class'=>'form-control mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('companies_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('banks_id', 'البنك ( يمكن تركها فارغة ) : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('banks_id', App\Models\banks::pluck('name', 'id'),old('banks_id'),['placeholder'=>'--- اختر البنك ---','class'=>'form-control mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('banks_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('end_at', 'تاريخ انتهاء المزاد : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::date('end_at', old('end_at'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>


                            </div>


                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            {!! Form::submit('تعديل', ['class' => 'btn btn-main-primary pd-x-20']) !!}
                        </div>
                        {{Form::close()}}

                    </div>
                </div>

                <!-- main-content closed -->
@endsection
