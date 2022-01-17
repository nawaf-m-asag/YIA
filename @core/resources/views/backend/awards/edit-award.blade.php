@extends('backend.admin-master')
@section('site-title')
    {{__('Edit award Post')}}
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
                            <h4 class="header-title">{{__('Edit award Post')}}</h4>
                            <a href="{{route('admin.awards.all')}}" class="btn btn-primary">{{__('All Awards')}}</a>
                        </div>

                        <form action="{{route('admin.awards.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="award_id" value="{{$award_post->id}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong>{{__('Language')}}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option @if($award_post->lang == $lang->slug) selected @endif value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="title" name="title" value="{{$award_post->title}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{__('Slug')}}</label>
                                        <input type="text" class="form-control"  id="slug" name="slug" value="{{$award_post->slug}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">{{__('Meta Tags')}}</label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" value="{{$award_post->meta_tags}}" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">{{__('Meta Description')}}</label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description">{{$award_post->meta_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">{{__('award Position')}}</label>
                                        <input type="text" class="form-control"  id="position" name="position" value="{{$award_post->position}}" placeholder="{{__('Position')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">{{__('Company Name')}}</label>
                                        <input type="text" class="form-control"  id="company_name" value="{{$award_post->company_name}}"  name="company_name" placeholder="{{__('Company Name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{__("Select Category")}}</option>
                                            @foreach($all_category as $category)
                                                <option @if($award_post->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vacancy">{{__('Vacancy')}}</label>
                                        <input type="text" class="form-control"  id="vacancy" value="{{$award_post->vacancy}}" name="vacancy" placeholder="{{__('Vacancy')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="award_context">{{__('award Context')}}</label>
                                        <input type="hidden" name="award_context" value='{{$award_post->award_context}}'>
                                        <div class="summernote" data-content='{{$award_post->award_context}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="award_responsibility">{{__('award Responsibility')}}</label>
                                        <input type="hidden" name="award_responsibility" value='{{$award_post->award_responsibility}}'>
                                        <div class="summernote" data-content='{{$award_post->award_responsibility}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_requirement">{{__('Educational Requirements')}}</label>
                                        <input type="hidden" name="education_requirement" value='{{$award_post->education_requirement}}'>
                                        <div class="summernote" data-content='{{$award_post->education_requirement}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience_requirement">{{__('Experience Requirements')}}</label>
                                        <input type="hidden" name="experience_requirement" value='{{$award_post->experience_requirement}}'>
                                        <div class="summernote" data-content='{{$award_post->experience_requirement}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="additional_requirement">{{__('Additional Requirements')}}</label>
                                        <input type="hidden" name="additional_requirement" value='{{$award_post->additional_requirement}}'>
                                        <div class="summernote" data-content='{{$award_post->additional_requirement}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_status">{{__('Employment Status')}}</label>
                                        <select name="employment_status" id="employment_status"  class="form-control">
                                            <option @if($award_post->employment_status == 'full_time') selected @endif value="full_time">{{__('Full-Time')}}</option>
                                            <option @if($award_post->employment_status == 'part_time') selected @endif value="part_time">{{__('Part-Time')}}</option>
                                            <option @if($award_post->employment_status == 'project_based') selected @endif value="project_based">{{__('Project Based')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="award_location">{{__('award Location')}}</label>
                                        <input type="text" class="form-control"  id="award_location" name="award_location" value="{{$award_post->award_location}}" placeholder="{{__('award Location')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_benefits">{{__('Compensation & Other Benefits')}}</label>
                                        <input type="hidden" name="other_benefits" value='{{$award_post->other_benefits}}'>
                                        <div class="summernote" data-content='{{$award_post->other_benefits}}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">{{__('Salary')}}</label>
                                        <input type="text" class="form-control"  id="salary" name="salary" value="{{$award_post->salary}}" placeholder="{{__('Salary')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline">{{__('Deadline')}}</label>
                                        <input type="date" class="form-control"  id="deadline" value="{{$award_post->deadline}}" name="deadline" placeholder="{{__('Deadline')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="application_fee_status"><strong>{{__('Enable Application Fee')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="application_fee_status"  @if(!empty($award_post->application_fee_status)) checked @endif>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="application_fee">{{__('Application Fee')}}</label>
                                        <input type="number" class="form-control" name="application_fee" value="{{$award_post->application_fee}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" id="status"  class="form-control">
                                            <option @if($award_post->status == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                                            <option @if($award_post->status == 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                                        </select>
                                    </div>
                                    <x-media-upload :id="$award_post->image" :name="'image'" :dimentions="'1920x1280'" :title="__('Image')"/>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update award Post')}}</button>
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
    <x-backend.auto-slug-js :url="route('admin.awards.slug.check')" :type="'update'"/>
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
                    url: "{{route('admin.awards.category.by.lang')}}",
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
