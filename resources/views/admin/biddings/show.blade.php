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
                المزاد ( {{ $bidding->product->name_ar }} )</span>
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
                    </div>
                    <br>
                    <br>
                    @if($bidding->product->images !== null)
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">

                            @foreach($bidding->product->GetImagesAttribute() as $value)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"
                                    @if($loop->first) class="active" @endif></li>
                            @endforeach

                        </ol>
                        <div class="carousel-inner">
                            @foreach($bidding->product->GetImagesAttribute() as $value)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img class="d-block" style="width: 100%; height:500px;"
                                         src="{{ asset($value->image)}}">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="las la-arrow-right"
                                  style="font-size: 20px; border-color: #0c1019">السابق</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="las la-arrow-left" style="font-size: 20px; border-color: #0c1019">التالي</span>
                        </a>
                    </div>
                    @endif
                </div>
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
                            @if($bidding->product->models_id !== null)
                            <td>{{ $bidding->product->model->model }} </td>
                            @else
                                <td>غير معلوم</td>
                            @endif
                            <th>سنة الصنع</th>
                            @if($bidding->product->model_years_id !== null)
                            <td>{{ $bidding->product->model_year->model_year}} </td>
                            @else
                                <td>غير معلوم</td>
                            @endif
                        </tr>
                        <tr>
                            <th>سعر المنتج</th>
                            <td>{{ $bidding->product->price }} </td>
                            <th>نوع المنتج</th>
                            @if($bidding->product->status == 'new')
                                <td> جديد</td>
                            @elseif($bidding->product->status == 'antique')
                                <td> عتيق</td>
                            @elseif($bidding->product->status == 'rare')
                                <td> نادر</td>
                            @elseif($bidding->product->status == 'slight_damage')
                                <td> ضرر طفيف</td>
                            @elseif($bidding->product->status == 'damage')
                                <td> محطم</td>
                            @endif
                        </tr>
                        <br>
                        <tr>
                            <th>العلامة التجارية للمنتج</th>
                            <td>{{ $bidding->product->brand->name_ar }}</td>
                            <th>تاريخ انتهاء المزاد</th>
                            <td>{{ $bidding->end_at}} </td>
                        </tr>
                        <tr>
                            <th>التاجر</th>
                            @if($bidding->trader->type == 'company')
                                <td><span style="color: limegreen">( شركة )</span> {{ $bidding->trader->name}}</td>
                            @elseif($bidding->trader->type == 'bank')
                                <td><span style="color: #dc2a2a">( بنك )</span> {{ $bidding->trader->name }}</td>
                            @endif

                            <th> نوع المزاد</th>
                            <td>{{ $bidding->type == 'open' ? 'مفتوح' : 'مغلق' }} </td>
                        </tr>
                        <tr>

                            <th>المميزات</th>
                            <td>
                                @foreach($bidding->product->GetFeaturesAttribute() as $value)
                                    - {{ $value->name_ar }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- main-content closed -->
@endsection

