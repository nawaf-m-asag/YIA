@extends('frontend.user.dashboard.user-master')
@section('style')
<style>
body{
text-align: right
}
.join{
  margin: 40px;
}
</style>

@endsection
@section('section')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="user-img card">
                <div class="row ">
                    <div class="col-4">
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
                                   {{ __('Update')}} <br /> {{__('Profile Photo')}}
                                  </div>
                                </div>
                              </label>
                            </div>

                    </div>
                    <div class="col-8 p-4" style="text-align: right">
                      <h3>{{$user_details->name}} @if (!empty($package_orders)) /{{$package_orders->package_name}} @endif</h3>
                      <h4>{{__('AIY number')}}: {{$user_details->id}}</h4>
                   </div>
                </div>    
            </div>
        </div>
    </div>
    <div class="row m-1">
        <div class="col-4">
          <div class="card">
            <div class="card-header">
             {{__('About me')}}
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <label for="">
                  {{__('Address')}}
                </label>
                <br>
                {{$user_details->address}}</li>
              <li class="list-group-item">
                <label for="">
                  {{__('Phone')}}
                </label>
                <br>
                {{$user_details->phone}}</li>
              <li class="list-group-item">
                <label for="">
                  {{__('Email')}}
                </label>
                <br>
                {{$user_details->email}}</li>
              <li class="list-group-item">
                <label for="">
                  {{__('Country')}}
                </label>
                <br>
                {{$user_details->country}}</li>
              <li class="list-group-item">
                <label for="">
                  {{__('City')}}
                </label>
                <br>
                {{$user_details->city}}</li>
            </ul>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <div class="card-header">
            {{__('education')}}
            </div>
            <ul class="list-group list-group-flush">
              @if ($user_details->certificate_status==1)
                  
              <li class="list-group-item">
                <label for=""> {{__('University Name')}}</label>
                <br>
                {{$user_details->university_name}}</li>
              <li class="list-group-item">
              <label for="">{{__('Specialization')}}</label>
              <br>
                {{$user_details->specialization}}
              </li>
              <li class="list-group-item">
                <label for="">
                  {{__('Graduation Date')}}
                </label>
                <br>
                {{$user_details->graduation_date}}</li>

              @endif
            </ul>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <div class="card-header">
            {{__('My member info')}}
            </div>
            @if (!empty($package_orders))
            <ul class="list-group list-group-flush">
              
              <li class="list-group-item">
                <label for="">
                  {{__('member name')}}
                </label>
                <br>
                {{$package_orders->package_name}}</li>
                <li class="list-group-item">
                  <label for="">
                    {{__('Expiry date')}}
                  </label>
                  <br>
                  @php
                       $dateString =$package_orders->created_at;
                        $t = strtotime($dateString);
                        $t2 = strtotime('+1 years', $t);
                        echo date('Y-m-d', $t2) . PHP_EOL; 
                  @endphp 
                </li>
               
            </ul>
            @endif
            <br>
            @if (empty($package_orders))
            <a href="{{route('frontend.price.plan')}}" type="button" class="btn join btn-danger">
              {{__('Join')}} 
              @else
              <a href="{{route('frontend.plan.order',$package_orders->package_id)}}" type="button" class="btn join btn-danger">
              {{__('renew')}} 
              @endif
            </a>
      
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