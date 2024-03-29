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
<style>
    .close-modal {
        font-weight: normal;
        position: absolute;
        right: 6px;
        top: 4px;
        display: block;
        cursor: pointer;
        color: #5a5a5a;
        opacity: 1;
        z-index: 999;
    }
    .close-modal:focus {
        outline: none;
    }

    .insta-detail-btn {
        cursor: pointer;
    }

    #instagramModal .modal-body {
        min-height: 200px;
    }

    #instagramModal .modal-body .insta-embed>iframe {
        border: none !important;
    }
</style>
@endpush
@section('content')
<!-- Hero -->
<section class="hero">
  <div id="banner-carousel" class="owl-carousel">
    @if(iterator_count($banners))
      @foreach($banners as $banner)
      <div class="slide" style="background-image: url('{{ $banner->thumbImageUrl }}')" data-image-src="{{ $banner->imageUrl }}">
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
        <i class="fas fa-search"></i> FIND YOUR HOLIDAY
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
@if (iterator_count($instagram_galleries))
<section class="ig-gallery container">
    @foreach ($instagram_galleries as $gallery)
    <div class="photo" data-insta-id="{{ $gallery->id }}">
      <img src="{{ $gallery->image }}" alt=""> <i class="fab fa-instagram insta-detail-btn"></i>
    </div>
    @endforeach
</section>
@endif

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
{{-- END OF LATEST NEWS --}}

{{-- INSTAGRAM DETAIL MODAL --}}
<div id="instagramModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
        <div class="modal-body">
            <div class="insta-embed" style="display: none;"></div>
        </div>
    </div>
  </div>
</div>
{{-- END OF INSTAGRAM DETAIL MODAL --}}

@endsection
@push('scripts')
<script async src="//www.instagram.com/embed.js"></script>
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
    const insta_gallery = {!! $instagram_galleries !!};
    $('#instagramModal').on('hidden.bs.modal', function (e) {
        $(this).find('.insta-embed').html('').hide();
    });

    window.__igEmbedLoaded = function( loadedItem ) {
        $('#instagramModal').find('.insta-embed').show();
    };

    $(".insta-detail-btn").on('click', function(event) {
        let modal = $("#instagramModal");
        let insta_id = $(this).closest('.photo').data('insta-id');

        let insta = insta_gallery.filter(obj => {
            return obj.id == insta_id
        })[0]
        modal.find('.insta-embed').html(insta.embed);
        instgrm.Embeds.process()
        modal.modal('show');
    });

    $("#banner-carousel>.slide").each(function(i, v) {
        let img = new Image();
        let image_src = $(v).data('image-src');
        img.onload = function() {
            $(v).css('background-image', 'url('+ image_src + ')');
        }
        img.src = image_src;
        if (img.complete) img.onload();
    });

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
