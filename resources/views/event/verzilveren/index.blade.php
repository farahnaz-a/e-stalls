@extends('layouts.main')

@section('wfdata', '61c349db3abf43443c5ed475')

@section('title', 'Verzilver je ' . $event->name . 'ticket!')

@section('content')
  <div class="normal-section wf-section">
    <div class="container w-container">
      <h2 class="centered"><strong>Verzilver </strong>je ticket om deel te nemen aan {{ $event->name }}</h2>
      <div>
        <form method="post" action="{{ url('/authticket') }}" class="form">
          @csrf
          <div data-w-id="a73a5a52-482a-46f5-8070-07b252134c0d" class="ticket">
            <div class="ticket-logo-part">
              {{-- <div class="blur"></div> --}}
              <img src="{{ asset('uploads/event-s/logos') }}/{{ $event->logo_url }}" loading="lazy" width="346" alt="" class="ticket-event-logo">
            </div>
            <div class="ticket-content-part">
              <div class="div-block w-clearfix">
                <div class="event-name dark">{{ $event->name }}</div>
                <div class="date">{{ Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</div>
                <div class="date time">Om {{ $event->start_time }}</div>
              </div><label for="name" class="unieke-code">Unieke code:</label>
              <input type="text" class="code-field w-input" minlength="15" maxlength="15" name="ticketID" placeholder="000-000-000-000">
              <input type="hidden" name="eventID" value="{{ $event->id }}">
            </div>
            <div class="ticket-fake-barcode"></div>
          </div>
          <div class="centered"><input type="submit" value="Event bezoeken" data-wait="Please wait..." class="button w-button"></div>
        </form>
      </div>
    </div>
  </div>
  @endsection
