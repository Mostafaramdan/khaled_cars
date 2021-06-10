@extends('layouts.master')
@section('css')



@section('title')
    السيارات المباعة
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
                <h4 class="content-title mb-0 my-auto">السيارات المباعة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                    @include('admin.orders.filter.filter')
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">المستخدم</th>
                                <th class="wd-10p border-bottom-0">المنتج</th>
                                <th class="wd-15p border-bottom-0">التاجر</th>
                                <th class="wd-10p border-bottom-0">سعر البيع</th>
                                <th class="wd-5p border-bottom-0">الضريبة</th>
                                <th class="wd-10p border-bottom-0">اجمالي المبلغ</th>
                                <th class="wd-5p border-bottom-0">الحالة</th>
                                <th class="wd-10p border-bottom-0">التاريخ</th>
                                <th class="wd-15p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($orders))
                            @forelse($orders as $key => $order)
                                <tr>
                                    <td>{{ $order->bidder->user->name }}</td>
                                    <td>{{ $order->bidder->bidding->product->name_ar }}</td>
                                    @if($order->bidder->bidding->trader->type == 'company')
                                        <td>  <span style="color: limegreen">( شركة )</span>  {{ $order->bidder->bidding->trader->name}}</td>
                                    @elseif($order->bidder->bidding->trader->type == 'bank')
                                        <td>  <span style="color: #dc2a2a">( بنك )</span>  {{ $order->bidder->bidding->trader->name }}</td>
                                    @endif
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->fees }}</td>
                                    <td>{{ $order->total }}</td>
                                    @if($order->status == 'coming')
                                            <td>
                                                <form action="{{route('orders.status',$order->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-success pd-x-20">قادم</button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <form action="{{route('orders.status',$order->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-dark pd-x-20">الانتظار</button>
                                                </form>
                                            </td>
                                    @endif
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-warning"
                                           title="عرض"> <i class="las la-eye"></i> عرض </a>
                                        @if (str_contains(auth('admin')->user()->permissions, "delete_order") !== false)
                                        <button class="btn btn-danger btn-sm " data-id="{{ $order->id }}"
                                                data-name_ar="{{ $order->bidder->user->name }}" data-toggle="modal"
                                                data-target="#modaldemo9"> <i class="las la-trash"></i> حذف</button>
                                        @endif
                                    </td>

                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لم يتم العثور علي أي نتائج</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <br><div class="text-center">{!! $orders->links('layouts.pagination') !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


        <!-- Modal effects -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف السيارة المباعة</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($orders->count() != 0)
                        <form action="orders/destroy" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="user_id" id="user_id" value="">
                                <input type="hidden" name="id" id="id" value="">
                                <input class="form-control" name="name_ar" id="name_ar" type="text" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    @endif
                </div>
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
                    var modal = $(this)

                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #name_ar').val(name_ar);
                })
            </script>
@endsection
