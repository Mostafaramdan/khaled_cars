@extends('layouts.master')

@section('title')
    تعديل المدير
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المدراء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                المدير ( {{ $admin->name }} )</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>خطا</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('admins.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    <form action="{{route('admins.update',$admin->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('put')
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
                                <div>
                                    <label for="exampleInputEmail1">الأسم : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('name',$admin->name)}}" class="form-control" id="name" name="name" required>
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">البريد الألكتروني : <span class="tx-danger">*</span> </label>
                                    <input type="email" value="{{old('email',$admin->email)}}" class="form-control" id="email" name="email" required>
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">رقم الهاتف : <span class="tx-danger">*</span> </label>
                                    <input type="text" value="{{old('phone',$admin->phone)}}" class="form-control" id="phone" name="phone" required>
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                <div>
                                    <label for="exampleInputEmail1">كلمة المرور : <span class="tx-danger">*</span> </label>
                                    <input type="password" class="form-control" id="password" name="password" >
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الصلاحيات : <span class="tx-danger">*</span> </label>
                                            <select class="form-control select-multiple-tags" name="permissions[]" id="permissions[]" multiple>
                                                <option value="show_admin"  @if (old('permissions[]', str_contains($admin->permissions, "show_admin")) == 'show_admin') selected @endif>عرض المدراء</option>
                                                <option value="add_admin"   @if (old('permissions[]', str_contains($admin->permissions, "add_admin")) == 'add_admin') selected @endif>اضافة مدراء</option>
                                                <option value="edit_admin"  @if (old('permissions[]', str_contains($admin->permissions, "edit_admin")) == 'edit_admin') selected @endif>تعديل مدراء</option>
                                                <option value="delete_admin"@if (old('permissions[]', str_contains($admin->permissions, "delete_admin")) == 'delete_admin') selected @endif>حدف مدراء</option>

                                                <option value="show_user"  @if (old('permissions[]', str_contains($admin->permissions, "show_user")) == 'show_user') selected @endif >عرض المستخدمين</option>
                                                <option value="add_user"  @if (old('permissions[]', str_contains($admin->permissions, "add_user")) == 'add_user') selected @endif >اضافة مستخدمين</option>
                                                <option value="edit_user"  @if (old('permissions[]', str_contains($admin->permissions, "edit_user")) == 'edit_user') selected @endif >تعديل مستخدمين</option>
                                                <option value="delete_user"  @if (old('permissions[]', str_contains($admin->permissions, "delete_user")) == 'delete_user') selected @endif >حدف مستخدمين</option>

                                                <option value="show_trader"  @if (old('permissions[]', str_contains($admin->permissions, "show_trader")) == 'show_trader') selected @endif >عرض التجار</option>
                                                <option value="add_trader"  @if (old('permissions[]', str_contains($admin->permissions, "add_trader")) == 'add_trader') selected @endif >اضافة تجار</option>
                                                <option value="edit_trader"  @if (old('permissions[]', str_contains($admin->permissions, "edit_trader")) == 'edit_trader') selected @endif >تعديل تجار</option>
                                                <option value="delete_trader"  @if (old('permissions[]', str_contains($admin->permissions, "delete_trader")) == 'delete_trader') selected @endif >حدف تجار</option>

                                                <option value="show_employee"  @if (old('permissions[]', str_contains($admin->permissions, "show_employee")) == 'show_employee') selected @endif >عرض الموظفين</option>
                                                <option value="add_employee"  @if (old('permissions[]', str_contains($admin->permissions, "add_employee")) == 'add_employee') selected @endif >اضافة موظفين</option>
                                                <option value="edit_employee"  @if (old('permissions[]', str_contains($admin->permissions, "edit_employee")) == 'edit_employee') selected @endif >تعديل موظفين</option>
                                                <option value="delete_employee"  @if (old('permissions[]', str_contains($admin->permissions, "delete_employee")) == 'delete_employee') selected @endif >حدف موظفين</option>

                                                <option value="show_bidding" @if (old('permissions[]', str_contains($admin->permissions, "show_bidding")) == 'show_bidding') selected @endif >عرض المزادات</option>
                                                <option value="add_bidding" @if (old('permissions[]', str_contains($admin->permissions, "add_bidding")) == 'add_bidding') selected @endif >اضافة مزادات</option>
                                                <option value="edit_bidding" @if (old('permissions[]', str_contains($admin->permissions, "edit_bidding")) == 'edit_bidding') selected @endif >تعديل مزادات</option>
                                                <option value="delete_bidding" @if (old('permissions[]', str_contains($admin->permissions, "delete_bidding")) == 'delete_bidding') selected @endif >حدف مزادات</option>

                                                <option value="show_order" @if (old('permissions[]', str_contains($admin->permissions, "show_order")) == 'show_order') selected @endif >عرض السيارات المباعة</option>
                                                <option value="add_order" @if (old('permissions[]', str_contains($admin->permissions, "add_order")) == 'add_order') selected @endif >اضافة سيارات مباعة</option>
                                                <option value="edit_order" @if (old('permissions[]', str_contains($admin->permissions, "edit_order")) == 'edit_order') selected @endif >تعديل سيارات مباعة</option>
                                                <option value="delete_order" @if (old('permissions[]', str_contains($admin->permissions, "delete_order")) == 'delete_order') selected @endif >حدف سيارات مباعة</option>

                                                <option value="show_bidder"  @if (old('permissions[]', str_contains($admin->permissions, "show_bidder")) == 'show_bidder') selected @endif >عرض المزايدات</option>
                                                <option value="add_bidder"  @if (old('permissions[]', str_contains($admin->permissions, "add_bidder")) == 'add_bidder') selected @endif >اضافة مزايدات</option>
                                                <option value="edit_bidder"  @if (old('permissions[]', str_contains($admin->permissions, "edit_bidder")) == 'edit_bidder') selected @endif >تعديل مزايدات</option>
                                                <option value="delete_bidder"  @if (old('permissions[]', str_contains($admin->permissions, "delete_bidder")) == 'delete_bidder') selected @endif >حدف مزايدات</option>

                                                <option value="show_insurance"  @if (old('permissions[]', str_contains($admin->permissions, "show_insurance")) == 'show_insurance') selected @endif >عرض طلبات دفع التأمين</option>
                                                <option value="edit_insurance"  @if (old('permissions[]', str_contains($admin->permissions, "edit_insurance")) == 'edit_insurance') selected @endif >تعديل طلبات دفع التأمين</option>
                                                <option value="delete_insurance"  @if (old('permissions[]', str_contains($admin->permissions, "delete_insurance")) == 'delete_insurance') selected @endif >حدف طلبات دفع التأمين</option>

                                                <option value="show_insurance_slide"  @if (old('permissions[]', str_contains($admin->permissions, "show_insurance_slide")) == 'show_insurance_slide') selected @endif >عرض شرائح التأمين</option>
                                                <option value="add_insurance_slide"  @if (old('permissions[]', str_contains($admin->permissions, "add_insurance_slide")) == 'add_insurance_slide') selected @endif >اضافة شرائح التأمين</option>
                                                <option value="edit_insurance_slide"  @if (old('permissions[]', str_contains($admin->permissions, "edit_insurance_slide")) == 'edit_insurance_slide') selected @endif >تعديل شرائح التأمين</option>
                                                <option value="delete_insurance_slide"  @if (old('permissions[]', str_contains($admin->permissions, "delete_insurance_slide")) == 'delete_insurance_slide') selected @endif >حدف شرائح التأمين</option>

                                                <option value="show_brand"  @if (old('permissions[]', str_contains($admin->permissions, "show_brand")) == 'show_brand') selected @endif >عرض العلامات التجارية</option>
                                                <option value="add_brand"  @if (old('permissions[]', str_contains($admin->permissions, "add_brand")) == 'add_brand') selected @endif >اضافة علامات تجارية</option>
                                                <option value="edit_brand"  @if (old('permissions[]', str_contains($admin->permissions, "edit_brand")) == 'edit_brand') selected @endif >تعديل علامات تجارية</option>
                                                <option value="delete_brand"  @if (old('permissions[]', str_contains($admin->permissions, "delete_brand")) == 'delete_brand') selected @endif >حدف علامات تجارية</option>

                                                <option value="show_model"  @if (old('permissions[]', str_contains($admin->permissions, "show_model")) == 'show_model') selected @endif >عرض الموديل</option>
                                                <option value="add_model"  @if (old('permissions[]', str_contains($admin->permissions, "add_model")) == 'add_model') selected @endif >اضافة موديل</option>
                                                <option value="edit_model"  @if (old('permissions[]', str_contains($admin->permissions, "edit_model")) == 'edit_model') selected @endif >تعديل موديل</option>
                                                <option value="delete_model"  @if (old('permissions[]', str_contains($admin->permissions, "delete_model")) == 'delete_model') selected @endif >حدف موديل</option>

                                                <option value="show_model_year"  @if (old('permissions[]', str_contains($admin->permissions, "show_model_year")) == 'show_model_year') selected @endif >عرض سنوات الموديلات</option>
                                                <option value="add_model_year"  @if (old('permissions[]', str_contains($admin->permissions, "add_model_year")) == 'add_model_year') selected @endif >اضافة سنوات الموديلات</option>
                                                <option value="edit_model_year"  @if (old('permissions[]', str_contains($admin->permissions, "edit_model_year")) == 'edit_model_year') selected @endif >تعديل سنوات الموديلات</option>
                                                <option value="delete_model_year"  @if (old('permissions[]', str_contains($admin->permissions, "delete_model_year")) == 'delete_model_year') selected @endif >حدف سنوات الموديلات</option>

                                                <option value="show_feature"  @if (old('permissions[]', str_contains($admin->permissions, "show_feature")) == 'show_feature') selected @endif >عرض الميزات</option>
                                                <option value="add_feature"  @if (old('permissions[]', str_contains($admin->permissions, "add_feature")) == 'add_feature') selected @endif >اضافة ميزات</option>
                                                <option value="edit_feature"  @if (old('permissions[]', str_contains($admin->permissions, "edit_feature")) == 'edit_feature') selected @endif >تعديل ميزات</option>
                                                <option value="delete_feature"  @if (old('permissions[]', str_contains($admin->permissions, "delete_feature")) == 'delete_feature') selected @endif >حدف ميزات</option>

                                                <option value="show_country"  @if (old('permissions[]', str_contains($admin->permissions, "show_country")) == 'show_country') selected @endif >عرض البلاد</option>
                                                <option value="add_country"  @if (old('permissions[]', str_contains($admin->permissions, "add_country")) == 'add_country') selected @endif >اضافة بلاد</option>
                                                <option value="edit_country"  @if (old('permissions[]', str_contains($admin->permissions, "edit_country")) == 'edit_country') selected @endif >تعديل بلاد</option>
                                                <option value="delete_country"  @if (old('permissions[]', str_contains($admin->permissions, "delete_country")) == 'delete_country') selected @endif >حدف بلاد</option>

                                                <option value="show_city"  @if (old('permissions[]', str_contains($admin->permissions, "show_city")) == 'show_city') selected @endif >عرض المحافظات</option>
                                                <option value="add_city"  @if (old('permissions[]', str_contains($admin->permissions, "add_city")) == 'add_city') selected @endif >اضافة محافظات</option>
                                                <option value="edit_city"  @if (old('permissions[]', str_contains($admin->permissions, "edit_city")) == 'edit_city') selected @endif >تعديل محافظات</option>
                                                <option value="delete_city"  @if (old('permissions[]', str_contains($admin->permissions, "delete_city")) == 'delete_city') selected @endif >حدف محافظات</option>

                                                <option value="show_region"  @if (old('permissions[]', str_contains($admin->permissions, "show_region")) == 'show_region') selected @endif >عرض الأحياء</option>
                                                <option value="add_region"  @if (old('permissions[]', str_contains($admin->permissions, "add_region")) == 'add_region') selected @endif >اضافة أحياء</option>
                                                <option value="edit_region"  @if (old('permissions[]', str_contains($admin->permissions, "edit_region")) == 'edit_region') selected @endif >تعديل أحياء</option>
                                                <option value="delete_region"  @if (old('permissions[]', str_contains($admin->permissions, "delete_region")) == 'delete_region') selected @endif >حدف أحياء</option>

                                                <option value="setting"  @if (old('permissions[]', str_contains($admin->permissions, "setting")) == 'setting') selected @endif>تعديل اعدادات التطبيق</option>

                                                <option value="contact" @if (old('permissions[]', str_contains($admin->permissions, "contact")) == 'contact') selected @endif>عرض الرسائل</option>
                                            </select>
                                            @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                        </div>
                        </form>

                    </div>
                </div>

                <!-- main-content closed -->
@endsection
