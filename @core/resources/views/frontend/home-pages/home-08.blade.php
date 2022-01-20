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





<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      @foreach($all_header_slider  as $i => $data)  
      <li data-target="#myCarousel" data-slide-to="{!!$i!!}" @if($i==0)class="active"@endif></li>
      @endforeach 
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
       
        @foreach($all_header_slider as $key => $data)

        @php
        $img = get_attachment_image_by_id($data->image,null,true);
        $img_sm = get_attachment_image_by_id($data->image_sm,null,true);
        @endphp   
      <div class="item @if($key==0) active @endif">
        <picture>
            <source srcset="{{$img['img_url']}}"
                    media="(min-width: 650px)">
            <img src="{{$img_sm['img_url']}}" alt="" />
            <div id="overlay"></div>
        </picture>
        <div class="slider_text">
            @if(!empty($data->subtitle))
            <h1 class="subtitle">{{$data->subtitle}}</h1>
        @endif
        @if(!empty($data->title))
            <h1 class="title">{{$data->title}}</h1>
        @endif
        @if(!empty($data->description))
            <p class="description">{{$data->description}}</p>
        @endif
        @if(!empty($data->btn_01_status))
            <div class="btn-wrapper  desktop-left padding-top-30">
                <a href="{{$data->btn_01_url}}" class="boxed-btn">{{$data->btn_01_text}}</a>
            </div>
        @endif
        </div>

              
    </div> 
      @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
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
                                <div class="icon style-{{$a}}">
                                    <i class="{{$data->icon}}"></i>  
                                </div>
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


