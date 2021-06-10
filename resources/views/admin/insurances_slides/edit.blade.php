@extends('layouts.master')

@section('title')
    تعديل الشريحة
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">شرائح التأمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                الشريحة ( {{ $insurances_slide->price }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('insurances_slides.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <form action="{{route('insurances_slides.update',$insurances_slide->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                        <div class="row row-sm">
                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    <label for="exampleInputEmail1">الأسم بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('name_ar',$insurances_slide->name_ar)}}" class="form-control" id="name_ar" name="name_ar" required>
                                    @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">الأسم بالنجليزية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('name_en',$insurances_slide->name_en)}}" class="form-control" id="name_en" name="name_en" required>
                                    @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">الوصف بالعربية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('description_ar',$insurances_slide->description_ar)}}" class="form-control" id="description_ar" name="description_ar" required>
                                    @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">الوصف بالنجليزية : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('description_en',$insurances_slide->description_en)}}" class="form-control" id="description_en" name="description_en" required>
                                    @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">القيمة : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('price',$insurances_slide->price)}}" class="form-control" id="price" name="price" required>
                                    @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">اجمالي المزادات : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('total_biddings',$insurances_slide->total_biddings)}}" class="form-control" id="total_biddings" name="total_biddings" required>
                                    @error('total_biddings')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1" >الصورة :  </label>
                                    <input type="file" class="form-control form-control"
                                           data-parsley-class-handler="#lnWrapper" id="image" name="image">
                                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
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
