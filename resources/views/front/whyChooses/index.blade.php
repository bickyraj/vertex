@extends('layouts.front')
@section('content')
<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  <div class="hero-bottom">
    <div class="container">
      <h1>Why Choose Us</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Why Choose Us</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-5">
    <div class="row">
      @if($chooses)
        @foreach($chooses as $choose)
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="news-card shadow">
            <div class="img-wrapper" style="text-align: center; margin-bottom: 20px;">
              <img width="75px;" src="{{ $choose->imageUrl }}" class="img-fluid" alt="">
            </div>
            <div class="info">
              <a class="title" href="javascript:;">
                {{ $choose->title }}
              </a>
              <p><?= $choose->description ?></p>
            </div>
          </div>
        </div>
        @endforeach
      @else
        <p>No content to show.</p>
      @endif
    </div>
  </div>

</section>
@endsection