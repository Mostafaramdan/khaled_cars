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
                    <form action="{{route('countries.update',$country->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                        <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    <label for="exampleInputEmail1">الكود : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('code',$country->code)}}" class="form-control" id="code" name="code" required>
                                    @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">Mobile Ex : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('mobile_ex',$country->mobile_ex)}}" class="form-control" id="mobile_ex" name="mobile_ex" required>
                                    @error('mobile_ex')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">مفتاح البلد : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('call_key',$country->call_key)}}" class="form-control" id="call_key" name="call_key" required>
                                    @error('call_key')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">الأسم بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('name_ar',$country->name_ar)}}" class="form-control" id="name_ar" name="name_ar" required>
                                    @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">الأسم بالانجليزية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('name_en',$country->name_en)}}" class="form-control" id="name_en" name="name_en" required>
                                    @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
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
