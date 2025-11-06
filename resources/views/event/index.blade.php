
@extends('layouts.event')
@section('wfdata', '61c5ad968b3d4765bc7dafd0')
@section('title', 'Main Hall - E-STALLS')
@section('content')
<style>
  .section{
    position: static !important;
  }
</style>
  <div class="w-form-success" style="margin: 20px; display: {{ session('success') ? '':'none' }}">
    <div>{{ session('success') }}</div>
  </div>
  <div class="event-section res-depen wf-section">
    <div class="div-block-2">
      <a href="{{url('/')}}/event/{{$event->id}}/stallhall" class="stall-hall w-inline-block"></a>
      <a href="{{url('/')}}/event/{{$event->id}}/auctionhall" class="main-event-button auction w-inline-block"></a>
      <a href="{{ url('/') }}/contact" class="main-help-desk-button w-inline-block"></a>
      <a href="{{url('/')}}/event/{{$event->id}}/loterij" class="main-lottery-button w-inline-block"></a>
      <a href="{{url('/')}}/event/{{$event->id}}/moviehall" class="main-event-button w-inline-block"></a>
      <div class="image-4" data-w-id="400a1972-baca-887b-6111-416a95c1fc86" data-animation-type="lottie" data-src="{{url('')}}/documents/Exhibition-Hall-2.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-default-duration="4.733333333333333" data-duration="0"></div>
    </div>
  </div>
    <p style="margin: 10px 0 20px 60px;"><span id="time"></span></p>
    <p style="margin: 10px 0 20px 60px;" id="eventMessage"></p>
    <div class="section wf-section">
      <div class="container w-container">
        <div data-delay="3000" data-animation="slide" class="logo-carousel w-slider" data-autoplay="true" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
          <div class="w-slider-mask">
            @foreach($ads as $ad)
              <div class="logo w-slide">
                <a href="#" target="_blank" class="logo-block w-inline-block"><img src="{{ asset('uploads/vendor/logoad') }}/{{ $ad->logo_url }}" loading="lazy" alt="" height="140" width="210" style="object-fit: cover;"></a>
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
