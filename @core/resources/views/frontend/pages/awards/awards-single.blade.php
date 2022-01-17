@extends('frontend.frontend-page-master')
@section('site-title')
    {{$award->title}}
@endsection
@section('page-title')
    {{$award->title}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$award->meta_description}}">
    <meta name="tags" content="{{$award->meta_tags}}">
@endsection
@section('og-meta')
    <meta property="og:url"  content="{{route('frontend.awards.single',$award->slug)}}" />
    <meta property="og:type"  content="award" />
    <meta property="og:title"  content="{{$award->title}}" />
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-job-details">
                        <ul class="job-meta-list">
                            @if(!empty($award->award_context))
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> {{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_context_label')}}</h4>
                                    <p>{!!  $award->award_context !!}</p>
                                </div>
                            </li>
                            @endif
                            @if(!empty($award->award_responsibility))
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_responsibility_label')}}</h4>
                                    <p>{!! $award->award_responsibility !!}</p>
                                </div>
                            </li>
                            @endif
                            @if(!empty($award->education_requirement))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">  {{get_static_option('award_single_page_'.$user_select_lang_slug.'_education_requirement_label')}}</h4>
                                        <p>{!! $award->education_requirement !!}</p>
                                    </div>
                                </li>
                            @endif
                            @if(!empty($award->experience_requirement))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> {{get_static_option('award_single_page_'.$user_select_lang_slug.'_experience_requirement_label')}}</h4>
                                        <p>{!! $award->experience_requirement !!}</p>
                                    </div>
                                </li>
                            @endif
                            @if(!empty($award->additional_requirement))
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> {{get_static_option('award_single_page_'.$user_select_lang_slug.'_additional_requirement_label')}}</h4>
                                    <p>{!! $award->additional_requirement !!}</p>
                                </div>
                            </li>
                            @endif
                            @if(!empty($award->other_benefits))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_others_benefits_label')}}</h4>
                                        <p>{!! $award->other_benefits !!}</p>
                                    </div>
                                </li>
                            @endif
                            @if(!empty($award->application_fee_status) && $award->application_fee > 0)
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_application_fee_text')}}</h4>
                                        <p>{{amount_with_currency_symbol($award->application_fee )}}</p>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <div class="apply-procedure">
                             @if(time() >= strtotime($award->deadline))
                                <div class="alert alert-danger margin-top-30">{{__('Dead Line Expired')}}</div>
                            @else
                                @if(!empty(get_static_option('award_single_page_apply_form')))
                                    <a class="btn-boxed style-01 margin-top-30" href="{{route('frontend.awards.apply',$award->id)}}">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_apply_button_text')}}</a>
                                @else
                                    <p>{{get_static_option('award_single_page_'.$user_select_lang_slug.'_apply_button_text')}}: <span>{{$award->email}}</span></p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                            <div class="widget award_information">
                                <h2 class="widget-title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_info_text')}}</h2>
                                <ul class="job-information-list">
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_company_name_text')}}</h4>
                                                <span class="details">{{$award->company_name}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_category_text')}}</h4>
                                                <span class="details">{!! get_awards_category_by_id($award->category_id,'link') !!}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-user"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_position_text')}}</h4>
                                                <span class="details">{{$award->position}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_type_text')}}</h4>
                                                <span class="details">{{str_replace('_',' ',$award->employment_status)}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_salary_text')}}</h4>
                                                <span class="details">{{$award->salary}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_location_text')}}</h4>
                                                <span class="details">{{$award->award_location}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">{{get_static_option('award_single_page_'.$user_select_lang_slug.'_award_deadline_text')}}</h4>
                                                <span class="details">{{date('d M Y',strtotime($award->deadline))}}</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <div class="widget-area">
                            {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('award',['column' => false]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
