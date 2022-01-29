@extends('backend.admin-master')
@section('site-title')
    {{__('Edit grant Post')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('Edit grant Post')}}</h4>
                            <a href="{{route('admin.grants.all')}}" class="btn btn-primary">{{__('All rants')}}</a>
                        </div>

                        <form action="{{route('admin.grants.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="grant_id" value="{{$grant_post->id}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong>{{__('Language')}}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option @if($grant_post->lang == $lang->slug) selected @endif value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="title" name="title" value="{{$grant_post->title}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{__('Slug')}}</label>
                                        <input type="text" class="form-control"  id="slug" name="slug" value="{{$grant_post->slug}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">{{__('Meta Tags')}}</label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" value="{{$grant_post->meta_tags}}" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">{{__('Meta Description')}}</label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description">{{$grant_post->meta_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">{{__('grant Position')}}</label>
                                        <input type="text" class="form-control"  id="position" name="position" value="{{$grant_post->position}}" placeholder="{{__('Position')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">{{__('Company Name')}}</label>
                                        <input type="text" class="form-control"  id="company_name" value="{{$grant_post->company_name}}"  name="company_name" placeholder="{{__('Company Name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{__("Select Category")}}</option>
                                            @foreach($all_category as $category)
                                                <option @if($grant_post->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vacancy">{{__('Vacancy')}}</label>
                                        <input type="text" class="form-control"  id="vacancy" value="{{$grant_post->vacancy}}" name="vacancy" placeholder="{{__('Vacancy')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="grant_context">{{__('grant Context')}}</label>
                                        <input type="hidden" name="grant_context" value='{{$grant_post->grant_context}}'>
                                        <div class="summernote" data-content='{{$grant_post->grant_context}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="grant_responsibility">{{__('grant Responsibility')}}</label>
                                        <input type="hidden" name="grant_responsibility" value='{{$grant_post->grant_responsibility}}'>
                                        <div class="summernote" data-content='{{$grant_post->grant_responsibility}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_requirement">{{__('Educational Requirements')}}</label>
                                        <input type="hidden" name="education_requirement" value='{{$grant_post->education_requirement}}'>
                                        <div class="summernote" data-content='{{$grant_post->education_requirement}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience_requirement">{{__('Experience Requirements')}}</label>
                                        <input type="hidden" name="experience_requirement" value='{{$grant_post->experience_requirement}}'>
                                        <div class="summernote" data-content='{{$grant_post->experience_requirement}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="additional_requirement">{{__('Additional Requirements')}}</label>
                                        <input type="hidden" name="additional_requirement" value='{{$grant_post->additional_requirement}}'>
                                        <div class="summernote" data-content='{{$grant_post->additional_requirement}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_status">{{__('Employment Status')}}</label>
                                        <select name="employment_status" id="employment_status"  class="form-control">
                                            <option @if($grant_post->employment_status == 'full_time') selected @endif value="full_time">{{__('Full-Time')}}</option>
                                            <option @if($grant_post->employment_status == 'part_time') selected @endif value="part_time">{{__('Part-Time')}}</option>
                                            <option @if($grant_post->employment_status == 'project_based') selected @endif value="project_based">{{__('Project Based')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="grant_location">{{__('grant Location')}}</label>
                                        <input type="text" class="form-control"  id="grant_location" name="grant_location" value="{{$grant_post->grant_location}}" placeholder="{{__('grant Location')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_benefits">{{__('Compensation & Other Benefits')}}</label>
                                        <input type="hidden" name="other_benefits" value='{{$grant_post->other_benefits}}'>
                                        <div class="summernote" data-content='{{$grant_post->other_benefits}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">{{__('Salary')}}</label>
                                        <input type="text" class="form-control"  id="salary" name="salary" value="{{$grant_post->salary}}" placeholder="{{__('Salary')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline">{{__('Deadline')}}</label>
                                        <input type="date" class="form-control"  id="deadline" value="{{$grant_post->deadline}}" name="deadline" placeholder="{{__('Deadline')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="application_fee_status"><strong>{{__('Enable Application Fee')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="application_fee_status"  @if(!empty($grant_post->application_fee_status)) checked @endif>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="application_fee">{{__('Application Fee')}}</label>
                                        <input type="number" class="form-control" name="application_fee" value="{{$grant_post->application_fee}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" id="status"  class="form-control">
                                            <option @if($grant_post->status == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                                            <option @if($grant_post->status == 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                                        </select>
                                    </div>
                                    <x-media-upload :id="$grant_post->image" :name="'image'" :dimentions="'1920x1280'" :title="__('Image')"/>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update grant Post')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <x-backend.auto-slug-js :url="route('admin.grants.slug.check')" :type="'update'"/>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 200,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "{{route('admin.grants.category.by.lang')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category').html('<option value="">{{__('Select Category')}}</option>');
                        $.each(data,function(index,value){
                            $('#category').append('<option value="'+value.id+'">'+value.title+'</option>')
                        });
                    }
                });
            });
        });
    </script>
@endsection
