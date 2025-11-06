@extends('layouts.main')

@section('title', 'Contact opnemen met het E-STALLS team')

@section('content')
<style>
  .error-text {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 5px;
  }

  .w-form-fail.show,
  .w-form-done.show {
    display: block !important;
  }

  .w-form-done,
  .w-form-fail {
    display: none;
  }
  ul {
    margin-bottom: 0;
  }
  ul li {
    list-style: none;
  }
 
</style>
  <div class="normal-section wf-section">
    <div class="container w-container">
      <h2>Retouraanvraagformulier</h2>
      <p>Met het bijgaande formulier vraag je een retour aan bij de stallhouder/veilingaanbieder waarvan je het item hebt gekocht. Deze neemt contact met je op over hoe je het item kunt terugsturen.<br></p>
      <p>Vul zoveel mogelijk gegevens in, zodat de stallhouder/veilingaanbieder je retour snel kan afhandelen. Het invullen van de reden van de retour is echter niet verplicht.<br></p>
      <p>Het ordernummer en de gegevens van het te retourneren item en de staalhouder/veilingaanbieder waarvan je het item hebt gekocht vind je in de orderbevestiging die we je per e-mail hebben gestuurd. Ben je ingelogd op je E-Stalls account, dan vind je de gegevens van je order ook terug in je dashboard.<br></p>
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
        <form method="post" action="{{ route('return.request') }}">
          @csrf
          <div class="contact-form-grid">
              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692fb-127e0eec">
                  <label for="first_name">Voornaam*</label>
                  <input type="text" class="w-input" maxlength="256" name="first_name" data-name="First Name" placeholder="" id="first_name" required="" />
              </div>
              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692ff-127e0eec">
                  <label for="last_name">Achternaam*</label>
                  <input type="text" class="w-input" maxlength="256" name="last_name" data-name="Last Name" placeholder="" id="last_name" required="" />
              </div>
              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                  <label for="Email" id="contact-email">E-Mail*</label>
                  <input type="email" class="w-input" maxlength="256" name="email" data-name="Email" placeholder="" id="contact-email" required="" />
              </div>

              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                  <label for="contact-phone">Tel. Nummer*</label>
                  <input type="tel" class="w-input" name="contact_phone_number" id="contact-phone" required>
              </div>

              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                  <label for="order-number">Ordernummer*</label>
                  <select class="w-input" name="order_number" id="order-number">
                    <option value="">Selecteer bestelling</option>
                    @foreach ($orders as $order)
                      <option value="{{ $order->id }}"> #{{ sprintf('%06d', $order->id) }}</option>
                    @endforeach
                  </select>
                  {{-- <input type="text" class="w-input" name="order_number" id="order-number" required> --}}
              </div>

              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                  <label for="item_description">Omschrijving item*</label>
                  <input type="text" class="w-input" name="item_description" id="item_description" required>
              </div>

              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                  <label for="return_item">Aantal retour*</label>
                  <input type="number" class="w-input" name="return_item" id="return-item" min="1" required>
              </div>

              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                  <label for="return_reason">Reden van retour</label>
                  <input type="text" class="w-input" name="return_reason" id="return-reason">
              </div>

              <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec">
                  <label for="message">Opmerkingen*</label>
                  <textarea name="message" id="message" class="textarea w-input" required></textarea>
              </div>

          </div>
          <input type="submit" value="Formulier versturen" data-wait="Bezig..." class="button w-button" />
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
