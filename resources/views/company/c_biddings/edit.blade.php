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
                    {!! Form::model($c_bidding,['route' => ['c_biddings.update' , $c_bidding->id], 'method' => 'put']) !!}
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    {!! Html::decode(Form::label('products_id', 'المنتج : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('products_id', App\Models\products::pluck('name_ar', 'id'),old('products_id'),[
            'placeholder'=>'--- اختر المنتج ---','class'=>'form-control mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('products_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
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
