<div class="single-job-list-item">
    <div class="row">
        <div class="col-lg-5">
            <div class="thumbnail">
                {!! render_image_markup_by_attachment_id($grants->image) !!}
            </div>
        </div>
        <div class="col-lg-7">
            <span class="job_type"><i class="far fa-clock"></i> {{__(str_replace('_',' ',$grants->employment_status))}}</span>
            <a href="{{route('frontend.grants.single',$grants->slug)}}"><h3 class="title">{{$grants->title}}</h3></a>
            <span class="company_name"><strong>{{__('Company:')}}</strong> {{$grants->company_name}}</span>
            <span class="deadline"><strong>{{__('Deadline:')}}</strong> {{date("d M Y", strtotime($grants->deadline))}}</span>
            <ul class="jobs-meta">
                <li><i class="fas fa-briefcase"></i> {{$grants->position}}</li>
                <li><i class="fas fa-wallet"></i> {{$grants->salary}}</li>
                <li><i class="fas fa-map-marker-alt"></i> {{$grants->grant_location}}</li>
            </ul>
        </div>
    </div>
</div>