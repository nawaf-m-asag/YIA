@extends('frontend.frontend-page-master')
@section('style')
    <style>
        body{
            background:#e6e6e6f3;
            text-align: right;
        }
        .item{
            margin-top: 30px;
        }
        .card-title{
            padding: 20px;
        }
        .logo-dis  {
            text-align: center;
            position: relative;
            border-radius: 3%;
            width: 100%;
            height: 120px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
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
                    @foreach($all_discounts as $key => $data)
                    <div class="col-lg-3 item">
                        <div class="card">
                            <h5 class="card-title">{{$data->title}}</h5>
                            <div class="logo-dis">
                                <a href="{{$data->url}}">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                                 </a>
                            </div>
                        </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
       
   
@endsection
