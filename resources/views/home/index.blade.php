
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

.w-container .imgcircle,.w-container .imgcircle1,.w-container .imgcircle2,
.w-container .imgcircle3,.w-container .imgcircle4{
    position: absolute;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
}

.w-container .tittle1,.w-container .tittle2,.w-container .tittle3,.w-container .tittle4
,.w-container .tittle5{
    text-align: center;
    position: absolute;

}

.w-container .hideImg  p {
    background: #932e7f;
    padding: 0px 20px;
    line-height: 25px;
    font-family: Nunito Sans, sans-serif;
    border-radius: 5px;
    color: #fff;
    font-weight: 700;
}

.w-container .tittle1 svg,.w-container .tittle2 svg,.w-container .tittle3 svg,.w-container .tittle4 svg
,.w-container .tittle5 svg{
    position: absolute;
    fill: #932e7f;
    width: 90px;
    height: 90px;
}

.w-container .tittle1 svg {
    left: 149px;
    top: -18px;
}

.w-container .tittle2 svg {
    left: 164px;
    top: -18px;
}

.w-container .tittle3 svg {
    left: 326px;
    top: -18px;
}

.w-container .tittle4 svg {
    left: 183px;
    top: -50px;
    transform: rotate(180deg);
}

.w-container .tittle5 svg {
    left: 366px;
    top: -50px;
    transform: rotate(180deg);
}

.w-container {
    position: relative;
}
.w-container .img{
    position: relative;
}

.w-container .tittle1 {
    left: 6%;
    top: 5%;
}

.w-container .tittle2 {
    left: 25%;
    top: 5%;
}

.w-container .tittle3 {
    left: 30%;
    top: 5%;
    /* width: 72%; */
}

.w-container .tittle4 {
    left: 47%;
    top: 99%;
    /* width: 80%; */
}

.w-container .tittle5 {
    left: 0;
    top: 99%;
    width: 85%;
}

.w-container .imgcircle {
    left: 25.5%;
    top: 22.7%;
    height: 25px;
    width: 23px;
}

.w-container .imgcircle1 {
    left: 46.1%;
    top: 12.5%;
    height: 25px;
    width: 23px;
}

.w-container .imgcircle2 {
    left: 68.3%;
    top: 16.5%;
    height: 25px;
    width: 23px;
}

.w-container .imgcircle3 {
    left: 69.8%;
    top: 89.1%;
    height: 25px;
    width: 23px;
}

.w-container .imgcircle4 {
    left: 42.5%;
    top: 89.1%;
    height: 25px;
    width: 23px;
}



@media (min-width: 0) and (max-width: 349px) {
   .w-container .img1  {
    display: block;
   }

   .w-container .hideImg .img {
    display: none;
   }
  }
