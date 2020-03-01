@extends('layouts.front')
@section('content')

<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  <div class="hero-bottom">
    <div class="container">
      <h1>{{ $trip->name }}</h1> <sub style="color: white; bottom: -.25em; margin-left: 6px;">Gallery</sub>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('front.trips.all-gallery') }}">Gallery</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $trip->name }}</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="tour-details-section">
      <div class="row">
        @forelse($trip->trip_galleries as $gallery)
        <div class="col-lg-4 col-md-4 col-lg-3 col-xl-4">
          <div class="thumb" style="background: center / cover url('{{ $gallery->mediumImageUrl }}')">
            <a href="{{ $gallery->imageUrl }}" class="stretched-link" data-fancybox="gallery" data-caption="{{ $gallery->name }}">
            </a>
          </div>
        </div>
        @empty
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
          <p>No gallery to show.</p>
        </div>
        @endforelse
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
