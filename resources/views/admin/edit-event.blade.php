@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container bmarge w-container">
  <h1 class="dark">Event aanmaken</h1>
    <form action="update" method="post" enctype="multipart/form-data">
      @csrf
      <h2>Algemeen</h2>
      <label for="name">Event naam</label>
      <input type="text" class="w-input" maxlength="256" name="name" required="" value="{{ $event_name }}">
      <input type="hidden" name="eventID" value="{{ $eventID }}">
      <label for="field">Beschrijving event</label>
      <textarea maxlength="5000" name="desc" required="" class="w-input">{{ $event_description }}</textarea>
      <label for="field">Evenementinformatie</label>
      <textarea maxlength="5000" name="information" required="" class="w-input">{{ $event_information }}</textarea>
      <label for="email">Ticket prijs</label>
      <input type="number" class="w-input" maxlength="256" step="0.01" name="price" required="" value="{{ $ticket_price }}">
      <label for="email-2">Event Logo</label>
      <input type="file" class="w-input" name="logo" onchange="document.getElementById('event-logo').src = window.URL.createObjectURL(this.files[0])">
      <div style="margin-bottom: 8px;">
        <img @if($event_logo_url) src="{{ asset('uploads/event-s/logos') }}/{{ $event_logo_url }}" @endif width="100px" id="event-logo">
      </div>
      <label for="email-2">Event Thumbnail</label>
      <input type="file" class="w-input" name="thumbnail" onchange="document.getElementById('event-thumbnail').src = window.URL.createObjectURL(this.files[0])">
      <div style="margin-bottom: 8px;">
        <img @if($event_thumbnail_url) src="{{ asset('uploads/event-s/thumbnails') }}/{{ $event_thumbnail_url }}" @endif width="100px" id="event-thumbnail">
      </div>
      <label for="email-2">Max. Tickets</label>
      <input type="number" class="w-input" name="tickets" required="" value="{{ $max_tickets }}">
      <label for="name">Dag van event</label>
      <input type="date" class="w-input" maxlength="256" name="day" required="" value="{{ $date }}">
      <label for="name">Event start om</label>
      <input type="time" class="w-input" maxlength="256" name="start-time" required="" value="{{ $start_time }}">
      <label for="email-3">Event eindigt om</label>
      <input type="time" class="w-input" maxlength="256" name="end-time" required="" value="{{ $end_time }}">
      <label style="margin: 20px 0px">Auctionhall gesloten? &nbsp;
          <input type="checkbox" maxlength="256" name="auction_hall_closed" {{ $auction_hall_closed ? "checked":'' }}>
      </label>
      <div class="woordprijs">
        <h2>Woordprijs</h2>
        <label for="name">Prijs</label>
        <input type="text" class="w-input" maxlength="256" name="wordprice" required="" value="{{ $wordprice }}">
        <label for="name-6">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="wordprice-winners" required="" value="{{ $wordprice_winners }}">
        <label for="name">Prijs 2</label>
        <input type="text" class="w-input" maxlength="256" name="wordprice2" required="" value="{{ $wordprice2 }}">
        <label for="name-6">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="wordprice-winners2" required="" value="{{ $wordprice_winners2 }}">
        <label for="name">Prijs 3</label>
        <input type="text" class="w-input" maxlength="256" name="wordprice3" required="" value="{{ $wordprice3 }}">
        <label for="name-6">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="wordprice-winners3" required="" value="{{ $wordprice_winners3 }}">
        <label for="email-3">Woord</label>
        <input type="text" class="w-input" maxlength="256" name="word" required="" value="{{ $word }}">
        <label for="email-3">Onthulling om</label>
        <input type="time" class="w-input" maxlength="256" name="wordprice-reveal" required="" value="{{ $wordprice_reveal }}">
        <label>Afbeelding</label>
        <input type="file" class="w-input" name="woordprice_image" onchange="document.getElementById('woordprice_image').src = window.URL.createObjectURL(this.files[0])">
        <div style="margin-bottom: 8px;">
          <img @if($woordprice_image) src="{{ asset('uploads/event-s/woordprice_images') }}/{{ $woordprice_image }}" @endif width="100px" id="woordprice_image">
        </div>
      </div>
      <div class="woordprijs"> <!-- class also is for lottery -->
        <h2>Loterij</h2>
        <label for="name-7">Prijs naam</label>
        <input type="text" class="w-input" maxlength="256" name="lottery" required="" value="{{ $lottery }}">
        <label for="email-3">Onthulling om</label>
        <input type="time" class="w-input" maxlength="256" name="lottery-reveal" required="" value="{{ $lottery_reveal }}">
        <label for="name-7">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="lottery-winners" required="" value="{{ $lottery_winners }}">
        <label>Afbeelding</label>
        <input type="file" class="w-input" name="loterij_image" onchange="document.getElementById('loterij_image').src = window.URL.createObjectURL(this.files[0])">
        <div style="margin-bottom: 8px;">
          <img @if($loterij_image) src="{{ asset('uploads/event-s/loterij_images') }}/{{ $loterij_image }}" @endif width="100px" id="loterij_image">
        </div>
      </div>
      <input type="submit" value="Bijwerken" data-wait="Even geduld a.u.b..." class="button w-button">
    </form>
</div>
@endsection
