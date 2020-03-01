<?php
  if (session()->has('success_message')) {
    $session_success_message = session('success_message');
    session()->forget('success_message');
  }

  if (session()->has('error_message')) {
    $session_error_message = session('error_message');
    session()->forget('error_message');
  }
?>
@extends('layouts.front')
@section('meta_og_title'){!! $trip->trip_seo->meta_title??'' !!}@stop 
@section('meta_description'){!! $trip->trip_seo->meta_description??'' !!}@stop
@section('meta_keywords'){!! $trip->trip_seo->meta_keywords??'' !!}@stop
@section('meta_og_url'){!! $trip->trip_seo->canonical_url??'' !!}@stop 
@section('meta_og_description'){!! $trip->trip_seo->meta_description??'' !!}@stop 
@section('meta_og_image'){!! $trip->trip_seo->ogImageUrl??'' !!}@stop 
@push('styles')
<link href="{{ asset('assets/vendors/bootstrap-rating-master/bootstrap-rating.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- Hero -->
<section class="hero-second tour-details-hero">
  <div class="owl-carousel">
    @if(iterator_count($trip->trip_galleries))
      @foreach($trip->trip_galleries as $gallery)
      <div class="slide" style="background-image: url({{ $gallery->imageUrl }})">
        {{-- <div class="caption"> --}}
          {{-- <h2>A phenomenal and luxurious Himalayan adventure</h2> --}}
          {{-- <p>Trek to EBC and return to Lukla by helicopter, accommodation at luxury mountain lodges</p> --}}
        {{-- </div> --}}
      </div>
      @endforeach
    @endif
  </div>
  <div class="breadcrumb-wrapper">

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('front.trips.listing') }}">Trips</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $trip->name }}</li>
      </ol>
    </nav>
  </div>
</section>

