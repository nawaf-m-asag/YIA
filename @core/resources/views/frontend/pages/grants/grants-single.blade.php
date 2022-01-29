@extends('frontend.frontend-page-master')
@section('site-title')
    {{$grant->title}}
@endsection
@section('page-title')
    {{$grant->title}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$grant->meta_description}}">
    <meta name="tags" content="{{$grant->meta_tags}}">
@endsection
@section('og-meta')
    <meta property="og:url"  content="{{route('frontend.grants.single',$grant->slug)}}" />
    <meta property="og:type"  content="grants" />
    <meta property="og:title"  content="{{$grant->title}}" />
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-job-details">
                        <ul class="job-meta-list">
                            @if(!empty($grant->grant_context))
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> {{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_context_label')}}</h4>
                                    <p>{!!  $grant->grant_context !!}</p>
                                </div>
                            </li>
                            @endif
                            @if(!empty($grant->grant_responsibility))
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_responsibility_label')}}</h4>
                                    <p>{!! $grant->grant_responsibility !!}</p>
                                </div>
                            </li>
                            @endif
                            @if(!empty($grant->education_requirement))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">  {{get_static_option('grant_single_page_'.$user_select_lang_slug.'_education_requirement_label')}}</h4>
                                        <p>{!! $grant->education_requirement !!}</p>
                                    </div>
                                </li>
                            @endif
                            @if(!empty($grant->experience_requirement))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> {{get_static_option('grant_single_page_'.$user_select_lang_slug.'_experience_requirement_label')}}</h4>
                                        <p>{!! $grant->experience_requirement !!}</p>
                                    </div>
                                </li>
                            @endif
                            @if(!empty($grant->additional_requirement))
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> {{get_static_option('grant_single_page_'.$user_select_lang_slug.'_additional_requirement_label')}}</h4>
                                    <p>{!! $grant->additional_requirement !!}</p>
                                </div>
                            </li>
                            @endif
                            @if(!empty($grant->other_benefits))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_others_benefits_label')}}</h4>
                                        <p>{!! $grant->other_benefits !!}</p>
                                    </div>
                                </li>
                            @endif
                            @if(!empty($grant->application_fee_status) && $grant->application_fee > 0)
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_application_fee_text')}}</h4>
                                        <p>{{amount_with_currency_symbol($grant->application_fee )}}</p>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <div class="apply-procedure">
                             @if(time() >= strtotime($grant->deadline))
                                <div class="alert alert-danger margin-top-30">{{__('Dead Line Expired')}}</div>
                            @else
                                @if(!empty(get_static_option('grant_single_page_apply_form')))
                                    <a class="btn-boxed style-01 margin-top-30" href="{{route('frontend.grants.apply',$grant->id)}}">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_apply_button_text')}}</a>
                                @else
                                    <p>{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_apply_button_text')}}: <span>{{$grant->email}}</span></p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                            <div class="widget grant_information">
                                <h2 class="widget-title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_info_text')}}</h2>
                                <ul class="job-information-list">
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_company_name_text')}}</h4>
                                                <span class="details">{{$grant->company_name}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_category_text')}}</h4>
                                                <span class="details">{!! get_grants_category_by_id($grant->category_id,'link') !!}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-user"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_position_text')}}</h4>
                                                <span class="details">{{$grant->position}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_type_text')}}</h4>
                                                <span class="details">{{str_replace('_',' ',$grant->employment_status)}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_salary_text')}}</h4>
                                                <span class="details">{{$grant->salary}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_location_text')}}</h4>
                                                <span class="details">{{$grant->grant_location}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('grant_single_page_'.$user_select_lang_slug.'_grant_deadline_text')}}</h4>
                                                <span class="details">{{date('d M Y',strtotime($grant->deadline))}}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <div class="widget-area">
                            {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('grant',['column' => false]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
