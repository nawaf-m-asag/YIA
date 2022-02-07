@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Search For: ')}} {{$search_term}}
@endsection
@section('content')
    <section class="blog-content-area padding-top-100 padding-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if(count($all_ads) < 1)
                            <div class="alert alert-danger">
                                {{__('Nothing found related to').' '.$search_term}}
                            </div>
                        @endif
                        @foreach($all_ads as $data)
                                <x-frontend.ads.grid :ads="$data" :margin="true"/> 
                        @endforeach
                    </div>    
                    <div class="pagination-wrapper" aria-label="Page navigation ">
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
