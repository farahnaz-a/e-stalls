@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container bmarge w-container">
  <h1 class="dark">Pop-Up Prijs aanmaken</h1>
    <form action="update" method="post" enctype="multipart/form-data">
      @csrf
      <div class="woordprijs"> <!-- class also is for popup -->
        <input type="hidden" name="id" value="{{$popup->id}}">
        <label for="name-7">Prijs naam</label>
        <input type="text" class="w-input" maxlength="256" name="name" required="" value="{{$popup->price_name}}">
        <label for="name-7">Wat bevat de prijs?</label>
        <input type="text" class="w-input" maxlength="256" name="contents" required="" value="{{$popup->contents}}">
        <label for="name-7">Hoeveel max. weggeven?</label>
        <input type="number" class="w-input" name="stock" required="" value="{{$popup->stock}}">
        <label for="name-7">Wat is de kans (0-100) ? - kans op basis van paginabezoek</label>
        <input type="number" class="w-input" name="chance" required="" value="{{$popup->chance}}">
        <select name="eventID" class="text-field nomaxw w-select" required="">
          {{-- <option value="{{$popup->eventID}}">{{$events->find($popup->eventID)->name}}</option> --}}
          <option value="">Kies event..</option>
          @foreach($events as $event)
          <option value="{{$event->id}}">{{$event->name}}</option>
          @endforeach
        </select>
      </div>
      <input type="submit" value="Bijwerken" data-wait="Even geduld a.u.b..." class="button w-button">
    </form>
</div>
@endsection
