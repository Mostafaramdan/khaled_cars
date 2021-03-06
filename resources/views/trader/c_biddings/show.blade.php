@extends('layouts.master')

@section('title')
    عرض المزاد
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المزادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض
                المزاد ( {{ $c_bidding->name_ar }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('c_biddings.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                                <th>اسم المنتج</th>
                                <td>{{ $c_bidding->product->name_ar }} </td>
                                <th>تاريخ انتهاء المزاد</th>
                                <td>{{ $c_bidding->end_at }}</td>
                            </tr>
                            <tr>
                                <th>العلامة التجارية للمنتج</th>
                                <td>{{ $c_bidding->product->brand->name_ar }}</td>
                                <th>مبلغ تأمين المزاد</th>
                                <td>{{ $c_bidding->Insurance}} </td>
                            </tr>
                            <tr>
                                <th>الحد الأدني للمزاد</th>
                                <td>{{ $c_bidding->min_auction}} </td>
                                <th> نوع المزاد</th>
                                <td>{{ $c_bidding->type == 'open' ? 'مفتوح' : 'مغلق' }} </td>
                            </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <!-- main-content closed -->
@endsection
