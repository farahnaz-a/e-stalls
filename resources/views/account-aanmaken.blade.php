@extends('layouts.main')

@section('title', 'Account aanmaken')

@include('includes.passwork-toggler.index')

@push('css')
    <style>
        .double [data-password="wrapper-2"]{
            width: 105%;
            margin-left: 10px;
            margin-bottom: 20px;
        }

        [data-password="wrapper-2"]{
            position: relative;
        }

        [data-password="toggler-2"]{
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            background-color: transparent;
            border: 0;
        }
        @media (max-width:479px){

            .double [data-password="wrapper-2"] {
                margin-left: 0 !important;
                width: 100% !important;
            }
            [data-password="toggler-2"]{
                position: absolute;
                top: 50%;
                left: 62% !important;
                transform: translateY(-50%);
                background-color: transparent;
                border: 0;
            }
        }
        @media (max-width:460px){

            [data-password="toggler-2"]{
                position: absolute;
                top: 50%;
                left: 70% !important;
                transform: translateY(-50%);
                background-color: transparent;
                border: 0;
            }
        }
        @media (max-width:440px){

            [data-password="toggler-2"]{
                position: absolute;
                top: 50%;
                left: 80% !important;
                transform: translateY(-50%);
                background-color: transparent;
                border: 0;
            }
        }
        @media (max-width:419px){

            [data-password="toggler-2"]{
                position: absolute;
                top: 50%;
                left: 85% !important;
                transform: translateY(-50%);
                background-color: transparent;
                border: 0;
            }
        }
        @media (max-width:300px){

            [data-password="toggler-2"]{
                position: absolute;
                top: 50%;
                left: 80% !important;
                transform: translateY(-50%);
                background-color: transparent;
                border: 0;
            }
        }
    </style>
@endpush

@section('content')
  <div class="normal-section gradient wf-section">
    <div class="container center w-container">
      <div class="login-form w-form">
        <form action="authcreate" method="post" class="create-account">
          @csrf
          <h1 class="dark">Account aanmaken</h1>
            <div class="alert alert-danger">
                <ul>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    @endif
                    @if (Session::has('emailError'))
                        <li style="color: red">{{ Session::get('emailError') }}</li>
                    @endif
                    <li id="addressValidationError" style="color: red; display: none">De combinatie van postcode en huisnummer komt ons niet bekend voor</li>
                </ul>
            </div>
          {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red">{{ $error }}</li>
                    @endforeach
                    @if (Session::has('emailError'))
                        <li style="color: red">{{ Session::get('emailError') }}</li>
                    @endif
                </ul>
            </div>
            @else
                @if (Session::has('emailError'))
                <div class="alert alert-danger">
                    <ul>
                        <li style="color: red">{{ Session::get('emailError') }}</li>
                    </ul>
                </div>
                @endif
            @endif --}}
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="first_name" required placeholder="Voornaam" id="name" value="{{ old('first_name') }}">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="last_name" required placeholder="Achternaam" id="name-2" value="{{ old('last_name') }}"></div>
            <div class="double">
                <input type="email" class="text-field w-input" maxlength="256" name="email" required placeholder="E-Mail" id="name-3" value="{{ old('email') }}">
                <div data-password="wrapper">
                    <input data-password="input" type="password" class="text-field dobule w-input" maxlength="256" name="password" required placeholder="Wachtwoord" id="name-2">
                    <button type="button" data-password="toggler">
                        <i data-password="icon" class="far fa-eye"></i>
                    </button>
                </div>
            </div>
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="street" required placeholder="Straat + nummer" id="Straatnummer" value="{{ old('street') }}">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="zip" required placeholder="Postcode" id="Postcode" value="{{ old('zip') }}"></div>
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="town" required placeholder="Plaats" id="town" value="{{ old('town') }}">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="country" required placeholder="Land" id="name-2" value="{{ old('country') }}"></div>
            <label class="w-checkbox checkbox-field">
              <input type="checkbox" id="checkbox" required class="w-checkbox-input">
              <span class="w-form-label" for="checkbox">Ik ga akkoord met het <a href="{{ url('/') }}/documents/privacy_policy.pdf">Privacy beleid</a> &amp; de <a href="{{ url('/') }}/documents/algemene_voorwaarden.pdf">Algemene Voorwaarden</a></span></label><input type="submit" value="Registreren" data-wait="Please wait..." class="button w-button">
              <p style="margin-top: 40px;">Al een account? <a href="inloggen">Log dan in.</a></p>
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif
        </form>
      </div>
    </div>
  </div>
  <div class="review-section wf-section">
    <div class="w-container">
      <h2 class="small">Wat deelnemers van onze events vinden</h2>
      <div data-delay="4000" data-animation="slide" class="reviews-slider w-slider" data-autoplay="false" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
        <div class="mask-2 w-slider-mask">
          <div class="w-slide">
            <div class="review"><img src="images/undraw_male_avatar_323b.png" loading="lazy" alt="">
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
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            let verified = false;
            $('.create-account').on('submit', function(e){
                if(!verified){
                    e.preventDefault();

                    let postcode = $("#Postcode").val();
                    let street_number = $("#Straatnummer").val();
                    let town = $("#town").val();

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
            });
        });
    </script>
@endpush
