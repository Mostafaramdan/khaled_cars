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
                    <div class="col-sm-1 col-md-2">
                        <a class="btn btn-primary modal-effect" href="#modaldemo8" data-toggle="modal">اضافة مزاد</a>
                    </div>
                    @include('trader.c_biddings.filter.filter')
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
                                <th class="wd-10p border-bottom-0">تاريخ انتهاء المزاد</th>
                                <th class="wd-20p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($c_biddings))
                            @forelse ($c_biddings as $key => $c_bidding)
                                <tr>
                                    <td>{{ $c_bidding->product->name_ar }}</td>
                                    <td>{{ $c_bidding->Insurance }}</td>
                                    <td>{{ $c_bidding->min_auction }}</td>
                                    @if($c_bidding->type == 'open')
                                        <td>
                                            <form action="{{route('c_biddings.status',$c_bidding->id)}}" method="post">
                                                {{csrf_field()}}
                                                @method('put')
                                                <button type="submit" class="btn btn-sm btn-success pd-x-20">مفتوح</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <form action="{{route('c_biddings.status',$c_bidding->id)}}" method="post">
                                                {{csrf_field()}}
                                                @method('put')
                                                <button type="submit" class="btn btn-sm btn-dark pd-x-20">مغلق</button>
                                            </form>
                                        </td>
                                    @endif
                                    <td>{{ $c_bidding->end_at }}</td>
                                    <td>
                                        <a href="{{ route('c_biddings.show', $c_bidding->id) }}" class="btn btn-sm btn-warning"
                                           title="تعديل"> <i class="las la-eye"></i> عرض </a>
                                        <a href="{{ route('c_biddings.edit', $c_bidding->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        <button class="btn btn-danger btn-sm " data-id="{{ $c_bidding->id }}"
                                                data-name_ar="{{ $c_bidding->product->name_ar }}" data-toggle="modal"
                                                data-target="#modaldemo9"> <i class="las la-trash"></i> حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لم يتم العثور علي أي نتائج</td>
                                </tr>
                            @endforelse


                            </tbody>
                        </table>
                        <br><div class="text-center">{!! $c_biddings->links('layouts.pagination') !!}</div>
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
                        <h6 class="modal-title">اضافة مزاد</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('c_biddings.store') }}" class=parsley-style-1' method="post" enctype="multipart/form-data">
                        @csrf

                    <div class="modal-body">
                        <label for="exampleInputEmail1"><h4><strong>بيانات المنتج</strong></h4></label>
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

                        <div>
                            <label for="exampleInputEmail1">حالة المنتج : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="status" id="status">
                                <option value="" >--- اختر حالة المنتج ---</option>
                                <option value="new" >جديد</option>
                                <option value="antique" >عتيق</option>
                                <option value="rare" >نادر</option>
                                <option value="slight_damage" >ضرر طفيف</option>
                                <option value="damage" >محطم</option>
                            </select>
                        </div>

                        <div>
                            <label for="exampleInputEmail1">السعر : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="price" name="price" required>
                            @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">الموديل : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="models_id" id="models_id">
                                <option value="" >--- اختر الموديل ---</option>
                                @foreach( $models as $model)
                                    <option value="{{$model->id}}" >{{$model->model}}</option>
                                @endforeach
                            </select>
                            @error('model')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">سنة الصنع : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="model_years_id" id="model_years_id">
                                <option value="" >--- اختر سنة الصنع ---</option>
                                @foreach( $model_years as $model_year)
                                    <option value="{{$model_year->id}}" >{{$model_year->model_year}}</option>
                                @endforeach
                            </select>
                            @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">الوصف بالعربية : <span class="tx-danger">*</span> </label>
                            <textarea type="text" class="form-control" id="description_ar" name="description_ar" required></textarea>
                            @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">الوصف بالانجليزية : <span class="tx-danger">*</span> </label>
                            <textarea type="text" class="form-control" id="description_en" name="description_en" required></textarea>
                            @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
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
                        <br>

                        <hr>

                        <label for="exampleInputEmail1"><h4><strong>بيانات المزاد</strong></h4></label>                        <br>

                        <div>
                            <label for="exampleInputEmail1">الحد الأدني للمزاد : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="min_auction" name="min_auction" required>
                            @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">مبلغ التأمين : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="Insurance" name="Insurance" required>
                            @error('Insurance')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">نوع المزاد : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="type" id="type">
                                <option value="" >--- اختر نوع المزاد ---</option>
                                <option value="open" >مفتوح</option>
                                <option value="close" >مغلق</option>
                            </select>
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">تاريخ انتهاء المزاد : <span class="tx-danger">*</span> </label>
                            <input type="date" class="form-control" id="end_at" name="end_at" required>
                            @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
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
                        <h6 class="modal-title">حذف المزاد</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($c_biddings->count() != 0)
                        <form action="c_biddings/destroy" method="post">
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
