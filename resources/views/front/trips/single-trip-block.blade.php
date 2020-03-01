<div class="package-card">
  <div class="img-wrapper">
    <img src="{{ $trip->mediumImageUrl }}" class="img-fluid" alt="">
    <div class="offer">
      {{ $trip->best_value }}
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
      <i class="fas fa-star">
      </i>
      <!-- <i class="fas fa-star-half">
      </i> -->
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
    <!-- <p class="difficulty"><i class="fas fa-hiking"></i><b>EASY</b></p> -->
    <a class="title" href="{{ route('front.trips.show', ['slug' => $trip->slug]) }}">{{ $trip->name }}</a>
    <div class="row mb-2">
      <div class="col-6">
        <p class="duration">
          <i class="far fa-calendar-alt"></i>
          {{ $trip->duration }} days
        </p>
      </div>
      <div class="col-6">
        <p class="duration text-right">
          <i class="fas fa-tachometer-alt"></i>
          {{ $trip->difficulty_grade_value }}
        </p>
      </div>
    </div>
    <!-- <hr> -->
    <div class="row">
      <div class="col-6 align-self-end">
        <a href="{{ route('front.trips.booking', ['slug' => $trip->slug]) }}" class="btn btn-accent">View Details</a>
      </div>
      <div class="col-6">
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
  <!-- <div class="actions">
    <a href="tour-details.php" class="book-now">Book Now <i class="fas fa-chevron-circle-right"></i></a>
    <a href="#" class="learn-more">Learn more</a>
  </div> -->
</div>