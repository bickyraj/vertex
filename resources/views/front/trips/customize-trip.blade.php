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
@section('content')
<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ $trip->imageUrl }})"></div>
  <div class="hero-bottom">
    <div class="container">
      <h1>Customize {{ $trip->name }}</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <!-- <li class="breadcrumb-item"><a href="index.php">Nepal</a></li> -->
          <li class="breadcrumb-item"><a href="{{ $trip->link }}">{{ $trip->name }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Customize</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="row">
      <div class="col-lg-8">
        <div class="tour-details-section">
          <form id="captcha-form" action="{{ route('front.trips.customize.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $trip->id }}">
            <h3>Custom trip details</h3>
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Trip duration *</label>
                  <input type="number" class="form-control" min="1" name="duration" placeholder="Trip duration" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">No. of travellers *</label>
                  <input type="number" class="form-control" min="1" name="no_of_travellers" placeholder="No. of travellers" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Departure date*</label>
                  <input type="date" name="departure_date" id="" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Price range*</label>
                  <select name="price_range" id="" class="form-control" required>
                    <option value="$5,000 - $8,000" selected>$5,000 - $8,000</option>
                    <option value="$3,000 - $5,000">$3,000 - $5,000</option>
                    <option value="$2,000 - $3,000">$2,000 - $3,000</option>
                    <option value="$1,000 - $2,000">$1,000 - $2,000</option>
                    <option value="$800 - $1,000">$800 - $1,000</option>
                    <option value="$500 - $800">$500 - $800</option>
                    <option value="$300 - $500">$300 - $500</option>
                    <option value="Less than $300">Less than $300</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Difficulty</label>
                  <select name="difficulty" id="" class="form-control">
                    <option value="Easy" selected>Easy</option>
                    <option value="Moderate">Moderate</option>
                    <option value="Difficult">Difficult</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Message</label>
                  <textarea name="message" id="" class="form-control" cols="30" rows="3" placeholder="Message"></textarea>
                </div>
              </div>
            </div>
            <br>
            <hr>
            <h3>Personal details</h3>
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Name *</label>
                  <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Country *</label>
                  @include('front.elements.country-select')
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Address *</label>
                  <textarea name="address" id="" cols="30" rows="3" class="form-control" placeholder="Address"
                    required></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Email *</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Contact no. *</label>
                  <input type="tel" name="contact_no" class="form-control" placeholder="Contact no." required>
                </div>
              </div>
            </div>
            @include('front.elements.recaptcha')
            <button class="btn btn-accent">Submit</button>
          </form>
        </div>

      </div>
      <div class="col-lg-4">
        <aside>
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
@endsection
@push('scripts')
<script type="text/javascript">
  $(function() {
    var session_success_message = '{{ $session_success_message ?? '' }}';
    var session_error_message = '{{ $session_error_message ?? '' }}';
    if (session_success_message) {
      toastr.success(session_success_message);
    }

    if (session_error_message) {
      toastr.danger(session_error_message);
    }
  });
</script>
@endpush