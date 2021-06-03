@extends('layouts.master')

@section('title')
    تعديل المستخدم
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                المستخدم ( {{ $user->name }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('users.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    {!! Form::model($user,['route' => ['users.update' , $user->id], 'method' => 'put', 'files'=>true]) !!}
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    {!! Html::decode(Form::label('name', 'الأسم : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('name', old('name'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('phone', 'رقم الهاتف : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('phone', old('phone'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('email', 'الايميل : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('email', old('email'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('password', 'كلمة السر : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::password('password', ['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('lang', 'اللغة : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('lang',  array("ar"=>"العربية","en" => "الانجليزية"),old('lang'), array( 'class' => 'form-control  nice-select  custom-select', 'tabindex' => '2',)) !!}
                                    @error('lang')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('currencies_id', 'العملة : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('currencies_id', App\Models\currencies::pluck('name_ar', 'id'),old('currencies_id'),['class'=>'form-control mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('currencies_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('image', 'الصورة : '))!!}
                                    {!! Form::file('image',['class'=>'form-control form-control"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
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
