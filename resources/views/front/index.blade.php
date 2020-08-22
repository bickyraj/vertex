@extends('layouts.front')
@section('meta_og_title'){!! Setting::get('homePageSeo')['og_title']??'' !!}@stop
@section('meta_description'){!! Setting::get('homePageSeo')['meta_description']??'' !!}@stop
@section('meta_keywords'){!! Setting::get('homePageSeo')['meta_keywords']??'' !!}@stop
@section('meta_og_url'){!! Setting::get('homePageSeo')['meta_url']??'' !!}@stop
@section('meta_og_site_name'){!! Setting::get('homePageSeo')['og_site_name']??'' !!}@stop
@section('meta_og_description'){!! Setting::get('homePageSeo')['og_description']??'' !!}@stop
@section('meta_og_image'){!! Setting::getSiteSettingImage(Setting::get('homePageSeo')['og_image']??'') !!}@stop
@push('styles')
<link href="{{ asset('assets/vendors/bootstrap-rating-master/bootstrap-rating.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- Hero -->
<section class="hero">
  <div class="owl-carousel">

    @if(iterator_count($banners))
      @foreach($banners as $banner)
      <div class="slide" style="background-image: url('{{ $banner->imageUrl }}')">
        <div class="container">
          <div class="text">
            <p class="main">
              {{ $banner->caption }}
            </p>
            @if ($banner->btn_name)
            <a href="{{ $banner->btn_link }}" class="btn btn-primary">{{ $banner->btn_name }}</a>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    @endif
  </div>

  <div class="hero-bottom">
    <div class="search-form">
      <div class="main-heading" role="tab" id="headingOne">
        <i class="fas fa-search"></i> FIND YOUR HOLIDAY here
        <a href="#search-accordion-wrapper" data-toggle="collapse" aria-expanded="true" class="stretched-link"></a>
      </div>
      <div id="search-accordion-wrapper" class="collapse show">
        <div id="search-accordion" class="accordion">

          @if($destinations)
          <div class="card">
            <div class="card-header" id="headingOne">
              <h1>Destination</h1>
              <a role="button" data-toggle="collapse" href="#banner-destination" class="stretched-link"
                aria-expanded="true">
              </a>
            </div>
            <div id="banner-destination" class="collapse" data-parent="#search-accordion" aria-labelledby="headingOne">
              <div class="card-body">
                <ul>
                  @foreach($destinations as $destination)
                  <li data-destid='{{ $destination->id }}' class='dest-select'>{{ $destination->name }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          @endif
          @if($activities)
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h1>Activities</h1>
              <a role="button" data-toggle="collapse" href="#banner-activity" class="stretched-link"
                aria-expanded="false">
              </a>
            </div>
            <div id="banner-activity" class="collapse" data-parent="#search-accordion" aria-labelledby="headingTwo">
              <div class="card-body">
                <ul>
                  @foreach($activities as $activity)
                  <li data-actid='{{ $activity->id }}' class='act-select'>{{ $activity->name }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          @endif
          <div class="card">
            <div class="card-header" id="headingThree">
              <h1>Price Range</h1>
              <a role="button" data-toggle="collapse" href="#banner-price" class="stretched-link" aria-expanded="false">
              </a>
            </div>
            <div id="banner-price" class="collapse" data-parent="#search-accordion" aria-labelledby="headingThree">
              <div class="card-body">
                <ul>
                  <li data-price="100.500" class="price-select">$100 - $500</li>
                  <li data-price="500.1000" class="price-select">$500 - $1000</li>
                  <li data-price="1000.1500" class="price-select">$1000 - $1500</li>
                  <li data-price="2000" class="price-select">$2000 and above</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour">
              <h1>Duration</h1>
              <a role="button" data-toggle="collapse" href="#banner-duration" class="stretched-link"
                aria-expanded="false">
              </a>
            </div>
            <div id="banner-duration" class="collapse" data-parent="#search-accordion" aria-labelledby="headingFour">
              <div class="card-body">
                <ul>
                  <li data-duration="1.5" class="duration-select">1 - 5 Day(s)</li>
                  <li data-duration="5.10" class="duration-select">5 - 10 Day(s)</li>
                  <li data-duration="10.20" class="duration-select">10 - 20 Day(s)</li>
                  <li data-duration="20.40" class="duration-select">20 - 40 Day(s)</li>
                  <li data-duration="40" class="duration-select">40 days and above</li>
                </ul>
              </div>
            </div>
          </div>
          <div>
            <input type="hidden" id="filter-dest-ids" />
            <input type="hidden" id="filter-act-ids" />
            <input type="hidden" id="filter-prices" />
            <input type="hidden" id="filter-durations" />
            <button class="banner-filter-btn btn btn-block">Find Trips <i
                class="fa fa-chevron-circle-right fa-fw"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Popular Trips -->
<section class="top-tours">
  <div class="container">

    <h1 class="section-title">
      {{ Setting::get('homePage')['trip_block_1']['title'] ?? '' }}
    </h1>
    <p class="section-subtitle">
      Our most-booked and enjoyed tour packages
    </p>

    <div class="row">
      @if(iterator_count($block_1_trips))
        @foreach($block_1_trips as $trip)
        <div class="col-12 col-sm-6 col-lg-4">
          @include('front.trips.single-trip-block')
        </div>
        @endforeach
      @endif
    </div>
</section>

<section class="welcome-reviews">
  <div class="welcome">
    <h1 class="section-title">
      {{ Setting::get('homePage')['welcome']['title'] ?? '' }} <br> <small>{{ Setting::get('homePage')['welcome']['sub_title'] ?? '' }}</small>
    </h1>
    <p><?= Setting::get('homePage')['welcome']['content'] ?? ''; ?></p>
    {{-- <p><a href="#">Read more</a></p> --}}
  </div>

  <div class="reviews">
    <h2>Our Travellers' Reviews</h2>

    <div class="reviews">
      @forelse($reviews as $review)
      <div class="review-card">
        <h3>{{ $review->name }}</h3>
        <p class="review-text">
          <?= truncate($review->review); ?>
        </p>
        <div class="bottom">
          <p class="name">{{ $review->review_name }}</p>
          <p class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </p>
        </div>
      </div>
      @empty
      <p>No review.</p>
      @endforelse
      <p><a href="{{ route('front.reviews.index') }}">Read more reviews</a></p>
    </div>
  </div>
</section>

<!-- New -->
<section class="new-tours">
  <div class="container">
    <h1 class="section-title">
      {{ Setting::get('homePage')['trip_block_2']['title'] }}
    </h1>
    <div class="section-subtitle">
      Freshly designed packages
    </div>
    <div class="owl-carousel">
      @if(iterator_count($block_2_trips))
        @foreach($block_2_trips as $trip)
        @include('front.trips.single-trip-block')
        @endforeach
      @endif
    </div>
  </div>
</section>

<!-- Video and Testimonials -->
<section class="clients-video">
  <div class="video" style="background-image: url({{ Setting::getHomePageImage(Setting::get('homePage')['video_image'] ?? '') }});">
    <i class="far fa-play-circle"></i>
    <a class="stretched-link" data-fancybox href="{{ Setting::get('homePage')['video']['link'] ?? '' }}"></a>
  </div>
  <div class="clients">
    <h2>Our Happy Customers</h2>
    <div class="container">
      <div class="row">
        @forelse($reviews as $review)
        <div class="col-sm-6">
          <div class="media">
            <img src="{{ $review->thumbImageUrl }}" class="mr-3" alt="{{ $review->image_name }}">
            <div class="media-body">
              <h5 class="mt-0">{{ $review->review_name }}</h5>
              <p class="country">{{ $review->review_country }}</p>
              <p class="stars">
                @for ($i=1; $i <= $review->rating; $i++)
                  <i class="fas fa-star"></i>
                @endfor
              </p>
            </div>
          </div>
        </div>
        @empty
        @endforelse
      </div>
    </div>
    <p class="text-center">
      <a href="{{ route('front.reviews.index') }}" class="btn btn-outline-light">Read Client Reviews</a>
    </p>
  </div>
</section>

<!-- Instagram Gallery -->
<section class="ig-gallery container">
  <div class="photo">
    <img
      src="https://scontent-atl3-1.cdninstagram.com/vp/d403095589ce72575dcb8cf29ab23b6e/5E536FA8/t51.2885-15/sh0.08/e35/s640x640/72669377_128389094839211_6751964122798869818_n.jpg?_nc_ht=scontent-atl3-1.cdninstagram.com&_nc_cat=111"
      alt="">
    <i class="fab fa-instagram"></i>
  </div>
  <div class="photo">
    <img
      src="https://scontent-atl3-1.cdninstagram.com/vp/c877a7c66b1d3e0f7b1f9333428665bf/5E44CBE5/t51.2885-15/sh0.08/e35/p640x640/76936880_555033178650158_5928925441178817331_n.jpg?_nc_ht=scontent-atl3-1.cdninstagram.com&_nc_cat=102"
      alt="">
    <i class="fab fa-instagram"></i>
  </div>
  <div class="photo">
    <img
      src="https://scontent-atl3-1.cdninstagram.com/vp/040423822d8688ce4417ebe0fae13992/5E590262/t51.2885-15/sh0.08/e35/s640x640/75595221_183526632824264_5668652172425696987_n.jpg?_nc_ht=scontent-atl3-1.cdninstagram.com&_nc_cat=108"
      alt="">
    <i class="fab fa-instagram"></i>
  </div>
  <div class="photo">
    <img
      src="https://instagram.fktm7-1.fna.fbcdn.net/v/t51.2885-15/e15/p640x640/79245086_260432848264586_2681944129594750745_n.jpg?_nc_ht=instagram.fktm7-1.fna.fbcdn.net&_nc_cat=102&_nc_ohc=JQaHNtOoP1EAX9htHnd&oh=0e1e89a8246af82d033c61863ec0dee5&oe=5ED5C8F5"
      alt="">
    <i class="fab fa-instagram"></i>
  </div>
  <div class="photo">
    <img
      src="https://instagram.fktm7-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/p640x640/77403860_478456416129773_1864207258660736952_n.jpg?_nc_ht=instagram.fktm7-1.fna.fbcdn.net&_nc_cat=105&_nc_ohc=HEXP6h-QFccAX-iJ2HU&oh=262ef784f8b15f576a026d559d7fb70f&oe=5EA7872F"
      alt="">
    <i class="fab fa-instagram"></i>
  </div>
  <div class="photo">
    <img
      src="https://instagram.fktm7-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/p640x640/72396310_122309295876347_3454222550197836393_n.jpg?_nc_ht=instagram.fktm7-1.fna.fbcdn.net&_nc_cat=111&_nc_ohc=0sS4ZczIs60AX-QM1J6&oh=2e509f526e87cdd05e92353e8a13586c&oe=5EBB8A8D"
      alt="">
    <i class="fab fa-instagram"></i>
  </div>
</section>

<!-- Latest News -->
@if(iterator_count($blogs))
<section class="news">
  <div class="container">
    <h2>{{ Setting::get('homePage')['blog']['title'] ?? '' }}</h2>

    <div class="row">
      @foreach($blogs as $blog)
      <div class="col-md-4">
        @include('front.blogs.single-blog-card')
      </div>
      @endforeach
    </div>
    <p class="text-center"><a href="{{ route('front.blogs.index') }}">See all</a></p>
  </div>
</section>
@endif
@endsection
@push('scripts')
<script src="{{ asset('assets/vendors/bootstrap-rating-master/bootstrap-rating.min.js') }}"></script>
<script type="text/javascript">

  function set_input_values(element, data, clear_value) {
      var new_data = data;
      var current_data = $('#' + element).val();
      if (typeof clear_value == 'undefined' && current_data != '') {
          new_data = current_data + ',' + data
      }
      $('#' + element).val(new_data);
  }

  function remove_input_values(element, data) {
      var current_data = $('#' + element).val();
      var exploded_ids = current_data.split(',');
      exploded_ids.splice($.inArray(data.toString(), exploded_ids), 1);
      $('#' + element).val(exploded_ids);
  }

  $(function() {
    $(".trip-rating").rating();

    // banner search
    $('.dest-select').on('click', function () {
        var that = $(this);
        that.toggleClass('active');
        var dest_id = that.data('destid');
        (that.hasClass('active')) ? set_input_values('filter-dest-ids', dest_id) : remove_input_values('filter-dest-ids', dest_id);
    });
    $('.act-select').on('click', function () {
        var that = $(this);
        that.toggleClass('active');
        var act_id = that.data('actid');
        (that.hasClass('active')) ? set_input_values('filter-act-ids', act_id) : remove_input_values('filter-act-ids', act_id);
    });
    $('.price-select').on('click', function () {
        var that = $(this);
        $('.price-select').removeClass('active');
        that.toggleClass('active');
        var price = that.data('price');
        set_input_values('filter-prices', price, true);
    });
    $('.duration-select').on('click', function () {
        var that = $(this);
        $('.duration-select').removeClass('active');
        that.toggleClass('active');
        var duration = that.data('duration');
        set_input_values('filter-durations', duration, true);
    });

    $('.banner-filter-btn').on('click', function() {
        var destination = $('#filter-dest-ids').val();
        var activity = $('#filter-act-ids').val();
        var price = $('#filter-prices').val();
        var duration = $('#filter-durations').val();
        var url_query = 'dest='+destination+'&act='+activity+'&price='+price+'&duration='+duration;
        var filter_url = '{{ route('front.trips.search') }}' + '?' + url_query;
        window.location.href = filter_url;
    });

    // end of banner search
  });
</script>
@endpush
