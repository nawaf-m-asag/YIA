@include('frontend.partials.homesupportbar')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
  body {
    margin: 0;
    color: var(--paragraph-color);
    overflow-x: hidden;
    font-family: var(--body-font) !important;
}
a{
    text-decoration: none;
    color:rgb(128, 128, 128);
}
a:hover{
    text-decoration: none !important;
  
}
    .slider_text{
         position: absolute;
        top: 40%;
        right: 20%;
        z-index: 100;
        color: #fff !important;
        text-align: right;
    }
    .carousel-inner img{
        width: 100% !important;
        height: -webkit-fill-available;
    }
    .item{
        height: 700px;
    }
    .navbar-nav>li{
        float: right;
    }
    #overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.274);
  z-index: 2;
  cursor: pointer;
}
.logo-wrapper{
    float: right
}
#myCarousel{
    margin-top:-20px; 
}
.container-fluid>.navbar-collapse, .container-fluid>.navbar-header, .container>.navbar-collapse, .container>.navbar-header{
    margin-left:unset;
    margin-right: unset;
}
.carousel-indicators li{
    margin-right: 10px !important;
        
}
.carousel-indicators .active{
   background: var(--main-color-one);

}
.svg{width: 100%;
height: 40px;
margin-top: -35px}
.svg_slider{
width: 100%;
height: 60px;
margin-top: -50px

}
</style>
@endsection
@php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant',$static_field_data);
@endphp

<div class="header-style-03  header-variant-{{$home_page_variant}}">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="{{url('/')}}" class="logo">
                        @if(!empty(filter_static_option_value('site_logo',$global_static_field_data)))
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)) !!}
                        @else
                            <h2 class="site-title">{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}</h2>
                        @endif
                    </a>
                </div>
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    {!! render_frontend_menu($primary_menu) !!}
                </ul>
            </div>
            <div class="nav-right-content">
                <div class="icon-part">
                    <ul>
                        <x-navbar-search/>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>





<div class="header-slider-one global-carousel-init logistic-dots"
     data-loop="true"
     data-desktopitem="1"
     data-mobileitem="1"
     data-tabletitem="1"
     data-nav="true"
     data-autoplay="true"
>
@php
    $all_bg_image_fields =  filter_static_option_value('home_page_07_header_section_bg_image',$static_field_data);
    $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields) : [];
    $all_bg_image_sm_fields =  get_static_option('home_page_07_header_section_bg_image_sm');
    $all_bg_image_sm_fields = !empty($all_bg_image_sm_fields) ? unserialize($all_bg_image_sm_fields) : [''];

    $all_button_one_url_fields =  filter_static_option_value('home_page_07_header_section_button_one_url',$static_field_data);
    $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields) : [];

    $all_button_one_icon_fields =  filter_static_option_value('home_page_07_header_section_button_one_icon',$static_field_data);
    $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields) : [];

    $all_description_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
    $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : [];
    $all_btn_one_text_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
    $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields) : [];
    $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
    $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
@endphp
@foreach($all_bg_image_fields as $index => $image_field)
    @php
        $image_details = get_attachment_image_by_id($image_field,'full');
        $image_sm_details = get_attachment_image_by_id($all_bg_image_sm_fields[$index], 'full');
    @endphp
    <div class="header-area style-04 header-bg-04 industry-home">
        <picture class="img_slider">
            @if (isset($image_details['img_url']))
            <source srcset="{{$image_details['img_url']}}"
                    media="(min-width: 650px)">
            @endif         
            @if (isset($image_sm_details['img_url']))
            <img src="{{$image_sm_details['img_url']}}" alt="" />   
            @endif  
            
            {{-- <div class="overlay"></div> --}}
        </picture>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-inner industry-home">
                        @if(isset($all_title_fields[$index]))
                            <h1 class="title">{{$all_title_fields[$index]}}</h1>
                        @endif
                        @if(isset($all_description_fields[$index]))
                            <p class="description">{{$all_description_fields[$index]}}</p>
                        @endif
                        @if(isset($all_btn_one_text_fields[$index]) || isset($all_btn_two_text_fields[$index]))
                            <div class="btn-wrapper">
                                @if(isset($all_btn_one_text_fields[$index]))
                                <a href="{{$all_button_one_url_fields[$index] ?? ''}}" class="industry-btn">{{$all_btn_one_text_fields[$index]}} <i class="{{$all_button_one_icon_fields[$index] ?? ''}}"></i></a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>

@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <div class="political-what-we-offer-area padding-bottom-30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @php $a=0; @endphp
                @foreach($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="political-single-what-we-cover-item  margin-bottom-30">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($data->image,'grid') !!}
                                <figure class="ie-curved-y position-absolute right-0 bottom-0 left-0 mb-n1">
                                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                                    <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                                    </svg>
                                    </figure>

                          
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a>
                                </h4>
                                <p>{{$data->excerpt}}</p>
                            </div>
                        </div>
                    </div>
                    @php ($a == 6) ? $a= 1 : $a++; @endphp
                @endforeach
            </div>
        </div>
    </div>
@endif


