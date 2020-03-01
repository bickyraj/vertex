<div class="g-recaptcha" style="margin-bottom: 10px;" data-sitekey="{{ config('constants.google_recaptcha') }}"></div>
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
	document.getElementById("captcha-form").addEventListener("submit",function(evt) {
	  var response = grecaptcha.getResponse();
	  if(response.length == 0) 
	  { 
	    toastr.warning("Please tick the Captcha."); 
	    evt.preventDefault();
	    return false;
	  }
	});
</script>
@endpush