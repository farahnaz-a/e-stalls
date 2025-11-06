@extends('layouts.event')
@section('wfdata', '61fba1ebd8aaa339c8c1949b')
@section('title', 'Auction Hall - E-STALLS')
@section('content')
<div class="event-bar auction-hall wf-section">
  <div class="container w-container">
    <h1 class="hall-heading">{{ $title }}</h1>
  </div>
</div>
<div class="stall-products wf-section">
  <div class="container w-container">

    <div class="centered">

      {{-- <img src="{{asset('public/auctions/close-auctions.png')}}" alt="Close" loading="Lazy"> --}}
      <h3 class="">
        Evenement is afgelopen.</h3>
    </div>
  </div>
</div>
@endsection
