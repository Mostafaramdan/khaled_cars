@extends('layouts.master')
@section('css')



@section('title')
    المنتجات
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
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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

                        <a class="btn btn-primary modal-effect" href="#modaldemo8" data-toggle="modal">اضافة منتج</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">الأسم بالعربية</th>
                                <th class="wd-15p border-bottom-0">الأسم بالأنجليزية</th>
                                <th class="wd-15p border-bottom-0">العلامة التجارية</th>
                                <th class="wd-15p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $product->name_ar }}</td>
                                    <td>{{ $product->name_en }}</td>
                                    <td>{{ $product->brands->name_ar }}</td>

                                    <td>
                                        <button class="btn btn-warning btn-sm " data-id="{{ $product->id }}"
                                                data-features="{{ $product->features }}"
                                                data-description_ar="{{ $product->description_ar }}"
                                                data-description_en="{{ $product->description_en }}"
                                                data-toggle="modal"
                                                data-target="#modaldemo7"> <i class="las la-eye"></i> عرض</button>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        <button class="btn btn-danger btn-sm " data-id="{{ $product->id }}"
                                                data-name_ar="{{ $product->name_ar }}" data-toggle="modal"
                                                data-target="#modaldemo9"> <i class="las la-trash"></i> حذف</button>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
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
                        <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    {{ Form::open(['route' => 'products.store', 'class' => 'parsley-style-1', 'method' => 'post']) }}
                    @csrf
                    <div class="modal-body">
                        <div>
                            {!! Html::decode(Form::label('name_ar', 'الأسم بالعربية : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('name_ar', old('name_ar'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('name_en', 'الأسم بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('name_en', old('name_en'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('description_ar', 'الوصف بالعربية : <span class="tx-danger">*</span>'))!!}
                            {!! Form::textarea('description_ar', old('description_ar'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('description_en', 'الوصف بالأنجليزية : <span class="tx-danger">*</span>'))!!}
                            {!! Form::textarea('description_en', old('description_en'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('features', 'المميزات : <span class="tx-danger">*</span>'))!!}
                            {!! Form::textarea('features', old('features'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('features')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('categories_id', 'القسم : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('categories_id', App\Models\categories::pluck('name_ar', 'id'),old('categories_id'),[
                                'name'=>'categories_id','placeholder'=>'--- اختر القسم ---','class'=>'form-control mg-b-20"
                                                   data-parsley-class-handler="#lnWrapper' ]) !!}
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('brands_id', 'العلامة التجارية : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('brands_id', [],old('brands_id'),[
                                   'name'=>'brands_id','placeholder'=>'--- اختر العلامة التجارية ---','class'=>'form-control mg-b-20"
                                                      data-parsley-class-handler="#lnWrapper' ]) !!}
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        {!! Form::submit('إضافة', ['class' => 'btn btn-main-primary']) !!}
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

        <!-- Modal effects -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($products->count() != 0)
                        <form action="products/destroy" method="post">
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

        <div class="modal" id="modaldemo7">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">عرض بيانات المنتج</h6><button aria-label="Close" class="close"
                                                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($products->count() != 0)
                        <form  method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <br>
                                <input type="hidden" name="user_id" id="user_id" value="">
                                <input type="hidden" name="id" id="id" value="">
                                {!! Html::decode(Form::label('description_ar', 'الوصف بالعربية'))!!}
                                <textarea class="form-control textarea" name="description_ar" id="description_ar" type="text" readonly></textarea>
                                <br>
                                {!! Html::decode(Form::label('description_en', 'الوصف بالأنجليزية'))!!}
                                <textarea class="form-control textarea" name="description_en" id="description_en" type="text" readonly></textarea>
                                <br>
                                {!! Html::decode(Form::label('features', 'المميزات'))!!}
                                <textarea class="form-control textarea" name="features" id="features" type="text" readonly></textarea>
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
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
            <script>
                $('#modaldemo7').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var description_ar = button.data('description_ar')
                    var description_en = button.data('description_en')
                    var features = button.data('features')
                    var modal = $(this)

                    modal.find('.modal-body #id').val(id);
                    modal.find('.modal-body #description_ar').val(description_ar);
                    modal.find('.modal-body #description_en').val(description_en);
                    modal.find('.modal-body #features').val(features);
                })
            </script>
            <script>
                $(document).ready(function ()
                {
                    $('select[name="categories_id"]').on('change',function(){
                        var tID = $(this).val();
                        if(tID)
                        {
                            $.ajax({
                                url : '/admin/gettype/' +tID,
                                type : "GET",
                                dataType : "json",
                                success:function(data)
                                {
                                    console.log(data);
                                    $('select[name="brands_id"]').empty();
                                    $.each(data, function(key,value){
                                        if (key !==null && value !== null){
                                            $('select[name="brands_id"]').append(' <option value="'+ key +'"> '+ value +'<option/>');
                                        }
                                    });
                                }
                            });
                        }
                        else
                        {
                            $('select[name="brands_id"]').empty();
                        }
                    });
                });
            </script>
@endsection
