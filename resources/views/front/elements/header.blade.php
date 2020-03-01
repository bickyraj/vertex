<!-- Header -- Topbar & Navbar-->
<div class="topbar d-flex justify-content-between align-items-center">
  <div class="topbar-contact">
    <a href="mailto:{{ Setting::get('email') }}">
      <i class="fas fa-envelope"></i>
      <span>{{ Setting::get('email') }}</span>
    </a>
    <a href="tel:+97714455667">
      <i class="fas fa-phone"></i>
      <span>{{ Setting::get('mobile1') . "/" . Setting::get('mobile2') }}</span>
    </a>
  </div>

  <div class="topbar-search">
    <form action="{{ route('front.trips.search') }}" method="GET">
      <input id="header-search" class="form-control" name="keyword" value="{{ request()->get('keyword') }}" type="text" placeholder="Search...">
      <button type="submit" class="btn btn-accent"><i class="fas fa-search"></i></button>
    </form>
  </div>

  <div class="topbar-social d-none d-lg-block">
    <a href="#">
      <i class="fab fa-facebook"></i>
    </a>
    <a href="#">
      <i class="fab fa-twitter"></i>
    </a>
    <a href="#">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="#">
      <i class="fab fa-linkedin"></i>
    </a>
    <a href="#">
      <i class="fab fa-youtube"></i>
    </a>
  </div>
</div>

<header class="middle-row">
  <div class="logos">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/front/img/logo.png') }}" alt="Vertex Holiday">
    </a>

    <div class="visit-nepal">
      <img src="{{ asset('assets/front/img/logo-visitnepal.png') }}" alt="Visit Nepal 2020">
    </div>
    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars"
      aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
      <i class="fas fa-bars"></i>
    </button>
  </div>
  {{-- navbar --}}
  @include('front.elements.navbar')
  {{-- end of navbar --}}
</header>