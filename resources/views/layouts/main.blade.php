<!DOCTYPE html>
<html data-wf-page="@yield('wfdata')" lang="nl">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="{{ url('/') }}/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="{{ url('/') }}/css/components.css" rel="stylesheet" tyasaspe="text/css">
  <link href="{{ url('/') }}/css/e-stalls.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Nunito:200,300,regular,500,600,700,800,900,200italic,300italic,italic,500italic","Nunito Sans:200,300,300italic,regular,italic,600,600italic,700,800,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="{{ url('/') }}/images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="{{ url('/') }}/images/webclip.png" rel="apple-touch-icon">
  @stack('css')
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-afc233b9-96ea-4c54-8939-30b385ad4330"></div>
  <script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=TZ9fLQ"></script>
</head>
<style>
    .main-nav-svg{
      position: relative;
    }
    .nav-svg {
      position: absolute;
      left: 100px;
      top: -36px;
    }

    .nav-svg .svg{
        width: 300px;
    }

    .nav-svg .first-tittle,.nav-svg .second-tittle,.nav-svg .third-tittle{
        position: absolute;
    }

    .nav-svg .item1,.nav-svg .item2,.nav-svg .item3{
        position: absolute;
        opacity: 0;
    }

    .nav-svg1{
        position: relative;
    }

    .nav-svg .item1 {
        height: 41px;
        width: 70px;
        background: red;
        left: 14px;
        top: 65px;
   }

   .nav-svg .first-tittle {
        left: 25px;
        top: 40px;
   }

   .nav-svg .first-tittle p{
        color: #363e5d;
        text-transform: capitalize;
        font-weight: 500;
   }

   .nav-svg .item2 {
        height: 50px;
        width: 39px;
        background: red;
        left: 138px;
        top: 60px;
   }

   .nav-svg .second-tittle {
        left: 140px;
        top: 40px;
   }

   .nav-svg .second-tittle p{
        color: #363e5d;
        text-transform: capitalize;
        font-weight: 500;
   }

   .nav-svg .item3 {
        height: 47px;
        width: 38px;
        background: red;
        left: 246px;
        top: 61px;
   }

   .nav-svg .third-tittle {
        left: 236px;
        top: 40px;
   }

   .nav-svg .third-tittle p{
        color: #363e5d;
        text-transform: capitalize;
        font-weight: 500;
   }

@media (min-width:0px) and (max-width: 350px) {
  .nav-svg .first-tittle,.nav-svg .second-tittle,.nav-svg .third-tittle{
    position: absolute;
  }

  .nav-svg .item1,.nav-svg .item2,.nav-svg .item3{
    position: absolute;
    opacity: 0;
  }

  .nav-svg .svg {
    width: 160px;
  }

  .nav-svg {
    left: 31%;
    top: 5px;
  }

  .nav-svg .first-tittle {
	left: 3px;
	top: 5px;
  }

  .nav-svg .second-tittle {
	left: 67px;
	top: 5px;
  }

  .nav-svg .third-tittle {
	left: 110px;
	top: 5px;
  }

  .nav-svg .item1 {
    height: 23px;
    width: 38px;
    background: red;
    position: absolute;
    left: 7px;
    top: 34px;
    display: none;
  }

  .nav-svg .item2 {
	height: 26px;
	width: 20px;
	background: red;
	position: absolute;
	left: 73px;
	top: 32px;
    display: none;
  }

  .nav-svg .item3 {
	height: 24px;
	width: 21px;
	background: red;
	left: 131px;
	top: 33px;
    display: none;
  }
}


@media (min-width:350px) and (max-width: 375px) {
  .nav-svg .first-tittle,.nav-svg .second-tittle,.nav-svg .third-tittle{
    position: absolute;
  }

  .nav-svg .item1,.nav-svg .item2,.nav-svg .item3{
    position: absolute;
    opacity: 0;
  }
  .nav-svg .svg {
    width: 160px;
  }

  .nav-svg {
    position: absolute;
    left: 31%;
    top: 5px;
  }

  .nav-svg .first-tittle {
	position: absolute;
	left: 3px;
	top: 5px;
  }

  .nav-svg .second-tittle {
	position: absolute;
	left: 67px;
	top: 5px;
  }

  .nav-svg .third-tittle {
	position: absolute;
	left: 100px;
	top: 5px;
  }

  .nav-svg .item1 {
    height: 23px;
    width: 38px;
    background: red;
    left: 7px;
    top: 34px;
  }

  .nav-svg .item2 {
	height: 26px;
	width: 20px;
	background: red;
	position: absolute;
	left: 73px;
	top: 32px;
  }

  .nav-svg .item3 {
	height: 24px;
	width: 21px;
	background: red;
	position: absolute;
	left: 131px;
	top: 33px;
  }
}

