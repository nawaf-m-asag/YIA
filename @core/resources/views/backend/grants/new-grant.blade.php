@extends('backend.admin-master')
@section('site-title')
اضافة منحة جديدة
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">اضافة منحة جديدة</h4>
                            <a href="{{route('admin.grants.all')}}" class="btn btn-primary">كل المنح</a>
                        </div>
                        <form action="{{route('admin.grants.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong>اللغة</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">العنوان</label>
                                        <input type="text" class="form-control"  id="title" name="title" value="{{old('title')}}" placeholder="ادخل العنوان">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">العنوان للمتصفح</label>
                                        <input type="text" class="form-control"  id="slug" name="slug" placeholder="ادخل العنوان للمتصفح">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">الكلمات المفتاحية</label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">الوصف سيو</label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">نوع المنحة دولية $ محلية</label>
                                        <input type="text" class="form-control"  id="position" name="position" value="{{old('position')}}" placeholder="دولية & محلية">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">اسم الشركة </label>
                                        <input type="text" class="form-control"  id="company_name" value="{{old('company_name')}}"  name="company_name" placeholder="ادخل اسم الشركة المانحة">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">التصنيف</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">حدد تصنيف</option>
                                            @foreach($all_category as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vacancy">الحد الاقصى للمتقدمين</label>
                                        <input type="text" class="form-control"  id="vacancy" value="{{old('vacancy')}}" name="vacancy" placeholder="ادخل العدد المسموح به للمقدمين ">
                                    </div>
                                    <div class="form-group">
                                        <label for="grant_context">متطلبات المنحة</label>
                                        <input type="hidden" name="grant_context" >
                                        <div class="summernote" ></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="grant_responsibility">الخبرة</label>
                                        <input type="hidden" name="grant_responsibility" >
                                        <div class="summernote" ></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_requirement">المتطلبات اتعليمية</label>
                                        <input type="hidden" name="education_requirement">
                                        <div class="summernote"></div>
                                    </div>
                                   
                                    
                                    <div class="form-group">
                                        <label for="employment_status">نوع المنحة</label>
                                        <select name="employment_status" id="employment_status"  class="form-control">
                                            <option value="منحة_مجانية">منحة مجانية</option>
                                            <option value="منحة_جزئية">منحة جزئية</option>
                                           
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="grant_location">الموقع</label>
                                        <input type="text" class="form-control"  id="grant_location" name="grant_location" value="{{old('grant_location')}}" placeholder="موقع المنحة">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_benefits">المزايا</label>
                                        <input type="hidden" name="other_benefits">
                                        <div class="summernote" ></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="deadline">اخر موعد للتقديم</label>
                                        <input type="date" class="form-control"  id="deadline" name="deadline" placeholder="ادخل موعد التقديم">
                                    </div>
                                    <div class="form-group">
                                        <label for="application_fee_status"><strong>تمكين الرسوم</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="application_fee_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="application_fee">رسوم التقديم</label>
                                        <input type="number" class="form-control" name="application_fee" value="{{old('application_fee')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">الحالة</label>
                                        <select name="status" id="status"  class="form-control">
                                            <option value="publish">منشور</option>
                                            <option value="draft">مسودة</option>
                                        </select>
                                    </div>
                                    <x-media-upload :id="''" :name="'image'" :dimentions="'1920x1280'" :title="__('Image')"/>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">اضافة</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <x-backend.auto-slug-js :url="route('admin.grants.slug.check')" :type="'new'"/>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 200,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "{{route('admin.grants.category.by.lang')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category').html('<option value="">حدد تصنيف</option>');
                        $.each(data,function(index,value){
                            $('#category').append('<option value="'+value.id+'">'+value.title+'</option>')
                        });
                    }
                });
            });
        });
    </script>
@endsection
