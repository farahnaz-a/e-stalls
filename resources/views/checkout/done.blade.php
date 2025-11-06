
  @extends('layouts.main')
  @section('wfdata', '61cb07b34d1a3e511ebe7129')
  @section('title', 'Je E-STALLS ticket afrekenen')

  @section('content')
  <div class="normal-section wf-section">
    <div class="container w-container">
      <div class="bedankt">
        <div data-w-id="2a8ff834-8752-f3e3-49ac-df14ea35583f" style="opacity:0;-webkit-transform:translate3d(0, 0, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="bedankt-content">
          <h1 class="bedankt-head">Bedankt, {{$naam}}!</h1>
          <h2 class="heading">Veel plezier op het event.</h2>
          <div>Wij sturen je z.s.m. informatie op over je bestelling per mail. (naar {{$email}})</div>
        </div>
        <div data-w-id="516b1075-e29b-cd2e-053f-64784903f913" data-animation-type="lottie" data-src="documents/74694-confetti.json" data-loop="0" data-direction="1" data-autoplay="0" data-is-ix2-target="1" data-renderer="svg" data-default-duration="2" data-duration="0" data-ix2-initial-state="0" class="bedankt-confetti"></div>
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
