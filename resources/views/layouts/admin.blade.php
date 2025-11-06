<!DOCTYPE html>
<html data-wf-page="@yield('wfdata')" lang="nl">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="@yield('title')" property="og:title">
  <meta content="@yield('title')" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ url('/') }}/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="{{ url('/') }}/css/components.css" rel="stylesheet" tyasaspe="text/css">
  <link href="{{ url('/') }}/css/e-stalls.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Nunito:200,300,regular,500,600,700,800,900,200italic,300italic,italic,500italic","Nunito Sans:200,300,300italic,regular,italic,600,600italic,700,800,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="{{ url('/') }}/images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="{{ url('/') }}/images/webclip.png" rel="apple-touch-icon">
  @yield('css')
</head>
<body>
  <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="admin-nav w-nav">
    <div class="container w-container">
      <a href="{{ url('/') }}/admin/" class="w-nav-brand"><img src="{{ url('/') }}/images/logo-2.png" loading="lazy" width="45" alt=""></a>
      <nav role="navigation" class="w-nav-menu">
        <a href="{{ url('/') }}/admin/events" class="w-nav-link">Events</a>
        <a href="{{ url('/') }}/admin/prices" class="w-nav-link">Prijzen</a>
        <a href="{{ url('/') }}/admin/orders" class="w-nav-link">Aankopen</a>
        <a href="{{ url('/') }}/admin/approvals" class="w-nav-link">Goedkeuren</a>
        <a href="{{ url('/') }}/admin/accounts" class="w-nav-link">Accounts</a>
        <a href="{{ url('/') }}/admin/auctions" class="w-nav-link">Veilingen</a>
        <a href="{{ url('/') }}/admin/goodiebag" class="w-nav-link">Goodiebag</a>
        <a href="{{ url('/') }}/admin/ondernemer" class="w-nav-link">Ondernemer</a>
        @auth
        <a href="{{ url('/' )}}/uitloggen" class="w-nav-link" style="color:#9799a2;">Uitloggen</a>
        @endauth
      </nav>
      <div class="w-nav-button">
        <div class="w-icon-nav-menu"></div>
      </div>
    </div>
  </div>
  @yield('content')
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=61c31d2747c9fc9d2ea0dfca" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="{{ url('/') }}/js/e-stalls.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  @yield('js')
</body>
</html>
