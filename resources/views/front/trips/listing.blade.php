<?php 
  if (!isset($keyword)) {
    $keyword = "";
  }
?>
@extends('layouts.front')
@section('content')
<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  </div>
  <div class="hero-bottom">
    <div class="container">
      <h1>Trips</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Trips</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="controls mb-5">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="">Destinations</label>
            <select name="" id="select-destination" class="custom-select">
              <option value="" selected>All Destinations</option>
              @if($destinations)
                @foreach($destinations as $destination)
                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="">Activities</label>
            <select name="" id="select-activity" class="custom-select">
              <option value="" selected>All activities</option>
              @if($activities)
                @foreach($activities as $activity)
                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="">Sort by</label>
            <select name="sort_by" id="select-sort" class="custom-select">
              <option value="price_l_h">Price (low to high)</option>
              <option value="price_h_l">Price (high to low)</option>
              {{-- <option value="3">Ratings (low to high)</option> --}}
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Search Results -->
    <div class="container">

      @if(isset($keyword) && !empty($keyword))
      <p id="search-p">Search results for "<strong>{{ strtoupper($keyword) }}</strong>"</p>
      @endif

      <div class="row" id="tirps-block">
        {{-- trip blcok goes here --}}
      </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
  var keyword = '{{ $keyword }}';
  filter();
  $(".custom-select").on('change', function(event) {
    filter();
  });

  function filter() {
    var destination_id = $("#select-destination").val();
    var activity_id = $("#select-activity").val();
    var sortBy = $("#select-sort").val();
    var url = "{{ url('trips/filter') }}" + "?keyword=" + keyword + "&destination_id=" + destination_id + "&activity_id=" + activity_id + "&sortBy=" + sortBy;
    $.ajax({
      url: url,
      type: "GET",
      dataType: "json",
      //data: data,
      async: "false",
      beforeSend: function(xhr) {
        var spinner = '<button style="margin:0 auto;" class="btn btn-sm btn-primary text-white" type="button" disabled>\
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\
                      Loading Trips...\
                    </button>';
        $("#tirps-block").html(spinner);
      },
      success: function(res) {
        if (res.success) {
          $("#search-p").hide();
          if (keyword == "") {
            window.history.pushState({}, document.title, "/" + "trips");
          }
          $("#tirps-block").html(res.data);
          keyword = "";
        }
      }
    }).done(function( data ) {
      // console.log('done');
    });
  }
</script>
@endpush