@media (min-width:375px) and (max-width: 386px) {
  .nav-svg .svg {
    width: 160px;
  }

  .nav-svg {
    position: absolute;
    left: 34.2%;
    top: 5px;
  }

  .nav-svg .first-tittle,.nav-svg .second-tittle,.nav-svg .third-tittle{
    position: absolute;
  }

  .nav-svg .item1,.nav-svg .item2,.nav-svg .item3{
    position: absolute;
    opacity: 0;
  }

  .nav-svg .first-tittle {
	left: 3px;
	top: 5px;
  }

  .nav-svg .second-tittle {
	left: 67px;
	top: 5px;
  }

  .nav-svg .third-tittle {
	left: 110px;
	top: 5px;
  }

  .nav-svg .item1 {
    height: 23px;
    width: 38px;
    background: red;
    left: 7px;
    top: 34px;
  }

  .nav-svg .item2 {
	height: 26px;
	width: 20px;
	background: red;
	left: 73px;
	top: 32px;
  }

  .nav-svg .item3 {
	height: 24px;
	width: 21px;
	background: red;
	left: 131px;
	top: 33px;
  }
}

@media (min-width: 386px) and (max-width: 490px) {
  .nav-svg .svg {
    width: 160px;
  }

  .nav-svg {
    position: absolute;
    left: 37.5%;
    top: 5px;
  }

  .nav-svg .first-tittle {
	position: absolute;
	left: 3px;
	top: 5px;
  }

  .nav-svg .second-tittle {
	position: absolute;
	left: 67px;
	top: 5px;
  }

  .nav-svg .third-tittle {
	position: absolute;
	left: 110px;
	top: 5px;
  }

  .nav-svg .item1 {
    height: 23px;
    width: 38px;
    background: red;
    position: absolute;
    left: 7px;
    top: 34px;
    opacity: 0;
  }

  .nav-svg .item2 {
	height: 26px;
	width: 20px;
	background: red;
	position: absolute;
	left: 73px;
	top: 32px;
	opacity: 0;
  }

  .nav-svg .item3 {
	height: 24px;
	width: 21px;
	background: red;
	position: absolute;
	left: 131px;
	top: 33px;
	opacity: 0;
  }

}



  </style>
