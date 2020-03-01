@extends('layouts.admin')
@push('styles')
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/cropperjs/dist/cropper.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-team" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ $team->id }}">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <span class="kt-portlet__head-icon">
                              <i class="kt-font-brand flaticon-edit-1"></i>
                          </span>
                            <h3 class="kt-portlet__head-title">
                                Edit Team
                            </h3>
                        </div>
                        <div class="kt-form__actions mt-3">
                            <a href="{{ route('admin.teams.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-check-mark"></i>
                            Update
                          </button>
                        </div>
                    </div>
                    <!--begin::Form-->
                    {{ csrf_field() }}
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label for="">Team Image</label>
                            <div class="row">
                              <div class="col-lg-7">
                                <div class="mb-3">
                                  <img id="cropper-image" class="crop-img-div" src="{{ $team->image_url }}">
                                </div>
                                <input type="file" name="file" id="cropper-upload">
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{ $team->name }}" name="name" class="form-control" aria-describedby="" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" id="" class="form-control form-control-sm">
                              <option value="1" {{ (($team->type == 1)?"selected":"") }}>Administration</option>
                              <option value="2" {{ (($team->type == 2)?"selected":"") }}>Representatives</option>
                              <option value="3" {{ (($team->type == 3)?"selected":"") }}>Tour Guides</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" value="{{ $team->position }}" name="position" class="form-control" aria-describedby="" placeholder="Position" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div id="summernote-description" class="summernote">
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-check-mark"></i>
                            Update
                          </button>
                            {{-- <button type="submit" class="btn btn-success">Publish</button> --}}
                            {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
{{-- <script src="./assets/js/demo1/pages/crud/forms/widgets/summernote.js" type="text/javascript"></script> --}}
<script src="./assets/vendors/cropperjs/dist/cropper.min.js"></script>
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
  function initSummerNote() {
    $('#summernote-description').summernote({
      height: 400
    });
    $('#summernote-description').summernote("code", '<?= $team->description; ?> ');
  }
  $("#add-form-team").validate({
    submitHandler: function(form, event) {
      event.preventDefault();
      var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
      handleTeamForm(form);
    }
  });
  var cropped = false;
  const image = document.getElementById('cropper-image');
  var cropper = "";

  function handleTeamForm(form) {
    var form = $(form);
    var formData = new FormData(form[0]);
    var description = form.find('#summernote-description').summernote('code');
    formData.append('description', description);
    if (cropper) {
      formData.append('cropped_data', JSON.stringify(cropper.getData()));
    }

    $.ajax({
        url: "{{ route('admin.teams.update') }}",
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        async: false,
        success: function(res) {
            if (res.status === 1) {
                location.href = '{{ route('admin.teams.index') }}';
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
        ready: function (data) {
          var contData = cropper.getImageData(); //Get container data
          cropper.setCropBoxData({"left":0,"top":0,"width":contData.width,"height":contData.height});
        },
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

  initCropperjs();
  initSummerNote();
});

</script>
@endpush
