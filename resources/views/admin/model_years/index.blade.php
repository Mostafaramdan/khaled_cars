@extends('layouts.master')
@section('css')



@section('title')
    سنوات الموديلات
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
                <h4 class="content-title mb-0 my-auto">سنوات الموديلات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                    @if (str_contains(auth('admin')->user()->permissions, "add_model_year") !== false)
                    <div class="col-sm-1 col-md-2">
                        <a class="btn btn-primary modal-effect" href="#modaldemo8" data-toggle="modal">اضافة سنة موديل</a>
                    </div>
                    @endif
                    @include('admin.model_years.filter.filter')
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">سنة موديل</th>
                                <th class="wd-15p border-bottom-0">العلامة التجارية</th>
                                @if (str_contains(auth('admin')->user()->permissions, "delete_model_year") !== false || str_contains(auth('admin')->user()->permissions, "edit_model_year") !== false)
                                <th class="wd-15p border-bottom-0">العمليات</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($model_years))
                            @forelse ($model_years as $key => $model_year)
                                <tr>
                                    <td>{{ $model_year->model_year }}</td>
                                    <td>{{ $model_year->brand->name_ar??'' }}</td>
                                    @if (str_contains(auth('admin')->user()->permissions, "delete_model_year") !== false || str_contains(auth('admin')->user()->permissions, "edit_model_year") !== false)
                                    <td>
                                        @if (str_contains(auth('admin')->user()->permissions, "edit_model_year") !== false)
                                        <a href="{{ route('model_years.edit', $model_year->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        @endif
                                        @if (str_contains(auth('admin')->user()->permissions, "delete_model_year") !== false)
                                        <button class="btn btn-danger btn-sm " data-id="{{ $model_year->id }}"
                                                data-name_ar="{{ $model_year->model_year }}" data-toggle="modal"
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
                        <br><div class="text-center">{!! $model_years->links('layouts.pagination') !!}</div>
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
                        <h6 class="modal-title">اضافة سنة موديل</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('model_years.store') }}" class=parsley-style-1' method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                        <div>
                            <label for="exampleInputEmail1"> سنة موديل : <span class="tx-danger">*</span> </label>
                            <input type="number" class="form-control" id="model_year" name="model_year" required>
                            @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">العلامة التجارية : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="brands_id" id="brands_id">
                                <option value="" >--- اختر العلامة التجارية ---</option>
                                @foreach( $brands as $brand)
                                    <option value="{{$brand->id}}" >{{$brand->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <h6 class="modal-title">حذف سنة موديل</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($model_years->count() != 0)
                        <form action="model_years/destroy" method="post">
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
