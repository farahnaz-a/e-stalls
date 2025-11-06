
  @extends('layouts.main')

  @section('title', 'Je E-STALLS ticket afrekenen')

  @section('content')
  <div class="normal-section gradient wf-section">
    <div class="container w-container">
      <div class="w-layout-grid checkout-gr">
        <div class="checkout-form">
          <h2>Bestel je ticket</h2>
          <form method="POST" action="{{url('/')}}/ticket-betalen" class='ticket-purchase'>
            @csrf
            <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="first_name" required placeholder="Voornaam" value="{{$user->first_name}}">
              <input type="text" class="text-field dobule w-input" maxlength="256" name="last_name" required placeholder="Achternaam" value="{{$user->last_name}}"></div>
            <div class="double"><input type="email" class="text-field w-input" maxlength="256" name="email" required placeholder="E-Mail" value="{{$user->email}}">
              <input type="number" class="text-field dobule w-input" maxlength="256" name="phone" required placeholder="Telefoonnummer" ></div>
            <div class="double"><input type="text" style="text-transform: uppercase" class="text-field w-input" maxlength="256" required name="street" placeholder="Straat + nummer" value="{{$user->street}}" id="Straatnummer">
              <input type="text" style="text-transform: uppercase" class="text-field dobule w-input" maxlength="256" name="zip" required placeholder="Postcode" value="{{$user->zip}}" id="Postcode"></div>
            <div class="double"><input style="text-transform: uppercase" type="text" class="text-field w-input" maxlength="256" required name="town" data-name="Name 3" placeholder="Plaats" value="{{$user->town}}" id="town">
              <input type="text" class="text-field dobule w-input" maxlength="256" name="country" required placeholder="Land" value="{{$user->country}}"></div>
              <input type="hidden" name="eventId" value="{{$event->id}}">
              <input type="submit" value="Afrekenen" data-wait="Bezig..." class="button w-button">
               <div class="alert alert-danger" style="margin-top: 10px;">
                <ul>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    @endif
                    <li id="addressValidationError" style="color: red; display: none">De combinatie van postcode en huisnummer komt ons niet bekend voor</li>
                </ul>
            </div>
          </form>
        </div>
        <div id="w-node-_63d068e1-c345-9561-249c-5c5dd51663c8-69414778" class="checkout-items">
          <h2>Dit is het event:</h2>
          <ul role="list" class="list w-list-unstyled">
            <li class="list-item w-clearfix">
              <div class="product-info">
                <div><strong class="black">{{$event->name}}</strong></div>
                <div> <p style="margin-bottom: 0px !important;"> {{$event->description}} </p></div>
                <div class="product-information">{{ Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }} om {{$event->start_time}} tot {{$event->end_time}}</div>
              </div>
            </li>
          </ul>
          <div class="checkout-numbers w-clearfix">
            <div class="price-type">Prijs</div>
            <div class="price-type price">€{{number_format($event->price/1.21, 2)}}</div>
          </div>
          <div class="checkout-numbers w-clearfix">
              <div class="price-type">BTW</div>
              <div class="price-type price">€{{ number_format($event->price - ($event->price / 1.21), 2) }}</div>
          </div>
          <div class="checkout-numbers w-clearfix">
            <div class="price-type total">Totaal</div>
            <div class="price-type price total">€{{number_format($event->price, 2)}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="review-section wf-section">
    <div class="w-container">
      <h2 class="small">Wat deelnemers van onze events vinden</h2>
      <div data-delay="4000" data-animation="slide" class="reviews-slider w-slider" data-autoplay="false" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
        <div class="mask-2 w-slider-mask">
          <div class="w-slide">
            <div class="review"><img src="{{url('/')}}/images/undraw_male_avatar_323b.png" loading="lazy" alt="">
              <div class="review-name">Max v C.</div>
              <p>&quot;E-STALLS is een erg uniek concept, zeker de moeite waard om een ticket te kopen!&quot;</p>
            </div>
          </div>
          <div class="w-slide">
            <div class="review"><img src="images/undraw_male_avatar_323b.png" loading="lazy" alt="">
              <div class="review-name">Isa L.</div>
              <p>&quot;Via E-STALLS ben ik veel te weten gekomen over belangrijke brands én heb ik een aantal leuke producten gekocht.&quot;</p>
            </div>
          </div>
        </div>
        <div class="left-arrow w-slider-arrow-left">
          <div class="w-icon-slider-left"></div>
        </div>
        <div class="right-arrow w-slider-arrow-right">
          <div class="w-icon-slider-right"></div>
        </div>
        <div class="hidden w-slider-nav w-round"></div>
      </div>
    </div>
  </div>

 @push('js')
 <script>
    $(document).ready(function(){
        let verified = false;
        $('.ticket-purchase').on('submit', function(e){
            if(!verified){
                e.preventDefault();
                let postcode = $('#Postcode').val();
                let street_number = $('#Straatnummer').val();
                let town = $('#town').val();

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                 $.ajax({
                    type  : "POST",
                    url   : "{{ route('address.verification') }}",
                    data  : {
                        postcode,
                        street_number,
                        town
                    },
                    success: response => {
                        if(response){
                            $('#addressValidationError').slideUp();
                            verified = true;
                            $(this).submit();
                        }else{
                            $('#addressValidationError').slideDown();
                        }
                    },
                    error: errors => {
                    // console.log(error);
                },
            });
            }
        })
    })
  </script>
 @endpush
  @endsection
