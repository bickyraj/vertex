@extends('layouts.front')
@section('content')
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  <div class="hero-bottom">
    <div class="container">
      <h1>{{ $team->name }}</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/teams') }}">Our Team</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $team->name }}</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="tour-details-section team-member">

      <div class="row">
        <div class="col-sm-4 col-md-3 col-lg-2">
          <img class="img-fluid" src="{{ $team->imageUrl }}" alt="">
        </div>
        <div class="col-sm-8 col-md-9 col-lg-10">
          <h2>{{ $team->name }}</h2>
          <p class="title">{{ $team->position }}</p>
          <?= $team->description; ?>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection