@extends('frontend.frontend-page-master')
@section('style')
 <style>
    .content span{
        padding: 2px;
        background:#17a2b8;
        border-radius:3px; 
        color: #fff;
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
                               <h class="title">{{$user->name}}</h2>
                               <div class="short-description">
                                @if ($user->university_name!==null)
                                {!! $user->university_name !!}
                                <span  class="label label-info p-2"> {{$user->specialization}}</span>
                                @endif
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
                       
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

