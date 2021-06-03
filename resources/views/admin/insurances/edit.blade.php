@extends('layouts.master')

@section('title')
    تعديل طلب الدفع
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">طلبات دفع التأمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                طلب الدفع</span>
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
                            <a class="btn btn-primary" href="{{ route('insurances.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    {!! Form::model($insurance,['route' => ['insurances.update' , $insurance->id], 'method' => 'put']) !!}
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>

                                <div>
                                    {!! Html::decode(Form::label('status', 'الحالة : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::select('status',  array("waiting"=>"بانتظار التأكيد","accept" => "مقبولة","refused"=> "مرفوضة","cancelled"=>"ملغية"),old('status'), array( 'class' => 'form-control  nice-select  custom-select', 'tabindex' => '2',)) !!}
                                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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
