@extends('layouts.admin')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-faq" enctype="multipart/form-data">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                      <span class="kt-portlet__head-icon">
                          <i class="kt-font-brand flaticon-business"></i>
                      </span>
                        <h3 class="kt-portlet__head-title">
                            Add Instagram Gallery
                        </h3>
                    </div>
                    <div class="kt-form__actions mt-3">
                        <a href="{{ route('admin.instagram-galleries.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">
                              <i class="flaticon2-arrow-up"></i>
                            Publish</button>
                    </div>
                </div>
                <!--begin::Form-->
                    {{ csrf_field() }}
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" aria-describedby="" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label>Embed</label>
                            <textarea name="embed" id="" cols="30" required rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                          <button type="submit" class="btn btn-sm btn-primary">
                                <i class="flaticon2-arrow-up"></i>
                              Publish</button>
                            {{-- <button type="submit" class="btn btn-success">Publish</button> --}}
                            {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
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
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
		$("#add-form-faq").validate({
			submitHandler: function(form, event) {
                event.preventDefault();
                var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
                handleFaqAddForm(form);
            }
		});

    function handleFaqAddForm(form) {
      var form = $(form);
      var formData = new FormData(form[0]);

      $.ajax({
          url: "{{ route('admin.instagram-galleries.store') }}",
          type: 'POST',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          async: false,
          success: function(res) {
              if (res.status === 1) {
                  location.href = '{{ route("admin.instagram-galleries.index") }}';
                  // form[0].reset();
                  // $('#cropper-image').attr('src', '{{ asset('img/default.gif') }}');
                  // if (cropped) {
                  //   cropper.destroy();
                  // }
                  // $('#summernote-content').summernote('reset');
              }
          }
      });
    }
});
</script>
@endpush
