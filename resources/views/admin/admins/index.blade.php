@extends('layouts.master')
@section('css')



@section('title')
    المدراء
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
                <h4 class="content-title mb-0 my-auto">المدراء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                    @if (str_contains(auth('admin')->user()->permissions, "add_admin") !== false)
                    <div class="col-sm-1 col-md-2">
                        <a class="btn btn-primary modal-effect" href="#modaldemo8" data-toggle="modal">اضافة مدير</a>
                    </div>
                    @endif
                    @include('admin.admins.filter.filter')
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">الأسم</th>
                                <th class="wd-15p border-bottom-0">الإيميل</th>
                                <th class="wd-15p border-bottom-0">رقم الهاتف</th>
                                <th class="wd-15p border-bottom-0">الحالة</th>
                                @if (str_contains(auth('admin')->user()->permissions, "delete_admin") !== false || str_contains(auth('admin')->user()->permissions, "edit_admin") !== false)
                                <th class="wd-15p border-bottom-0">العمليات</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($admins))
                            @forelse ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    @if($admin->is_active == 1)
                                        <td>
                                            <form action="{{route('admins.status',$admin->id)}}" method="post">
                                            {{csrf_field()}}
                                            @method('put')
                                                <button type="submit" class="btn btn-sm btn-success pd-x-20">مفعل</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <form action="{{route('admins.status',$admin->id)}}" method="post">
                                                {{csrf_field()}}
                                                @method('put')
                                                <button type="submit" class="btn btn-sm btn-danger pd-x-20">غير مفعل</button>
                                            </form>
                                        </td>
                                    @endif
                                    {{--@if((str_contains($admin->permissions, "add") !== false && str_contains($admin->permissions, "edit") !== false && str_contains($admin->permissions, "delete") !== false))
                                        <td>كل الصلاحيات</td>
                                    @elseif($admin->permissions == 'add')
                                        <td>اضافة</td>
                                    @elseif($admin->permissions == 'edit')
                                        <td>تعديل</td>
                                    @elseif($admin->permissions == 'delete')
                                        <td>حذف</td>
                                    @elseif((str_contains($admin->permissions, "add") !== false && str_contains($admin->permissions, "edit") !== true && str_contains($admin->permissions, "delete") !== false))
                                        <td>اضافة و حذف</td>
                                    @elseif((str_contains($admin->permissions, "add") !== false && str_contains($admin->permissions, "edit") !== false && str_contains($admin->permissions, "delete") !== true))
                                        <td>اضافة و تعديل</td>
                                    @elseif((str_contains($admin->permissions, "add") !== true && str_contains($admin->permissions, "edit") !== false && str_contains($admin->permissions, "delete") !== false))
                                        <td>تعديل و حذف</td>
                                    @else
                                        <td>عرض</td>
                                    @endif--}}
                                    @if (str_contains(auth('admin')->user()->permissions, "edit_admin") !== false || str_contains(auth('admin')->user()->permissions, "delete_admin") !== false)
                                    <td>
                                        @if (str_contains(auth('admin')->user()->permissions, "edit_admin") !== false)
                                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        @endif
                                        @if (str_contains(auth('admin')->user()->permissions, "delete_admin") !== false)
                                        <button class="btn btn-danger btn-sm " data-id="{{ $admin->id }}"
                                                data-name_ar="{{ $admin->name }}" data-toggle="modal"
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
                        <br><div class="text-center">{!! $admins->links('layouts.pagination') !!}</div>
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
                        <h6 class="modal-title">اضافة المدير</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('admins.store') }}" class=parsley-style-1' method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">

                        <div>
                            <label for="exampleInputEmail1">الأسم : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">البريد الألكتروني : <span class="tx-danger">*</span> </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">رقم الهاتف : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">كلمة المرور : <span class="tx-danger">*</span> </label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الصلاحيات : <span class="tx-danger">*</span> </label>
                                    <select class="form-control select-multiple-tags" name="permissions[]" id="permissions[]" multiple>

                                        <option value="show_admin">عرض المدراء</option>
                                        <option value="add_admin">اضافة مدراء</option>
                                        <option value="edit_admin">تعديل مدراء</option>
                                        <option value="delete_admin">حدف مدراء</option>

                                        <option value="show_user">عرض المستخدمين</option>
                                        <option value="add_user">اضافة مستخدمين</option>
                                        <option value="edit_user">تعديل مستخدمين</option>
                                        <option value="delete_user">حدف مستخدمين</option>

                                        <option value="show_trader">عرض التجار</option>
                                        <option value="add_trader">اضافة تجار</option>
                                        <option value="edit_trader">تعديل تجار</option>
                                        <option value="delete_trader">حدف تجار</option>

                                        <option value="show_employee">عرض الموظفين</option>
                                        <option value="add_employee">اضافة موظفين</option>
                                        <option value="edit_employee">تعديل موظفين</option>
                                        <option value="delete_employee">حدف موظفين</option>

                                        <option value="show_bidding">عرض المزادات</option>
                                        <option value="add_bidding">اضافة مزادات</option>
                                        <option value="edit_bidding">تعديل مزادات</option>
                                        <option value="delete_bidding">حدف مزادات</option>

                                        <option value="show_order">عرض السيارات المباعة</option>
                                        <option value="delete_order">حدف سيارات مباعة</option>

                                        <option value="show_bidder">عرض المزايدات</option>

                                        <option value="show_insurance">عرض طلبات دفع التأمين</option>
                                        <option value="edit_insurance">تعديل طلبات دفع التأمين</option>
                                        <option value="delete_insurance">حدف طلبات دفع التأمين</option>

                                        <option value="show_insurance_slide">عرض شرائح التأمين</option>
                                        <option value="add_insurance_slide">اضافة شرائح التأمين</option>
                                        <option value="edit_insurance_slide">تعديل شرائح التأمين</option>
                                        <option value="delete_insurance_slide">حدف شرائح التأمين</option>

                                        <option value="show_brand">عرض العلامات التجارية</option>
                                        <option value="add_brand">اضافة علامات تجارية</option>
                                        <option value="edit_brand">تعديل علامات تجارية</option>
                                        <option value="delete_brand">حدف علامات تجارية</option>

                                        <option value="show_model">عرض الموديل</option>
                                        <option value="add_model">اضافة موديل</option>
                                        <option value="edit_model">تعديل موديل</option>
                                        <option value="delete_model">حدف موديل</option>

                                        <option value="show_model_year">عرض سنوات الموديلات</option>
                                        <option value="add_model_year">اضافة سنوات الموديلات</option>
                                        <option value="edit_model_year">تعديل سنوات الموديلات</option>
                                        <option value="delete_model_year">حدف سنوات الموديلات</option>

                                        <option value="show_feature">عرض الميزات</option>
                                        <option value="add_feature">اضافة ميزات</option>
                                        <option value="edit_feature">تعديل ميزات</option>
                                        <option value="delete_feature">حدف ميزات</option>

                                        <option value="show_country">عرض البلاد</option>
                                        <option value="add_country">اضافة بلاد</option>
                                        <option value="edit_country">تعديل بلاد</option>
                                        <option value="delete_country">حدف بلاد</option>

                                        <option value="show_city">عرض المحافظات</option>
                                        <option value="add_city">اضافة محافظات</option>
                                        <option value="edit_city">تعديل محافظات</option>
                                        <option value="delete_city">حدف محافظات</option>

                                        <option value="show_region">عرض الأحياء</option>
                                        <option value="add_region">اضافة أحياء</option>
                                        <option value="edit_region">تعديل أحياء</option>
                                        <option value="delete_region">حدف أحياء</option>

                                        <option value="setting">تعديل اعدادات التطبيق</option>

                                        <option value="contact">عرض الرسائل</option>

                                    </select>
                                    @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
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
                        <h6 class="modal-title">حذف المدير</h6><button aria-label="Close" class="close"
                                                                         data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @if($admins->count() != 0)
                        <form action="admins/destroy" method="post">
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
