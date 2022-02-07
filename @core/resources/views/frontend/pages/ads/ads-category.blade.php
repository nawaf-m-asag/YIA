@extends('frontend.frontend-page-master')
@section('page-title')
 {{' '.$category_name}}
@endsection
@section('site-title')
    {{' '.$category_name}}
@endsection

@section('content')

    <section class="blog-content-area padding-top-100 padding-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                        @if(count($all_ads) < 1)
                                <div class="alert alert-danger">
                                    {{__('غير متوفر اي بيانات عن ').$category_name.__(' Category')}}
                                </div>
                         @endif
                    <div class="row">
                        
                                @foreach($all_ads as $data)
                                    <x-frontend.ads.grid :ads="$data" :margin="true"/>
                                @endforeach
                    </div>    
                    <div class="pagination-wrapper" aria-label="Page navigation">
                       {{$all_ads->links()}}
                    </div>
                </div>
                <div class="col-lg-4">
                   @include('frontend.pages.ads.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