<body>
  <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
    <div class="small-bar">
      {{-- <div class="container w-container"></div> --}}
    </div>
    <div class="container w-container main-nav-svg">
      <a href="/" aria-current="page" class="brand w-nav-brand w--current"><img src="{{ url('/') }}/images/logo-2.png" loading="lazy" height="70" alt=""></a>
     <div class="nav-img1">
        <div class="nav-svg">
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player class="svg" src="documents/line.json" background="transparent" speed="1" loop autoplay></dotlottie-player>
            <div class="first-tittle">
                <p></p>
            </div>
            <div class="second-tittle">
                <p></p>
            </div>
            <div class="third-tittle">
                <p></p>
            </div>
            <div class="item1"></div>
            <div class="item2"></div>
            <div class="item3"></div>
           </div>
     </div>
      <nav role="{{ url('/') }}/navigation" class="nav-menu w-nav-menu">
        <a href="{{ url('/') }}/" aria-current="page" class="nav-link w-nav-link">Home</a>
        <a href="{{ url('/') }}/events" class="nav-link w-nav-link">Events</a>
        <a href="{{ url('/') }}/over-ons" class="nav-link w-nav-link">Over Ons</a>
        @auth
        <a href="{{ url('/') }}/dashboard" class="button gradient w-button">Dashboard</a>
        <a href="{{ url('/' )}}/uitloggen" class="nav-link w-nav-link" style="color:#9799a2;">Uitloggen</a>
        @endauth
        @guest
        <a href="{{ url('/') }}/inloggen" class="button gradient w-button">Inloggen</a>
        @endguest
      </nav>
      <div class="menu-button w-nav-button">
        <div class="w-icon-nav-menu"></div>
      </div>
    </div>
  </div>
  @yield('content')
  <footer id="footer" class="footer wf-section">
    <div class="container w-container">
      <div class="footer-flex-container">
        <div>
          <h2 class="footer-heading">E-STALLS Events</h2>
          <div class="adres">KVK: 81552653<br>Btw: NL003577058B75<br>Melkwegsingel 10,<br>3331TG Zwijndrecht<br>(geen bezoekadres)</div>
        </div>
        <div>
          <h2 class="footer-heading">Pagina&#x27;s</h2>
          <ul role="list" class="w-list-unstyled">
            <li>
              <a href="{{ url('/') }}/" aria-current="page" class="footer-link w--current">Home</a>
              <a href="{{ url('/') }}/events" class="footer-link">Events</a>
            </li>
            <li>
              <a href="{{ url('/') }}/contact" class="footer-link">Contact</a>
              @auth
              <a href="{{ url('/') }}/dashboard" class="footer-link">Dashboard</a>
              @endauth
              @guest
              <a href="{{ url('/') }}/inloggen" class="footer-link">Inloggen</a>
              @endguest
            </li>
          </ul>
        </div>
        <div>
          <h2 class="footer-heading">Belangrijke Links</h2>
          <ul role="list" class="w-list-unstyled">
            <li>
              <a href="{{ url('/') }}/documents/algemene_voorwaarden.pdf" class="footer-link" target="_blank">Algemene Voorwaarden</a>
            </li>
            <li>
              <a href="{{ url('/') }}/documents/partnervoorwaarden.pdf" class="footer-link" target="_blank">Partnervoorwaarden</a>
            </li>
            <li>
              <a href="{{ url('/') }}/documents/privacy_policy.pdf" class="footer-link" target="_blank">Privacybeleid</a>
            </li>
            <li>
              <a href="{{ url('/') }}/documents/cookie_policy.pdf" class="footer-link" target="_blank">Cookiebeleid</a>
            </li>
            <li>
              <a href="{{ url('/') }}/documents/Bezoeker.pdf" class="footer-link" target="_blank">Bezoeker</a>
            </li>
            <li>
              <a href="{{ url('/') }}/documents/Vendor.pdf" class="footer-link" target="_blank">Vendor</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="bottom-footer">
      <div class="container w-container">
        <div class="betaalmethoden-cont w-clearfix">
          <div class="betaalmethoden">Betaalmethoden</div>
          <div class="beschikbare-betaalmethoden"><img src="{{ url('/') }}/images/Icon-payment-ideal.png" loading="lazy" alt="" class="betaalmethode"><img src="{{ url('/') }}/images/Icon-awesome-cc-visa.png" loading="lazy" alt="" class="betaalmethode"><img src="{{ url('/') }}/images/Icon-awesome-cc-paypal.png" loading="lazy" alt="" class="betaalmethode"></div>
        </div>
        <div class="green-host w-embed"><img style="height: 80px;" src="https://api.thegreenwebfoundation.org/greencheckimage/e-stalls.nl?nocache=true" alt="This website is hosted Green - checked by thegreenwebfoundation.org"></div>
        <div class="footer-disc">©E-STALLS 2023-24 - Alle rechten voorbehouden</div>
      </div>
    </div>
  </footer>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=61c31d2747c9fc9d2ea0dfca" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="{{ url('/') }}/js/e-stalls.js" type="text/javascript"></script>
  @stack('js')
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
<script>
// svg1 start
let item1 = document.querySelector(".nav-svg .item1");
let firstTittle = document.querySelector(".first-tittle p");

item1.addEventListener("mouseenter",function(){
    firstTittle.innerHTML = "Beleef";
})

item1.addEventListener("mouseleave",function(){
    firstTittle.innerHTML = "";
})

// svg1 end

// svg2 start
let item2 = document.querySelector(".nav-svg .item2");
let secondTittle = document.querySelector(".second-tittle p");

item2.addEventListener("mouseenter",function(){
    secondTittle.innerHTML = "Win";
})

item2.addEventListener("mouseleave",function(){
    secondTittle.innerHTML = "";
})
// svg2 end

// svg3 start
let item3 = document.querySelector(".nav-svg .item3");
let thirdTittle = document.querySelector(".third-tittle p");

item3.addEventListener("mouseenter",function(){
    thirdTittle.innerHTML = "Bespaar";
})

item3.addEventListener("mouseleave",function(){
    thirdTittle.innerHTML = "";
})
// svg3 end


</script>
</html>
