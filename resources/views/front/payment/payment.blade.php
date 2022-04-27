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
@section('title', 'Payment')
@section('content')
<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  </div>
  <div class="hero-bottom">
    <div class="container">
      <h1>Payment</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Payment</li>
        </ol>
      </nav>
    </div>
</section>

<section class="py-10">
    <div class="container">
        <div class="grid lg:grid-cols-3 xl:grid-cols-4 gap-10">
            <div class="lg:col-span-2 xl:col-span-3">
                <div class="mb-8">
                    <form action="{{ route('front.store_payment') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="amount" class="text-sm">Amount to Pay:</label>
                            <input type="number" required name="amount" class="form-control" id="amount" placeholder="Amount in USD">
                        </div>
                        <div class="form-group mb-4">
                            <label for="price" class="text-sm">Total Amount to Pay (with bank's 4% service
                                charge)</label>
                            <input type="number" required name="price" class="form-control" id="price" placeholder="" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label for="trip" class="text-sm">Trip to Pay:</label>
                            <input type="text" required name="trip_name" value="{{ session('trip_name')??"" }}" class="form-control" id="trip" placeholder="Trip Name">
                        </div>
                        <div class="form-group mb-4">
                            <label for="fullname" class="text-sm">Full Name:</label>
                            <input name="fullname" required type="text" id="fullname" class="form-control" list="countries"
                                placeholder="Your full name for payment">
                        </div>
                        <div class="form-group mb-4">
                            <label for="email" class="text-sm">Email:</label>
                            <input type="email" name="email" class="form-control block" id="email"
                                placeholder="Your email address to receive payment confirmation and further details">
                        </div>
                        <div class="form-group mb-4">
                            <label for="phone" class="text-sm">Contact Number:</label>
                            <input type="tel" required name="contact_number" class="form-control block" id="phone"
                                placeholder="Your mobile or phone where we can contact">
                        </div>
                        <div class="form-check form-check-inline mb-4">
                          <input class="form-check-input" name="terms_conditions" required type="checkbox" id="inlineCheckbox1" value="option1">
                          <label class="form-check-label" for="inlineCheckbox1">
                              I accept <a class="green" href="" title="I accept all terms and conditions" target="_blank">Terms &amp; Conditions</a>
                          </label>
                        </div>
                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var session_success_message = '{{ $session_success_message ?? '' }}';
            var session_error_message = '{{ $session_error_message ?? '' }}';
            if (session_success_message) {
              toastr.success(session_success_message);
            }

            if (session_error_message) {
              toastr.danger(session_error_message);
            }

            $("#amount").on('input', function () {
                var amount = $('#amount').val();
                var charge = 0.04 * amount;
                var total = parseFloat(amount) + parseFloat(charge);
                document.getElementById('price').value = total;
            });
        });
    </script>
@endpush
