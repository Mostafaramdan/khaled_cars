@extends('layouts.master')
@section('css')



@section('title')
    الاعلانات
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
                <h4 class="content-title mb-0 my-auto">الاعلانات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                    @if(auth('admin')->check())
                    @if (str_contains(auth('admin')->user()->permissions, "add_bidding") !== false)
                        <div class="row">
                            <div class="col-sm-1 col-md-2">
                                <div class="form-group">
                                    <a class="btn btn-primary modal-effect" href="#modaldemo8" data-toggle="modal"><i
                                            class="las la-plus"></i> اعلان  </a>
                                </div>
                            </div>
                            <!-- <div class="col-sm-1 col-md-2">
                                <div class="form-group">
                                    <a class="btn btn-primary modal-effect" href="#modaldemo11" data-toggle="modal"><i
                                            class="las la-plus"></i> اعلان لشركة </a>
                                </div>
                            </div> -->
                        </div>
                    @endif
                    @endif
                    @if(auth('trader')->check())
                            <div class="col-sm-1 col-md-2">
                                <a class="btn btn-primary modal-effect" href="#modaldemo12" data-toggle="modal">اضافة مزاد</a>
                            </div>
                    @endif
                    @if(auth('employee')->check() !== true)
                    @include('admin.biddings.filter.filter')
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover"  data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0"> #</th>
                                <th class="wd-10p border-bottom-0"> المنتج</th>
