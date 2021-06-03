@extends('layouts.master')
@section('css')



@section('title')
    المستخدمين
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
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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

                        <a class="btn btn-primary modal-effect" href="#modaldemo8" data-toggle="modal">اضافة مستخدم</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">الأسم</th>
                                <th class="wd-15p border-bottom-0">التليفون</th>
                                <th class="wd-15p border-bottom-0">الأيميل</th>
                                <th class="wd-10p border-bottom-0">الحالة</th>
                                <th class="wd-20p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone !== null ? $user->phone : 'غير متوفر' }}</td>
                                    <td>{{ $user->email !== null ? $user->email : 'غير متوفر'}}</td>
                                    @if($user->is_active == 1)

                                        <td>
                                            {!! Form::model($user,['route' => ['users.status' , $user->id], 'method' => 'put']) !!}
                                            {!! Form::submit('مفعل', ['class' => 'btn btn-sm btn-success pd-x-20']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    @else
                                        <td>
                                            {!! Form::model($user,['route' => ['users.status' , $user->id], 'method' => 'put']) !!}
                                            {!! Form::submit('غير مفعل', ['class' => 'btn btn-sm btn-danger pd-x-20']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-warning"
                                           title="تعديل"> <i class="las la-eye"></i> عرض </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        <button class="btn btn-danger btn-sm " data-id="{{ $user->id }}"
                                                data-name_ar="{{ $user->name }}" data-toggle="modal"
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
                        <h6 class="modal-title">اضافة مستخدم</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    {{ Form::open(['route' => 'users.store', 'class' => 'parsley-style-1', 'method' => 'post', 'files'=> true]) }}
                    @csrf
                    <div class="modal-body">
                        <div>
                            {!! Html::decode(Form::label('name', 'الأسم : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('name', old('name'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            {!! Html::decode(Form::label('phone', 'رقم الهاتف : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('phone', old('phone'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('email', 'الايميل : <span class="tx-danger">*</span>'))!!}
                            {!! Form::text('email', old('email'),['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('password', 'كلمة السر : <span class="tx-danger">*</span>'))!!}
                            {!! Form::password('password', ['class'=>'form-control  mg-b-20"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('lang', 'اللغة : <span class="tx-danger">*</span>'))!!}
                            {!! Form::select('lang',  array("ar"=>"العربية","en" => "الانجليزية"),old('lang'), array( 'class' => 'form-control  nice-select  custom-select', 'tabindex' => '2',)) !!}
                            @error('lang')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            {!! Html::decode(Form::label('image', 'الصورة : '))!!}
                            {!! Form::file('image',['class'=>'form-control form-control"
                                               data-parsley-class-handler="#lnWrapper' ]) !!}
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
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
                        <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($users->count() != 0)
                        <form action="users/destroy" method="post">
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
