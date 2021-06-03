@extends('layouts.master')

@section('title')
    تعديل المنتج
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                المنتج ( {{ $product->name_ar }} )</span>
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
                            <a class="btn btn-primary" href="{{ route('products.index') }}">رجوع</a>
                        </div>
                    </div><br>
                    {!! Form::model($product,['route' => ['products.update' , $product->id], 'method' => 'put', 'files'=>true]) !!}
                    <div class="row row-sm">

                        <div class="col-lg-12 col-xl-12">
                            <div class="card card-dashboard-map-one">
                                <div class="" style="width: 100%">
                                </div>
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
                                    {!! Form::select('categories_id', App\Models\categories::pluck('name_ar', 'id'),[],[
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


                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            {!! Form::submit('تعديل', ['class' => 'btn btn-main-primary pd-x-20']) !!}
                        </div>
                        {{Form::close()}}

                    </div>
                </div>

                <!-- main-content closed -->
@endsection
@section('js')
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