<!--                                <th class="wd-10p border-bottom-0">مبلغ التأمين</th>-->
                                <th class="wd-15p border-bottom-0">الحد الأدني للمزاد</th>
                                @if(auth('admin')->check())
                                <th class="wd-15p border-bottom-0">التاجر</th>
                                <th class="wd-15p border-bottom-0">حالة</th>
                                
                                @endif
                                <th class="wd-10p border-bottom-0">النوع</th>
                                <th class="wd-15p border-bottom-0">حالة المزاد</th>

                                <th class="wd-10p border-bottom-0">المزادات</th>
                                <th class="wd-10p border-bottom-0">التاريخ</th>
                                <th class="wd-20p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($biddings))
                            @forelse($biddings as $key => $bidding)
                                <tr>
                                    <td>#{{ $bidding->product->id* 97 }}</td>
                                    <td>{{ Str::words($bidding->product->description_ar,3) }}</td>
                                    <!-- <td>{{ $bidding->Insurance }}</td>-->
                                    <td>{{ $bidding->min_auction }}</td>
                                    @if(auth('admin')->check())
                                        @if($bidding->trader)
                                            @if($bidding->trader->type == 'company')
                                                <td>  <span style="color: limegreen">( شركة )</span>  {{ $bidding->trader->name}}</td>
                                            @elseif($bidding->trader->type == 'bank')
                                                <td>  <span style="color: #dc2a2a">( بنك )</span>  {{ $bidding->trader->name }}</td>
                                            @endif
                                        @else 
                                            <td>  <span style="color: #dc2a2a">( لا يوجد )</span>  </td>
                                        @endif

                                    @endif
                                    <td>
                                        @if(!$bidding->has_order)
                                            <button  class='confirm_bidding btn btn-primary' data-id="{{$bidding->id}}" >لم يتم البيع</button>
                                        @else
                                            <button  class='btn btn-success'>تم البيع</button>
                                        @endif
                                    </td>
                                    @if($bidding->type == 'open')
                                            <td>
                                                <form action="{{route('biddings.status',$bidding->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-success pd-x-20">مفتوح</button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <form action="{{route('biddings.status',$bidding->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-dark pd-x-20">مغلق</button>
                                                </form>
                                            </td>
                                    @endif
                                    <td>@if($bidding->end_at <= date('Y-m-d H:i:s')) مزاد منتهي @else مزاد مفتوح  @endif</td>

                                    <td><a href="bidders?biddings_id={{$bidding->id}}" class='btn btn-dark'><i class="fas fa-eye"></i></a></td>
                                    <td>{{ $bidding->end_at }}</td>

                                    <td>
                                        <a href="{{ route('biddings.show', $bidding->id) }}" class="btn btn-sm btn-warning"
                                           title="عرض"> <i class="las la-eye"></i> عرض </a>
                                        @if(auth('admin')->check())
                                        @if (str_contains(auth('admin')->user()->permissions, "edit_bidding") !== false)
                                        <a href="{{ route('biddings.edit', $bidding->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                        @endif
                                        @if (str_contains(auth('admin')->user()->permissions, "delete_bidding") !== false)
                                        <button class="btn btn-danger btn-sm " data-id="{{ $bidding->id }}"
                                                data-name_ar="{{ $bidding->product->name_ar }}" data-toggle="modal"
                                                data-target="#modaldemo9"> <i class="las la-trash"></i> حذف</button>
                                        @endif
                                            @endif
                                        @if(auth('trader')->check())
                                            <a href="{{ route('biddings.edit', $bidding->id) }}" class="btn btn-sm btn-info"
                                               title="تعديل"> <i class="las la-pen"></i> تعديل</a>
                                            <button class="btn btn-danger btn-sm " data-id="{{ $bidding->id }}"
                                                data-name_ar="{{ $bidding->product->name_ar }}" data-toggle="modal"
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
                        <br><div class="text-center">{!! $biddings->links('layouts.pagination') !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
        @if(auth('admin')->check())
        <!-- Modal effects -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> اضافة اعلان </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('biddings.store') }}" class=parsley-style-1' method="post" enctype="multipart/form-data">
                        @csrf

                    <div class="modal-body">
                        <label for="exampleInputEmail1"><h4><strong>بيانات المنتج</strong></h4></label>
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
                            <label for="exampleInputEmail1">حالة المنتج : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="status" id="status">
                                <option value="" >--- اختر حالة المنتج ---</option>
                                <option value="new" >سليم</option>
                                <!-- <option value="antique" >عتيق</option> -->
                                <option value="rare" >نادر</option>
                                <option value="slight_damage" >مصدوم</option>
                                <option value="damage" >حطام</option>
                            </select>
                        </div>
                        <br>
                        <div>
                            <label for="carType">نوع السيارة : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="car_type" id="car_type">
                                <option value="sedan" >سيدان </option>
                                <option value="Jeep" >جيب</option>
                                <option value="hatchback" >هاتشباك</option>
                                <option value="Pick-Up" >بكب </option>
                            </select>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">المميزات : <span class="tx-danger">*</span> </label>
                                    <select class="form-control select-multiple-tags" name="features[]" id="features[]" multiple>
                                        @foreach( $features as $feature)
                                            <option value="{{$feature->id}}" >{{$feature->name_ar}}</option>
                                        @endforeach
                                    </select>
                                    @error('features')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">العلامة التجارية : <span class="tx-danger">*</span> </label>
                            <select class="form-control brands_id"  name="brands_id" id="brands_id">
                                <option value="" >--- اختر العلامة التجارية ---</option>
                                @foreach( $brands as $brand)
                                    <option value="{{$brand->id}}" >{{$brand->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">الموديل : <span class="tx-danger">*</span> </label>
                            <select class="form-control models_id"  name="models_id" id="models_id">
                                <option value="" >--- اختر الموديل ---</option>
                            </select>
                            @error('models_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">سنة الصنع : <span class="tx-danger">*</span> </label>
                            <select class="form-control model_years_id"  name="model_years_id" id="model_years_id">
                                <option value="" >--- اختر سنة الصنع ---</option>
                            </select>
                            @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1" >الصور :  </label>
                            <input type="file" class="form-control form-control"
                                   data-parsley-class-handler="#lnWrapper" id="images[]" name="images[]" multiple>
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <hr>

                        <label for="exampleInputEmail1"><h4><strong>بيانات المزاد</strong></h4></label>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">  المبلع المبدأي للمزاد : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="initial_auction" name="initial_auction" required>
                            @error('initial_auction')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">الحد الأدني للمزاد : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="min_auction" name="min_auction" required>
                            @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1"> الضريبة % : <span class="tx-danger">*</span> </label>
                            <input type="number" class="form-control" id="fees" name="fees" required min=0 >
                            @error('fees')<span class="text-danger">{{ $message }}</span>@enderror
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
                            <input type="datetime-local" class="form-control" id="end_at" name="end_at" required>
                            @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div class='d-none'>
                            <label for="exampleInputEmail1">البنك : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="traders_id" id="traders_id">
                                <option value="1" ></option>
                            </select>
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
        <div class="modal" id="modaldemo11">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> اضافة اعلان</h6><button aria-label="Close" class="close"
                                                                       data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('biddings.store') }}" class=parsley-style-1' method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                        <label for="exampleInputEmail1"><h4><strong>بيانات المنتج</strong></h4></label>
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
                            <label for="exampleInputEmail1">حالة المنتج : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="status" id="status">
                                <option value="" >--- اختر حالة المنتج ---</option>
                                <option value="new" >سليم</option>
                                <!-- <option value="antique" >عتيق</option> -->
                                <option value="rare" >نادر</option>
                                <option value="slight_damage" >مصدوم</option>
                                <option value="damage" >حطام</option>
                            </select>
                        </div>
                        <br>
                        <div>
                            <label for="carType">نوع السيارة : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="car_type" id="car_type">
                                <option value="sedan" >سيدان </option>
                                <option value="Jeep" >جيب</option>
                                <option value="hatchback" >هاتشباك</option>
                                <option value="Pick-Up" >بكب </option>
                            </select>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">المميزات : <span class="tx-danger">*</span> </label>
                                    <select class="form-control select-multiple-tags" name="features[]" id="features[]" multiple>
                                        @foreach( $features as $feature)
                                            <option value="{{$feature->id}}" >{{$feature->name_ar}}</option>
                                        @endforeach
                                    </select>
                                    @error('features')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">العلامة التجارية : <span class="tx-danger">*</span> </label>
                            <select class="form-control brands_id"  name="brands_id" id="brands_id">
                                <option value="" >--- اختر العلامة التجارية ---</option>
                                @foreach( $brands as $brand)
                                    <option value="{{$brand->id}}" >{{$brand->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div>
                            <label for="exampleInputEmail1">الموديل : <span class="tx-danger">*</span> </label>
                            <select class="form-control models_id"  name="models_id" id="models_id">
                                <option value="" >--- اختر الموديل ---</option>
                            </select>
                            @error('models_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">سنة الصنع : <span class="tx-danger">*</span> </label>
                            <select class="form-control model_years_id"  name="model_years_id" id="model_years_id">
                                <option value="" >--- اختر سنة الصنع ---</option>
                            </select>
                            @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1" >الصور :  </label>
                            <input type="file" class="form-control form-control"
                                   data-parsley-class-handler="#lnWrapper" id="images[]" name="images[]" multiple>
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>
                        <hr>

                        <label for="exampleInputEmail1"><h4><strong>بيانات المزاد</strong></h4></label>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">  المبلع المبدأي للمزاد : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="initial_auction" name="initial_auction" required>
                            @error('initial_auction')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1">الحد الأدني للمزاد : <span class="tx-danger">*</span> </label>
                            <input type="text" class="form-control" id="min_auction" name="min_auction" required>
                            @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div>
                            <label for="exampleInputEmail1"> الضريبة % : <span class="tx-danger">*</span> </label>
                            <input type="number" class="form-control" id="fees" name="fees" required min=0 >
                            @error('fees')<span class="text-danger">{{ $message }}</span>@enderror
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
                            <input type="datetime-local" class="form-control" id="end_at" name="end_at" required>
                            @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <br>

                        <div class='d-none'>
                            <label for="exampleInputEmail1">البنك : <span class="tx-danger">*</span> </label>
                            <select class="form-control"  name="traders_id" id="traders_id">
                                <option value="1" ></option>
                            </select>
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
        @endif

        @if(auth('trader')->check())
            <!-- Modal effects -->
                <div class="modal" id="modaldemo12">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">اضافة اعلان</h6><button aria-label="Close" class="close"
                                                                               data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{ route('biddings.store') }}" class=parsley-style-1' method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">
                                    <label for="exampleInputEmail1"><h4><strong>بيانات المنتج</strong></h4></label>
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
                                        <label for="exampleInputEmail1">حالة المنتج : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="status" id="status">
                                            <option value="" >--- اختر حالة المنتج ---</option>
                                            <option value="new" >سليم</option>
                                            <!-- <option value="antique" >عتيق</option> -->
                                            <option value="rare" >نادر</option>
                                            <option value="slight_damage" >مصدوم</option>
                                            <option value="damage" >حطام</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label for="carType">نوع السيارة : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="car_type" id="car_type">
                                            <option value="sedan" >سيدان </option>
                                            <option value="Jeep" >جيب</option>
                                            <option value="hatchback" >هاتشباك</option>
                                            <option value="Pick-Up" >بكب </option>
                                        </select>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">المميزات : <span class="tx-danger">*</span> </label>
                                                <select class="form-control select-multiple-tags" name="features[]" id="features[]" multiple>
                                                    @foreach( $features as $feature)
                                                        <option value="{{$feature->id}}" >{{$feature->name_ar}}</option>
                                                    @endforeach
                                                </select>
                                                @error('features')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div>
                                        <label for="exampleInputEmail1">العلامة التجارية : <span class="tx-danger">*</span> </label>
                                        <select class="form-control brands_id"  name="brands_id" id="brands_id">
                                            <option value="" >--- اختر العلامة التجارية ---</option>
                                            @foreach( $brands as $brand)
                                                <option value="{{$brand->id}}" >{{$brand->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label for="exampleInputEmail1">الموديل : <span class="tx-danger">*</span> </label>
                                        <select class="form-control models_id"  name="models_id" id="models_id">
                                            <option value="" >--- اختر الموديل ---</option>
                                        </select>
                                        @error('models_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>

                                    <div>
                                        <label for="exampleInputEmail1">سنة الصنع : <span class="tx-danger">*</span> </label>
                                        <select class="form-control model_years_id"  name="model_years_id" id="model_years_id">
                                            <option value="" >--- اختر سنة الصنع ---</option>
                                        </select>
                                        @error('model_year')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>

                                    <div>
                                        <label for="exampleInputEmail1" >الصور :  </label>
                                        <input type="file" class="form-control form-control"
                                            data-parsley-class-handler="#lnWrapper" id="images[]" name="images[]" multiple>
                                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>
                                    <hr>

                                    <label for="exampleInputEmail1"><h4><strong>بيانات المزاد</strong></h4></label>
                                    <br>

                                    <div>
                                        <label for="exampleInputEmail1">  المبلع المبدأي للمزاد : <span class="tx-danger">*</span> </label>
                                        <input type="text" class="form-control" id="initial_auction" name="initial_auction" required>
                                        @error('initial_auction')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>

                                    <div>
                                        <label for="exampleInputEmail1">الحد الأدني للمزاد : <span class="tx-danger">*</span> </label>
                                        <input type="text" class="form-control" id="min_auction" name="min_auction" required>
                                        @error('min_auction')<span class="text-danger">{{ $message }}</span>@enderror
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
                                        <input type="datetime-local" class="form-control" id="end_at" name="end_at" required>
                                        @error('end_at')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <br>

                                    <div class='d-none'>
                                        <label for="exampleInputEmail1">البنك : <span class="tx-danger">*</span> </label>
                                        <select class="form-control"  name="traders_id" id="traders_id">
                                            <option value="{{auth('trader')->check()? auth('trader')->user()->id: null }}" ></option>
                                        </select>
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
        @endif


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
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.confirm_bidding').on('click', function() {
                        let biddingId = $(this).data('id');
                        let button = $(this);
                        if(confirm('هل انت متأكد من  تأكيد بيع هذه السيارة')){
                            $.ajax({
                                url: "{{route('biddings.confirm',[':id'])}}".replaceAll(':id',biddingId),
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    if(data.status == 409){
                                        alert('لا يوجد اي عروض حتي الان لهذا الاعلان')
                                    }
                                    if(data.status == 410){
                                        alert('تم البيع مسبقا')
                                    }
                                    if(data.status == 200){
                                        alert('تم تأكيد بيع هذه  السيارة بنجاح')
                                        button.addClass('btn-success').removeClass('btn-primary confirm_bidding').html('تم الاستلام')
                                    }
                                }
                            });
                        }
                    });
                    $('select[name="brands_id"]').on('change', function() {
                        var models_id = $(this).val();
                        console.log(models_id);
                        if(models_id) {
                            $.ajax({
                                url: '/admin/myform/ajax/'+models_id,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    $('select[name="models_id"]').empty();
                                    $.each(data, function(key, value) {
                                        $('select[name="models_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                }
                            });
                        }else{
                            $('select[name="models_id"]').empty();
                        }
                    });
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('select[name="brands_id"]').on('change', function() {
                        var model_years_id = $(this).val();
                        console.log(model_years_id);
                        if(model_years_id) {
                            $.ajax({
                                url: '/admin/myform2/ajax/'+model_years_id,
                                type: "GET",
                                dataType: "json",
                                success:function(data) {
                                    $('select[name="model_years_id"]').empty();
                                    $.each(data, function(key, value) {
                                        $('select[name="model_years_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                }
                            });
                        }else{
                            $('select[name="model_years_id"]').empty();
                        }
                    });
                });
            </script>
@endsection

