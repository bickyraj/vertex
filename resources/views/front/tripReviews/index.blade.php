@extends('layouts.front')
<?php
  if (session()->has('message')) {
    $session_success_message = session('message');
    session()->forget('message');
  }
?>
@section('content')
<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  <div class="hero-bottom">
    <div class="container">
      <h1>Reviews</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reviews</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-8">
        <div class="tour-details-section">

          @forelse($reviews as $review)
          <div class="review-card mb-3">
            <div class="row">
              <div class="col-md-8">
                <h3 class="review-title">{{ $review->title }}</h3>
                <p class="review-text">
                  <?= $review->review; ?>
                </p>
                <p class="stars">
                  <i class="fas fa-star active"></i>
                  <i class="fas fa-star active"></i>
                  <i class="fas fa-star active"></i>
                  <i class="fas fa-star active"></i>
                  <i class="fas fa-star active"></i>
                </p>

              </div>
              <div class="col-md-4">
                <div class="reviewer">
                  <img src="img/user.jpg" alt="">
                  <div class="reviewer-info">
                    <p class="name">{{ $review->review_name }}</p>
                    <p class="from">{{ $review->review_country }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <p>No reviews yet.</p>
          @endforelse
        </div>
      </div>
      <div class="col-lg-4">
        <aside>
          <a href="#" data-toggle="modal" data-target="#review-modal" class="btn btn-accent mb-5"><i
              class="fas fa-edit"></i> Write a review</a>
          <div class="ta-widget" style="padding: 45px;">
            {{-- trip-advisor --}}
            @include('front.elements.trip-advisor')
            {{-- end of trip-advisor --}}
          </div>
        </aside>
      </div>

    </div>
  </div>

</section>

<!-- Write a review modal -->
@include('front.elements.review-modal')
{{-- end of review modal --}}
@endsection
@push('scripts')
<script>
window.onload = function() {
  var session_success_message = '{{ $session_success_message ?? '' }}';
  if (session_success_message) {
    toastr.success(session_success_message);
  }
  //Display user image upon select
  const showImage = (src, target) => {
    var fr = new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function(e) {
      target.src = this.result;
    };
    src.addEventListener("change", function() {
      // fill fr with image data    
      fr.readAsDataURL(src.files[0]);
    });
  }
  const src = document.getElementById("photo-input");
  const target = document.getElementById("write-review-photo");
  showImage(src, target);

  //Control ratings
  const stars = document.querySelectorAll('.select-ratings i');
  const ratingsInput = document.querySelector('#ratings-input');
  stars.forEach((star, index) => {
    star.addEventListener('click', () => {
      ratingsInput.value = index + 1
      console.log(ratingsInput.value)
      stars.forEach((star, indexx) => {
        star.classList.remove('active')
        if (indexx <= index) star.classList.add('active')
      })
    })
  });
}
</script>
@endpush
