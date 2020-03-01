@extends('layouts.front')
@section('content')
<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  <div class="hero-bottom">
    <div class="container">
      <h1>Blog</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Blog</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-5">
    <div class="row">
      @if($blogs)
        @foreach($blogs as $blog)
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="news-card shadow">
            <div class="img-wrapper">
              <img src="{{ $blog->imageUrl }}" class="img-fluid" alt="">
            </div>
            <div class="info">
              <p class="date">
                <span>{{ $blog->formattedDate }}</span>
              </p>
              <a class="title" href="{{ $blog->link }}">
                {{ $blog->name }}
              </a>
              <p><?= truncate($blog->description) ?></p>
            </div>
          </div>
        </div>
        @endforeach
      @else
        <p>No blogs to show.</p>
      @endif
    </div>
  </div>

</section>
@endsection