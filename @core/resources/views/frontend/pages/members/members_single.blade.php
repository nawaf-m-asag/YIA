@extends('frontend.frontend-page-master')
@section('style')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
        .members-single-item img{
            height: 320px;
            height: 320px;
            object-fit: cover;
        }
  </style>
@endsection
@php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($user->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 @endphp

@section('og-meta')
    
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="{{$user->name}}" />
    <meta property="og:image" content="{{$post_img}}" />
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$user->name}}">
@endsection
@section('site-title')
    {{$user->name}}
@endsection
@section('page-title')
    {{$user->name}}
@endsection
@section('content')
    <section class="blog-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="appointment-details-item">
                        
                       <div class="top-part shadow-sm p-3 mb-5 bg-light rounded">
                           <div class="thumb members-single-item">
                            @php
                            $user_img = get_attachment_image_by_id($user->image,'full',true);
                            @endphp
                             @if (!empty($user_img))
                             <img  src="{{$user_img['img_url']}}" alt="Card image cap">
                             @endif 
                               <div class="membership shadow-sm">
                                {{$user->package_name}}
                                </div>  
                           </div>
                           <div class="content">
                               <h2 class="title">{{$user->name}}</h2>
                               <div class="short-description">{!! $user->university_name    !!}
                                <span  class="label label-info p-2"> {{$user->specialization}}</span>
                                </div>
                                <h5 class=" mt-4">العنوان</h5>
                                <div class="d-inline">
                                    @if($user->city)
                               
                                    <div class="location d-inline"><i class="fas fa-map-marked-alt pl-2"></i>  {{$user->city}}</div>
                                    @endif
                                    @if($user->address)
                                    <div class="location d-inline"><i class="fas fa-map-marker-alt pl-2"></i>  {{$user->address}}</div>
                                    @endif
                                </div>
                                <h5 class=" mt-4">التواصل</h5>
                                <div class="d-inline">
                                    @if($user->phone)
                                        <div class="location d-inline"><a href="tel: {{$user->phone}}"><i class="fas fa-phone pl-2"></i>  {{$user->phone}}</a></div>
                                    @endif
                                    @if($user->email)
                                        <div class="location d-inline"><a href = "mailto:{{$user->email}}"><i class="fas fa-envelope pl-2"></i>{{$user->email}}</a></div>
                                    @endif
                                </div>
                           </div>
                       </div>
                        {{-- <div class="bottom-part">
                            <x-error-msg/>
                            <x-flash-msg/>
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-link "  data-toggle="tab" href="#nav-information" role="tab"  aria-selected="false">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_information_tab_title')}}</a>
                                    <a class="nav-link active"  data-toggle="tab" href="#nav-booking" role="tab"  aria-selected="true">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_booking_tab_title')}}</a>
                                    <a class="nav-link"  data-toggle="tab" href="#nav-feedback" role="tab"  aria-selected="false">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_feedback_tab_title')}}</a>
                                </div>
                            </nav>
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="nav-information" role="tabpanel" >
                                    <div class="information-area-wrap">
                                        <div class="description-wrap">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_about_me_title')}}</h3>
                                            {!! $item->lang_front->description !!}
                                        </div>
                                        @if(!empty(current($item->lang_front->experience_info)))
                                        <div class="education-info">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_educational_info_title')}}</h3>
                                            <ul class="circle-list">
                                                @foreach($item->lang_front->experience_info as $info)
                                                    <li>{{$info}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @if(!empty(current($item->lang_front->additional_info)))
                                        <div class="additional-info">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_additional_info_title')}}</h3>
                                            <ul class="circle-list">
                                                @foreach($item->lang_front->additional_info as $info)
                                                    <li>{{$info}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @if(!empty(current($item->lang_front->specialized_info)))
                                        <div class="specialised-info">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_specialize_info_title')}}</h3>
                                            <ul class="circle-list">
                                                @foreach($item->lang_front->specialized_info as $info)
                                                    <li>{{$info}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-booking" role="tabpanel" >
                                    @if($item->appointment_status === 'yes')
                                    <div class="booking-wrap">
                                        <div class="left-part">
                                            <div class="date-time-block">
                                                <h4 class="title">{{__('Available On')}} <time>{{date('F Y')}}</time></h4>
                                                <ul class="time-slot date">
                                                    <li data-date="{{date('d-m-Y')}}">{{date('D, d F, Y')}}</li>
                                                    @for($i=1; $i <7; $i++)
                                                        <li data-date="{{date('d-m-Y',strtotime("+".$i." day"))}}">{{date('D, d F, Y',strtotime("+".$i." day"))}}</li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <div class="date-time-block">
                                                <h4 class="title">{{__('Availability On')}} <time class="time_slog_date">{{date('D, d F, Y')}}</time></h4>
                                                <ul class="time-slot time">
                                                    @foreach($item->booking_time_ids as $time)
                                                        <li data-id="{{$time['id']}}">{{$time['time']}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-part">
                                            <div class="form-wrapper">

                                                <div class="billing-details-wrapper">
                                                    <div class="order-tab-wrap">
                                                        <nav>
                                                            <div class="nav nav-tabs" role="tablist">
                                                                @if(!auth()->guard('web')->check())
                                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"  aria-selected="true"><i class="fas fa-user"></i></a>
                                                                @endif
                                                                <a class="nav-item nav-link  @if(auth()->check()) active @else disabled @endif" disabled id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-address-book"></i></a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" >
                                                            @if(!auth()->guard('web')->check())
                                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                                                    @if(get_static_option('disable_guest_mode_for_appointment_module'))
                                                                    <div class="checkout-type margin-bottom-30  @if(auth()->guard('web')->check()) d-none @endif ">
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                                                            <label class="custom-control-label" for="guest_logout">{{__('Guest Order')}}</label>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @if(!auth()->guard('web')->check())
                                                                        @include('frontend.partials.ajax-login-form')
                                                                    @else
                                                                        <div class="alert alert-success">
                                                                            {{__('Your Are Logged In As')}} {{auth()->guard('web')->user()->name}}
                                                                        </div>
                                                                    @endif
                                                                    @if(!auth()->guard('web')->check())
                                                                        <div class="next-step">
                                                                            <button class="next-step-btn btn-boxed" style="display: none" type="button">{{__('Next Step')}}</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            <div class="tab-pane fade @if(auth()->guard('web')->check()) show active @endif" id="nav-profile" role="tabpanel">

                                                                <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_information_text')}}</h3>
                                                                <form action="{{route('frontend.appointment.booking')}}" method="post" class="appointment-booking-form" id="appointment-booking-form">
                                                                    @csrf
                                                                    <div class="error-message"></div>
                                                                    <input type="hidden" name="booking_date">
                                                                    <input type="hidden" name="booking_time_id">
                                                                    <input type="hidden" name="appointment_id" value="{{$item->id}}">
                                                                    <div class="form-group">
                                                                        <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}" value="{{auth()->guard('web')->check() ? auth()->guard('web')->user()->name : ''}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}" value="{{auth()->guard('web')->check() ? auth()->guard('web')->user()->email : ''}}">
                                                                    </div>
                                                                    {!! render_form_field_for_frontend(get_static_option('appointment_booking_page_form_fields')) !!}

                                                                    @if(!empty($item->price))
                                                                        {!! render_payment_gateway_for_form(false) !!}
                                                                        @if(!empty(get_static_option('manual_payment_gateway')))
                                                                            <div class="form-group manual_payment_transaction_field" @if( get_static_option('site_default_payment_gateway') === 'manual_payment') style="display: block;"@endif >
                                                                                <div class="label">{{__('Transaction ID')}}</div>
                                                                                <input type="text" name="transaction_id" placeholder="{{__('transaction')}}" class="form-control">
                                                                                <span class="help-info">{!! get_manual_payment_description() !!}</span>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    <div class="button-wrap">
                                                                        <button type="submit" class="btn-boxed appointment appo_booking_btn">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_button_text')}} <i class="fas fa-spinner fa-spin d-none"></i></button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @else
                                       <div class="alert alert-warning"> {{__('Not Available')}}</div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-feedback" role="tabpanel" >
                                    <div class="feedback-wrapper">
                                        @if(auth()->guard('web')->check())
                                        <div class="feedback-form-wrapper">
                                            <h3 class="title">{{__('Leave your feedback')}}</h3>
                                            <form action="{{route('frontend.appointment.review')}}" method="post" class="appointment-booking-form" id="appointment_rating_form">
                                                @csrf
                                                <div class="error-message"></div>
                                                <input type="hidden" name="appointment_id" value="{{$item->id}}">
                                                <div class="form-group">
                                                    <label for="rating-empty-clearable2">{{__('Ratings')}}</label>
                                                    <input type="number" name="ratings"
                                                           id="rating-empty-clearable2"
                                                           class="rating text-warning"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">{{__('Message')}}</label>
                                                    <textarea name="message" cols="30" class="form-control" rows="5"></textarea>
                                                </div>
                                                <button type="submit" class="btn-boxed appointment" id="appointment_ratings">{{__('Submit')}}  <i class="fas fa-spinner fa-spin d-none"></i></button>
                                            </form>
                                        </div>
                                        @else
                                            @include('frontend.partials.ajax-login-form')
                                        @endif
                                        @if(count($item->reviews) > 0)
                                        <div class="feedback-comment-list-wrap margin-top-40">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_client_feedback_title')}}</h3>
                                            <ul class="feedback-list">
                                                @foreach($item->reviews as $data)
                                                <li class="single-feedback-item">
                                                    <div class="content">
                                                        <h4 class="title">{{$data->user ? $data->user->username : __("Anonymous")}}</h4>
                                                        <div class="rating-wrap single">
                                                           @for( $i =1; $i <= $data->ratings; $i++ )
                                                               <i class="fas fa-star"></i>
                                                           @endfor
                                                        </div>
                                                        <div class="description">{{$data->message}}</div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

