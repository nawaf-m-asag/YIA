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
                    @foreach ($all_partners as $data)
                        
                 <div class="col-lg-6">
                    <div class="strategic-partner mt-5">
                            <div class="partner-logo">
                                {!! render_image_markup_by_attachment_id($data->image,'my-auto d-block') !!}
                            </div>
                            <div class="text">
                            <h4><a href="{{route('frontend.partners.single_page',$data->id)}}">{{$data->title}}</a></h4>
                            <p>
                                @if (strlen($data->describe) > 150)
                                {{mb_substr($data->describe, 0, 150, 'utf-8')}}<span style="display: none;">{{mb_substr($data->describe, 150, null, 'utf-8')}}</span> ...</span>
                                @else
                                    {{$data->describe}}
                                @endif</p>
                            <a class="btn btn-s" href="{{$data->url}}">website</a>
                            </div>
                      
                      </div>
                    </div>    
                      @endforeach
                </div>
            </div>
        </section>
       
   
@endsection
