@extends('layouts.master')

@section('title')
    الاعدادات
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @toastr_css
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                  </span>
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

                    </div><br>
                    {!! Form::model($settings,['route' => ['settings.update' , $settings->id], 'method' => 'put', 'files'=>true]) !!}
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    {!! Html::decode(Form::label('policyTerms_ar', 'سياسة الاستخدام بالعربية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('policyTerms_ar', old('policyTerms_ar'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('policyTerms_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('policyTerms_en', 'سياسة الاستخدام بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('policyTerms_en', old('policyTerms_en'),['class'=>'form-control text-left' ]) !!}
                                    @error('policyTerms_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('aboutUs_ar', 'عن التطبيق بالعربية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('aboutUs_ar', old('aboutUs_ar'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('aboutUs_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    {!! Html::decode(Form::label('aboutUs_en', 'عن التطبيق بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('aboutUs_en', old('aboutUs_en'),['class'=>'form-control text-left' ]) !!}
                                    @error('aboutUs_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('privacy_ar', 'سياسة الأستخدام بالعربية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('privacy_ar', old('privacy_ar'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('privacy_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('privacy_en', 'سياسة الأستخدام بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('privacy_en', old('privacy_en'),['class'=>'form-control text-left' ]) !!}
                                    @error('privacy_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('emails', 'ايميلات الشركة : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('emails', old('emails'),['class'=>'form-control text-left' ]) !!}
                                    @error('emails')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('phones', 'أرقام هواتف الشركة : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::textarea('phones', old('phones'),['class'=>'form-control text-left' ]) !!}
                                    @error('phones')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('fees', 'الضرائب : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('fees', old('fees'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('fees')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    {!! Html::decode(Form::label('min_days_to_paid', 'عدد أيام فترة السماح للدفع : <span class="tx-danger">*</span>'))!!}
                                    {!! Form::text('min_days_to_paid', old('min_days_to_paid'),['class'=>'form-control  mg-b-20"
                                                       data-parsley-class-handler="#lnWrapper' ]) !!}
                                    @error('min_days_to_paid')<span class="text-danger">{{ $message }}</span>@enderror
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
@endsection
@section('js')
                    @toastr_js
                    @toastr_render
@endsection
