
  @extends('layouts.main')

  @section('wfdata', '61c31d2747c9fc25d4a0dfcb')

  @section('title', 'E-STALLS - Events van diverse brands online')

  @push('css')
  <link rel="stylesheet" href="{{ asset('plugins/venobox/css/venobox.min.css') }}">
  <style>
      .hero-section{
        background-image: linear-gradient(rgba(54, 62, 93, .94), rgba(54, 62, 93, .94)), url("{{ asset('images/home-banner-image.jpeg') }}");
        background-size: cover;
      }

.w-container {
        position: relative;
}
.w-container .img{
        position: relative;
}

.w-container .tittle1 {
        position: absolute;
        left: 0%;
        top: 2%;
        text-align: center;
   }

.w-container .tittle2 {
    position: absolute;
    left: 25%;
    top: 2%;
    text-align: center;
}

.w-container .tittle3 {
    position: absolute;
    left: 30%;
    top: -3%;
    width: 72%;
    text-align: center;
}

.w-container .tittle4 {
    position: absolute;
    left: 22%;
    top: 93%;
    width: 80%;
    text-align: center;
}

.w-container .tittle5 {
    position: absolute;
    left: 5%;
    top: 93%;
    width: 87%;
    text-align: center;
}
.w-container .imgcircle, .w-container .imgcircle1, .w-container .imgcircle2, .w-container .imgcircle3, .w-container .imgcircle4{
    position: absolute;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer; 
    height: 25px;
    width: 23px;
}
.w-container .imgcircle { 
    left: 25.5%;
    top: 22.7%;

}

.w-container .imgcircle1 { 
    left: 46.1%;
    top: 12.5%; 
}

.w-container .imgcircle2 { 
    left: 68.3%;
    top: 16.5%; 
}

.w-container .imgcircle3 { 
    left: 69.8%;
    top: 89.1%; 
}

.w-container .imgcircle4 { 
    left: 42.5%;
    top: 89.1%; 
}

