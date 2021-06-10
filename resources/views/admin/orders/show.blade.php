@extends('layouts.master')

@section('title')
    عرض المزاد
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> المزادات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض
                المزاد ( {{ $order->bidder->user->name }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('orders.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                                <th>اسم المستخدم</th>
                                <td>{{ $order->bidder->user->name }} </td>
                                <th>اسم المنتج</th>
                                <td>{{ $order->bidder->bidding->product->name_ar}} </td>
                            </tr>
                            <tr>
                                <th>موديل المنتج</th>
                                <td>{{ $order->bidder->bidding->product->model->model }} </td>
                                <th>سنة الصنع</th>
                                <td>{{ $order->bidder->bidding->product->model_year->model_year}} </td>
                            </tr>
                            <tr>
                                <th>سعر المنتج</th>
                                <td>{{ $order->bidder->bidding->product->price }} </td>
                                <th>نوع المنتج</th>
                                @if($order->bidder->bidding->product->status == 'new')
                                <td> جديد </td>
                                @elseif($order->bidder->bidding->product->status == 'antique')
                                    <td> عتيق </td>
                                @elseif($order->bidder->bidding->product->status == 'rare')
                                    <td> نادر </td>
                                @elseif($order->bidder->bidding->product->status == 'slight_damage')
                                    <td> ضرر طفيف </td>
                                @elseif($order->bidder->bidding->product->status == 'damage')
                                    <td> محطم </td>
                                @endif
                            </tr>
                            <br>
                            <tr>
                                <th>العلامة التجارية للمنتج</th>
                                <td>{{ $order->bidder->bidding->product->brand->name_ar }}</td>
                                <th>مبلغ تأمين المزاد</th>
                                <td>{{ $order->bidder->bidding->Insurance}} </td>
                            </tr>
                            <tr>
                                <th>الحد الأدني للمزاد</th>
                                <td>{{ $order->bidder->bidding->min_auction}} </td>
                                <th> نوع المزاد</th>
                                <td>{{ $order->bidder->bidding->type == 'open' ? 'مفتوح' : 'مغلق' }} </td>
                            </tr>
                            <tr>
                                <th>التاريخ</th>
                                <td>{{ $order->created_at}} </td>
                                <th>التاجر</th>
                                @if($order->bidder->bidding->trader->type == 'company')
                                    <td>  <span style="color: limegreen">( شركة )</span>  {{ $order->bidder->bidding->trader->name}}</td>
                                @elseif($order->bidder->bidding->trader->type == 'bank')
                                    <td>  <span style="color: #dc2a2a">( بنك )</span>  {{ $order->bidder->bidding->trader->name }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>سعر الشراء</th>
                                <td>{{ $order->price}} </td>
                                <th> الضريبة</th>
                                <td>{{ $order->fees }} </td>
                            </tr>
                            <tr>
                                <th>السعر شامل الضريبة</th>
                                <td>{{ $order->total}} </td>
                                <th>حالة الشراء</th>
                                @if($order->status == 'coming')
                                    <td>  <span style="color: limegreen">( قادم )</span></td>
                                @elseif($order->status == 'waiting')
                                    <td>  <span style="color: #dc2a2a">( الانتظار )</span></td>
                                @endif
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <!-- main-content closed -->
@endsection
