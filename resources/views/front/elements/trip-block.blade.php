@forelse ($trips as $trip)
<div class="col-12 col-sm-6 col-lg-4">
  <div class="package-card shadow">
    <div class="img-wrapper">
      <img src="{{ $trip->mediumImageUrl }}" class="img-fluid" alt="">
      <div class="offer">
        {{ $trip->best_value }}
      </div>
      <p class="difficulty">
        {!! $trip->trip_activity_type !!}
      </p>
      <!-- <div class="overlay">
        <button class="btn btn-primary">
          Book Now
        </button>
        <span>or</span>
        <a href="">Learn more</a>
      </div> -->
    </div>
    <div class="info">
      <p class="difficulty">Grade: <b><b>{{ $trip->difficulty_grade_value }}</b></b></p>
      <a class="title" href="{{ route('front.trips.show', ['slug' => $trip->slug]) }}">{{ $trip->name }}</a>
      <div class="row">
        <div class="col-6">
          <p class="stars">
            <i class="fas fa-star active">
            </i>
            <i class="fas fa-star active">
            </i>
            <i class="fas fa-star active">
            </i>
            <i class="fas fa-star active">
            </i>
            <i class="fas fa-star active">
            </i>
          </p>
          <p class="duration">
            <i class="far fa-calendar-alt"></i>
            {{ $trip->duration }} days
          </p>
        </div>
        @if($trip->cost)
        <div class="col-6">
          <div class="old">
            <s>
              USD {{ number_format($trip->cost) }}
            </s>
          </div>
          <p class="price">
            <span class="currency">
              USD 
            </span>
            <span class="amount">
              {{ number_format($trip->offer_price) }}
            </span>
          </p>
        </div>
        @endif
      </div>
    </div>
    <div class="actions">
      <a href="{{ route('front.trips.booking', ['slug' => $trip->slug]) }}" class="book-now">Book Now <i class="fas fa-chevron-circle-right"></i></a>
      <!-- <a href="#" class="learn-more">Learn more</a> -->
    </div>
  </div>
</div>
@empty
    <p>No Trips</p>
@endforelse