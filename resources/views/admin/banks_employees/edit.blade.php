@extends('layouts.master')

@section('title')
    تعديل الموظف
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">موظفين البنوك</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                الموظف ( {{ $bank_employee->name }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('banks_employees.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    {!! Form::model($bank_employee,['route' => ['banks_employees.update' , $bank_employee->id], 'method' => 'put']) !!}
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
                                    {!! Html::decode(Form::label('email', 'الإيميل : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('email', old('email'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('phone', 'التليفون : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('phone', old('phone'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('password', 'كلمة المرور : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::password('password', ['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('banks_id', 'البنك : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('banks_id', App\Models\banks::pluck('name', 'id'),old('banks_id'),[
                                        'name'=>'banks_id','class'=>'form-control mg-b-20"
                                                           data-parsley-class-handler="#lnWrapper' ]) !!}
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
