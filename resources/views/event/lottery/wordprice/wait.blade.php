@extends('layouts.event')
@section('wfdata', '61cb13f18d5b3f18e46c2eec')
@section('title', 'Letters Vinden voor een prijs!')
@section('content')
<div class="normal-section wf-section">
  <div class="container minh center vertical w-container">
    <h2 data-w-id="7116d730-3258-f43e-6228-f2e1d6ba31af">Bedankt voor je inzending!</h2>
    {{-- <h3 style="text-align: center">We gaan je antwoord controleren, je krijgt om {{$wordprice->release_time}} te horen of dat je {{$wordprice->p1}} @if(!empty($wordprice->p2)), {{$wordprice->p2}}@endif @if(!empty($wordprice->p2))of {{$wordprice->p3}}@endif gewonnen hebt.</h3> --}}
    {{-- <h3 style="text-align: center">Bedankt voor je inzending! Als je een prijs hebt gewonnen, ontvang je hierover bericht via e-mail.</h3> --}}
    <h3 style="text-align: center">Als je een prijs hebt gewonnen, ontvang je hierover een bericht per e-mail.
    </h3>
  </div>
</div>
@endsection
