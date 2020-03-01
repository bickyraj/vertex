<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Namaste Nepal Trekking & Research Hub Pvt. Ltd.</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- meta tags --}}
  <meta name="description" content="@yield('meta_description')" />
  <meta name="keywords" content="@yield('meta_keywords')" />
  <meta property="og:title" content="@yield('meta_og_title')" />
  <meta property="og:url" content="@yield('meta_og_url')" />
  <meta property="og:site_name" content="@yield('meta_og_site_name', Setting::get('site_name')??'Namaste Nepal Trekking & Research Hub Pvt.Ltd')" />
  <meta property="og:image" content="@yield('meta_og_image')" />
  <meta property="og:description" content="@yield('meta_og_description')" />
  {{-- end of meta tags --}}

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/all.min.css') }}">
  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> -->
  <!-- Bootstrap-->
  <link rel="shortcut icon" href="{{ asset('assets/front/img/favicon.ico') }}" />
  <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
  <!-- Owl Carousel -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/css/owl.theme.default.min.css') }}">
  <!-- Fancybox -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/jquery.fancybox.min.css') }}">
  <!-- Custom -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/css/front-style.css') }}">
  <link href="{{ asset('assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
  @stack('styles')
</head>

<body data-spy="scroll" data-target="#secondnav" data-offset="100">
  <!-- scrollspy for tour-details page -->

  <!-- Header -- Topbar & Navbar-->
  @include('front.elements.header')
  {{-- end of header --}}

  {{-- start of content --}}
  @yield('content')
  {{-- end of content --}}

  <!-- Footer -->
  @include('front.elements.footer')
  {{-- end of footer --}}

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
<script src="{{ asset('assets/front/js/app.js') }}"></script>
<script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/toastr-option.js') }}" type="text/javascript"></script>
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
  $(".hero .owl-carousel").owlCarousel({
    items: 1,
    dots: false,
    nav: true,
    autoplay: true,
    autoplayTimeout: 8000,
    loop: true,
    animateOut: 'fadeOut'
  });


  // Recently Added Tours Slider
  $(".new-tours .owl-carousel").owlCarousel({
    margin: 30,
    dots: false,
    autoplay: true,
    autoplayTimeout: 8000,
    loop: true,
    nav: true,
    navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
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
