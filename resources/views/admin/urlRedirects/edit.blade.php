@extends('layouts.admin')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <form class="kt-form" id="add-form-faq" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ $url_redirect->id }}">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <span class="kt-portlet__head-icon">
                              <i class="kt-font-brand flaticon-edit-1"></i>
                          </span>
                            <h3 class="kt-portlet__head-title">
                                Edit Redirection
                            </h3>
                        </div>
                        <div class="kt-form__actions mt-3">
                            <a href="{{ route('admin.redirection-managers') }}" class="btn btn-sm btn-secondary">Cancel</a>
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
                            <label>Name</label>
                            <input type="text" value="{{ $url_redirect->name }}" name="name" class="form-control" aria-describedby="nameHelp" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label>From Url</label>
                            <input type="text" value="{{ $url_redirect->from_url }}" name="from_url" class="form-control" aria-describedby="from_urlHelp" placeholder="Url" required>
                        </div>
                        <div class="form-group">
                            <label>To Url</label>
                            <input type="text" value="{{ $url_redirect->to_url }}" name="to_url" class="form-control" aria-describedby="to_urlHelp" placeholder="Url" required>
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
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
  $("#add-form-faq").validate({
    submitHandler: function(form, event) {
      event.preventDefault();
      var btn = $(form).find('button[type=submit]').attr('disabled', true).html('Publishing...');
      handleFaqForm(form);
    }
  });

  function handleFaqForm(form) {
    var form = $(form);
    var formData = new FormData(form[0]);
    $.ajax({
        url: "{{ route('admin.redirection-managers.update') }}",
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        async: false,
        success: function(res) {
            if (res.status === 1) {
                location.href = '{{ route("admin.redirection-managers") }}';
            }
        }
    });
  }
  initSummerNote();
});

</script>
@endpush
