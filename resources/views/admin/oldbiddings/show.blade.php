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
                المزاد ( {{ $bidding->products->name_ar }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('biddings.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                                <th>اسم المنتج بالعربية</th>
                                <td>{{ $bidding->product->name_ar }} </td>
                                <th>اسم المنتج بالأنجليزية</th>
                                <td>{{ $bidding->product->name_en}} </td>
                            </tr>
                            <tr>
                                <th>موديل المنتج</th>
                                <td>{{ $bidding->product->model }} </td>
                                <th>سنة الصنع</th>
                                <td>{{ $bidding->product->model_year}} </td>
                            </tr>
                            <tr>
                                <th>سعر المنتج</th>
                                <td>{{ $bidding->product->price }} </td>
                                <th>نوع المنتج</th>
                                @if($bidding->product->status == 'new')
                                <td> جديد </td>
                                @elseif($bidding->product->status == 'antique')
                                    <td> عتيق </td>
                                @elseif($bidding->product->status == 'rare')
                                    <td> نادر </td>
                                @elseif($bidding->product->status == 'slight_damage')
                                    <td> ضرر طفيف </td>
                                @elseif($bidding->product->status == 'damage')
                                    <td> محطم </td>
                                @endif
                            </tr>
                            <br>
                            <tr>
                                <th>العلامة التجارية للمنتج</th>
                                <td>{{ $bidding->product->brands->name_ar }}</td>
                                <th>مبلغ تأمين المزاد</th>
                                <td>{{ $bidding->Insurance}} </td>
                            </tr>
                            <tr>
                                <th>الحد الأدني للمزاد</th>
                                <td>{{ $bidding->min_auction}} </td>
                                <th> نوع المزاد</th>
                                <td>{{ $bidding->type == 'open' ? 'مفتوح' : 'مغلق' }} </td>
                            </tr>
                            <tr>
                                <th>تاريخ انتهاء المزاد</th>
                                <td>{{ $bidding->end_at}} </td>
                                <th>الشركة</th>
                                <td>{{ @$bidding->companies->name == null ? 'غير معين لشركة' : $bidding->companies->name}} </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <!-- main-content closed -->
@endsection
