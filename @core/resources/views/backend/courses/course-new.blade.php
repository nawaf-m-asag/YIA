@extends('backend.admin-master')
@section('site-title')
    اضافة جديد
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between margin-bottom-30">
                            <h4 class="header-title">اضافة جديد</h4>
                            <a href="{{route('admin.courses.all')}}" class="btn btn-info">الكل</a>
                        </div>
                        <form action="{{route('admin.courses.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @php $default_lang = get_default_language(); @endphp
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($lang->slug == $default_lang) active @endif" data-lang="{{$lang->slug}}" data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-40" >
                                @foreach($all_languages as $lang)
                                    <div class="tab-pane fade @if($lang->slug == $default_lang) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="title">العنوان</label>
                                            <input type="text" class="form-control title-field" name="title[{{$lang->slug}}]" placeholder="ادخل العنوان">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">العنوان للمتصفح</label>
                                            <input type="text" class="form-control slug-field" name="slug[{{$lang->slug}}]" placeholder="العنوان للمتصفح">
                                        </div>
                                        <div class="form-group">
                                            <label>الوصف</label>
                                            <input type="hidden" name="description[{{$lang->slug}}]" >
                                            <div class="summernote"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title">العنوان سيو</label>
                                            <input type="text" class="form-control" name="meta_title[{{$lang->slug}}]" placeholder="العنوان سيو">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description"> الوصف سيو</label>
                                            <textarea  class="form-control max-height-120" name="meta_description[{{$lang->slug}}]"cols="30" rows="10" placeholder="الوصف سيو"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_tags">السيو</label>
                                            <input type="text" name="meta_tags[{{$lang->slug}}]"  class="form-control" data-role="tagsinput" >
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_title">{{__('Og Meta عنوان')}}</label>
                                            <input type="text" class="form-control" name="og_meta_title[{{$lang->slug}}]" placeholder="{{__('Og Meta عنوان')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="max_student">الحد الأقصى لعدد الطلاب</label>
                                <input type="number" class="form-control" name="max_student" >
                            </div>
                            <div class="form-group">
                                <label for="price">السعر</label>
                                <input type="number" class="form-control" name="price" >
                                <span class="info-text">أدخل 0 لجعلها مجانية</span>
                            </div>
                            <div class="form-group">
                                <label for="sale_price">سعر البيع</label>
                                <input type="number" class="form-control" name="sale_price" >
                            </div>
                            <div class="form-group">
                                <label for="points">النقاط</label>
                                <input type="number" class="form-control" name="points" >
                            </div>
                            <div class="form-group">
                                <label for="external_url">رابط خارجي</label>
                                <input type="text" class="form-control" name="external_url" >
                                <span class="info-text">سينتقل إلى الرابط الخاص بك عندما ينقر أي شخص على زر التسجيل</span>
                            </div>
                            <div class="form-group">
                                <label for="duration">المدة الزمنية</label>
                                <input type="text" class="form-control" name="duration" >
                            </div>
                            <div class="form-group">
                                <label for="duration_type">نوع المدة </label>
                                <select name="duration_type" class="form-control">
                                    <option value="min">دقائق</option>
                                    <option value="hr">ساعات</option>
                                    <option value="days">ايام</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="featured"><strong>مميزة</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="featured" >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="enroll_required"><strong>التسجيل مطلوب</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="enroll_required" >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <x-media-upload :name="'image'" :title="__('Image')" :id="null" :dimentions="'1920x1080px'" />
                            <x-media-upload :name="'og_meta_image'" :title="__('Og Meta Image')" :id="null" :dimentions="'1920x1080px'" />

                            <div class="form-group">
                                <label for="categories_id">التصنيف</label>
                                <select name="categories_id" class="form-control nice-select wide">
                                    @foreach($all_categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->lang->title ?? __('untitled')}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="instructor_id">المدرب</label>
                                <select name="instructor_id" class="form-control nice-select wide">
                                    @foreach($all_instructor as $inst)
                                        <option value="{{$inst->id}}">{{$inst->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">الحالة</label>
                                <select name="status" class="form-control">
                                    <option value="draft">مسودة</option>
                                    <option value="publish">منشور</option>
                                </select>
                            </div>
                            <div class="iconbox-repeater-wrapper dynamic-repeater">
                                <label for="additional_info" class="d-block">المقرر  <span class="d-none"><i class="fas fa-spinner fa-spin"></i></span></label>
                               <div class="curriculmn-outer-wrap">
                                   <div class="curriculmn-repeater-wrap">
                                       <div class="action-wrap">
                                           <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                           <span class="add"><i class="ti-plus"></i></span>
                                           <span class="remove"><i class="ti-trash"></i></span>
                                       </div>
                                       <ul class="nav nav-tabs" role="tablist">
                                           @foreach($all_languages as $lang)
                                               <li class="nav-item">
                                                   <a class="nav-link @if($lang->slug == $default_lang) active @endif"  data-toggle="tab" href="#repeater_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                               </li>
                                           @endforeach
                                       </ul>
                                       <div class="tab-content" >
                                           @foreach($all_languages as $lang)
                                               <div class="tab-pane fade @if($lang->slug == $default_lang) show active @endif" id="repeater_tab_{{$lang->slug}}" role="tabpanel" >
                                                   <div class="form-group">
                                                       <input type="text" class="form-control" name="curriculum_title[1][{{$lang->slug}}]" placeholder="عنوان المقرر">
                                                   </div>
                                                   <div class="form-group">
                                                       <textarea  class="form-control max-height-120" name="curriculum_description[1][{{$lang->slug}}]"cols="30" rows="10" placeholder="وصف المقرر"></textarea>
                                                   </div>
                                               </div>
                                           @endforeach
                                       </div>
                                   </div>
                                   <div class="all-field-wrap lesson">
                                       <div class="form-group">
                                           <input type="text" class="form-control" name="course_lesson[1][]"  placeholder="انشاء درس جديد">
                                       </div>
                                       <div class="action-wrap">
                                           <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                           <span class="add"><i class="ti-plus"></i></span>
                                           <span class="remove"><i class="ti-trash"></i></span>
                                       </div>
                                   </div>
                               </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">اضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    @include('backend.partials.repeater.course-script')
    @include('backend.partials.media-upload.media-js')
    @include('backend.partials.icon-field.js')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <x-backend.auto-slug-multilangual :url="route('admin.courses.slug.check')" :type="'new'" />
    <script>
        (function (){
            "use strict";

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }

            $(document).ready(function () {

                $('.summernote').summernote({
                    height: 400,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });
                $(document).on('click','.curriculmn-repeater-wrap .action-wrap .remove',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $('.curriculmn-outer-wrap');

                    if (container.length > 1){
                        el.show(300);
                        parent.parent().hide(300).remove();
                    }else{
                        el.hide(300);
                    }
                });

                $(document).on('click','.curriculmn-repeater-wrap .action-wrap .add',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $('.curriculmn-repeater-wrap');
                    var clonedDiv = $(this).parent().parent().parent().clone();
                    var containerLength = container.length;
                    var allFields = clonedDiv.find('.form-control');
                    allFields.val('');
                    allFields.each(function (item,index){
                        var name = $(this).attr('name');
                        var number = name.replace(/\d+/g,containerLength + 1);
                        $(this).attr('name',number);
                    });
                    clonedDiv.find('.curriculmn-repeater-wrap > .action-wrap .remove').css({'display':'inline-block'});
                    clonedDiv.find('.all-field-wrap.lesson').not(':first').remove();

                    var allTab =  clonedDiv.find('.tab-pane');
                    allTab.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('id');
                        el.attr('id',oldId+containerLength);
                    });
                    var allTabNav =  clonedDiv.find('.nav-link');
                    allTabNav.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('href');
                        el.attr('href',oldId+containerLength);
                    });
                    container.parent().parent().append(clonedDiv);
                    if (container.length > 0){
                        parent.parent().find('.remove').show(300);
                    }
                });

            });
        })(jQuery);
    </script>

@endsection
