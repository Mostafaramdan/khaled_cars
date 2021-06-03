@extends('layouts.master')

@section('title')
    تعديل البلد
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">البلاد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                البلد ( {{ $country->name_ar }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('countries.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    {!! Form::model($country,['route' => ['countries.update' , $country->id], 'method' => 'put']) !!}
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    {!! Html::decode(Form::label('code', 'الكود : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('code', old('code'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('mobile_ex', 'Mobile Ex : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('mobile_ex', old('mobile_ex'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('mobile_ex')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('call_key', 'مفتاح البلد : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('call_key', old('call_key'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('call_key')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('name_ar', 'الأسم بالعربية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('name_ar', old('name_ar'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('name_en', 'الأسم بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('name_en', old('name_en'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
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
