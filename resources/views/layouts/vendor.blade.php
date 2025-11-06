<!DOCTYPE html>
<html data-wf-page="@yield('wfdata')" lang="nl">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="@yield('title')" property="og:title">
  <meta content="@yield('title')" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
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
    @yield('vendor-css')
  <style>
        .w-nav-menu {
            line-height: 60px;
        }
       
  </style>
  @if (count(explode(',', getCurrentVendor()->permissions)) == 6)
    <style>
        .w-nav-menu a {
          font-size: 14px;
        }
    </style>
  @endif
</head>
<body class="body">
  <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="o-navbar w-nav">
    <div class="small-bar">
      <div class="o-container w-container">
        <div class="small-bar">
          <div class="o-container w-container"></div>
          <div class="message">@if(!empty($message)){{$message}}@endif
          </div>
        </div>
      </div>
    </div>
    <div class="o-container w-container">
      <a href="{{ url('/') }}/vendor" class="brand w-nav-brand"><img src="{{ url('/') }}/images/logo-2.png" loading="lazy" height="70" alt=""></a>
      <nav role="navigation" class="o-nav-menu w-nav-menu">
        @if(str_contains(getCurrentVendor()->permissions, 'approved'))
          @if(str_contains(getCurrentVendor()->permissions, 'logo'))
            {{-- @if($logoAd == true) --}}
            @if(!getCurrentVendor()->logo)
              <a href="{{ url('/') }}/vendor/place-logo-ad" class="o-nav-link event">Logo Adverteren</a>
            @endif
          @endif
          @if(str_contains(getCurrentVendor()->permissions, 'movie'))
            @if(!getCurrentVendor()->movie)
              <a href="{{ url('/') }}/vendor/place-movie" class="o-nav-link event">Movie Plaatsen</a>
            @endif
          @endif
          @if(str_contains(getCurrentVendor()->permissions, 'stall'))
            @if(!getCurrentVendor()->stall?->request)
              <a href="{{ url('/') }}/vendor/request-stall" class="o-nav-link event">Stall Aanmaken</a>
            @endif
          @endif
          @if(str_contains(getCurrentVendor()->permissions, 'auction') && (getCurrentVendor()->auction_item_count -  getCurrentVendor()->getAllAuction->count()) > 0)
              <a href="{{ url('/') }}/vendor/request-auction-product" class="o-nav-link event">Veiling-items Aanbieden</a>
          @endif
          @if(str_contains(getCurrentVendor()->permissions, 'goodiebag'))
            @if(!getCurrentVendor()->goodiebag)
              <a href="{{ url('/') }}/vendor/request-goodiebag" class="o-nav-link event">Goodiebag Item aanbieden</a>
            @endif
          @endif
        @endif
        @auth
        <a href="{{ url('/' )}}/uitloggen" class="o-nav-link event" style="color:#9799a2;">Uitloggen</a>
        <a href="{{ url('/' )}}/vendor" class="o-nav-link event" style="color:#9799a2;">Dashboard</a>
        @endauth
        {{-- <a href="" class="button gradient w-button" style="opacity:0;">niet beschikbaar</a> --}}
      </nav>
      <div class="menu-button w-nav-button">
        <div class="w-icon-nav-menu"></div>
      </div>
    </div>
  </div>
  @yield('content')
  <footer id="footer" class="footer wf-section">
    <div class="o-container w-container">
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
              <a href="{{ url('/') }}/inloggen" class="footer-link">Inloggen</a>
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
                <a href="{{ url('/') }}/documents/privacy_policy.pdf" class="footer-link" target="_blank">Privacybeleid</a>
            </li>
            <li>
                <a href="{{ url('/') }}/documents/cookie_policy.pdf" class="footer-link" target="_blank">Cookiebeleid</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="bottom-footer">
      <div class="o-container w-container">
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
   @yield('vendor-js')
  <script src="{{ url('/') }}/js/e-stalls.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  @stack('js')
</body>
</html>
