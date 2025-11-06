  @extends('layouts.main')

  @section('title', 'Inloggen in het E-STALLS systeem')

  @include('includes.passwork-toggler.index')

  @push('css')
  <style>
      .text-field{
          max-width: unset;
      }
  </style>
  @endpush

  @section('content')
  <div class="normal-section gradient wf-section">
    <div class="container center w-container">
      <div class="login-form">
        <form action="auth" method="post" class="form-2">
          @csrf
          <h1 class="dark">Inloggen</h1>
          <input required type="email" class="text-field w-input" maxlength="256" name="email" placeholder="E-Mail" id="name" >
        <div data-password="wrapper" style="display:block;">
            <input data-password="input" required type="password" class="text-field w-input" maxlength="256" name="password" placeholder="Wachtwoord" id="id_password">
            <button type="button" data-password="toggler">
                <i data-password="icon" class="far fa-eye"></i>
            </button>
        </div>
          <input type="submit" value="Inloggen" data-wait="Please wait..." class="button w-button"><a style="margin-left: 5px; color:grey;" href="forgot-password">Wachtwoord vergeten</a>
          <p style="margin-top: 40px;">Nog geen account? <a href="account-aanmaken">Maak dan een account aan.</a></p>
          @if ($errors->any())
            <div style="color: red">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
          @endif
          
          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
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
