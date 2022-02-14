@extends('backend.admin-master')
@section('site-title')
اعدادات صفحة الدفع
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">اعدادات صفحة الدفع</h4>
                        <form action="{{route('admin.grants.success.page.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="grant_success_page_{{$lang->slug}}_title">العنوان</label>
                                            <input type="text" name="grant_success_page_{{$lang->slug}}_title"  class="form-control" value="{{get_static_option('grant_success_page_'.$lang->slug.'_title')}}" id="grant_success_page_{{$lang->slug}}_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="grant_success_page_{{$lang->slug}}_description">الوصف</label>
                                            <textarea name="grant_success_page_{{$lang->slug}}_description" class="form-control" id="grant_success_page_{{$lang->slug}}_description" cols="30" rows="10">{{get_static_option('grant_success_page_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">حفظ التعديل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
