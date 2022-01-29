@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('site-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if(count($all_grants) > 0)
                        @foreach($all_grants as $data)
                            <div class="col-lg-12">
                                <x-frontend.grants.grid :grants="$data" />
                            </div>
                        @endforeach
                        @else
                            <div class="col-lg-12">
                                <div class="alert alert-warning">{{__('Nothing Found In This Category')}}</div>
                            </div>
                        @endif

                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper text-center" aria-label="Page navigation ">
                            {{$all_grants->links()}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('grant',['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