<section class="tour-details">

  <nav class="tour-details-tabs sticky-top" id="secondnav">
    <ul class="nav">
      <li class="nav-item">
        <a href="#overview" class="nav-link"><i class="fas fa-receipt"></i> Overview</a>
      </li>
      @if(iterator_count($trip->trip_itineraries))
      <li class="nav-item">
        <a href="#itinerary" class="nav-link"><i class="far fa-calendar-alt"></i> Itinerary</a>
      </li>
      @endif
      @if($trip->trip_include_exclude)
      <li class="nav-item">
        <a href="#inclusions" class="nav-link"><i class="fas fa-box-open"></i> Inclusions</a>
      </li>
      @endif
      @if(iterator_count($trip->trip_departures))
      <li class="nav-item">
        <a href="#date-price" class="nav-link"><i class="fas fa-box-open"></i> Date & Price</a>
      </li>
      @endif
      @if(iterator_count($trip->trip_reviews))
      <li class="nav-item">
        <a href="#reviews" class="nav-link"><i class="far fa-comments"></i> Review</a>
      </li>
      @endif
      @if(iterator_count($trip->trip_faqs))
      <li class="nav-item">
        <a href="#faqs" class="nav-link"><i class="far fa-question-circle"></i> FAQs</a>
      </li>
      @endif
    </ul>
  </nav>

  <div class="container mt-2 mb-5">
    <div class="row">
      <div class="col-md-8">
        <h1 class="tour-title">{{ $trip->name }}</h1>
        <div class="card price-card mb-4 d-md-none">
          <div class="ribbon">
            <div class="text">
              {{ $trip->best_value }}
            </div>
          </div>
          <div class="card-header">
            <h3>Price starting from</h3>
          </div>
          <p class="price">
            <s>${{ $trip->cost }}</s>
            <span class="currency">USD</span>
            <span class="figure">{{ $trip->offer_price }}</span>
          </p>
          <p class="mb-3">
            <small>per person</small>
          </p>
          <p class="mb-3">
            <a href="" class="btn btn-block btn-accent">Book Now</a>
            <a href="#" class="btn btn-block btn-accent">Enquire Now</a>
          </p>
          <hr>
          <div class="text">
            <h4>
              You can customize this trip
            </h4>
            <ul>
              <li>Have a big group?</li>
              <li>Budget problem?</li>
              <li>Date & Itinerary problem?</li>
              <li>Wanna add / lessen services?</li>
            </ul>
            All right, we'll help you personalize your trips
          </div>
        </div>
        <a href="{{ route('front.trips.customize', ['slug' => $trip->slug]) }}" class="print mr-3"><i class="fas fa-tools"></i> Customize this trip</a>
        <a href="{{ route('front.trips.print', ['slug' => $trip->slug]) }}" class="print mr-3"> <i class="fas fa-print"></i> Print tour details</a>
        @if($trip->pdfLink)
        <a href="{{ $trip->pdfLink }}" download target="_blank" class="print my-2"> <i class="fas fa-map"></i> Download brochure</a>
        @endif
        <div id="overview" class="tour-details-section">
          <!-- <h2>Overview</h2> -->
          <div class="tabular">
            <div class="row">

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-stopwatch"></i>
                </div>
                <div class="data">
                  <p class="field-name">
                    Duration
                  </p>
                  <p class="field-value">
                    {{ $trip->duration }}
                  </p>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-mountain"></i>
                </div>
                <div class="data">
                  <p class="field-name">
                    Max. Elevation
                  </p>
                  <p class="field-value">
                    {{ $trip->max_altitude }}m
                  </p>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="data">
                  <p class="field-name">
                    Group size
                  </p>
                  <p class="field-value">
                    {{ $trip->group_size }}
                  </p>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="data">

                  <div class="field-name">

                    Level
                  </div>
                  <div class="field-value">
                    {{ $trip->difficulty_grade_value }}
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-bus"></i>
                </div>
                <div class="data">
                  <div class="field-name">
                    Transportation
                  </div>
                  <div class="field-value">
                    {!! ($trip->trip_info)?$trip->trip_info->transportation:'' !!}
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-cloud-sun"></i>
                </div>
                <div class="data">

                  <div class="field-name">
                    Best Season
                  </div>
                  <div class="field-value">
                    March to May,
                    September to December
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-hotel"></i>
                </div>
                <div class="data">
                  <div class="field-name">
                    Accomodation
                  </div>
                  <div class="field-value">
                    {!! ($trip->trip_info)?$trip->trip_info->accomodation:'' !!}
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-utensils"></i>
                </div>
                <div class="data">
                  <div class="field-name">
                    Meals
                  </div>
                  <div class="field-value">
                    <?= ($trip->trip_info)?$trip->trip_info->meals: '' ?>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="far fa-play-circle"></i>
                </div>
                <div class="data">

                  <div class="field-name">

                    Starts at
                  </div>
                  <div class="field-value">
                    {{ $trip->starting_point }}
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="far fa-stop-circle"></i>
                </div>
                <div class="data">

                  <div class="field-name">

                    Ends at
                  </div>
                  <div class="field-value">
                    {{ $trip->ending_point }}
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="icon">
                  <i class="fas fa-route"></i>
                </div>
                <div class="data">

                  <div class="field-name">

                    Trip Route
                  </div>
                  <div class="field-value">
                    {!! ($trip->trip_info)?$trip->trip_info->trip_route:'' !!}
                  </div>
                </div>
              </div>

            </div>

          </div>

          <h3>Highlights</h3>
          <ul class="highlights">
              {!! ($trip->trip_info)?$trip->trip_info->highlights:'' !!}
          </ul>

          <div id="overview-text" class="collapse">
            <p>
              {!! ($trip->trip_info)?$trip->trip_info->overview:'' !!}
            </p>

            <div class="trip-note mb-3">
              <p class="font-weight-bold mb-0"><i class="fas fa-info"></i> Important Note</p>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam aspernatur corporis, quibusdam
                nostrum itaque cum quod quaerat ea! Unde magnam provident quod! Fugit in enim deleniti ex, tenetur modi
                neque?</p>
            </div>
          </div>
          <p class="text-center">
            <button id="toggle-overview" class="btn btn-accent" data-toggle="collapse" data-target="#overview-text">Show
              More</button>
          </p>


        </div>
        @if(iterator_count($trip->trip_itineraries))
        <div id="itinerary" class="tour-details-section">
          <h2>Trip Itinerary</h2>
          <button class="btn btn-sm btn-accent expand-all">Expand All</button>
          <button class="btn btn-sm btn-accent collapse-all">Collapse All</button>
          <div class="itinerary">
            @foreach($trip->trip_itineraries as $key => $itinerary)
            <div class="itinerary-row">
              <div class="day">
                <p class="d">Day</p>
                {{ $itinerary->day }}
              </div>
              <div class="itinerary-text">
                <div class="collapse-toggle">
                  <a data-toggle="collapse" href="#day1" aria-expanded="false" aria-controls="day{{ $key }}">
                    <h3>{{ $itinerary->name }}</h3>
                  </a>
                </div>
                <div id="day{{ $key }}" class="collapse day-details">
                  <p>
                    <?= $itinerary->description; ?>
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endif

        @if($trip->trip_include_exclude)
        <div id="inclusions" class="tour-details-section">
          <h2>Inclusions</h2>
          <div class="row justify-content-center">

            <div class="col-lg-6">
              <!-- <h3>What is included?</h3> -->
              @if($trip->trip_include_exclude)
              <ul class="includes">
                <?= $trip->trip_include_exclude->include; ?>
              </ul>
              @endif
            </div>
            <div class="col-lg-6">
              <!-- <h3>What isn't included?</h3> -->
              @if($trip->trip_include_exclude)
              <ul class="excludes">
                <?= $trip->trip_include_exclude->exclude; ?>
              </ul>
              @endif
            </div>
          </div>
          @if($trip->trip_include_exclude && $trip->trip_include_exclude->complimentary)
          <div class="complimentary">
            <!-- <div class="row justify-content-center">
              <div class="col-lg-7"> -->
            <h3>Complimentary</h3>
            <ul>
                <?= $trip->trip_include_exclude->complimentary; ?>
            </ul>
            <!-- </div>
            </div> -->
          </div>
          @endif
        </div>
        @endif
        @if(iterator_count($trip->trip_departures))
        <div id="date-price" class="tour-details-section">
          <!-- <h2>Date & Price</h2> -->
          <h2>Upcoming Departure Dates</h2>
          <!-- <h3>Upcoming Departure Dates</h3> -->
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Offer Price</th>
                <th>Status</th>
                <th></th>
              </thead>
              <tbody>
                @foreach($trip->trip_departures as $departure)
                <tr>
                  <td>{{ formatDate($departure->from_date) }}</td>
                  <td>{{ formatDate($departure->to_date) }}</td>
                  <td>
                    <small class="text-gray"><s>USD {{ number_format($trip->cost) }}</s></small><br>
                    <span class="text-accent">USD <b>{{ number_format($departure->price) }}</b></span>
                  </td>
                  <td><span class="text-success">{{ $departure->statusInfo }}</span></td>
                  <td><a href="{{ route('front.trips.departure-booking', ['slug' => $trip->slug, 'id' => $departure->id]) }}" class="btn btn-sm btn-accent">Book now</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <p class="text-center"><button id="more-dates" class="btn btn-accent2">See more dates</button></p>
          </div>
        </div>
        @endif

        @if(iterator_count($trip->trip_reviews))
        <div id="reviews" class="tour-details-section">
          <h2>Reviews</h2>
          @foreach($trip->trip_reviews as $review)
          <div class="review-card mb-3">
            <div class="row">
              <div class="col-md-8 col-lg-9">
                <div class="review">

                  {{-- <h3 class="review-title">Lorem, ipsum dolor.</h3> --}}
                  <p class="review-text">
                    {{ $review->review }}
                  </p>
                  <p class="stars">
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                  </p>
                </div>

              </div>
              <div class="col-md-4 col-lg-3 align-self-center">
                <div class="reviewer">
                  <img src="{{ $review->imageUrl }}" alt="">
                  <div class="reviewer-info">
                    <p class="name">{{ $review->review_name }}</p>
                    <p class="from">{{ $review->review_country }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <p class="text-center"><button id="more-reviews" class="btn btn-accent2">See more reviews</button></p>
          <!-- Write a review button. Triggers modal. -->
          <a href="#" class="btn btn-accent" data-toggle="modal" data-target="#review-modal"><i class="fas fa-edit"></i>
            Write a review</a>
        </div>
        @endif

        @if(iterator_count($trip->trip_faqs))
        <div id="faqs" class="tour-details-section">
          <h2>Frequently Asked Questions</h2>
          <div class="accordion" id="faq-accordion">
            @foreach($trip->trip_faqs as $key => $faq)
            <div class="card">
              <div class="card-header" id="faq{{ $key }}">
                <h1>{{ $faq->title }}</h1>
                <a role="button" data-toggle="collapse" href="#answer{{ $key }}" class="stretched-link" aria-expanded="true">
                </a>
              </div>
              <div id="answer{{ $key }}" class="collapse" data-parent="#faq-accordion" aria-labelledby="faq{{ $key }}">
                <div class="card-body">
                  <p>{{ $faq->description }}</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endif
        <p class="mb-5">
          <a href="{{ route('front.trips.booking', ['slug' => $trip->slug]) }}" class="d-none d-md-inline-block btn btn-accent mr-3">Book Now</a>
          <a href="{{ route('front.trips.customize', ['slug' => $trip->slug]) }}" class="print mr-3"><i class="fas fa-tools"></i> Customize this trip</a>
          <a href="{{ route('front.trips.print', ['slug' => $trip->slug]) }}" class="print mr-3"> <i class="fas fa-print"></i> Print tour details</a>
          @if($trip->pdfLink)
          <a href="{{ $trip->pdfLink }}" download target="_blank" class="print my-2"> <i class="fas fa-map"></i> Download brochure</a>
          @endif
        </p>
        <div class="share-links mb-5">
          <h3>Share this tour</h3>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-pinterest"></i></a>
          <a href="#"><i class="fab fa-blogger-b"></i></a>
          <a href="#"><i class="fab fa-google-plus-g"></i></a>
        </div>
      </div>
      <div class="col-md-4">
        <aside>
          <div class="card price-card mb-4">
            <div class="ribbon">
              <div class="text">
                Best Price
              </div>
            </div>
            <div class="card-header">
              <h3>Price starting from</h3>
            </div>
            <p class="price">
              <s>$2,400</s>
              <span class="currency">USD</span>
              <span class="figure">2,000</span>
            </p>
            <p class="mb-3">
              <small>per person</small>
            </p>
            <p class="mb-3">
              <a href="booking-form.php" class="btn btn-block btn-accent">Book Now</a>
              <a href="#" class="btn btn-block btn-accent">Enquire Now</a>
            </p>
            <hr>
            <div class="text">
              <h4>
                You can customize this trip
              </h4>
              <ul>
                <li>Have a big group?</li>
                <li>Budget problem?</li>
                <li>Date & Itinerary problem?</li>
                <li>Wanna add / lessen services?</li>
              </ul>
              All right, we'll help you personalize your trips
            </div>
          </div>
          <a href="{{ route('front.trips.customize', ['slug' => $trip->slug]) }}" class="btn btn-customize btn-accent2 btn-block mb-3"><i class="fas fa-tools"></i>
            Customize this
            trip</a>

          {{-- special discount --}}
          <!-- <div class="card group-discounts-card mb-3">
            <small>
              Get special discounts while travelling as group! For a booking of more than 10 people, the team leader
              will get their trip free of cost.
            </small>
            <table class="table">
              <thead>
                <th class="text-left">No. of travellers</th>
                <th class="text-right">Price / person</th>
              </thead>
              <tbody>
                <tr>
                  <td class="text-left">1</td>
                  <td class=" text-right">USD 2,400</td>
                </tr>
                <tr>
                  <td class="text-left">2</td>
                  <td class=" text-right">USD 2,380</td>
                </tr>
                <tr>
                  <td class="text-left">3-5</td>
                  <td class=" text-right">USD 2,300</td>
                </tr>
                <tr>
                  <td class="text-left">5-10</td>
                  <td class=" text-right">USD 2,200</td>
                </tr>
                <tr>
                  <td class="text-left">10+</td>
                  <td class=" text-right">USD 2,000</td>
                </tr>
              </tbody>
            </table>
          </div> -->
          {{-- end of special discount --}}

          <!-- <a href="#" class="btn btn-book-now mb-4">Book Now</a> -->

          <!-- <button data-toggle="modal" data-target="#agency-modal"
            class="btn btn-customize btn-accent2 btn-block mb-3"><i class="fas fa-stream"></i>Ask for Agency
            Price</button> -->

          {{-- map --}}
          @if($trip->map_file_name)
          <div class="card mb-3">
            <div class="card-header">
              <h3>Map & Route</h3>
            </div>
            <div class="card-body p-0">
              <a data-fancybox href="{{ $trip->mapImageUrl }}">
                <img class="img-fluid" src="{{ $trip->mapImageUrl }}" alt="">
              </a>
            </div>
          </div>
          @endif
          {{-- end of map --}}

          <button data-toggle="modal" data-target="#agency-modal"
            class="btn btn-customize btn-accent2 btn-block mb-3"><i class="fas fa-file-download"></i>Download
            Brochure</button>

          <div class="quick-enquiry-card card mb-3">
            <div class="card-header">
              <h3>Quick Enquiry</h3>
            </div>
            <div class="card-body">
              <form action="">
                <div class="form-group">
                  <!-- <label for="">Name <sup>*</sup></label> -->
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <!-- <label for="">E-mail <sup>*</sup></label> -->
                  <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                  <!-- <label for="">Country <sup>*</sup></label> -->
                  <select name="" id="" class="form-control">
                    <option disabled selected>Country</option>
                  </select>
                </div>

                <div class="form-group">
                  <!-- <label for="">Phone Number <sup>*</sup></label> -->
                  <input type="tel" class="form-control" placeholder="Phone No.">
                </div>
                <div class="form-group">
                  <!-- <label for="">Message <sup>*</sup></label> -->
                  <textarea rows="5" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-accent">Send</button>
                </div>
              </form>
            </div>
          </div>

          <div class="experts-card card">
            <p class="mb-0">Still confused?</p>
            <h3 class="mb-4">Talk to our experts</h3>
            <p class="experts-phone"><a href="#"><i class="fas fa-phone"></i> +977 -9849683653</a></p>
            <p class="experts-phone"><a href="mailto:"><i class="fas fa-envelope"></i> info@vertexholiday.com</a></p>
          </div>

          <div class="social-links mb-3">
            <p class=" mb-0 text-center experts">
              <a href="#"><i class="fab fa-facebook"></i></a>
              <!-- <a href="#"><i class="fab fa-instagram"></i></a> -->
              <a href="#"><i class="fab fa-whatsapp"></i></a>
              <a href="#"><i class="fab fa-viber"></i></a>
              <a href="#"><i class="fab fa-skype"></i></a>
              <a href="#"><i class="fab fa-weixin"></i></a>
              <a href="#"><i class="fab fa-facebook-messenger"></i></a>
            </p>
          </div>

          <div class="mb-3 essential-info">
            <h3>Essential Trip Information</h3>
            <ul class="essential-links">
              <li>
                <a href="lifetime-deposit" target="_blank">
                  Lifetime Deposit </a>
              </li>
              <li>
                <a href="privacy-policy" target="_blank">
                  Privacy Policy </a>
              </li>
              <li>
                <a href="trek-packing-list" target="_blank">
                  Trek Packing List </a>
              </li>
              <li>
                <a href="responsible-tourism" target="_blank">
                  Responsible Tourism </a>
              </li>
              <li>
                <a href="travel-insurance" target="_blank">
                  Travel Insurance </a>
              </li>
              <li>
                <a href="nepal-international-flight" target="_blank">
                  Nepal International Flight </a>
              </li>
              <li>
                <a href="terms-and-conditions" target="_blank">
                  Terms &amp; Conditions </a>
              </li>
            </ul>
          </div>

          {{-- addon trips --}}
          @if(iterator_count($trip->addon_trips))
            @foreach($trip->addon_trips as $trip)
            <div class="package-card-sm">
              <div class="img"
                style="background-image: linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.3)),url('{{ $trip->mediumImageUrl }}')">
              </div>
              <div class="info">
                <h1 class="title">{{ $trip->name }}</h1>
                <div class="info-bottom">
                  <div class="days">{{ $trip->days }}</div>
                  @if($trip->cost)
                    <div class="price"><small>from</small> <br><b>USD {{ number_format($trip->cost) }}</b></div>
                  @endif
                </div>
              </div>
              <a href="{{ $trip->link }}" class="stretched-link"></a>
            </div>
            @endforeach
          @endif
          {{-- end of addon trips --}}

          @if(iterator_count($blogs))
          <div class="latest-blog card mb-3">
            <div class="card-body p-0">
              <div class="latest-blog-card">
                <b>Latest news/blog</b>
              </div>
              @foreach($blogs as $blog)
              <div class="latest-blog-card">
                <h1 class="title">{{ $blog->name }}</h1>
                <a href="{{ $blog->link }}" class="stretched-link"></a>
              </div>
              @endforeach
            </div>
          </div>
          @endif

          <div class="ta-widget">
            <img src="{{ asset('assets/front/img/ta-widget.jpg') }}" alt="" class="img-fluid">
          </div>
        </aside>
      </div>

    </div>
  </div>
  @if(iterator_count($trip->similar_trips))
  <div class="container">
    <h2>Similar Trips</h2>
    <div class="row">
      @foreach($trip->similar_trips as $trip)
      <div class="col-12 col-md-6 col-lg-3">
        <div class="package-card">
          <div class="img-wrapper">
            <img src="{{ $trip->mediumImageUrl }}" class="img-fluid" alt="">
            <div class="offer">
              {{ $trip->best_value }}
              {{-- 10<span>% off</span> --}}
            </div>
            <p class="difficulty">
              Trekking
            </p>
            <p class="stars">
              <i class="fas fa-star">
              </i>
              <i class="fas fa-star">
              </i>
              <i class="fas fa-star">
              </i>
              <i class="fas fa-star">
              </i>
              <i class="fas fa-star-half">
              </i>
            </p>
          </div>
          <div class="info">
            <a class="title" href="{{ route('front.trips.show', ['slug' => $trip->slug]) }}">
              {{ $trip->name }}
            </a>
            <div class="row">
              <div class="col-4 align-self-end">
                <p class="duration">
                  <i class="far fa-calendar-alt"></i>
                  {{ $trip->duration }} days
                </p>
              </div>
              <div class="col-8">
                <p class="price">
                  <s>
                    USD {{ number_format($trip->cost) }}
                  </s>
                  <span class="currency">
                    USD
                  </span>
                  <span class="amount">
                    {{ number_format($trip->offer_price) }}
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</section>

<!-- Write a review modal -->
<div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="reviewModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-primary mb-0" id="exampleModalLabel">Write a review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="text-primary font-weight-bold">Everest Three Passes Trek</h5>
        <form action="">
          <div class="form-group">
            <label for="photo-input">Photo</label>
            <input type="file" class="form-control-file" id="photo-input">
            <img src="img/person-placeholder.jpg" alt="" id="write-review-photo">
          </div>
          <!-- <div class="form-row">
            <div class="col-md-6"> -->
          <div class="form-group icon">
            <input type="text" class="form-control" placeholder="Name">
            <i class="fas fa-user"></i>
          </div>
          <!-- </div>
            <div class="col-md-6"> -->
          <div class="form-group icon">
            <!-- <label for="">Country</label> -->
            <input type="text" class="form-control" placeholder="Country" list="countries">
            <i class="fas fa-flag"></i>

          </div>
          <!-- </div>
            <div class="col-md-6"> -->
          <div class="form-group icon">
            <textarea type="text" rows="5" class="form-control" placeholder="Review"></textarea>
            <i class="fas fa-comment"></i>
          </div>
          <!-- <label for="">Review</label> -->
          <!-- </div> -->
          <!-- </div> -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Submit review</button>
      </div>
    </div>
  </div>
</div>

<!-- Ask for Agency Price modal -->
<div class="modal fade" id="agency-modal" tabindex="-1" role="dialog" aria-labelledby="agencyModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-primary mb-0">Ask for Agency Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="text-primary font-weight-bold">Everest Three Passes Trek</h5>
        <form action="">
          <div class="form-group icon">
            <i class="fas fa-user"></i>
            <input type="text" class="form-control" placeholder="Name">
          </div>
          <div class="form-group icon">
            <i class="fas fa-building"></i>
            <input type="text" class="form-control" placeholder="Company Name">
          </div>
          <div class="form-group icon">
            <i class="fas fa-link"></i>
            <input type="url" class="form-control" placeholder="Company Url">
          </div>
          <div class="form-group icon">
            <i class="fas fa-phone"></i>
            <input type="tel" class="form-control" placeholder="Phone No.">
          </div>
          <div class="form-group icon">
            <input type="text" class="form-control" placeholder="Country" list="countries">
            <i class="fas fa-flag"></i>
          </div>
          <div class="form-group icon">
            <textarea type="text" rows="5" class="form-control" placeholder="Message"></textarea>
            <i class="fas fa-comment-alt"></i>
          </div>
          <!-- <label for="">Review</label> -->
          <!-- </div> -->
          <!-- </div> -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Submit request</button>
      </div>
    </div>
  </div>
</div>

<datalist id="countries">
  <option value="Afghanistan">
  <option value="Albania">
  <option value="Algeria">
  <option value="American Samoa">
  <option value="Andorra">
  <option value="Angola">
  <option value="Anguilla">
  <option value="Antarctica">
  <option value="Antigua and Barbuda">
  <option value="Argentina">
  <option value="Armenia">
  <option value="Aruba">
  <option value="Australia">
  <option value="Austria">
  <option value="Azerbaijan">
  <option value="Bahamas">
  <option value="Bahrain">
  <option value="Bangladesh">
  <option value="Barbados">
  <option value="Belarus">
  <option value="Belgium">
  <option value="Belize">
  <option value="Benin">
  <option value="Bermuda">
  <option value="Bhutan">
  <option value="Bolivia">
  <option value="Bosnia and Herzegovina">
  <option value="Botswana">
  <option value="Bouvet Island">
  <option value="Brazil">
  <option value="British Indian Ocean Territory">
  <option value="Brunei Darussalam">
  <option value="Bulgaria">
  <option value="Burkina Faso">
  <option value="Burundi">
  <option value="Cambodia">
  <option value="Cameroon">
  <option value="Canada">
  <option value="Cape Verde">
  <option value="Cayman Islands">
  <option value="Central African Republic">
  <option value="Chad">
  <option value="Chile">
  <option value="China">
  <option value="Christmas Island">
  <option value="Cocos (Keeling) Islands">
  <option value="Colombia">
  <option value="Comoros">
  <option value="Congo">
  <option value="Congo, The Democratic Republic of The">
  <option value="Cook Islands">
  <option value="Costa Rica">
  <option value="Cote D'ivoire">
  <option value="Croatia">
  <option value="Cuba">
  <option value="Cyprus">
  <option value="Czech Republic">
  <option value="Denmark">
  <option value="Djibouti">
  <option value="Dominica">
  <option value="Dominican Republic">
  <option value="Ecuador">
  <option value="Egypt">
  <option value="El Salvador">
  <option value="Equatorial Guinea">
  <option value="Eritrea">
  <option value="Estonia">
  <option value="Ethiopia">
  <option value="Falkland Islands (Malvinas)">
  <option value="Faroe Islands">
  <option value="Fiji">
  <option value="Finland">
  <option value="France">
  <option value="French Guiana">
  <option value="French Polynesia">
  <option value="French Southern Territories">
  <option value="Gabon">
  <option value="Gambia">
  <option value="Georgia">
  <option value="Germany">
  <option value="Ghana">
  <option value="Gibraltar">
  <option value="Greece">
  <option value="Greenland">
  <option value="Grenada">
  <option value="Guadeloupe">
  <option value="Guam">
  <option value="Guatemala">
  <option value="Guinea">
  <option value="Guinea-bissau">
  <option value="Guyana">
  <option value="Haiti">
  <option value="Heard Island and Mcdonald Islands">
  <option value="Holy See (Vatican City State)">
  <option value="Honduras">
  <option value="Hong Kong">
  <option value="Hungary">
  <option value="Iceland">
  <option value="India">
  <option value="Indonesia">
  <option value="Iran, Islamic Republic of">
  <option value="Iraq">
  <option value="Ireland">
  <option value="Israel">
  <option value="Italy">
  <option value="Jamaica">
  <option value="Japan">
  <option value="Jordan">
  <option value="Kazakhstan">
  <option value="Kenya">
  <option value="Kiribati">
  <option value="Korea, Democratic People's Republic of">
  <option value="Korea, Republic of">
  <option value="Kuwait">
  <option value="Kyrgyzstan">
  <option value="Lao People's Democratic Republic">
  <option value="Latvia">
  <option value="Lebanon">
  <option value="Lesotho">
  <option value="Liberia">
  <option value="Libyan Arab Jamahiriya">
  <option value="Liechtenstein">
  <option value="Lithuania">
  <option value="Luxembourg">
  <option value="Macao">
  <option value="Macedonia, The Former Yugoslav Republic of">
  <option value="Madagascar">
  <option value="Malawi">
  <option value="Malaysia">
  <option value="Maldives">
  <option value="Mali">
  <option value="Malta">
  <option value="Marshall Islands">
  <option value="Martinique">
  <option value="Mauritania">
  <option value="Mauritius">
  <option value="Mayotte">
  <option value="Mexico">
  <option value="Micronesia, Federated States of">
  <option value="Moldova, Republic of">
  <option value="Monaco">
  <option value="Mongolia">
  <option value="Montserrat">
  <option value="Morocco">
  <option value="Mozambique">
  <option value="Myanmar">
  <option value="Namibia">
  <option value="Nauru">
  <option value="Nepal">
  <option value="Netherlands">
  <option value="Netherlands Antilles">
  <option value="New Caledonia">
  <option value="New Zealand">
  <option value="Nicaragua">
  <option value="Niger">
  <option value="Nigeria">
  <option value="Niue">
  <option value="Norfolk Island">
  <option value="Northern Mariana Islands">
  <option value="Norway">
  <option value="Oman">
  <option value="Pakistan">
  <option value="Palau">
  <option value="Palestinian Territory, Occupied">
  <option value="Panama">
  <option value="Papua New Guinea">
  <option value="Paraguay">
  <option value="Peru">
  <option value="Philippines">
  <option value="Pitcairn">
  <option value="Poland">
  <option value="Portugal">
  <option value="Puerto Rico">
  <option value="Qatar">
  <option value="Reunion">
  <option value="Romania">
  <option value="Russian Federation">
  <option value="Rwanda">
  <option value="Saint Helena">
  <option value="Saint Kitts and Nevis">
  <option value="Saint Lucia">
  <option value="Saint Pierre and Miquelon">
  <option value="Saint Vincent and The Grenadines">
  <option value="Samoa">
  <option value="San Marino">
  <option value="Sao Tome and Principe">
  <option value="Saudi Arabia">
  <option value="Senegal">
  <option value="Serbia and Montenegro">
  <option value="Seychelles">
  <option value="Sierra Leone">
  <option value="Singapore">
  <option value="Slovakia">
  <option value="Slovenia">
  <option value="Solomon Islands">
  <option value="Somalia">
  <option value="South Africa">
  <option value="South Georgia and The South Sandwich Islands">
  <option value="Spain">
  <option value="Sri Lanka">
  <option value="Sudan">
  <option value="Suriname">
  <option value="Svalbard and Jan Mayen">
  <option value="Swaziland">
  <option value="Sweden">
  <option value="Switzerland">
  <option value="Syrian Arab Republic">
  <option value="Taiwan, Province of China">
  <option value="Tajikistan">
  <option value="Tanzania, United Republic of">
  <option value="Thailand">
  <option value="Timor-leste">
  <option value="Togo">
  <option value="Tokelau">
  <option value="Tonga">
  <option value="Trinidad and Tobago">
  <option value="Tunisia">
  <option value="Turkey">
  <option value="Turkmenistan">
  <option value="Turks and Caicos Islands">
  <option value="Tuvalu">
  <option value="Uganda">
  <option value="Ukraine">
  <option value="United Arab Emirates">
  <option value="United Kingdom">
  <option value="United States">
  <option value="United States Minor Outlying Islands">
  <option value="Uruguay">
  <option value="Uzbekistan">
  <option value="Vanuatu">
  <option value="Venezuela">
  <option value="Viet Nam">
  <option value="Virgin Islands, British">
  <option value="Virgin Islands, U.S">
  <option value="Wallis and Futuna">
  <option value="Western Sahara">
  <option value="Yemen">
  <option value="Zambia">
  <option value="Zimbabwe">
</datalist>
<script>
  window.onload = function() {
    // Hero Slider
    $(".tour-details-hero .owl-carousel").owlCarousel({
      items: 1,
      dots: false,
      autoplay: true,
      autoplayTimeout: 5000,
      loop: true,
      animateOut: 'fadeOut'
    });


    //Tour Details Page
    //Overview text expand and collapse
    const toggleOverviewBtn = $('#toggle-overview')
    $('#overview-text').on('hidden.bs.collapse', () => {
      toggleOverviewBtn.text('Show more')
    })
    $('#overview-text').on('shown.bs.collapse', () => {
      toggleOverviewBtn.text('Show less')
    })

    // Itineray expand and collapse
    $('.expand-all').on('click', () => {
      $('.day-details').collapse('show')
    })
    $('.collapse-all').on('click', () => {
      $('.day-details').collapse('hide')
    })

    //Departure Dates expand and collapse

    const rows = document.querySelectorAll('#date-price table tbody tr')
    const toggleDatesBtn = document.querySelector('#more-dates')
    let rowDisplay = false
    const hideRows = () => {
      rows.forEach((row, index) => {
        if (index > 4) row.classList.add('nodisplay')
        rowDisplay = false
      })
      toggleDatesBtn.textContent = 'Show more dates'
    }
    const showRows = () => {
      rows.forEach((row, index) => {
        if (index > 4) row.classList.remove('nodisplay')
      })
      toggleDatesBtn.textContent = 'Show less dates'
      rowDisplay = true
    }
    hideRows()
    toggleDatesBtn.addEventListener('click', () => {
      if (!rowDisplay) showRows()
      else hideRows()
    })

    //Departure Dates expand and collapse

    const reviews = document.querySelectorAll('.review-card')
    const toggleReviewsBtn = document.querySelector('#more-reviews')
    let reviewsDisplay = false
    const hideReviews = () => {
      reviews.forEach((review, index) => {
        if (index > 1) review.classList.add('nodisplay')
        reviewsDisplay = false
      })
      toggleReviewsBtn.textContent = 'See more reviews'
    }
    const showReviews = () => {
      reviews.forEach((review, index) => {
        if (index > 1) review.classList.remove('nodisplay')
      })
      toggleReviewsBtn.textContent = 'See less reviews'
      reviewsDisplay = true
    }
    hideReviews()
    toggleReviewsBtn.addEventListener('click', () => {
      if (!reviewsDisplay) showReviews()
      else hideReviews()
    })


    // $("#review-modal").modal('show');

    //Display user image upon select
    const showImage = (src, target) => {
      src.style.display = "none";
      target.addEventListener('click', () => {
        src.click();
      })
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
    const stars = document.querySelectorAll('.select-ratings i')
    const ratingsInput = document.querySelector('#ratings-input')
    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        ratingsInput.value = index + 1
        console.log(ratingsInput.value)
        stars.forEach((star, indexx) => {
          star.classList.remove('active')
          if (indexx <= index) star.classList.add('active')
        })
      })
    })
  }
</script>
@endsection
