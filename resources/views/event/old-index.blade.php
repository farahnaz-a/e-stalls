@extends('layouts.event')
@section('wfdata', '61c5ad968b3d4765bc7dafd0')
@section('title', 'Main Hall - E-STALLS')
@section('content')
  <div class="event-section wf-section" style="background-image: url('{{url('/')}}/images/event-bg-2.jpg'); background-size: cover">
    <div class="w-layout-grid main-event-grid" style="background-color: rgb(200,200,200,0.8);">
      <a id="w-node-_6f09ee66-5eac-a032-6ef2-0a3e51ec0c3f-bc7dafd0" href="{{url('/')}}/event/{{$event->id}}/stallhall" class="stall-hall-sign w-inline-block">
        <div class="hall-name" style="position:relative;z-index:1;">Stall Hall</div>
        <div class="stick right" style="z-index:0;"></div>
        <div class="stick" style="z-index:0;"></div>
      </a>

      <div id="w-node-_3194fb72-f4c8-1d05-a64b-5d802787abd2-bc7dafd0" class="helpdesk"><a href="{{ url('/') }}/contact"><img src="{{ url('/') }}/images/Artboard-2-2.png" loading="lazy" style="opacity:0" data-w-id="dffbde11-1096-b0c0-682d-daf5540bda1e" alt="" class="char"><img src="{{ url('/') }}/images/Group-56.png" loading="lazy" sizes="(max-width: 479px) 300px, 500px" srcset="{{ url('/') }}/images/Group-56.png 500w, {{ url('/') }}/images/Group-56.png 635w" alt="" class="balie"></a></div>

      <a id="w-node-acf13fc2-2b15-c5f4-ed5b-b3da784b267c-bc7dafd0" href="{{url('/')}}/event/{{$event->id}}/moviehall" class="side-hall-sign w-inline-block">
        <div class="sign-content">
          <div class="sign-logo"><img src="{{ $event->logo_url }}" loading="lazy" alt="" class="sign-image-logo">
            <div class="sign-logo-bg"></div>
          </div>
          <div class="hall-name normal"><strong class="purple">Movie</strong><br>Hall</div>
        </div>
      </a>
      <a id="w-node-_940941b2-3913-945b-2348-abc9d2c79b36-bc7dafd0" href="{{url('/')}}/event/{{$event->id}}/auctionhall" class="side-hall-sign right w-inline-block">
        <div class="sign-content">
          <div class="sign-logo"><img src="{{ $event->logo_url }}" loading="lazy" alt="" class="sign-image-logo">
            <div class="sign-logo-bg"></div>
          </div>
          <div class="hall-name normal"><strong class="purple smaller">Auction</strong><br>Hall</div>
        </div>
      </a>
      <div id="w-node-_690588d0-a708-743d-7209-afacd07cb1f6-bc7dafd0" class="lottery">
        <a data-w-id="adbd5de5-2e04-02bf-8460-3bda86198da3" href="{{url('/')}}/event/{{$event->id}}/loterij" class="link-block-2 w-inline-block">
          <div data-w-id="082292c3-0851-4608-76f5-cec08d1401a0" data-animation-type="lottie" data-src="{{url('/')}}/documents/lf30_editor_roudr7xq.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-default-duration="10" data-duration="0" class="lottie-animation"></div>
          <div class="loterij-sign">LOTERIJ</div>
        </a>
      </div>
    </div>
  </div>
  <div class="section wf-section">
    <div class="container w-container">
      <div data-delay="4000" data-animation="slide" class="logo-carousel w-slider" data-autoplay="true" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
        <div class="w-slider-mask">
          @foreach($ads as $ad)
          <div class="logo w-slide">
            <a href="{{$ad->redirect_url}}" style="max-width: 90%;" class="logo-block w-inline-block"><img src="{{$ad->logo_url}}" loading="lazy" alt=""></a>
          </div>
          @endforeach
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