@media (min-width: 0) and (max-width: 767px) {
   .w-container .hideImg img{
    display: none;
   }

   .w-container .hideImg img{
    display: none;
   }
  }
   @media (min-width: 768px) and (max-width: 991px){

    .w-container .imgcircle, .w-container .imgcircle1, .w-container .imgcircle2, .w-container .imgcircle3, .w-container .imgcircle4{
        height: 18px;
        width: 18px; 
    }
    .w-container .imgcircle { 
    left: 25.5%;
    top: 22.8%;
}

.w-container .imgcircle1 { 
    left: 46%;
    top: 12.5%; 
}

.w-container .imgcircle2 { 
    left: 68.3%;
    top: 16.5%; 
}

.w-container .imgcircle3 { 
    left: 69.8%;
    top: 89.1%; 
}

.w-container .imgcircle4 { 
    left: 42.5%;
    top: 89.1%; 
}


.w-container .tittle1 {
    position: absolute;
    left: 4%;
    top: -5%;
    text-align: center;
}

.w-container .tittle2 {
    position: absolute;
    left: 25%;
    top: -5%;
    text-align: center;
}

.w-container .tittle3 {
    position: absolute;
    left: 27%;
    top: -12%;
    width: 72%;
    text-align: center;
}

.w-container .tittle4 {
    position: absolute;
    left: 22%;
    top: 93%;
    width: 80%;
    text-align: center;

}

.w-container .tittle5 {
    position: absolute;
    left: -3%;
    top: 93%;
    width: 100%;
    text-align: center;
}




   .w-container .img1 img{
    display: none;
   }

   .w-container .hideImg img{
    display: block;
   }
  }

  @media (min-width: 992px) {
   .w-container .img1 img{
    display: none;
   }

   .w-container .hideImg img{
    display: block;
   }
  }

  </style>
  @endpush

  @section('content')
  <div class="hero-section wf-section">
    <div class="container w-container">
      <div class="w-layout-grid hero-grid">
        <div id="w-node-_087ce150-7cab-0355-ffcf-a2f4c8c255d6-d4a0dfcb" class="hero-content">
          <h1>Ontvang goodiebags, couponcodes, scoor de nieuwste producten/diensten van diverse brands en maak kans op waanzinnige prijzen.</h1>
          <a href="http://youtu.be/Tnnd_Wk_vhE" class="popup-btn button w-button" data-autoplay="true" data-vbtype="video">Waarom E-STALLS?</a>
        </div>
        {{-- <div class="image hi" data-w-id="ca469f7f-be0c-1de7-d8ff-7b42f2445988" data-animation-type="lottie" data-src="documents/line.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-duration="0"></div> --}}
        {{-- <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="documents/line.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player> --}}
        {{-- <div id="w-node-_3711ecee-2874-1158-5ea1-7757e7c336dd-d4a0dfcb" class="html-embed w-embed w-iframe">
            <iframe width="420" height="250" src="https://www.youtube-nocookie.com/embed/Tnnd_Wk_vhE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div> --}}
      </div>
    </div>
    <div data-delay="4000" data-animation="cross" class="slider w-slider" data-autoplay="true" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
      <div class="mask w-slider-mask">
        @foreach ($events as $event)
            @if($event->status == "live")
                @php
                    $less_than_10_percent = false;
                    $max_tickets = $event->max_tickets;
                    $sell_tickets = $event->sell_count;
                    if($sell_tickets > (($max_tickets*90)/100)){
                        $less_than_10_percent = true;
                    }
                @endphp
                <div class="w-slide">
                    <div class="event-top-bar">
                        @if ($event->start_date == date('Y-m-d'))
                            <div class="event-word today">VANDAAG</div>
                        @else
                            <div class="event-word">GEPLAND</div>
                        @endif
                        <div class="line"></div>
                        <div class="available-tickets {{ $less_than_10_percent ? 'almost-end' : '' }}">{{ $event->max_tickets - $event->sell_count }} tickets beschikbaar</div>
                    </div>
                    <div class="event-date">{{ date('d-m-Y', strtotime($event->start_date)) }}</div>
                    <div class="event-name">{{ $event->name }}</div>
                    @if(($event->max_tickets - $event->sell_count) > 0)
                        <a href="{{url('/')}}/ticket-kopen/{{$event->id}}" class="button w-button">Bestel je tickets!</a>
                    @else
                        <a href="javascript:void(0)" class="button w-button">UITVERKOCHT</a>
                    @endif
                </div>
            @endif
        @endforeach
      </div>
      <div class="left-arrow w-slider-arrow-left">
        <div class="w-icon-slider-left"></div>
      </div>
      <div class="right-arrow w-slider-arrow-right">
        <div class="w-icon-slider-right"></div>
      </div>
      <div class="slide-nav w-slider-nav w-round"></div>
    </div>
    {{-- <div data-poster-url="https://uploads-ssl.webflow.com/61c31d2747c9fc9d2ea0dfca/649dc11594387f0283a08743_Trade Show-4-poster-00001.jpg" data-video-urls="https://uploads-ssl.webflow.com/61c31d2747c9fc9d2ea0dfca/649dc11594387f0283a08743_Trade Show-4-transcode.mp4,https://uploads-ssl.webflow.com/61c31d2747c9fc9d2ea0dfca/649dc11594387f0283a08743_Trade Show-4-transcode.webm" data-autoplay="true" data-loop="true" data-wf-ignore="true" class="background-video w-background-video w-background-video-atom">
        <video id="9957521b-5fdd-3d58-5160-d8def480095b-video" autoplay="" loop="" style="background-image:url(&quot;https://uploads-ssl.webflow.com/61c31d2747c9fc9d2ea0dfca/649dc11594387f0283a08743_Trade Show-4-poster-00001.jpg&quot;)" muted="" playsinline="" data-wf-ignore="true" data-object-fit="cover">
            <source src="https://uploads-ssl.webflow.com/61c31d2747c9fc9d2ea0dfca/649dc11594387f0283a08743_Trade Show-4-transcode.mp4" data-wf-ignore="true">
            <source src="https://uploads-ssl.webflow.com/61c31d2747c9fc9d2ea0dfca/649dc11594387f0283a08743_Trade Show-4-transcode.webm" data-wf-ignore="true">
        </video>
    </div> --}}
  </div>
  <div data-w-id="b601b1ad-8163-a3b2-3c00-67c1078eb1a2" class="about-estalls wf-section">
    <div id="waarom" class="container w-container">
      <div class="w-layout-grid grid">
        <div id="w-node-_00e32fb0-c159-fe65-bdaf-f9f92d14e224-d4a0dfcb" class="about-content">
          <h2>Op het E-STALLS platform ervaar je unieke <strong>events</strong> en scoor je exclusieve deals vanuit huis.</h2>
          <p class="paragraph">Er gaat een wereld voor je open met de online events van E-STALLS. Maak kans op toffe prijzen, ontdek nieuwe brands en scoor geweldige deals voor elk budget.</p>
          <a href="{{ url('/' )}}/events" class="button purple w-button">Check de geplande events</a>
        </div>
        <div id="w-node-_8ea8392a-5c67-da44-17f2-5002d9373468-d4a0dfcb" class="about-image">
          <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
           <dotlottie-player src="documents/Hi-scene-1-new.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
          {{-- <div class="image hi" data-w-id="ca469f7f-be0c-1de7-d8ff-7b42f2445988" data-animation-type="lottie" data-src="documents/Hi-scene-1-new.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-duration="0"></div> --}}
          <div data-w-id="e159d314-2ed8-f655-6757-daaecff96492" class="bubble"></div>
          <div data-w-id="c5c45c84-f7a5-8dcc-1289-890510f3d513" class="bubble _4"></div>
          <div class="bubble _3"></div>
          <div data-w-id="5991f1d8-0d31-5a17-3e56-d71b97ae5d86" class="bubble _2"></div>
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
  <div class="review-section wf-section">
    <div class="w-container">
     <div class="img1">
      <img src="{{ asset('images/map.png') }}" alt="">
     </div>
     <div class="hideImg">
      <h2 class="tittle1"></h2>
      <h2 class="tittle2"></h2>
      <h2 class="tittle3"></h2>
      <h2 class="tittle4"></h2>
      <h2 class="tittle5"></h2>
      <div class="img">
        <img src="{{ asset('images/map.png') }}" alt="">
       <div class="imgcircle"></div>
       <div class="imgcircle1"></div>
       <div class="imgcircle2"></div>
       <div class="imgcircle3"></div>
       <div class="imgcircle4"></div>
      </div>
     </div>
    </div>
  </div>
  @endsection


  @push('js')
  <script src="{{ asset('plugins/venobox/js/venobox.min.js') }}"></script>
  <script>
    new VenoBox({
        selector: '.popup-btn',
    });
    let clickImg = document.querySelector(".w-container .img .imgcircle")
    let h2Text = document.querySelector(".w-container .tittle1")

    clickImg.addEventListener("click",function(){
      h2Text1.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
      let result =   h2Text.innerHTML = "Bepaal zelf de prijs voor je product in de Auctionhall";
      console.log(result)
    })

    // circle2
    let clickImg1 = document.querySelector(".w-container .img .imgcircle1")
    let h2Text1 = document.querySelector(".w-container .tittle2")

    clickImg1.addEventListener("click",function(){
      h2Text.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
      let result =   h2Text1.innerHTML = "Scoor geweldige deals in de Stallhall";

    })

     // circle3
     let clickImg2 = document.querySelector(".w-container .img .imgcircle2")
    let h2Text2 = document.querySelector(".w-container .tittle3")

    clickImg2.addEventListener("click",function(){
      h2Text.innerHTML = " ";
      h2Text1.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
      let result =   h2Text2.innerHTML = "Neem een kijkje achter de schermen bij deelnemende bedrijven in de Moviehall";

    })

      // circle4
      let clickImg3 = document.querySelector(".w-container .img .imgcircle3")
      let h2Text3 = document.querySelector(".w-container .tittle4")

    clickImg3.addEventListener("click",function(){
      h2Text.innerHTML = " ";
      h2Text1.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
      let result =   h2Text3.innerHTML = "Tijdens elk event maak je kans op waanzinnige prijzen.";

    })

        // circle5
      let clickImg4 = document.querySelector(".w-container .img .imgcircle4")
      let h2Text4 = document.querySelector(".w-container .tittle5")

    clickImg4.addEventListener("click",function(){
      h2Text.innerHTML = " ";
      h2Text1.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text3.innerHTML = " ";
      let result =   h2Text4.innerHTML = "Service vinden wij belangrijk, en daarom zijn wij gedurende elk evenement beschikbaar om al jouw vragen te beantwoorden.";

    })
  </script>

  @if(session('destroy'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
  <script>
        $(document).ready(function () {
            Swal.fire({
                icon: "info",
                title: "{{ session('destroy') }}",
                showConfirmButton: false,
                timer: 5000
            });
        });
  </script>
  @endif
  @endpush
