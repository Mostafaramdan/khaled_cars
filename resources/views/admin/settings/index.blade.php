@extends('layouts.master')
@section('css')

@section('title')

    الاعدادات
    @stop
<link href="{{ URL::asset('assets/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />

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

                    </div>
                    <br>
                    <form action="{{route('settings.update',$settings->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                        <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    <label for="exampleInputEmail1">سياسة الاستخدام بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('policyTerms_ar',$settings->policyTerms_ar)}}" class="form-control" id="policyTerms_ar" name="policyTerms_ar" required>
                                    @error('policyTerms_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">سياسة الاستخدام بالانجليزية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('policyTerms_en',$settings->policyTerms_en)}}" class="form-control" id="policyTerms_en" name="policyTerms_en" required>
                                    @error('policyTerms_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">عن التطبيق بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('aboutUs_ar',$settings->aboutUs_ar)}}" class="form-control" id="aboutUs_ar" name="aboutUs_ar" required>
                                    @error('aboutUs_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">عن التطبيق بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('aboutUs_en',$settings->aboutUs_en)}}" class="form-control" id="aboutUs_en" name="aboutUs_en" required>
                                    @error('aboutUs_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">سياسة الاستخدام و الاسترجاع بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('privacy_ar',$settings->privacy_ar)}}" class="form-control" id="privacy_ar" name="privacy_ar" required>
                                    @error('privacy_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    <label for="exampleInputEmail1">سياسة الاستخدام و الاسترجاع بالانجليزية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('privacy_en',$settings->privacy_en)}}" class="form-control" id="privacy_en" name="privacy_en" required>
                                    @error('privacy_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    <label for="exampleInputEmail1">قيمة الضريبة : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('fees',$settings->fees)}}" class="form-control" id="fees" name="fees" required>
                                    @error('fees')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div>
                                    <label for="exampleInputEmail1">عدد أيام فترة السماح للدفع : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('min_days_to_paid',$settings->min_days_to_paid)}}" class="form-control" id="min_days_to_paid" name="min_days_to_paid" required>
                                    @error('min_days_to_paid')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div class="form-group">
                                    <label>ايميلات الشركة : <span class="text-danger">*</span></label>
                                    <br>

                                    {{ implode('  ,  ',$settings->emails)}}

                                    <br><br>
                                    <input type="text" id="emails" name="emails" data-role="tagsinput" >

                                    <br>
                                    @if ($errors->has('emails'))
                                        <span class="text-danger">{{ $errors->first('emails') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>تليفونات الشركة : <span class="text-danger">*</span></label>
                                    <br>

                                    {{ implode('  ,  ',$settings->phones)}}

                                    <br><br>
                                    <input type="text" id="phones"  name="phones" data-role="tagsinput" >

                                    <br>
                                    @if ($errors->has('phones'))
                                        <span class="text-danger">{{ $errors->first('phones') }}</span>
                                    @endif
                                </div>

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
                    @toastr_js
                    @toastr_render
                <script>
                    $("#emails").tagsinput('items').split(',');
                    $("#phones").tagsinput('items').split(',');
                </script>
                    <script src="{{ URL::asset('assets/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js') }}"></script>
                    <style type="text/css">
                        .label-info{
                            background-color: #0c1019;

                        }
                        .label {
                            display: inline-block;
                            padding: .25em .4em;
                            font-size: 100%;
                            font-weight: 700;
                            line-height: 1;
                            text-align: center;
                            white-space: nowrap;
                            vertical-align: baseline;
                            border-radius: .25rem;
                            transition: color .15s ease-in-out,background-color .15s ease-in-out,
                            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                        }
                    </style>

@endsection
