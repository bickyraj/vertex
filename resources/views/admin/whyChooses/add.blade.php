@extends('layouts.admin')
@push('styles')
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/cropperjs/dist/cropper.min.css" rel="stylesheet">
<link href="./assets/vendors/bootstrap-rating-master/bootstrap-rating.css" rel="stylesheet">
@endpush
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-page" enctype="multipart/form-data">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                      <span class="kt-portlet__head-icon">
                          <i class="kt-font-brand flaticon-business"></i>
                      </span>
                        <h3 class="kt-portlet__head-title">
                            Add Why Choose Us
                        </h3>
                    </div>
                    <div class="kt-form__actions mt-3">
                        <a href="{{ route('admin.why-chooses.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-arrow-up"></i>
                            Publish</button>
                    </div>
                </div>
                <!--begin::Form-->
                    {{ csrf_field() }}
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <div class="row">
                              <div class="col-lg-7">
                                <div class="mb-3">
                                    <img id="cropper-image" class="crop-img-div" src="{{ asset('img/default.gif') }}">
                                </div>
                              </div>
                            </div>
                            <input type="file" name="file" id="cropper-upload">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            {{-- <button type="submit" class="btn btn-success">Publish</button> --}}
                            {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                            <button type="submit" class="btn btn-sm btn-primary">
                                  <i class="flaticon2-arrow-up"></i>
                                Publish</button>
                        </div>
                    </div>
                <!--end::Form-->
            </div>
                </form>

            <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="./assets/js/demo1/pages/crud/forms/widgets/summernote.js" type="text/javascript"></script>
<script src="./assets/vendors/cropperjs/dist/cropper.min.js"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="./assets/vendors/bootstrap-rating-master/bootstrap-rating.min.js"></script>
<script type="text/javascript">
$(function() {
  $("#trip-rating").rating();
		$("#add-form-page").validate({
			submitHandler: function(form, event) {
        event.preventDefault();
        var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
        handleReviewAddForm(form);
		  }
		});
		var cropped = false;
    const image = document.getElementById('cropper-image');
    var cropper = "";

    function handleReviewAddForm(form) {
      var form = $(form);
      var formData = new FormData(form[0]);
      if (cropper) {
        formData.append('cropped_data', JSON.stringify(cropper.getData()));
      }

      $.ajax({
          url: "{{ route('admin.why-chooses.store') }}",
          type: 'POST',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          async: false,
          success: function(res) {
              if (res.status === 1) {
                  location.href = '{{ route('admin.why-chooses.index') }}';
              }
          }
      });
    }

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#cropper-image').attr('src', e.target.result);
          initCropperjs();
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#cropper-upload").change(function() {
      readURL(this);
    });

    function initCropperjs() {
    	if (cropped) {
    		cropper.destroy();
    		cropped = false;
    	}

	    cropper = new Cropper(image, {
	        aspectRatio: 1 / 1,
	        zoomable: false,
	        viewMode: 2,
	        crop(event) {
	            // console.log(event.detail.x);
	            // console.log(event.detail.y);
	            // console.log(event.detail.width);
	            // console.log(event.detail.height);
	            // console.log(event.detail.rotate);
	            // console.log(event.detail.scaleX);
	            // console.log(event.detail.scaleY);
	        },
	    });

	    cropped = true;
    }
});

</script>
@endpush
