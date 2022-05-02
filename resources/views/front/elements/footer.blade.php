<!-- Footer -->
<footer>
  <div class="container">
    <div class="row py-5 mb-2">
      <div class="col-12 col-md-5">

        <div class="newsletter">
          <h2>Subscribe to our newsletter</h2>
          <p>Sign up and we'll send the best deals to you !</p>
        </div>
      </div>
      <div class="col-12 col-md-5">
        <form id="email-subscribe-form">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-8">
                <input type="email" name="email" class="form-control" placeholder="Email address" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-accent">Subscribe</button>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-3">
        <h3>Travel Info</h3>
        <ul>
          @if($footer1)
          @foreach($footer1 as $menu)
            <li class="nav-item dropdown">
              <a href="{!! ($menu->link)?$menu->link:'javascript:;' !!}">{{ $menu->name }}</a>
            </li>
          @endforeach
          @endif
        </ul>
      </div>
      <div class="col-12 col-lg-3">
        <h3>Activities</h3>
        <ul>
          @if($footer2)
          @foreach($footer2 as $menu)
            <li class="nav-item dropdown">
              <a href="{!! ($menu->link)?$menu->link:'javascript:;' !!}">{{ $menu->name }}</a>
            </li>
          @endforeach
          @endif
        </ul>
      </div>
      <div class="col-12 col-lg-3">
        <h3>Quick Info</h3>
        <ul>
          @if($footer3)
          @foreach($footer3 as $menu)
            <li class="nav-item dropdown">
              <a href="{!! ($menu->link)?$menu->link:'javascript:;' !!}">{{ $menu->name }}</a>
            </li>
          @endforeach
          @endif
        </ul>
      </div>
      <div class="col-12 col-lg-3">
        <div class="first-col mb-4">
          <table>
            <tbody>
              <tr>
                <td><i class="fas fa-map-marker fa-fw icon"></i></td>
                <td>
                  {{ Setting::get('address') }}
                  <br>
                  <small>
                    {{ Setting::get('office_time') }}
                  </small>
                </td>
              </tr>
              <tr>
                <td><i class="fas fa-phone fa-fw icon"></i></td>
                <td><a href="tel:{{ Setting::get('telephone') }}">{{ Setting::get('telephone') }}</a></td>
              </tr>
              <tr>
                <td><i class="fas fa-mobile fa-fw icon"></i></td>
                <td><a href="tel:{{ Setting::get('mobile1') }}">{{ Setting::get('mobile1') }}</a></td>
              </tr>
              <tr>
                <td><i class="fas fa-envelope fa-fw icon"></i></td>
                <td><a href="mailto:{{ Setting::get('mobile1') }}">{{ Setting::get('email') }}</a></td>
              </tr>
            </tbody>
          </table>
          <h3>Get Connected</h3>
          <div class="social-contact">
            <a href="{{ Setting::get('instagram') }}">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="{{ Setting::get('facebook') }}">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="{{ Setting::get('twitter') }}">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="{{ Setting::get('pinterest') }}">
              <i class="fab fa-pinterest"></i>
               <a href="https://api.whatsapp.com/send?phone={{ Setting::get('mobile2') }}">
              <i class="fab fa-whatsapp"></i>
               <a href="https://msng.link/o/?{{ Setting::get('mobile2') }}=vi">
              <i class="fab fa-viber"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="affiliations-payment">
      <div>
        <P>We are affiliated with</P>
        <p class="affiliations">
          <a href="http://www.tourism.gov.np"><img src="{{ asset('img/sponsers/ng.jpg') }}" height="64" alt="Vertex Holiday"></a>
          <a href="https://welcomenepal.com"><img src="{{ asset('img/sponsers/ntb.jpg') }}" height="64" alt="Vertex Holiday"></a>
          <a href="https://www.taan.org.np/"><img src="{{ asset('img/sponsers/taan@2x.png') }}" height="64" alt="Vertex Holiday"></a>
          <a href="https://www.nepalmountaineering.org/"><img src="{{ asset('img/sponsers/nma@2x.png') }}" height="64" alt="Vertex Holiday"></a>
        </p>
      </div>
      <div>
        <p>Online Payment</p>
        <p>
            <div class="gap-10 grid lg:grid-cols-6">
                <a class="btn btn-accent" href="{{ route('front.payment') }}">Online Payment</a>
            </div>
        </p>
      </div>
      <div>
        <p>We accept</p>
        <p><img src="{{ asset('assets/front/img/svg/payment.svg') }}" alt="Vertex Holiday" height="28"></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-6">
        <p>
          <small>
            © <?= date('Y'); ?> Vertex Holiday Pvt. Ltd. All Right Reserved.
          </small>
        </p>
      </div>
      <div class="col-lg-6">
        <p class="text-right">
          <a href="https://www.thirdeyesystem.com">
            <small>
              Powered by Third Eye Systems Pvt. Ltd.
            </small>
          </a>
        </p>
      </div>
    </div>
  </div>
</footer>
@push('scripts')
<script type="text/javascript">
  $(function() {

    $('#email-subscribe-form').on('submit', function(event) {
      event.preventDefault();
      var form = $(this);
      var formData = form.serialize();

      $.ajax({
        url: "{{ route('front.email-subscribers.store') }}",
        type: "POST",
        data: formData,
        dataType: "json",
        async: "false",
        success: function(res) {
          if (res.status == 1) {
            toastr.success(res.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          var status = jqXHR.status;
          if (status == 404) {
              toastr.warning("Element not found.");
          } else if (status == 422) {
              toastr.info(jqXHR.responseJSON.errors.email[0]);
          }
        }
      });

    });
  });
</script>
@endpush
