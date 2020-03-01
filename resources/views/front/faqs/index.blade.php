@extends('layouts.front')
<!-- Hero -->
@section('content')
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  </div>
  <div class="hero-bottom">
    <div class="container">
      <h1>Frequently Asked Questions</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">FAQs</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="row">
      <div class="col-lg-8">
        <div class="tour-details-section">

          <div class="accordion" id="faq-accordion">
            @forelse($faqs as $faq)
            <div class="card">
              <div class="card-header" id="faq_{{ $faq->id }}">
                <h1>{{ $faq->title }}</h1>
                <a role="button" data-toggle="collapse" href="#answer_{{ $faq->id }}" class="stretched-link" aria-expanded="true">
                </a>
              </div>
              <div id="answer_{{ $faq->id }}" class="collapse" data-parent="#faq-accordion" aria-labelledby="faq_{{ $faq->id }}">
                <div class="card-body">
                  <?= $faq->content; ?>
                </div>
              </div>
            </div>
            @empty
            <p>No FAQs</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection