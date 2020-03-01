@extends('layouts.front')
@section('content')

<!-- Hero -->
<section class="hero-second">
  <div class="slide" style="background-image: url({{ config('constants.default_hero_banner') }})">
  <div class="hero-bottom">
    <div class="container">
      <h1>Legal Documents</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Legal Documents</li>
        </ol>
      </nav>
    </div>
</section>

<section class="tour-details">
  <div class="container mt-2">
    <div class="tour-details-section">
      <div class="row">
        @forelse($documents as $document)
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
          <div class="thumb" style="background: center / cover url('{{ $document->fileUrl }}')">
            <a href="{{ $document->fileUrl }}" class="stretched-link" data-fancybox="gallery" data-caption="{{ $document->name }}">
            </a>
          </div>
        </div>
        @empty
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
          <p>No Documents to show.</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>
</section>

@endsection
@push('scripts')
<script>
$(function() {
  $('[data-fancybox="gallery"]').fancybox({
    buttons: ['close']
  });
});
</script>
@endpush
