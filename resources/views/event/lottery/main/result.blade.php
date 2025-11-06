@extends('layouts.event')
@section('wfdata', '61cb0cf18c700143b8f1f856')
@section('title', 'Het resultaat is binnen! 🤩 - E-STALLS')
@section('content')
<div class="normal-section wf-section">
  <div data-w-id="a8e41c5d-e05a-1864-c586-271644f2f1a3" data-animation-type="lottie" data-src="{{url('/')}}/documents/17252-colorful-confetti.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-default-duration="10.01000960229397" data-duration="0" class="lottery-confetti"></div>
  <div class="container minh center vertical w-container">
      <h2 data-w-id="7116d730-3258-f43e-6228-f2e1d6ba31af">Alle lotnummers zijn binnen..</h2>
      <h2 data-w-id="9c591e51-bb09-9c68-c441-b9ed5c94e860" style="opacity:0;display:none">Het WINNENDE lotnummer:</h2>
      @if ($lottery->image)
        <img src="{{ asset('uploads/event-s/loterij_images') }}/{{ $lottery->image }}">
      @endif
    <div data-w-id="ee32d42b-1df9-14fa-0b29-8c5792707e2e" style="opacity:0" class="numbers">
      <div class="num purple">
        <div class="lotnum">{{$winning_ticket[0]}}</div>
      </div>
      <div class="num">
        <div class="lotnum">{{$winning_ticket[1]}}</div>
      </div>
      <div class="num purple">
        <div class="lotnum">{{$winning_ticket[2]}}</div>
      </div>
      <div class="num dash">
        <div class="lotnum">-</div>
      </div>
      <div class="num">
        <div class="lotnum">{{$winning_ticket[4]}}</div>
      </div>
      <div class="num purple">
        <div class="lotnum">{{$winning_ticket[5]}}</div>
      </div>
      <div class="num">
        <div class="lotnum">{{$winning_ticket[6]}}</div>
      </div>
      <div class="num dash">
        <div class="lotnum">-</div>
      </div>
      <div class="num purple">
        <div class="lotnum">{{$winning_ticket[8]}}</div>
      </div>
      <div class="num">
        <div class="lotnum">{{$winning_ticket[9]}}</div>
      </div>
      <div class="num purple">
        <div class="lotnum">{{$winning_ticket[10]}}</div>
      </div>
      <div class="num dash">
        <div class="lotnum">-</div>
      </div>
      <div class="num">
        <div class="lotnum">{{$winning_ticket[12]}}</div>
      </div>
      <div class="num purple">
        <div class="lotnum">{{$winning_ticket[13]}}</div>
      </div>
      <div class="num">
        <div class="lotnum">{{$winning_ticket[14]}}</div>
      </div>
    </div>
  </div>
</div>
@endsection
