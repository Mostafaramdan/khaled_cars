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
                        <h6 class="mb-3 tx-20 text-white">عدد الموظفين</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-30 font-weight-bold mb-1 text-white justify-content-center">
                                    {{ \App\Models\employees::where('companies_id','=',auth('company')->user()->id)->count() }}
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
                                    {{ \App\Models\biddings::where('companies_id','=',auth('company')->user()->id)->count() }}
                                </h3>
                                <p class="mb-0 tx-12 text-white op-7"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- row closed -->
@endsection
