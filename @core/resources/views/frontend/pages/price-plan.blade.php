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
                    @foreach($all_price_plan as $key => $data)
                    <div class="col-lg-4">
                        <div class="card" style="width: 18rem;">
                            @php
                            $plan_img = get_attachment_image_by_id($data->image,null,true);
                            @endphp
                             @if (!empty($plan_img))
                             <img class="card-img-top" src="{{$plan_img['img_url']}}" alt="Card image cap">
                             @endif
                            <div class="card-body">
                              <h5 class="card-title">{{$data->title}}</h5>
                              <p class="card-text">
                                @if (strlen($data->features) > 200)
                                {{mb_substr($data->features, 0, 200, 'utf-8')}}<span style="display: none;">{{mb_substr($data->features, 200, null, 'utf-8')}}</span> ...</span>
                                @else
                                    {{$data->features}}
                                @endif
                                </p>
                            </div>
                            <div class="card-body">
                            
                                @php
                                    $url = !empty($data->url_status) ? route('frontend.plan.order',['id' => $data->id]) : $data->btn_url;
                                @endphp
                                <a href="{{$url}}" rel="canonical" class="btn btn-primary">{{$data->btn_text}}</a>
                            </div>
                          </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
       
   
@endsection
