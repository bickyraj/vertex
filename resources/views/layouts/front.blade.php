<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="theme-color" content="#0b2852">
  <title>Vertex Holiday</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- meta tags --}}
  <meta name="description" content="@yield('meta_description')" />
  <meta name="keywords" content="@yield('meta_keywords')" />
  <meta property="og:title" content="@yield('meta_og_title')" />
  <meta property="og:url" content="@yield('meta_og_url')" />
  <meta property="og:site_name" content="@yield('meta_og_site_name', Setting::get('site_name')??'Vertex Holiday Pvt.Ltd')" />
  <meta property="og:image" content="@yield('meta_og_image')" />
  <meta property="og:description" content="@yield('meta_og_description')" />
  {{-- end of meta tags --}}

  <meta name="IndexType" content="{{ Setting::get('site_name') }}"/>
  <meta name="language" content="EN-US"/>
  <meta name="type" content="Trekking"/>
  <meta name="classification" content="Trekking, Tour operator in Nepal"/>
  <meta name="company" content="{{ Setting::get('site_name') }}"/>
  <meta name="author" content="{{ Setting::get('site_name') }}"/>
  <meta name="contact person" content="{{ Setting::get('site_name') }}"/>
  <meta name="copyright" content=""/>
  <meta name="security" content="public"/>
  <meta content="all" name="robots"/>
  <meta name="document-type" content="Public"/>
  <meta name="category" content="Trekking in Nepal"/>
  <meta name="robots" content="all,index"/>
  <meta name="googlebot" content="INDEX, FOLLOW" />
  <meta name="YahooSeeker" content="INDEX, FOLLOW" />
  <meta name="msnbot" content="INDEX, FOLLOW" />
  <meta name="allow-search" content="Yes" />
  <meta name="doc-rights" content="{{ Setting::get('site_name') }}" />
  <meta name="doc-publisher" content="www.vertexholiday.com" />
  <meta name="p:domain_verify" content=""/>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/all.min.css') }}">
  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> -->
  <!-- Bootstrap-->
  <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
  <!-- jQuery SmartMenus -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartmenus/1.1.0/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.min.css"
    integrity="sha256-IbVTniyadRTitKPpYX/0NvZ1dyrr0e1sD4+MR9q4CWM=" crossorigin="anonymous" />
  <!-- Owl Carousel -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/css/owl.theme.default.min.css') }}">
  <!-- Fancybox -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/jquery.fancybox.min.css') }}">
  <!-- Custom -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/css/front-style.css') }}">
  @stack('styles')
</head>

<body data-spy="scroll" data-target="#secondnav" data-offset="160">
  <!-- scrollspy for tour-details page -->

  @include('front.elements.header')

  {{-- start of content --}}
  @yield('content')
  {{-- end of content --}}

  @include('front.elements.footer')

<!-- Scripts -->
<!-- jQuery-->
<script src="{{ asset('assets/front/js/jQuery-3.3.1.min.js') }}"></script>
<!-- Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- Bootstrap -->
<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
<!-- Fancybox -->
<script src="{{ asset('assets/front/js/jquery.fancybox.min.js') }}"></script>
<!-- App.js -->
<script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartmenus/1.1.0/jquery.smartmenus.min.js"></script>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartmenus/1.1.0/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.min.js"
  integrity="sha256-86IE6BxjIc6DQWhu21kSaAYt4+62VrnCr+JkpdajhAY=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/front/js/app.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.5/gsap.min.js"></script> -->
@stack('scripts')
<script>
$(document).ready(function() {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function(jqXHR, textStatus, errorThrown) {
          var status = jqXHR.status;
          if (status == 404) {
              toastr.warning("Element not found.");
          } else if (status == 422) {
              toastr.info(jqXHR.responseJSON.message);
          }
      }
  });

  // Hero Slider
  $('.hero .owl-carousel').owlCarousel({
    items: 1,
    dots: true,
    // nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    loop: true,
  });
  $('.hero .owl-carousel').on('changed.owl.carousel', event => {
    let item = event.item.index
    $('.hero .owl-carousel .main').removeClass('fadeInDown')
    $('.hero .owl-carousel .owl-item').eq(item).find('.main').addClass('fadeInDown');
  });

  // Recently Added Tours Slider
  $(".new-tours .owl-carousel").owlCarousel({
    margin: 30,
    dots: false,
    autoplay: true,
    autoplayTimeout: 8000,
    loop: true,
    nav: true,
    navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      },
      992: {
        items: 3
      }
    }
  });

  // Testimonials Slider
  // $(".testimonials .owl-carousel").owlCarousel({
  //   items: 1,
  //   dots: false,
  //   nav: true,
  //   navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
  //   loop: true
  // });
});
</script>
</body>
</html>
