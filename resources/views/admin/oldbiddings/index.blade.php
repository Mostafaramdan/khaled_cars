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
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">اسم المنتج</th>
                                <th class="wd-10p border-bottom-0">مبلغ التأمين</th>
                                <th class="wd-15p border-bottom-0">الحد الأدني للمزاد</th>
                                <th class="wd-10p border-bottom-0">التاريخ</th>
                                <th class="wd-10p border-bottom-0">النوع</th>
                                <th class="wd-15p border-bottom-0">التاجر</th>
                                <th class="wd-20p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($biddings as $key => $bidding)
                                <tr>
                                    <td>{{ $bidding->product->name_ar }}</td>
                                    <td>{{ $bidding->Insurance }}</td>
                                    <td>{{ $bidding->min_auction }}</td>
                                    <td>{{ $bidding->end_at }}</td>
                                    @if($bidding->type == 'open')

                                        <td>
                                            {!! Form::model($bidding,['route' => ['biddings.status' , $bidding->id], 'method' => 'put']) !!}
                                            {!! Form::submit('مفتوح', ['class' => 'btn btn-sm btn-success pd-x-20']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    @else
                                        <td>
                                            {!! Form::model($bidding,['route' => ['biddings.status' , $bidding->id], 'method' => 'put']) !!}
                                            {!! Form::submit('مغلق', ['class' => 'btn btn-sm btn-dark pd-x-20']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    @endif
                                    @if($bidding->companies_id !== null)
                                        <td>  شركة : {{ $bidding->company->name }}</td>
                                    @elseif($bidding->banks_id !== null)
                                        <td>  بنك : {{ $bidding->bank->name }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('biddings.show', $bidding->id) }}" class="btn btn-sm btn-warning"
                                           title="عرض"> <i class="las la-eye"></i> عرض </a>
                                        <a href="{{ route('biddings.edit', $bidding->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        <button class="btn btn-danger btn-sm " data-id="{{ $bidding->id }}"
                                                data-name_ar="{{ $bidding->name_ar }}" data-toggle="modal"
                                                data-target="#modaldemo9"> <i class="las la-trash"></i> حذف</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br><div class="text-center">{!! $biddings->links('layouts.pagination') !!}</div>
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
                    {{ Form::open(['route' => 'biddings.store', 'class' => 'parsley-style-1', 'method' => 'post']) }}
                    @csrf

                    <div class="modal-body">
                        {!! Html::decode(Form::label('products_id', '<h4><strong>بيانات المنتج</strong></h4>'))!!}
                        <br>

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
                            {!! Html::decode(Form::label('status', 'حالة المنتج : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('status',
array("new"=>"جديد","antique" => "عتيق","rare"=>"نادر","slight_damage"=>"ضرر طفيف","damage"=>"محطم"),old('status'),
 array( 'class' => 'form-control  nice-select  custom-select', 'tabindex' => '2','placeholder'=>'--- اختر حالة المنتج  ---',)) !!}
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('price', 'السعر : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('price', old('price'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('model', 'الموديل : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('model', old('model'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('model')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('model_year', 'سنة الصنع : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('model_year', old('model_year'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
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
                            {!! Html::decode(Form::label('brands_id', 'العلامة التجارية : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('brands_id', App\Models\brands::pluck('name_ar', 'id'),old('brands_id'),[
                                'name'=>'brands_id','placeholder'=>'--- اختر العلامة التجارية ---','class'=>'form-control mg-b-20"
                                                   data-parsley-class-handler="#lnWrapper' ]) !!}
                        </div>
                        <br>


                        <hr>
                        {!! Html::decode(Form::label('products_id', '<h4><strong>بيانات المزاد</strong></h4>'))!!}
                        <br>

                        <div>
                            {!! Html::decode(Form::label('Insurance', 'مبلغ التأمين : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('Insurance', old('Insurance'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('Insurance')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('min_auction', 'الحد الأدني للمزاد : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('min_auction', old('min_auction'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>


                        <div>
                            {!! Html::decode(Form::label('type', 'نوع المزاد : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('type',  array("open"=>"مفتوح","close" => "مغلق"),old('type'), array( 'class' => 'form-control  nice-select  custom-select', 'tabindex' => '2',)) !!}
                            @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('companies_id', 'الشركة ( يمكن تركها فارغة ) : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('companies_id', App\Models\companies::pluck('name', 'id'),old('companies_id'),['placeholder'=>'--- اختر الشركة ---','class'=>'form-control mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('companies_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('banks_id', 'البنك ( يمكن تركها فارغة ) : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('banks_id', App\Models\banks::pluck('name', 'id'),old('banks_id'),['placeholder'=>'--- اختر البنك ---','class'=>'form-control mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('banks_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('end_at', 'تاريخ انتهاء المزاد : <span class="tx-danger">*</span>'))!!}
                            {!! Form::date('end_at', old('end_at'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
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
                        <h6 class="modal-title">حذف المزاد</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($biddings->count() != 0)
                        <form action="biddings/destroy" method="post">
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
