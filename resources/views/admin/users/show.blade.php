@extends('layouts.master')

@section('title')
    عرض المستخدم
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                                <td colspan="4" alt="centered image">
                                    @if ($user->image !== null)
                                        <center><img src="{{ asset('assets/upload/user_image/' . $user->image) }}" class="img-fluid center" width="250" height="250"></center>
                                    @else
                                        <center><img src="{{ asset('assets/upload/user_image/default.png') }}" class="img-fluid" width="250" height="250"></center>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>الأسم</th>
                                <td>{{ $user->name }} </td>
                                <th>الايميل</th>
                                <td>{{ $user->email !== null ? $user->email : 'غير متوفر' }}</td>
                            </tr>
                            <tr>
                                <th>الهاتف</th>
                                <td>{{ $user->phone !== null ? $user->phone : 'غير متوفر' }}</td>
                                <th>اللغة</th>
                                <td>{{ $user->lang == 'ar' ? 'العربية' : 'الانجليزية'}} </td>
                            </tr>
                            <tr>
                                <th>الحالة</th>
                                <td>{{ $user->is_active == 1 ? 'مفعل' : 'غير مفعل'}} </td>
                                <th>تاريخ الانشاء</th>
                                <td>{{ $user->created_at}} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <!-- main-content closed -->
@endsection
