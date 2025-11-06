@extends('layouts.main')

@section('title', 'Contact opnemen met het E-STALLS team')

@section('content')
  <div class="normal-section wf-section">
    <div class="container w-container">
      <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
          <h2>Direct contact nodig?</h2>
          <p>Tijdens een event reageren wij het snelst via WhatsApp, neem contact op via onderstaande knop.</p>
          <a href="https://wa.me/624797059" class="button green w-button" style="background-color:green !important; margin-left: 0px !important; margin-top: 10px !important; margin-bottom: 20px !important;">WhatsApp</a>
        </div>
        <div><a href="{{url()->previous()}}" class="button green w-button">Main Hall</a></div>
      </div>
      <h2>Contactformulier</h2>
      <p>Mocht je vragen of opmerkingen hebben, neem dan contact op via onderstaand formulier.<br></p>
      <div id="formInstructions" class="small-text"><em>Velden gemarkeerd met (*) zijn verplicht.</em></div>
      <div>
        <form method="get">
          <div class="contact-form-grid">
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692fb-127e0eec"><label for="First-Name" id="contact-first-name">Voornaam</label><input type="text" class="w-input" maxlength="256" name="First-Name" data-name="First Name" placeholder="" id="First-Name" required=""></div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d73692ff-127e0eec"><label for="Last-Name" id="contact-last-name">Achternaam</label><input type="text" class="w-input" maxlength="256" name="Last-Name" data-name="Last Name" placeholder="" id="Last-Name" required=""></div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369303-127e0eec"><label for="Email" id="contact-email">E-Mail*</label><input type="email" class="w-input" maxlength="256" name="Email" data-name="Email" placeholder="" id="Email" required=""></div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d7369307-127e0eec"><label for="Contact-Phone-Number" id="contact-phone">Tel. Nummer</label><input type="tel" class="w-input" maxlength="256" name="Contact-Phone-Number" data-name="Contact Phone Number" placeholder="" id="Contact-Phone-Number"></div>
            <div id="w-node-_1864f9e8-ce8c-a3d7-9684-9964d736930b-127e0eec"><label for="Message" id="contact-message">Bericht*</label><textarea data-name="Message" maxlength="5000" id="Message" name="Message" placeholder="" class="textarea w-input"></textarea></div>
          </div><input type="submit" value="Verzenden" data-wait="Bezig..." class="button w-button">
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
