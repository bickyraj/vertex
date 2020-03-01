@extends('layouts.front')
@section('content')
<section class="hero-second">
  <div class="slide" style="background-image: url({{ $page->imageUrl ?? '' }})">
  </div>
  <div class="hero-bottom">
    <div class="container">
      <h1>{{ $page->name ?? '' }}</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="row">
      <div class="col-lg-8">
        <div class="tour-details-section">
        	<div>
        		<?= $page->description ?? ''; ?>
        	</div>
        </div>
      </div>
      <div class="col-lg-4">
        <aside>
          <!-- enquiry block -->
          @include('front.elements.enquiry')
          <!-- end of enquiry block -->
        </aside>
      </div>
    </div>
</section>
@endsection