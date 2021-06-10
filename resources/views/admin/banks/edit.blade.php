@extends('layouts.master')

@section('title')
    تعديل البنك
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">البنوك</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                البنك ( {{ $bank->name }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('banks.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <form action="{{route('banks.update',$bank->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                        <div class="row row-sm">

                            <div class="col-lg-12 col-xl-12">
                                <div class="card card-dashboard-map-one">
                                    <div class="" style="width: 100%">
                                    </div>
                                    <div>
                                        <label for="exampleInputEmail1">الأسم : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('name',$bank->name)}}" class="form-control" id="name" name="name" required>
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">البريد الألكتروني : <span class="tx-danger">*</span> </label>
                                        <input type="email" value="{{old('email',$bank->email)}}" class="form-control" id="email" name="email" required>
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">رقم الهاتف : <span class="tx-danger">*</span> </label>
                                        <input type="text" value="{{old('phone',$bank->phone)}}" class="form-control" id="phone" name="phone" required>
                                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">كلمة المرور : <span class="tx-danger">*</span> </label>
                                        <input type="password" class="form-control" id="password" name="password" >
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
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
