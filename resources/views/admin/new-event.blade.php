@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container bmarge w-container">
  <h1 class="dark">Event aanmaken</h1>
    <form action="new" method="post" enctype="multipart/form-data">
      @csrf
      <h2>Algemeen</h2>
      <label for="name">Event naam</label>
      <input type="text" class="w-input" maxlength="256" name="name" required="">
      <label for="field">Beschrijving event</label>
      <textarea maxlength="5000" name="desc" required="" class="w-input"></textarea>
      <label for="field">Evenementinformatie</label>
      <textarea maxlength="5000" name="information" required="" class="w-input"></textarea>
      <label for="email">Ticket prijs</label>
      <input type="number" class="w-input" step="0.01" maxlength="256" name="price" required="">
      <label for="email-2">Event Logo</label>
      <input type="file" class="w-input" name="logo" required="">
      <label for="email-2">Event Thumbnail</label>
      <input type="file" class="w-input" name="thumbnail" required="">
      <label for="email-2">Max. Tickets</label>
      <input type="number" class="w-input" name="tickets" required="">
      <label for="name">Dag van event</label>
      <input type="date" class="w-input" maxlength="256" name="day" required="">
      <label for="name">Event start om</label>
      <input type="time" class="w-input" maxlength="256" name="start-time" required="">
      <label for="email-3">Event eindigt om</label>
      <input type="time" class="w-input" maxlength="256" name="end-time" required="">
      <label style="margin: 20px 0px">Auctionhall gesloten? &nbsp;
          <input type="checkbox" maxlength="256" name="auction_hall_closed">
      </label>
      <div class="woordprijs">
        <h2>Woordprijs</h2>
        <label for="name">Prijs</label>
        <input type="text" class="w-input" maxlength="256" name="wordprice" required="">
        <label for="name-6">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="wordprice-winners" required="">
        <label for="name">Prijs 2</label>
        <input type="text" class="w-input" maxlength="256" name="wordprice2" required="">
        <label for="name-6">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="wordprice-winners2" required="">
        <label for="name">Prijs 3</label>
        <input type="text" class="w-input" maxlength="256" name="wordprice3" required="">
        <label for="name-6">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="wordprice-winners3" required="">
        <label for="email-3">Woord</label>
        <input type="text" class="w-input" maxlength="256" name="word" required="">
        <label for="email-3">Onthulling om</label>
        <input type="time" class="w-input" maxlength="256" name="wordprice-reveal" required="">

      </div>
      <div class="woordprijs"> <!-- class also is for lottery -->
        <h2>Loterij</h2>
        <label for="name-7">Prijs naam</label>
        <input type="text" class="w-input" maxlength="256" name="lottery" required="">
        <label for="email-3">Onthulling om</label>
        <input type="time" class="w-input" maxlength="256" name="lottery-reveal" required="">
        <label for="name-7">Aantal winnaars</label>
        <input type="number" class="w-input" maxlength="256" name="lottery-winners" required="">
      </div>
      <input type="submit" value="Aanmaken" data-wait="Even geduld a.u.b..." class="button w-button">
    </form>
</div>
@endsection