@media (min-width: 768px) and (max-width: 991px){

.w-container .tittle1 svg {
    left: 121px;
    top: -18px;
}
.w-container .tittle2 svg {
    left: 117px;
    top: -18px;
}

.w-container .tittle3 svg {
    left: 264px;
    top: 10px;
}

.w-container .tittle4 svg {
    left: 312px;
    top: -50px;
    transform: rotate(180deg);
}

.w-container .tittle5 svg {
    left: 244px;
    top: -50px;
    transform: rotate(180deg);
}


.w-container .imgcircle {
    position: absolute;
    left: 25.5%;
    top: 22.8%;
    height: 18px;
    width: 18px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
}

.w-container .imgcircle1 {
    position: absolute;
    left: 46%;
    top: 12.5%;
    height: 18px;
    width: 18px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
}

.w-container .imgcircle2 {
    position: absolute;
    left: 68.3%;
    top: 16.5%;
    height: 18px;
    width: 18px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
}

.w-container .imgcircle3 {
    position: absolute;
    left: 69.8%;
    top: 89.1%;
    height: 18px;
    width: 18px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
}

.w-container .imgcircle4 {
    position: absolute;
    left: 42.5%;
    top: 89.1%;
    height: 18px;
    width: 18px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
}


.w-container .tittle1 {
    position: absolute;
    left: 4%;
    top: 4%;
}

.w-container .tittle2 {
    position: absolute;
    left: 25%;
    top: 3%;
}

.w-container .tittle3 {
    position: absolute;
    left: 27%;
    top: -1%;
    width: 72%;
}

.w-container .tittle4 {
    position: absolute;
    left: 22%;
    top: 99%;
    /* width: 80%; */
}

.w-container .tittle5 {
    position: absolute;
    left: 4%;
    top: 99%;
    /* width: 90%; */
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

@media (min-width: 576px) and (max-width: 660px){
.w-container .tittle1 svg,.w-container .tittle2 svg,.w-container .tittle3 svg,.w-container .tittle4 svg
,.w-container .tittle5 svg{
    position: absolute;
    fill: #932e7f;
    width: 80px;
    height: 90px;
}

.w-container .tittle1 svg {
    left: 128px;
    top: -17px;
    transform: rotate(13deg);
}

.w-container .tittle2 svg {
    left: 113px;
    top: -17px;
    transform: rotate(13deg);
}

.w-container .tittle3 svg {
    left: 239px;
    top: 7px;
    transform: rotate(13deg);
}

.w-container .tittle4 svg {
    left: 286px;
    top: -49px;
    transform: rotate(171deg);
}

.w-container .tittle5 svg {
    left: 223px;
    top: -48px;
    transform: rotate(167deg);
}

.w-container .imgcircle,.w-container .imgcircle1,.w-container .imgcircle2,
.w-container .imgcircle3,.w-container .imgcircle4{
    height: 15px;
    width: 15px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
}

.w-container .tittle1,.w-container .tittle2,.w-container .tittle3,.w-container .tittle4
,.w-container .tittle5{
    position: absolute;
    text-align: center;
}

.w-container .imgcircle {
    left: 25.5%;
    top: 22.9%;
}

.w-container .imgcircle1 {
    left: 46.1%;
    top: 12.6%;
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
    left: 4%;
    top: 3%;
}

.w-container .tittle2 {
    left: 25%;
    top: 2%;
}

.w-container .tittle3 {
    left: 28%;
    top: -3%;
    /* width: 72%; */
}

.w-container .tittle4 {
    position: absolute;
    left: 22%;
    top: 99%;
    /* width: 80%; */
}

.w-container .tittle5 {
    left: 5%;
    top: 99%;
    /* width: 85%; */
}

.w-container .img1 img{
    display: none;
}

.w-container .hideImg img{
    display: block;
}
}


@media (min-width: 661px) and (max-width: 767px){

.w-container .imgcircle,.w-container .imgcircle1,.w-container .imgcircle2,
.w-container .imgcircle3,.w-container .imgcircle4{
    height: 16px;
    width: 16px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
}

.w-container .tittle1,.w-container .tittle2,.w-container .tittle3,.w-container .tittle4
,.w-container .tittle5{
    position: absolute;
    text-align: center;
}

.w-container .tittle1 svg,.w-container .tittle2 svg,.w-container .tittle3 svg,.w-container .tittle4 svg
,.w-container .tittle5 svg{
    position: absolute;
    fill: #932e7f;
    width: 80px;
    height: 90px;
}

.w-container .tittle1 svg {
    left: 142px;
    top: -18px;
    transform: rotate(16deg);
}

.w-container .tittle2 svg {
    left: 140px;
    top: -18px;
    transform: rotate(15deg);
}

.w-container .tittle3 svg {
    left: 294px;
    top: 7px;
    transform: rotate(15deg);
}

.w-container .tittle4 svg {
    left: 288px;
    top: -48px;
    transform: rotate(193deg);
}

.w-container .tittle5 svg {
    left: 244px;
    top: -48px;
    transform: rotate(167deg);
}

.w-container .imgcircle {
    left: 25.6%;
    top: 22.7%;
    height: 17.5px !important;
    width: 17.5px !important;
}

.w-container .imgcircle1 {
    left: 46.2%;
    top: 12.8%;
}

.w-container .imgcircle2 {
    left: 68.4%;
    top: 16.6%;
}

.w-container .imgcircle3 {
    left: 69.9%;
    top: 89.4%;
}

.w-container .imgcircle4 {
    left: 42.6%;
    top: 89.3%;
}


.w-container .tittle1 {
    left: 4%;
    top: 2%;
}

.w-container .tittle2 {
    left: 25%;
    top: 2%;
}

.w-container .tittle3 {
    left: 26%;
    top: -3%;
    /* width: 54%; */
}

.w-container .tittle4 {
    left: 20%;
    top: 99%;
    /* width: 80%; */
}

.w-container .tittle5 {
    left: 5%;
    top: 99%;
    /* width: 86%; */
}

.w-container .img1 img{
    display: none;
}

.w-container .hideImg img{
    display: block;
}
}

@media (min-width: 500px) and (max-width: 575px){
.w-container .tittle1 svg,.w-container .tittle2 svg,.w-container .tittle3 svg,.w-container .tittle4 svg
,.w-container .tittle5 svg{
    position: absolute;
    fill: #932e7f;
    width: 80px;
    height: 90px;
}

.w-container .tittle1 svg {
    left: 96px;
    top: -17px;
    transform: rotate(13deg);
}

.w-container .tittle2 svg {
    left: 91px;
    top: -17px;
    transform: rotate(13deg);
}

.w-container .tittle3 svg {
    left: 203px;
    top: 7px;
    transform: rotate(13deg);
}

.w-container .tittle4 svg {
    left: 258px;
    top: -49px;
    transform: rotate(171deg);
}

.w-container .tittle5 svg {
    left: 216px;
    top: -48px;
    transform: rotate(167deg);
}

.w-container .imgcircle,.w-container .imgcircle1,.w-container .imgcircle2,
.w-container .imgcircle3,.w-container .imgcircle4{
    height: 16px;
    width: 16px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
}

.w-container .tittle1,.w-container .tittle2,.w-container .tittle3,.w-container .tittle4
,.w-container .tittle5{
    position: absolute;
    text-align: center;
}

.w-container .imgcircle {
    left: 25.2%;
    top: 22.6%;
}

.w-container .imgcircle1 {
    left: 45.7%;
    top: 12.3%;
}

.w-container .imgcircle2 {
    left: 68%;
    top: 16.2%;
}

.w-container .imgcircle3 {
    left: 69.5%;
    top: 89.2%;
}


.w-container .imgcircle4 {
    left: 42.2%;
    top: 89%;
}

.w-container h2{
    font-size: 18px;
}


.w-container .tittle1 {
    left: 4%;
    top: 3%;
}

.w-container .tittle2 {
    left: 25%;
    top: 0%;
}

.w-container .tittle3 {
    left: 28%;
    top: -6%;
    /* width: 72%; */
}

.w-container .tittle4 {
    left: 20%;
    top: 99%;
    /* width: 80%; */
}



.w-container .img1 img{
    display: none;
}

.w-container .hideImg img{
    display: block;
}
}

@media (min-width: 440px) and (max-width: 446px){
    .w-container .tittle1 svg {
    left: 70px !important;
    top: 7px !important;
    transform: rotate(13deg) !important;
}

.w-container .tittle1 {
    left: 4% !important;
    top: -8% !important;
}

}

@media (min-width: 440px) and (max-width: 459px){
.w-container .tittle3 svg {
    left: 155px !important;
    top: 32px !important;
    transform: rotate(13deg) !important;
}

.w-container .tittle3 {
    left: 28% !important;
    top: -17% !important;
    /* width: 72%; */
}

}

@media (min-width: 440px) and (max-width: 499px){
.w-container .tittle1 svg,.w-container .tittle2 svg,.w-container .tittle3 svg,.w-container .tittle4 svg
,.w-container .tittle5 svg{
    position: absolute;
    fill: #932e7f;
    width: 80px;
    height: 90px;
}

.w-container .tittle1 svg {
    left: 79px;
    top: -17px;
    transform: rotate(13deg);
}

.w-container .tittle2 svg {
    left: 76px;
    top: -17px;
    transform: rotate(13deg);
}

.w-container .tittle3 svg {
    left: 176px;
    top: 7px;
    transform: rotate(13deg);
}

.w-container .tittle4 svg {
    left: 239px;
    top: -49px;
    transform: rotate(171deg);
}

.w-container .tittle5 svg {
    left: 150px;
    top: -48px;
    transform: rotate(167deg);
}

.w-container .imgcircle,.w-container .imgcircle1,.w-container .imgcircle2,
.w-container .imgcircle3,.w-container .imgcircle4{
    height: 13.5px;
    width: 13.5px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
}

.w-container .tittle1,.w-container .tittle2,.w-container .tittle3,.w-container .tittle4
,.w-container .tittle5{
    position: absolute;
    text-align: center;
}

.w-container .imgcircle {
    left: 25.5%;
    top: 22.5%;
}

.w-container .imgcircle1 {
    left: 46%;
    top: 12.2%;
}

.w-container .imgcircle2 {
    left: 68.2%;
    top: 16.2%;
}

.w-container .imgcircle3 {
    left: 69.6%;
    top: 89%;
}

.w-container .imgcircle4 {
    left: 42.5%;
    top: 89.2%;
}

.w-container h2{
    font-size: 18px;
}


.w-container .tittle1 {
    left: 4%;
    top: 2%;
}

.w-container .tittle2 {
    left: 25%;
    top: -1%;
}

.w-container .tittle3 {
    left: 28%;
    top: -9%;
    /* width: 72%; */
}

.w-container .tittle4 {
    left: 16%;
    top: 103%;
    /* width: 80%; */
}

.w-container .tittle5 {
    left: 7%;
    top: 99%;
    width: 88%;
}

.w-container .img1 img{
    display: none;
}

.w-container .hideImg img{
    display: block;
}
}

@media (min-width: 375px) and (max-width: 421px){
.w-container .tittle2 svg {
    left: 61px !important;
    top: 7px !important;
    transform: rotate(13deg) !important;
}

.w-container .tittle2 {
    left: 25% !important;
    top: -16% !important;
}

}

@media (min-width: 375px) and (max-width: 439px){

.w-container .tittle1 svg,.w-container .tittle2 svg,.w-container .tittle3 svg,.w-container .tittle4 svg
,.w-container .tittle5 svg{
    position: absolute;
    fill: #932e7f;
    width: 80px;
    height: 90px;
}

.w-container .tittle1 svg {
    left: 67px;
    top: 7px;
    transform: rotate(13deg);
}

.w-container .tittle2 svg {
    left: 62px;
    top: -17px;
    transform: rotate(13deg);
}

.w-container .tittle3 svg {
    left: 151px;
    top: 32px;
    transform: rotate(13deg);
}

.w-container .tittle4 svg {
    left: 188px;
    top: -49px;
    transform: rotate(171deg);
}

.w-container .tittle5 svg {
    left: 150px;
    top: -48px;
    transform: rotate(167deg);
}

.w-container .imgcircle,.w-container .imgcircle1,.w-container .imgcircle2,
.w-container .imgcircle3,.w-container .imgcircle4{
    height: 11.5px;
    width: 11.5px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
}

.w-container .tittle1,.w-container .tittle2,.w-container .tittle3,.w-container .tittle4
,.w-container .tittle5{
    position: absolute;
    text-align: center;
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
    left: 68.2%;
    top: 16.5%;
}

.w-container .imgcircle3 {
    left: 69.8%;
    top: 89.2%;
}

.w-container .imgcircle4 {
    left: 42.4%;
    top: 89%;
}

.w-container h2{
    font-size: 18px;
}


.w-container .tittle1 {
    left: 4%;
    top: -10%;
}

.w-container .tittle2 {
    left: 25%;
    top: -3%;
}

.w-container .tittle3 {
    left: 28%;
    top: -23%;
    /* width: 72%; */
}

.w-container .tittle4 {
    left: 20%;
    top: 102%;
    /* width: 80%; */
}

.w-container .tittle5 {
    left: 7%;
    top: 105%;
    width: 88%;
}

.w-container .img1 img{
    display: none;
}

.w-container .hideImg img{
    display: block;
}
}

@media (min-width: 350px) and (max-width: 374px){

.w-container .tittle1 svg,.w-container .tittle2 svg,.w-container .tittle3 svg,.w-container .tittle4 svg
,.w-container .tittle5 svg{
    position: absolute;
    fill: #932e7f;
    width: 80px;
    height: 90px;
}

.w-container .tittle1 svg {
    left: 52px;
    top: 7px;
    transform: rotate(13deg);
}

.w-container .tittle2 svg {
    left: 49px;
    top: 8px;
    transform: rotate(13deg);
}

.w-container .tittle3 svg {
    left: 119px;
    top: 32px;
    transform: rotate(13deg);
}

.w-container .tittle4 svg {
    left: 157px;
    top: -49px;
    transform: rotate(171deg);
}

.w-container .tittle5 svg {
    left: 107px;
    top: -48px;
    transform: rotate(167deg);
}

.w-container .imgcircle,.w-container .imgcircle1,.w-container .imgcircle2,
.w-container .imgcircle3,.w-container .imgcircle4{
    height: 9.8px;
    width: 9.8px;
    background: red;
    border-radius: 50%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
}

.w-container .tittle1,.w-container .tittle2,.w-container .tittle3,.w-container .tittle4
,.w-container .tittle5{
    position: absolute;
    text-align: center;
}

.w-container .imgcircle {
    left: 25.5%;
    top: 22.5%;
}

.w-container .imgcircle1 {
    left: 46%;
    top: 12.2%;
}

.w-container .imgcircle2 {
    left: 68.2%;
    top: 16.3%;
}

.w-container .imgcircle3 {
    left: 69.9%;
    top: 89.4%;
}

.w-container .imgcircle4 {
    left: 42.5%;
    top: 89.5%;
}

.w-container h2{
    font-size: 18px;
}


.w-container .tittle1 {
    left: 4%;
    top: -14%;
}

.w-container .tittle2 {
    left: 25%;
    top: -22%;
}

.w-container .tittle3 {
    left: 28%;
    top: -26%;
    /* width: 72%; */
}

.w-container .tittle4 {
    left: 20%;
    top: 102%;
    /* width: 80%; */
}

.w-container .tittle5 {
    left: 7%;
    top: 105%;
    width: 88%;
}

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
            <div class="tooltip"></div>
            <p class="tittle1"></p>
            <p class="tittle2"></p>
            <p class="tittle3"></p>
            <p class="tittle4"></p>
            <p class="tittle5"></p>
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
    let tootTip = document.querySelector(".w-container .tooltip")
    clickImg.addEventListener("click",function(event){
      h2Text1.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";

      let result =   h2Text.innerHTML = 'Bepaal zelf de prijs voor je product in de Auctionhall <svg xmlns="#" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/></svg>';
      event.stopPropagation();
    })

    // circle2
    let clickImg1 = document.querySelector(".w-container .img .imgcircle1")
    let h2Text1 = document.querySelector(".w-container .tittle2")

    clickImg1.addEventListener("click",function(event){
      h2Text.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
      let result =   h2Text1.innerHTML = 'Scoor geweldige deals in de Stallhall <svg xmlns="#" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/></svg>';
      event.stopPropagation();
    })

     // circle3
     let clickImg2 = document.querySelector(".w-container .img .imgcircle2")
    let h2Text2 = document.querySelector(".w-container .tittle3")

    clickImg2.addEventListener("click",function(event){
      h2Text.innerHTML = " ";
      h2Text1.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
      let result =   h2Text2.innerHTML = 'Neem een kijkje achter de schermen bij deelnemende bedrijven in de Moviehall <svg xmlns="#" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/></svg>';
      event.stopPropagation();

    })

      // circle4
      let clickImg3 = document.querySelector(".w-container .img .imgcircle3")
      let h2Text3 = document.querySelector(".w-container .tittle4")

    clickImg3.addEventListener("click",function(event){
      h2Text.innerHTML = " ";
      h2Text1.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
      let result =   h2Text3.innerHTML = 'Tijdens elk event maak je kans op waanzinnige prijzen. <svg xmlns="#" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/></svg>';
      event.stopPropagation();

    })

        // circle5
      let clickImg4 = document.querySelector(".w-container .img .imgcircle4")
      let h2Text4 = document.querySelector(".w-container .tittle5")

    clickImg4.addEventListener("click",function(event){
      h2Text.innerHTML = " ";
      h2Text1.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text3.innerHTML = " ";
      let result =   h2Text4.innerHTML = 'Service vinden wij belangrijk, en daarom zijn wij gedurende elk evenement beschikbaar om al jouw vragen te beantwoorden. <svg xmlns="#" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/></svg>';
      event.stopPropagation();

    })

    const allBody = document.querySelector("body");

    allBody.addEventListener('click', (event) => {
      h2Text.innerHTML = " ";
      h2Text1.innerHTML = " ";
      h2Text2.innerHTML = " ";
      h2Text3.innerHTML = " ";
      h2Text4.innerHTML = " ";
  });

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
