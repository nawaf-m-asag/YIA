@extends('frontend.user.dashboard.user-master')
@section('section')
    <div class="dashboard-form-wrapper m-5">
        <h2 class="title">{{__('Edit Certificate')}}</h2>
        <form action="{{route('user.home.edit.profile.post.certificate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="university_name">{{__('University Name')}}</label>
                <input type="text" class="form-control" id="university_name" name="university_name" value="{{$user_details->university_name}}">
            </div>
            <div class="form-group">
                <label for="specialization">{{__('Specialization')}}</label>
                <input type="text" class="form-control" id="specialization" name="specialization" value="{{$user_details->specialization}}">
            </div>
            <div class="form-group">
                <label for="graduation_date">{{__('Graduation Date')}}</label>
                <input type="date" class="form-control" id="graduation_date" name="graduation_date" value="{{$user_details->graduation_date}}">
            </div>
            <div class="form-group">
                <label for="attached_file">{{__('Attached File')}}</label>
                <input type="file" class="form-control" id="attached_file" name="attached_file" value="{{$user_details->attached_file}}">
            </div>
            <button type="submit" class="submit-btn dash-btn width-200">{{__('Save changes')}}</button>
        </form>
    </div>
@endsection