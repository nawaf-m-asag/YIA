@extends('backend.admin-master')
@section('site-title')
اعدادت صفحة عرض المنحة
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">اعدادت صفحة عرض المنحة</h4>
                        <form action="{{route('admin.grants.single.page.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_context_label">معلومات المنحة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_context_label"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_context_label')}}" id="grant_single_page_{{$lang->slug}}_grant_context_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_responsibility_label">المتطلبات</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_responsibility_label"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_responsibility_label')}}" id="grant_single_page_{{$lang->slug}}_grant_responsibility_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_education_requirement_label">المتطلبات التعلمية</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_education_requirement_label"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_education_requirement_label')}}" id="grant_single_page_{{$lang->slug}}_education_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_experience_requirement_label">متطلبات الخبرة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_experience_requirement_label"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_experience_requirement_label')}}" id="grant_single_page_{{$lang->slug}}_experience_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_additional_requirement_label">متطلبات إضافية</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_additional_requirement_label"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_additional_requirement_label')}}" id="grant_single_page_{{$lang->slug}}_additional_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_others_benefits_label">المزايا</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_others_benefits_label"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_others_benefits_label')}}" id="grant_single_page_{{$lang->slug}}_others_benefits_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_apply_button_text">نص زر اتقيم على منحة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_apply_button_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_apply_button_text')}}" id="grant_single_page_{{$lang->slug}}_apply_button_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_info_text">معلومات المنحة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_info_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_info_text')}}" id="grant_single_page_{{$lang->slug}}_grant_info_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_company_name_text">المقدم للمنحة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_company_name_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_company_name_text')}}" id="grant_single_page_{{$lang->slug}}_company_name_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_category_text">تصنيف المنحة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_category_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_category_text')}}" id="grant_single_page_{{$lang->slug}}_grant_category_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_position_text">دولية & محلية</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_position_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_position_text')}}" id="grant_single_page_{{$lang->slug}}_grant_position_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_type_text">نوع المنحة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_type_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_type_text')}}" id="grant_single_page_{{$lang->slug}}_grant_type_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_salary_text">قيمة المنحة</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_salary_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_salary_text')}}" id="grant_single_page_{{$lang->slug}}_salary_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_location_text">الموقع</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_location_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_location_text')}}" id="grant_single_page_{{$lang->slug}}_grant_location_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_deadline_text">الموعد النهائي للتقديم</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_deadline_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_deadline_text')}}" id="grant_single_page_{{$lang->slug}}_grant_deadline_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_single_page_{{$lang->slug}}_grant_application_fee_text">رسوم التقديم</label>
                                            <input type="text" name="grant_single_page_{{$lang->slug}}_grant_application_fee_text"  class="form-control" value="{{get_static_option('grant_single_page_'.$lang->slug.'_grant_application_fee_text')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="grant_single_page_applicant_mail">ايمل استقبال طلبات التقديم</label>
                                <input type="text" name="grant_single_page_applicant_mail"  class="form-control" value="{{get_static_option('grant_single_page_applicant_mail')}}" id="grant_single_page_applicant_mail">
                            </div>
                            <div class="form-group">
                                <label for="grant_single_page_apply_form"><strong>{{__('Apply Page Enable/Disable')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="grant_single_page_apply_form"  @if(!empty(get_static_option('grant_single_page_apply_form'))) checked @endif id="grant_single_page_apply_form">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">حفظ التعديلات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
