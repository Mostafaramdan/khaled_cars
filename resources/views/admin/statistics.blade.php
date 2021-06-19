@extends('layouts.master')
@section('title')
 الاحصائيات
@stop

@section('content')
    <!-- row -->
    <br><br>
    @if(auth('admin')->check())

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">احصائيات المزادات علي مدار ٦ أشهر</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-body" style="width: 100%">
                    {!! $chartjs->render() !!}

                </div>
            </div>
        </div>


        <div class="col-lg-12 col-xl-6">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">احصائيات مزادات الشركات و البنوك</label>
                <div class="" style="width: 100%">
                    {!! $chartjs_2->render() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <br><br>
    <div class="row row--lg">
        <div class="col-xl-4 col-lg-6 col-lg-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-secondary">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد المدراء</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white justify-content-center">
                                    {{ \App\Models\admins::count() }}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-lg-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-pink-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد الشركات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white justify-content-center">
                                    {{ \App\Models\traders::where('type','=','company')->count() }}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-lg-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد البنوك</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white justify-content-center">
                                    {{ \App\Models\traders::where('type','=','bank')->count() }}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-lg-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-teal">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد المستخدمين</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white justify-content-center">
                                    {{ \App\Models\users::count() }}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد المزادات المفتوحة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ \App\Models\biddings::where('type','=','open')->count() }}

                                </h3>
                                <p class="mb-0 tx-12 text-white op-7">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد المزادات المغلقة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ \App\Models\biddings::where('type','=','close')->count() }}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7">
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white"> اجمالي عدد المزٌايدات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ \App\Models\bidders::count() }}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد العلامات التجارية</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ \App\Models\brands::count()}}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد المنتجات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{--{{ \App\Models\products::count()}}--}}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">رسائل المستخدمين المفتوحة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ \App\Models\contacts::where('is_open','=',1)->count()}}                                </h3>
                                <p class="mb-0 tx-12 text-white op-7">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    @endif
    @if(auth('trader')->check())
        <div class="row row--lg">
            <div class="col-xl-4 col-lg-6 col-lg-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-secondary">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-20 text-white">عدد الموظفين</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h3 class="tx-30 font-weight-bold mb-1 text-white justify-content-center">
                                        {{ \App\Models\employees::where('traders_id','=',auth('trader')->user()->id)->count() }}
                                    </h3>
                                    <p class="mb-0 tx-12 text-white op-7"></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-lg-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-pink-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-20 text-white">عدد المزادات</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h3 class="tx-30 font-weight-bold mb-1 text-white justify-content-center">
                                        {{ \App\Models\biddings::where('traders_id','=',auth('trader')->user()->id)->count() }}
                                    </h3>
                                    <p class="mb-0 tx-12 text-white op-7"></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
    @endif

@endsection
