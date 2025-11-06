@extends('layouts.event')
@section('wfdata', '61cb0ac843a75680ddd38e86')
@section('title', 'Loterij 🤩 - E-STALLS')
@section('content')
<META HTTP-EQUIV="refresh" CONTENT="20">
<div class="normal-section wf-section">
  <div class="container w-container"></div>
  <div class="container minh center vertical w-container">
      <h2 data-w-id="7116d730-3258-f43e-6228-f2e1d6ba31af">De winnaar van de loterij wordt bekend gemaakt om  {{$lottery->release_time}} uur</h2>
      <h3>Prijs: {{$lottery->price_name}}</h3>
      @if ($lottery->image)
        <img style="width:250px;height:250px" src="{{ asset('uploads/event-s/loterij_images') }}/{{ $lottery->image }}">
      @endif
    <div data-w-id="ee32d42b-1df9-14fa-0b29-8c5792707e2e" class="numbers">
      <div class="num purple">
        <div class="lotnum">?</div>
      </div>
      <div class="num">
        <div class="lotnum">?</div>
      </div>
      <div class="num purple">
        <div class="lotnum">?</div>
      </div>
      <div class="num dash">
        <div class="lotnum">-</div>
      </div>
      <div class="num">
        <div class="lotnum">?</div>
      </div>
      <div class="num purple">
        <div class="lotnum">?</div>
      </div>
      <div class="num">
        <div class="lotnum">?</div>
      </div>
      <div class="num dash">
        <div class="lotnum">-</div>
      </div>
      <div class="num purple">
        <div class="lotnum">?</div>
      </div>
      <div class="num">
        <div class="lotnum">?</div>
      </div>
      <div class="num purple">
        <div class="lotnum">?</div>
      </div>
      <div class="num dash">
        <div class="lotnum">-</div>
      </div>
      <div class="num">
        <div class="lotnum">?</div>
      </div>
      <div class="num purple">
        <div class="lotnum">?</div>
      </div>
      <div class="num">
        <div class="lotnum">?</div>
      </div>
    </div>
  </div>
</div>
@endsection
