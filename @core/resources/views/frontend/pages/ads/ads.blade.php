@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('ads_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('ads_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('ads_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('ads_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('ads_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')

    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                            @foreach($all_ads as $data)
                                <x-frontend.ads.grid :ads="$data" :margin="true"/>
                            @endforeach
                            <nav class="pagination-wrapper" aria-label="Page navigation ">
                            {{$all_ads->links()}}
                            </nav>
                    </div>        
                </div>
                <div class="col-lg-4">
                   @include('frontend.pages.ads.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
