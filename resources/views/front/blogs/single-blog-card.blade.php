<div class="news-card">
  <div class="img-wrapper">
    <a href="blog-article.php">
      <img src="{{ $blog->mediumImageUrl }}" class="img-fluid" alt="">
    </a>
  </div>
  <div class="info">

    <a class="title" href="{{ route('front.blogs.show', ['slug' => $blog->slug]) }}">
      {{ $blog->name }}
    </a>
    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, sapiente consequatur amet aut vero
      illo voluptate recusandae repellat..</p> -->
    <p class="date">
      <span>{{ $blog->formattedDate }}</span>
    </p>
  </div>
</div>