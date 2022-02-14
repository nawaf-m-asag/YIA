@extends('backend.admin-master')
@section('site-title')
اعدادت صفحة المنح   
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-flash-msg/>
                <x-error-msg/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">اعدادت صفحة المنح</h4>
                    
                        <form action="{{route('admin.grants.page.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_grant_post_items">عدد العناصر التي يتم عرضها في صفحة المنح</label>
                                <input type="text" name="site_grant_post_items"  class="form-control" value="{{get_static_option('site_grant_post_items')}}" id="site_grant_post_items">
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">حفظ التعديل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection