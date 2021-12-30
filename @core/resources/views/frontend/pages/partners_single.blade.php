@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('price_plan_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('price_plan_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
        <section class="pricing-plan-area price-inner padding-bottom-120 padding-top-110">
            <div class="container">
                <div class="row">
     
                 <div class="col-lg-12">
                    <div class="strategic-partner mt-5 h-100 p-5">
                <div class="row">    
                    <div class="col-lg-4">
                        <div class="partner-logo">
                            {!! render_image_markup_by_attachment_id($partner->image,'my-auto d-block') !!}
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="text -h-100">
                          <h4>{{$partner->title}}</h4>
                          <p>
                                {{$partner->describe}}
                          </p>
                          <a class="btn btn-s mp-5" style="bottom: -40px"  href="{{$partner->url}}">website</a>
                        </div>
                    </div>  
                </div>    
                      </div>
                    </div>    
                </div>
            </div>
        </section>
       
   
@endsection
