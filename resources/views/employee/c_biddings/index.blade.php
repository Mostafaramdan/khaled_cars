@extends('layouts.master')
@section('css')



@section('title')
    المزادات
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!-- breadcrumb -->
    @toastr_css
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المزادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                <th class="wd-15p border-bottom-0">مبلغ التأمين</th>
                                <th class="wd-15p border-bottom-0">الحد الأدني للمزاد</th>
                                <th class="wd-10p border-bottom-0">النوع</th>
                                <th class="wd-20p border-bottom-0">عرض</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($c_biddings as $key => $c_bidding)
                                <tr>
                                    <td>{{ $c_bidding->product->name_ar }}</td>
                                    <td>{{ $c_bidding->Insurance }}</td>
                                    <td>{{ $c_bidding->min_auction }}</td>
                                    @if($c_bidding->type == 'open')

                                        <td>
                                            مفتوح
                                        </td>
                                    @else
                                        <td>
                                            مغلق

                                        </td>
                                    @endif
                                    <td>
                                        <button class="btn btn-warning btn-sm " data-id="{{ $c_bidding->id }}"
                                                data-name_ar="{{ $c_bidding->product->name_ar }}"
                                                data-brand_name="{{ $c_bidding->product->brand->name_ar }}"
                                                data-Insurance="{{ $c_bidding->Insurance }}"
                                                data-min_auction="{{ $c_bidding->min_auction }}"
                                                data-toggle="modal"
                                                data-target="#modaldemo9"> <i class="las la-eye"></i> عرض</button>

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <br><div class="text-center">{!! $c_biddings->links('layouts.pagination') !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">عرض الرسالة</h6><button aria-label="Close" class="close"
                                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($c_biddings->count() != 0)
                        <form action="trucks/destroy" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <br>
                                <input type="hidden" name="user_id" id="user_id" value="">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="exampleInputEmail1">اسم المنتج :  </label>
                                <textarea class="form-control textarea" name="name_ar" id="name_ar" type="text" readonly></textarea><br>
                                <label for="exampleInputEmail1">العلامة التجارية للمنتج :  </label>
                                <textarea class="form-control textarea" name="brand_name" id="brand_name" type="text" readonly></textarea><br>
                                <label for="exampleInputEmail1">الحد الأدني للمزاد :  </label>
                                <textarea class="form-control textarea" name="min_auction" id="min_auction" type="text" readonly></textarea><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>


    @endsection
    @section('js')
        <!-- Internal Data tables -->
            <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
            <!--Internal  Datatable js -->
            <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
            <!--Internal  Notify js -->
            <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
            <!-- Internal Modal js-->
            <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
            @toastr_js
            @toastr_render
            <script>
                $('#modaldemo9').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var name_ar = button.data('name_ar')
                    var cat_name = button.data('cat_name')
                    var brand_name = button.data('brand_name')
                    var Insurance = button.data('Insurance')
                    var min_auction = button.data('min_auction')
                    var modal = $(this)

                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #name_ar').val(name_ar);
                    modal.find('.modal-body #cat_name').val(cat_name);
                    modal.find('.modal-body #brand_name').val(brand_name);
                    modal.find('.modal-body #Insurance').val(Insurance);
                    modal.find('.modal-body #min_auction').val(min_auction);
                })
            </script>
@endsection
