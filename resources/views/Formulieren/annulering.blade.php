@extends('layouts.main')

@section('title', 'Contact opnemen met het E-STALLS team')

@section('content')
  <div class="normal-section wf-section">
    <div class="container w-container">
      <h2>Annuleringsformulier</h2>
      <p>Met het bijgaande formulier geef je aan dat je een order wil annuleren. Vul zoveel mogelijk gegevens in, zodat we de annulering snel kunnen afhandelen.<br></p>
      <p>Het ordernummer vind je in de orderbevestiging die we je per e-mail hebben gestuurd. Ben je ingelogd op je E-stalls account, dan vind je de gegevens van je order ook terug in je dashboard.<br></p>
      <div id="formInstructions" class="small-text"><em>Velden gemarkeerd met (*) zijn verplicht.</em></div>
      <div>
        <!-- Success/Error messages will appear here -->
        @if(session('success'))
          <div class="w-form-done show">
            <div>{{ session('success') }}</div>
          </div>
        @endif

        @if($errors->any())
          <div class="w-form-fail show">
            <div>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif
        <form method="post" action="{{ route('cancel.request') }}">
          @csrf
          <div class="contact-form-grid">

            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692fb-127e0eec">
              <label for="first_name">Voornaam*</label>
              <input type="text" class="w-input" maxlength="256" name="first_name" data-name="First Name" placeholder="" id="first_name" required="">
            </div>

            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692ff-127e0eec">
              <label for="last_name">Achternaam*</label>
              <input type="text" class="w-input" maxlength="256" name="last_name" data-name="Last Name" placeholder="" id="last_name" required="">
            </div>

            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
              <label for="email">E-Mail*</label>
              <input type="email" class="w-input" maxlength="256" name="email" data-name="Email" placeholder="" id="email" required="">
            </div>

            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369307-127e0eec">
              <label for="contact-phone">Tel. Nummer*</label>
              <input type="tel" class="w-input" maxlength="256" name="contact_phone_number" data-name="Contact Phone Number" placeholder="" id="contact-phone">
            </div>

            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369307-127e0eec" style="grid-area: span 1 / span 2 / span 1 / span 2;">
              <label for="order-number">Ordernummer (zie toelichting)*</label>
              <select class="w-input" name="order_number" id="order-number">
                <option value="">Selecteer bestelling</option>
                @foreach ($orders as $order)
                  <option value="{{ $order->id }}"> #{{ sprintf('%06d', $order->id) }}</option>
                @endforeach
              </select>
              {{-- <input type="tel" class="w-input" maxlength="256" name="Contact-Phone-Number" data-name="Contact Phone Number" placeholder="" id="Contact-Phone-Number"> --}}
            </div>

            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d736930b-127e0eec">
              <label for="Message" id="contact-message">Opmerking voor de stalhouder/veilingaanbieder*</label>
              <textarea data-name="Message" maxlength="5000" id="contact-message" name="message" placeholder="" class="textarea w-input"></textarea>
            </div>

          </div><input type="submit" value="Formulier versturen" data-wait="Bezig..." class="button w-button">
        </form>
        <div class="w-form-done">
          <div>Thank you! Your submission has been received!</div>
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
              <div class="review-name">Max v C.</div>
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
