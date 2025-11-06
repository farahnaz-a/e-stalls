<!DOCTYPE html>
<html data-wf-page="@yield('wfdata')" lang="nl">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="@yield('title')" property="og:title">
  <meta content="@yield('title')" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="{{ url('/') }}/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="{{ url('/') }}/css/components.css" rel="stylesheet" tyasaspe="text/css">
  <link href="{{ url('/') }}/css/e-stalls.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Nunito:200,300,regular,500,600,700,800,900,200italic,300italic,italic,500italic","Nunito Sans:200,300,300italic,regular,italic,600,600italic,700,800,900"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="{{ url('/') }}/images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="{{ url('/') }}/images/webclip.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
  @yield('vendor-css')
  {{-- random word css --}}
    <style>
    .letter-hint {
      position: fixed;
      z-index: 1000;
      cursor: pointer;
      transform: translate(-50%, 50%);
      transition: transform 0.3s ease-out;
      width: 60px;
      height: 60px;
      z-index: 99999;
    }

    /* Sparkle effect for the letter-hint container */
    .letter-hint::before, .letter-hint::after {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      border-radius: 50%;
      pointer-events: none;
      opacity: 0;
    }

    .letter-hint::before {
      background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
      animation: sparkle 3s infinite;
    }

    .letter-hint::after {
      background: radial-gradient(circle, rgba(255,255,255,0.6) 0%, rgba(255,255,255,0) 70%);
      animation: sparkle 3s 1s infinite;
    }

    .letter-bubble {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2), 0 0 0 2px white;
      animation: pulse 2s infinite;
      transition: all 0.3s ease;
    }

    .letter-bubble:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 20px rgba(0,0,0,0.3), 0 0 0 3px white;
      filter: brightness(1.1);
    }

    .text-block-2 {
      font-size: 28px;
      font-weight: 800;
      color: white;
      text-shadow: 0 1px 3px rgba(0,0,0,0.3);
      font-family: 'Nunito', sans-serif;
      z-index: 2;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    @keyframes sparkle {
      0% { transform: scale(0.8); opacity: 0; }
      50% { transform: scale(1.2); opacity: 1; }
      100% { transform: scale(1.5); opacity: 0; }
    }
  </style>
    @yield('style-css')
</head>
<body class="body">
  @if(!empty($letter) && $letter != '~')
    @php
        $letter_key = array_key_first($letter);   // Gets first key (PHP 7.3+)
        $letter_value = $letter[$letter_key];
    @endphp
    <div class="letter-hint" style="left: 70% !important; bottom: 70% !important">
      <div class="letter-bubble" data-letter="{{ $letter_value }}" data-letter_key="{{ $letter_key }}">
        <div class="text-block-2">{{ $letter_value }}</div>
      </div>
    </div>
    <script>
      // Define color palette for each letter (26 colors)
    //   const letterColors = {
    //     'A': '#FF5252',  'B': '#FF4081',  'C': '#E040FB',  'D': '#7C4DFF',
    //     'E': '#536DFE',  'F': '#448AFF',  'G': '#40C4FF',  'H': '#18FFFF',
    //     'I': '#64FFDA',  'J': '#69F0AE',  'K': '#B2FF59',  'L': '#EEFF41',
    //     'M': '#FFFF00',  'N': '#FFD740',  'O': '#FFAB40',  'P': '#FF6E40',
    //     'Q': '#FF8A65',  'R': '#F4511E',  'S': '#5D4037',  'T': '#7B1FA2',
    //     'U': '#512DA8',  'V': '#303F9F',  'W': '#1976D2',  'X': '#0288D1',
    //     'Y': '#0097A7',  'Z': '#00796B'
    //   };
      const letterColors = {
        '0': '#FF5252',  '1': '#185900',  '2': '#FF00B7',  '3': '#002E93',
        '4': '#51127C',  '5': '#BB6B24',  '6': '#FF3C14',  '7': '#005E68',
        '8': '#BC139C',  '9': '#545FC6',  '10': '#2250D1',  '11': '#740CBD',
        '12': '#FF7E5E',  '13': '#08A000',  '14': '#A53860',  '15': '#3094E7',
        '16': '#A064EE',  '17': '#445253',  '18': '#F7810B',  '19': '#37B070',
        '20': '#5E4563',  '21': '#DDBE39',  '22': '#9ECE06',  '23': '#00C1C2',
        '24': '#6D6A00',  '25': '#6A2B05'
      };

      // Get letter bubble element
      const letterBubble = document.querySelector('.letter-bubble');
      const letter = letterBubble.dataset.letter;
      const letter_key = letterBubble.dataset.letter_key;

      // Apply color if letter exists in our palette
      if (letterColors[letter_key]) {
        letterBubble.style.background = letterColors[letter_key];
      } else {
        // Fallback gradient for non-alphabet characters
        letterBubble.style.background = 'linear-gradient(135deg, #6a11cb 0%, #2575fc 100%)';
      }

      // Add interactive animation
      letterBubble.addEventListener('click', function() {
        this.style.animation = 'none';
        this.style.transform = 'scale(1.2)';
        setTimeout(() => {
          this.style.animation = 'pulse 2s infinite';
          this.style.transform = '';
        }, 300);
      });
    </script>
  @endif
  {{-- @if(!empty($letter) && $letter != '~')
  <div class="letter-hint" style="left: {{rand(0,100)}}% !important; bottom: {{rand(0,100)}}% !important">
    <div class="text-block-2">{{$letter}}</div>
    <div data-animation-type="lottie" data-src="{{url('/')}}/documents/lf30_editor_iedqjjsk.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-default-duration="3" data-duration="0" class="hint"></div>
  </div>
  @endif --}}
    @php
        if(!isset($randomPrice)){
            $randomPrice = 4;
        }
    @endphp
     @if($randomPrice == 1)
      @if(!empty($data))
        @if(!in_array(Auth::user()->id, explode(',', $data->claimed_by)))
        <div class="popupwindow" id="popup">
          <div class="popupwrap centered">
            <h1 class="dark nomarg">Gefeliciteerd!</h1>
            <h4 class="dark">Je hebt een prijs gewonnen.</h4>
            <div>Je prijs is: <strong>{{$data->price_name}}</strong></div>
            <a href="{{url('/')}}/popup/{{$data->id}}" class="button gradient nomarg margtop w-button">Claim je prijs</a>
            <a data-w-id="4ce732bb-2e05-5b87-5d30-fb2cbb79e8b3" href="#" onclick="hidePopUp()" class="exit">X</a>
          </div>
        </div>
        <script>
          function hidePopUp() {
            document.getElementById("popup").style.display = "none";
          }
        </script>
        @endif
      @endif
     @elseif($randomPrice == 2)
      @if(!empty($data))
        @if(!in_array(Auth::user()->id, explode(',', $data->claimed_by)))
        <div class="popupwindow" id="goodiePopup">
          <div class="popupwrap centered">
            <h1 class="dark nomarg">Gefeliciteerd!</h1>
            <h4 class="dark">Je hebt een goodiebag gewonnen.</h4>
            <div><strong>{{$data->contents}}</strong></div>
            <a href="{{url('/')}}/goodiebag/{{$data->id}}" class="button gradient nomarg margtop w-button">Claim je goodiebag</a>
            <a data-w-id="4ce732bb-2e05-5b87-5d30-fb2cbb79e8b3" href="#" onclick="hideGoodiePopUp()" class="exit">X</a>
          </div>
        </div>
        <script>
          function hideGoodiePopUp() {
            document.getElementById("goodiePopup").style.display = "none";
          }
        </script>
        @endif
      @endif

     @endif


  <script>
    function confirmExit() {
        if (confirm("Weet je zeker dat je het event wilt verlaten?\nLet op!: Je kunt niet meer terugkeren zonder een nieuwe ticket te kopen.") == true) {
            window.location="{{ url('/') }}/event/{{ $event->id }}/verlaten";
        } else {
        }
    }
  </script>
  <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="o-navbar w-nav">
    <div class="small-bar">
      <div class="o-container w-container">
        <div class="small-bar">
          <div class="o-container w-container"></div>
          <div class="message" style="display: flex; justify-content: space-between; align-items: center">
            <div>

            </div>
            <div>
                Zoek alle letters, raad het juiste woord en maak kans op een exclusieve prijs!  <a href="{{url('/')}}/event/{{$event->id}}/woordprijs" class="messagelink">Vul hier je letters in.</a>
            </div>
            <div>
                <span id="eventCountDownTimer" style="display: none ; font-size: 35px; font-weight: bold; color: #333;" data-event-date="{{ $event->end_date }}" data-event-time="{{ $event->end_time }}">00:00</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="o-container w-container">
      <a href="{{ url('/') }}/event/{{ $event->id }}" aria-current="page" class="brand w-nav-brand w--current"><img src="{{ url('/') }}/images/logo-2.png" loading="lazy" height="70" alt=""></a>
      <nav role="navigation" class="nav-menu w-nav-menu">
        <a href="{{ url('/') }}/event/{{ $event->id }}" class="o-nav-link event">Main hall</a>
        <a href="{{ url('/') }}/event/{{$event->id}}/winkelwagen" class="button gradient w-button">Winkelmandje</a>
        <a onclick="confirmExit()" class="o-nav-link leave w-nav-link">x</a>
      </nav>
      <div class="menu-button w-nav-button">
        <div class="w-icon-nav-menu"></div>
      </div>
    </div>
  </div>

        @php
            date_default_timezone_set('Europe/Amsterdam');
            $eventEnd = strtotime($event->end_date . ' ' . $event->end_time);
            $now = \Carbon\Carbon::now()->timestamp;
            // dd(\Carbon\Carbon::now());
            $diff = $eventEnd - $now;
        @endphp
        @if ($diff > 14400 && $diff <= 15300)
        <div class="w-form-success" style="margin: 20px;">
            <div>Na het event heb je nog 30 minuten om je winkelmandje af te rekenen!</div>
        </div>
        @endif

  @yield('content')
  @stack('all-modals')
  <footer id="footer" class="footer wf-section">
    <div class="o-container w-container">
      <div class="footer-flex-container">
        <div>
          <h2 class="footer-heading">E-STALLS Events</h2>
          <div class="adres">KVK: 81552653<br>Btw: NL003577058B75<br>Melkwegsingel 10,<br>3331TG Zwijndrecht<br>(geen bezoekadres)</div>
        </div>
        <div>
          <h2 class="footer-heading">Event Hallen</h2>
          <ul role="list" class="w-list-unstyled">
            <li>
              <a href="{{ url('/') }}/event/{{ $event->id }}/stallhall" class="footer-link">Stall Hall</a>
              <a href="{{ url('/') }}/event/{{ $event->id }}/auctionhall" class="footer-link">Auction Hall</a>
            </li>
            <li>
              <a href="{{ url('/') }}/event/{{ $event->id }}/moviehall" class="footer-link">Movie Hall</a>
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
    <script type="text/javascript" async="" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=PUBLIC_API_KEY"></script>
  </footer>

  {{-- 1 hour, 30 minutes, 15minutes timer alert modal --}}
        <div id="eventModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
        <div style="background:#fff; padding:20px; margin:15% auto; width:400px; border-radius:10px; position:relative; text-align:center; box-shadow:0 4px 10px rgba(0,0,0,0.3);">
            <!-- Close X button -->
            <span id="closeModal" style="position:absolute; top:10px; right:15px; font-size:20px; font-weight:bold; cursor:pointer;">&times;</span>
            <p id="modalText" style="font-size:16px; font-weight:700; padding-top:30px"></p>
        </div>
        </div>

  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=61c31d2747c9fc9d2ea0dfca" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  @yield('vendor-js')
  <script src="{{ url('/') }}/js/e-stalls.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  @yield('script-js')

  <script>
    $(document).ready(function(){
        let end_date = $("#eventCountDownTimer").data('event-date');
        let end_time = $("#eventCountDownTimer").data('event-time');
        let event_date = new Date(`${end_date}T${end_time}:00`).getTime();
        let current_date_time =  new Date().getTime();
        let distance = event_date - current_date_time;
        if(distance > 10000){
            setInterval(() => {
                if(distance > 1000 && distance < 900000){
                    const totalSeconds = Math.floor(distance / 1000);
                    const minutes = Math.floor(totalSeconds / 60);
                    const seconds = totalSeconds % 60;
                    const display = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    $("#eventCountDownTimer").text(display);
                    $("#eventCountDownTimer").slideDown();
                }else{
                    $("#eventCountDownTimer").slideUp();
                }

                distance = distance - 1000;
            }, 1000);
        }
    })
  </script>

<script>
$(document).ready(function() {
    var endtime = new Date("{{ $event->end_date }}T{{ $event->end_time }}:00").getTime();
    var now = new Date().getTime();

    // Time markers (1hr, 30min, 15min before event end)
    var oneHourBefore = endtime - (60 * 60 * 1000);
    var thirtyMinBefore = endtime - (30 * 60 * 1000);
    var fifteenMinBefore = endtime - (15 * 60 * 1000);

    function scheduleModal(showTime, message) {
        if (now < showTime) {
            var timeoutDuration = showTime - now;
            setTimeout(function() {
                $("#modalText").text(message);
                $("#eventModal").fadeIn();
            }, timeoutDuration);
        }
    }

    // Schedule all modals
    scheduleModal(oneHourBefore, "Het event eindigt over 1 uur! Zorg dat je niets mist!");
    scheduleModal(thirtyMinBefore, "Het event sluit over 30 minuten! Je hebt nog maar even de tijd om de beste deals te scoren");
    scheduleModal(fifteenMinBefore, "Het event sluit over 15 minuten! Na het event heb je nog 30 minuten om je favoriete deals af te rekenen");

    // Close button
    $("#closeModal").on("click", function() {
        $("#eventModal").fadeOut();
    });
});
</script>
</body>
</html>
