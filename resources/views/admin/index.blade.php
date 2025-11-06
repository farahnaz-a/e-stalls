@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container w-container">
  <h1 class="dark">Dag, Hillary!</h1>
  <h3>Overzicht van events:</h3>
  <div data-delay="4000" data-animation="cross" class="slider admin w-slider" data-autoplay="true" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
    <div class="mask w-slider-mask">
      @foreach ($events as $event)
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
            <div class="event-date">{{ date('d-m-Y',strtotime($event->start_date)) }}</div>
            <div class="event-name">{{ $event->name }}</div>
            @if(($event->max_tickets - $event->sell_count) > 0)
                <a href="{{url('/')}}/ticket-kopen/{{$event->id}}" class="button w-button">Bestel je tickets!</a>
            @else
                <a href="javascript:void(0)" class="button w-button">UITVERKOCHT</a>
            @endif
        </div>
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
  <!--
  <div class="information-block-holder">
    <h3>Ticket-omzet deze maand:</h3>
    <div class="omzet">€<strong class="positive">6000</strong></div>
  </div>
  <div class="information-block-holder">
    <h3>Omzet extra&#x27;s</h3>
    <div class="omzet">€<strong class="positive">2800</strong></div>
  </div>
-->
</div>
@endsection
