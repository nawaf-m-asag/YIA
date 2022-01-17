<div class="single-job-list-item">
    <div class="row">
        <div class="col-lg-5">
            <div class="thumbnail">
                {!! render_image_markup_by_attachment_id($awards->image) !!}
            </div>
        </div>
        <div class="col-lg-7">
            <span class="job_type"><i class="far fa-clock"></i> {{__(str_replace('_',' ',$awards->employment_status))}}</span>
            <a href="{{route('frontend.awards.single',$awards->slug)}}"><h3 class="title">{{$awards->title}}</h3></a>
            <span class="company_name"><strong>{{__('Company:')}}</strong> {{$awards->company_name}}</span>
            <span class="deadline"><strong>{{__('Deadline:')}}</strong> {{date("d M Y", strtotime($awards->deadline))}}</span>
            <ul class="jobs-meta">
                <li><i class="fas fa-briefcase"></i> {{$awards->position}}</li>
                <li><i class="fas fa-wallet"></i> {{$awards->salary}}</li>
                <li><i class="fas fa-map-marker-alt"></i> {{$awards->job_location}}</li>
            </ul>
        </div>
    </div>
</div>