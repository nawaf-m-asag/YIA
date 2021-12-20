@extends('frontend.user.dashboard.user-master')
@section('section')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="user-img card">
                <div class="row ">
                    <div class="col-4">
                            <div class="pic-holder">
                              <!-- uploaded pic shown here -->
                              {!! render_image_markup_by_attachment_id($user_details->image,'pic') !!}                              <label for="newProfilePhoto" class="upload-file-block">
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
                                    Update <br /> Profile Photo
                                  </div>
                                </div>
                              </label>
                            </div>

                    </div>
                    <div class="col-8 p-4">
                      <h3>{{$user_details->name}}</h3>
                   </div>
                </div>    
            </div>
        </div>
    </div>
    <div class="row m-1">
        <div class="col-4 card"> ufduf</div>
        <div class="col-4 card"> ufduf</div>
        <div class="col-4 card"> ufduf</div>
    </div>    
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