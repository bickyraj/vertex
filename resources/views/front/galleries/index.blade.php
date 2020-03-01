@extends('layouts.front')
@section('content')

<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  <div class="hero-bottom">
    <div class="container">
      <h1>Gallery</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Gallery</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="tour-details-section">
      <div class="row">
        @if($trips)
          @foreach($trips as $trip)
          <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
            <a href="{{ $trip->galleryLink }}">
              <div class="gallery-wrap">
                <img alt="{{ $trip->name }}" title="{{ $trip->name }}" src="{{ $trip->mediumImageUrl }}">
                <div class="overlay"></div>
                <div class="title">{{ $trip->name }}</div>
              </div>
            </a>
          </div>
          @endforeach
        @else
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
          <p>No gallery to show.</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection
@push('scripts')
<script>
$(function() {
  $('[data-fancybox="gallery"]').fancybox({
    buttons: ['close']
  });
});
</script>
@endpush
