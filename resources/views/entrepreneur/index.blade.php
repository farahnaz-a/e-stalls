@extends('layouts.main')

@section('title', 'Contact opnemen met het E-STALLS team')

@section('content')
  <div class="normal-section wf-section">
    <div class="container w-container">
      <h2>Beste ondernemer,</h2>
      <p>Bedankt voor je belangstelling en we zijn enthousiast om met je samen te werken! Om ervoor te zorgen dat je deelname aan een evenement optimaal wordt voorbereid, zouden we graag willen weten welke opties jouw interesse hebben gewekt.</p>
      <div>
        <form method="POST" action="{{ route('ondernemer.store') }}">
            @csrf
          <label>Laat ons alsjeblieft weten welke van de volgende opties jou aanspreken, zodat wij de benodigde informatie naar je kunnen mailen.</label>
          <br>
          <div>
              <label>
                  <input type="checkbox" name="offer[]" id="offer_options1" value="Logo plaatsing">
                  Logo plaatsing
              </label>
              <label>
                  <input type="checkbox" name="offer[]" id="offer_options2" value="Moviehall">
                  Moviehall
              </label>
              <label>
                  <input type="checkbox" name="offer[]" id="offer_options3" value="Stallhall">
                  Stallhall
              </label>
              <label>
                  <input type="checkbox" name="offer[]" id="offer_options4" value="Auctionhall">
                  Auctionhall
              </label>
              <label>
                  <input type="checkbox" name="offer[]" id="offer_options5" value="Goodiebag deelname">
                  Goodiebag deelname
              </label>
          </div>
          <div class="contact-form-grid">
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692fb-127e0eec">
                <label for="First-Name" id="contact-first-name">Voornaam</label>
                <input type="text" class="w-input" maxlength="256" name="first_name" data-name="First Name" placeholder="" id="First-Name" required="">
            </div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692ff-127e0eec">
                <label for="Last-Name" id="contact-last-name">Achternaam</label>
                <input type="text" class="w-input" maxlength="256" name="last_name" data-name="Last Name" placeholder="" id="Last-Name" required="">
            </div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                <label for="Email" id="contact-email">E-Mail*</label>
                <input type="email" class="w-input" maxlength="256" name="email" data-name="Email" placeholder="" id="Email" required="">
            </div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369307-127e0eec">
                <label for="Contact-Phone-Number" id="contact-phone">Tel. Nummer</label>
                <input type="tel" class="w-input" maxlength="256" name="phone" data-name="Contact Phone Number" placeholder="" id="Contact-Phone-Number">
            </div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d736930b-127e0eec">
                <label for="Message" id="contact-message">Bericht*</label>
                <textarea data-name="Message" maxlength="5000" id="Message" name="message" placeholder="" class="textarea w-input"></textarea>
            </div>
          </div>
          <input type="submit" value="Verzenden" data-wait="Bezig..." class="button w-button">
        </form>

        <div class="w-form-success" style="margin-top: 20px; display: {{ session('success') ? '':'none' }}">
          <div>Dank je wel! De gevraagde informatie komt zo snel mogelijk jouw kant op.</div>
        </div>
        <div class="w-form-fail">
          <div>Oops! Something went wrong while submitting the form.</div>
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
