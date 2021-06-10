@extends('layouts.master')

@section('title')
    تعديل الموديل
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الموديلات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                الموديل ( {{ $model->model }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('models.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <form action="{{route('models.update',$model->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>

                                <div>
                                    <label for="exampleInputEmail1">اسم الموديل : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('model',$model->model)}}" class="form-control" id="model" name="model" required>
                                    @error('model')<span class="text-danger">{{ $message }}</span>@enderror
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
