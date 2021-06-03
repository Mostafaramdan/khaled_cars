@extends('layouts.master')
@section('title')
 الاحصائيات
@stop

@section('content')
    <!-- row -->
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
                                    {{ \App\Models\companies::count() }}
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
                                    {{ \App\Models\banks::count() }}
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
            <div class="card overflow-hidden sales-card bg-secondary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد الأقسام</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ \App\Models\categories::count() }}
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

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-20 text-white">عدد المنتجات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ \App\Models\products::count()}}
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
@endsection
