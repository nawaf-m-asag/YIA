@extends('frontend.user.dashboard.user-master')
@section('style')
<style>
body{
text-align: right
}
.join{
  margin: 40px;
}
.pic-holder {
  width: 200px;
  height: 200px;
}
.nav-tabs{
border-bottom: solid 2px #d62222;
margin: 20px;
width: 100%;
padding-bottom: 2px
}
.nav-tabs button{
background: #e56116;
border: unset;
}

.transcript{
  text-align: center;
  line-height: 50px;
  background: #e9e9e9!important;

  height: 100px;
}
.transcript a{
 font-size: 20px;
}
.transcript a:hover{
color:#d62222;
}
</style>

@endsection
@section('section')
    <div class="row">
      
  
    
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{get_static_option('site_'.$user_select_lang_slug.'_Aboutmes')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transcript</a>
        </li>
      </ul>
              <br>
              <br>

        <div class="col-lg-12 mb-3">
            <div class="user-img card">
                <div class="row ">
                  
                    <div class="col-lg-4">
                            <div class="pic-holder">
                              <!-- uploaded pic shown here -->
                              @php
                              $user_img = get_attachment_image_by_id($user_details->image,null,true);
                              @endphp
                               @if (!empty($user_img))
                               <img  src="{{$user_img['img_url']}}" alt="Card image cap">
                               @endif                             <label for="newProfilePhoto" class="upload-file-block">
                                <div class="text-center">
                                  <div class="mb-2">
                                    <i class="fa fa-camera fa-2x"></i>
                                  </div>
                                  <form id="formUploadProfileInput" action="{{route('image.profile.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" style="display: none"name="_token" value="{{ csrf_token() }}">
                                    <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" style="display: none" />
                                </form>
                                  <div class="text-uppercase">
                                   {{get_static_option('site_'.$user_select_lang_slug.'_Updates')}} <br /> {{get_static_option('site_'.$user_select_lang_slug.'_ProfilePhoto')}}
                                  </div>
                                </div>
                              </label>
                            </div>

                    </div>
                    <div class="col-lg-8 p-4" style="text-align: right">
                      <h3>{{$user_details->name}} @if (!empty($package_orders)) /{{$package_orders->package_name}} @endif</h3>
                      <h4>{{__('YIA number')}}: {{$user_details->id}}</h4>
                   </div>
                </div>    
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row m-1">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
               {{get_static_option('site_'.$user_select_lang_slug.'_Aboutmes')}}
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <label for="">
                    {{get_static_option('site_'.$user_select_lang_slug.'_Addressa')}}
                  </label>
                  <br>
                  {{$user_details->address}}</li>
                <li class="list-group-item">
                  <label for="">
                    {{get_static_option('site_'.$user_select_lang_slug.'_Phones')}}
                  </label>
                  <br>
                  {{$user_details->phone}}</li>
                <li class="list-group-item">
                  <label for="">
                    {{get_static_option('site_'.$user_select_lang_slug.'_emailsa')}}
                  </label>
                  <br>
                  {{$user_details->email}}</li>
                <li class="list-group-item">
                  <label for="">
                    {{get_static_option('site_'.$user_select_lang_slug.'_Statesa')}}
                  </label>
                  <br>
                  {{$user_details->state}}</li>
                <li class="list-group-item">
                  <label for="">
                    {{get_static_option('site_'.$user_select_lang_slug.'_citys')}}
                  </label>
                  <br>
                  {{$user_details->city}}</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
              {{get_static_option('site_'.$user_select_lang_slug.'_education')}}
              </div>
              <ul class="list-group list-group-flush">
                @if ($user_details->certificate_status==1)
                    
                <li class="list-group-item">
                  <label for=""> {{{get_static_option('site_'.$user_select_lang_slug.'_UniversityName')}}}</label>
                  <br>
                  {{$user_details->university_name}}</li>
                <li class="list-group-item">
                <label for="">{{get_static_option('site_'.$user_select_lang_slug.'_Specialization')}}</label>
                <br>
                  {{$user_details->specialization}}
                </li>
                <li class="list-group-item">
                  <label for="">
                    {{get_static_option('site_'.$user_select_lang_slug.'_GraduationDate')}}
                  </label>
                  <br>
                  {{$user_details->graduation_date}}</li>
  
                @endif
              </ul>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
              {{get_static_option('site_'.$user_select_lang_slug.'_membershp')}}
              </div>
              @if (!empty($package_orders))
              <ul class="list-group list-group-flush">
                
                <li class="list-group-item">
                  <label for="">
                    {{get_static_option('site_'.$user_select_lang_slug.'_membertype')}}
                  </label>
                  <br>
                  {{$package_orders->package_name}}</li>
                  <li class="list-group-item">
                    <label for="">
                      {{get_static_option('site_'.$user_select_lang_slug.'_Expirydatemember')}}
                    </label>
                    <br>
                    @php
                         $dateString =$package_orders->created_at;
                          $t = strtotime($dateString);
                          $t2 = strtotime('+1 years', $t);
                          echo date('Y-m-d', $t2) . PHP_EOL; 
                               $date= date('Y-m-d',strtotime('-1 years')) . PHP_EOL;
                          if($package_orders->created_at<$date){
                            echo '<span id="expiry" class="label btn-danger p-1">انتهت العضوية</span>';
                          }
                    @endphp 
                  </li>
                 
              </ul>
              @endif
              <br>
              @if (empty($package_orders))
              <a href="{{route('frontend.price.plan')}}" type="button" class="btn join btn-danger">
                {{get_static_option('site_'.$user_select_lang_slug.'_joinuss')}} 
                @else
                <a href="{{route('frontend.plan.order',$package_orders->package_id)}}" type="button" class="btn join btn-danger">
                {{get_static_option('site_'.$user_select_lang_slug.'_renews')}} 
                @endif
              </a>
        
            </div>
          </div>
      </div> 
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
          <div class="col-lg-4">
            <div class="card transcript">
              <h4 class="p-1">transcript</h4>
              <a href="{{route('user.home.course.transcript')}}">{{get_static_option('site_'.$user_select_lang_slug.'_viewall')}}<i class="fas fa-angle-left"></i></a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card transcript">
              <h4 class="p-1">{{get_static_option('site_'.$user_select_lang_slug.'_ExternalCertificates')}}</h4>
              <a href="{{route('user.home.self_reports')}}">{{get_static_option('site_'.$user_select_lang_slug.'_viewall')}}<i class="fas fa-angle-left"></i></a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card transcript">
              <h4 class="p-1">{{get_static_option('courses_page_'.$user_select_lang_slug.'_name')}}</h4>
              <a href="{{route('frontend.course')}}">{{get_static_option('site_'.$user_select_lang_slug.'_viewall')}}<i class="fas fa-angle-left"></i></a>
            </div>
          </div>
        </div>
      </div>
  </div>
    <br>
    <br>
@endsection
@section('scripts')
    

<script>
  $(document).on("change", ".uploadProfileInput", function () {
  var triggerInput = this;
  var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
  var holder = $(this).closest(".pic-holder");
  var wrapper = $(this).closest(".profile-pic-wrapper");
  $(wrapper).find('[role="alert"]').remove();
  var files = !!this.files ? this.files : [];
  if (!files.length || !window.FileReader) {
    return;
  }
  if (/^image/.test(files[0].type)) {
    // only image file
    var reader = new FileReader(); // instance of the FileReader
    reader.readAsDataURL(files[0]); // read the local file

    reader.onloadend = function () {
      $(holder).addClass("uploadInProgress");
      $(holder).find(".pic").attr("src", this.result);
      $(holder).append(
        '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
      );

      // Dummy timeout; call API or AJAX below
      setTimeout(() => {
        $(holder).removeClass("uploadInProgress");
        $(holder).find(".upload-loader").remove();
        // If upload successful
        if (Math.random() < 0.9) {
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
          );

          // Clear input after upload
          $("#formUploadProfileInput").submit();
          $(triggerInput).val("");

          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
        } else {
          $(holder).find(".pic").attr("src", currentImg);
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
          );

          // Clear input after upload
          $(triggerInput).val("");
          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
        }
      }, 1500);
    };
  } else {
    $(wrapper).append(
      '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
    );
    setTimeout(() => {
      $(wrapper).find('role="alert"').remove();
    }, 3000);
  }
});

</script>
@endsection