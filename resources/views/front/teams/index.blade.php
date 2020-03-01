@extends('layouts.front')
@section('content')
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  </div>
  <div class="hero-bottom">
    <div class="container">
      <h1>Our Team</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Our Team</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="administration-tab" data-toggle="pill" href="#administration" role="tab"
          aria-controls="administration" aria-selected="true">Administration</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="representatives-tab" data-toggle="pill" href="#representatives" role="tab"
          aria-controls="representatives" aria-selected="false">Representatives</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="tour-guides-tab" data-toggle="pill" href="#tour-guides" role="tab"
          aria-controls="tour-guides" aria-selected="false">Tour Guides</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="administration" role="tabpanel" aria-labelledby="administration-tab">
        <h2>Administration</h2>
        @if($administrations)
        	@foreach($administrations as $item)
        	<div class="tour-details-section team-member">

        	  <div class="row">
        	    <div class="col-sm-4 col-md-3 col-lg-2">
        	      <img class="img-fluid" src="{{ $item->imageUrl }}" alt="">
        	    </div>
        	    <div class="col-sm-8 col-md-9 col-lg-10">
        	      <h2>{{ $item->name }}</h2>
        	      <p class="title">{{ $item->position }}</p>
        	      {{ strip_tags($item->description) }}
        	      <a href="{{ route('front.teams.show', ['slug' => $item->slug]) }}" class="btn btn-primary">Read more</a>
        	    </div>
        	  </div>
        	</div>
        	@endforeach
        @endif
      </div>
      <div class="tab-pane fade" id="representatives" role="tabpanel" aria-labelledby="representatives-tab">
        <h2>Representatives</h2>
        @if($representatives)
        	@foreach($representatives as $item)
        	<div class="tour-details-section team-member">

        	  <div class="row">
        	    <div class="col-sm-4 col-md-3 col-lg-2">
        	      <img class="img-fluid" src="{{ $item->imageUrl }}" alt="">
        	    </div>
        	    <div class="col-sm-8 col-md-9 col-lg-10">
        	      <h2>{{ $item->name }}</h2>
        	      <p class="title">{{ $item->position }}</p>
        	      {{ strip_tags($item->description) }}
        	      <a href="{{ route('front.teams.show', ['slug' => $item->slug]) }}" class="btn btn-primary">Read more</a>
        	    </div>
        	  </div>
        	</div>
        	@endforeach
        @endif
      </div>
      <div class="tab-pane fade" id="tour-guides" role="tabpanel" aria-labelledby="tour-guides-tab">
        <h2>Tour Guides</h2>
        @if($tour_guides)
        	@foreach($tour_guides as $item)
        	<div class="tour-details-section team-member">

        	  <div class="row">
        	    <div class="col-sm-4 col-md-3 col-lg-2">
        	      <img class="img-fluid" src="{{ $item->imageUrl }}" alt="">
        	    </div>
        	    <div class="col-sm-8 col-md-9 col-lg-10">
        	      <h2>{{ $item->name }}</h2>
        	      <p class="title">{{ $item->position }}</p>
        	      {{ strip_tags($item->description) }}
        	      <a href="{{ route('front.teams.show', ['slug' => $item->slug]) }}" class="btn btn-primary">Read more</a>
        	    </div>
        	  </div>
        	</div>
        	@endforeach
        @endif
      </div>
    </div>


  </div>
</section>
@endsection