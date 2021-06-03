@extends('layouts.master')

@section('title')
    عرض طلب الدفع
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">طلبات دفع التأمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض
                طلب الدفع ( {{ $insurance->users->name }} )</span>
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                                <td colspan="4" alt="centered image">
                                    @if ($insurance->images->image !== null)
                                        <center><img src="{{ asset('assets/upload/insurance/' . $insurance->images->image) }}" class="img-fluid center" width="250" height="250"></center>
                                    @else
                                        <center><img src="{{ asset('assets/upload/insurance/default.png') }}" class="img-fluid" width="250" height="250"></center>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>اسم المستخدم</th>
                                <td><a href="{{ route('users.show', $insurance->users->id) }}">{{ $insurance->users->name }}</td>
                                <th>اسم المنتج</th>
                                <td><a href="{{ route('biddings.show', $insurance->biddings->id) }}">{{ $insurance->biddings->products->name_ar }}</a></td>
                            </tr>

                            <tr>
                                <th>الحالة</th>
                                @if($insurance->status == 'waiting')
                                    <td>بانتظار التأكيد</td>
                                @elseif($insurance->status == 'accept')
                                    <td>مقبولة</td>
                                @elseif($insurance->status == 'refused')
                                    <td>مرفوضة</td>
                                @elseif($insurance->status == 'cancelled')
                                    <td>ملغية</td>
                                @endif
                                <th>تاريخ الانشاء</th>
                                <td>{{ $insurance->created_at}} </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <!-- main-content closed -->
@endsection
