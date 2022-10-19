@extends('layouts.front')
@section('meta_og_title'){!! $seo->meta_title??'' !!}@stop
@section('meta_description'){!! $seo->meta_description??'' !!}@stop
@section('meta_keywords'){!! $seo->meta_keywords??'' !!}@stop
@section('meta_og_url'){!! $seo->canonical_url??'' !!}@stop
@section('meta_og_description'){!! $seo->meta_description??'' !!}@stop
@section('meta_og_image'){!! $seo->socialImageUrl??'' !!}@stop
@section('content')
<!-- Hero -->
<section class="hero-second">
    <div class="slide" style="background-image: url('{{ $blog->imageUrl }}')">
    </div>
    <div class="hero-bottom">
        <div class="container">
            <h1>{{ $blog->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.blogs.index') }}">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lorem ipsum...</li>
                </ol>
            </nav>
        </div>
</section>
<section class="tour-details">
    <div class="container mt-2">
        <div class="tour-details-section">
            <?= $blog->description; ?>
        </div>
    </div>
</section>
<!-- Latest News -->
<section class="news">
    <div class="container">
        <h2>Blog / News</h2>
        <div class="row">
        	@if($blogs)
    			@foreach($blogs as $blog)
    			<div class="col-md-4">
    			    <div class="news-card shadow">
    			        <div class="img-wrapper">
    			            <img src="{{ $blog->mediumImageUrl }}" class="img-fluid" alt="">
    			        </div>
    			        <div class="info">
    			            <p class="date">
    			                <span>{{ $blog->formattedDate }}</span>
    			            </p>
    			            <a class="title" href="blog-article.php">
    			            	{{ $blog->name }}
    			            </a>
    			            <?= truncate($blog->description); ?>
    			        </div>
    			    </div>
    			</div>
    			@endforeach
        	@endif
        </div>
        <p class="text-center"><a href="{{ route('front.blogs.index') }}">See all</a></p>
    </div>
</section>
<section class="news">
    <div class="container">
        <h2>Table of Content</h2>
        <div class="row">
            @if(!empty($contents))
                @include('bickyraj.toc.table', $contents)
            @endif
        </div>
    </div>
</section>
@endsection
