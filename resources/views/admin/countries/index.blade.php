@extends('layouts.master')
@section('css')



@section('title')
    البلاد
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
                <h4 class="content-title mb-0 my-auto">البلاد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                    @if (str_contains(auth('admin')->user()->permissions, "add_country") !== false)
                    <div class="col-sm-1 col-md-2">
                        <a class="btn btn-primary modal-effect" href="#modaldemo8" data-toggle="modal">اضافة بلد</a>
                    </div>
                    @endif
                    @include('admin.countries.filter.filter')
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">الكود</th>
                                <th class="wd-15p border-bottom-0">Mobile EX</th>
                                <th class="wd-15p border-bottom-0">مفتاح البلد</th>
                                <th class="wd-15p border-bottom-0">الأسم بالعربية</th>
                                <th class="wd-15p border-bottom-0">الأسم بالأنجليزية</th>
                                <th class="wd-15p border-bottom-0">الحالة</th>
                                @if (str_contains(auth('admin')->user()->permissions, "delete_country") !== false || str_contains(auth('admin')->user()->permissions, "edit_country") !== false)
                                <th class="wd-15p border-bottom-0">العمليات</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($countries))
                            @forelse ($countries as $key => $country)
                                <tr>
                                    <td>{{ $country->code }}</td>
                                    <td>{{ $country->mobile_ex }}</td>
                                    <td>{{ $country->call_key }}</td>
                                    <td>{{ $country->name_ar }}</td>
                                    <td>{{ $country->name_en }}</td>
                                    @if($country->is_active == 1)
                                        <td>
                                            <form action="{{route('countries.status',$country->id)}}" method="post">
                                                {{csrf_field()}}
                                                @method('put')
                                                <button type="submit" class="btn btn-sm btn-success pd-x-20">مفعل</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <form action="{{route('countries.status',$country->id)}}" method="post">
                                                {{csrf_field()}}
                                                @method('put')
                                                <button type="submit" class="btn btn-sm btn-danger pd-x-20">غير مفعل</button>
                                            </form>
                                        </td>
                                    @endif
                                    @if (str_contains(auth('admin')->user()->permissions, "edit_country") !== false || str_contains(auth('admin')->user()->permissions, "edit_country") !== false)
                                    <td>
                                        @if (str_contains(auth('admin')->user()->permissions, "edit_country") !== false)
                                        <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        @endif
                                        @if (str_contains(auth('admin')->user()->permissions, "delete_country") !== false)
                                        <button class="btn btn-danger btn-sm " data-id="{{ $country->id }}"
                                                data-name_ar="{{ $country->name_ar }}" data-toggle="modal"
                                                data-target="#modaldemo9"> <i class="las la-trash"></i> حذف</button>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لم يتم العثور علي أي نتائج</td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <br><div class="text-center">{!! $countries->links('layouts.pagination') !!}</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!--/div-->

        <!-- Modal effects -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة البلد</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('countries.store') }}" class=parsley-style-1' method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                        <div>
                            <label for="exampleInputEmail1">الكود : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="code" name="code" required>
                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1"> Mobile Ex  : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="mobile_ex" name="mobile_ex" required>
                            @error('mobile_ex')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">مفتاح البلد : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="call_key" name="call_key" required>
                            @error('call_key')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">الأسم بالعربية : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                            @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">الأسم بالأنجليزية : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="name_en" name="name_en" required>
                            @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">اضافة</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal effects -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف البلد</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($countries->count() != 0)
                        <form action="countries/destroy" method="post">
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
