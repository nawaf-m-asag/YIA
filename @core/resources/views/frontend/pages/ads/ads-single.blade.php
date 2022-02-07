@extends('frontend.frontend-page-master')
@php
  $post_img = null;
  $ads_image = get_attachment_image_by_id($ads_post->image,"full",false);
  $post_img = !empty($ads_image) ? $ads_image['img_url'] : '';
 @endphp

@section('og-meta')
    <meta property="og:url"  content="{{route('frontend.ads.single',$ads_post->slug)}}" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="{{$ads_post->title}}" />
    <meta property="og:image" content="{{$post_img}}" />
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$ads_post->meta_description}}">
    <meta name="tags" content="{{$ads_post->meta_tag}}">
@endsection
@section('site-title')
    {{$ads_post->title}}
@endsection
@section('page-title')
    {{$ads_post->title}}
@endsection
@section('content')
    <section class="blog-details-content-area padding-top-100 padding-bottom-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-item">
                        <div class="thumb">
                            @php

                            @endphp
                            @if (!empty($ads_image))
                                <img src="{{$ads_image['img_url']}}" alt="{{__($ads_post->title)}}">
                            @endif
                        </div>
                        <div class="entry-content">
                            <ul class="post-meta">
                                <li><i class="fas fa-calendar-alt"></i> {{ date_format($ads_post->created_at,'d M Y')}}</li>
                                <li>
                                    <div class="cats">
                                        <i class="fas fa-folder"></i>
                                        {!! get_ads_category_by_id($ads_post->ads_categories_id,'link') !!}
                                    </div>
                                </li>
                            </ul>
                           <div class="content-area">
                               {!! $ads_post->content !!}
                           </div>
                        </div>
                        <div class="blog-details-footer">
                        @php
                            $all_tags = explode(',',$ads_post->tags);
                        @endphp
                        @if(count($all_tags) > 1) 
                            <div class="left">
                                <ul class="tags">
                                    <li class="title">{{get_static_option('ads_single_page_'.$user_select_lang_slug.'_tags_title')}}</li>
                                    @foreach($all_tags as $tag)
                                    @php 
                                    $slug = Str::slug($tag);
                                    @endphp 
                                    @if (!empty($slug))
                                        <li><a href="{{route('frontend.ads.tags.page',['name' => $slug])}}">{{$tag}}</a></li>
                                    @endif
                                        
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                   @include('frontend.pages.ads.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection

