@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container w-container">
  <h1 class="dark">Prijzen</h1>
  <a style="margin-bottom: 10px; background-color:green;" href="prices/popup/add" class="button w-button">Nieuwe Pop-Up Prijs</a>
  <a style="margin-bottom: 10px;" href="{{url('admin/goodiebag/popup/prices/add')}}" class="button gradient w-button">Nieuwe Goodiebag Prijs</a>
  <ul role="list" class="dashboard-list w-list-unstyled">
    @foreach($popup_prices as $popup_price)
    <li class="dashboard-list-item w-clearfix">
      <div class="list-item-data">
        <div class="important">Prijs: {{$popup_price->price_name}}</div>
        <div class="light">Voorraad: {{$popup_price->stock}}</div>
        <div class="light">Voor event: {{$events->find($popup_price->eventID)->name}}</div>
        <div class="light">Kansindicatie: {{$popup_price->chance}} (%/paginabezoek)</div>
      </div>
      <div class="list-item-action">
        <a href="prices/popup/{{$popup_price->id}}" class="button w-button">bewerken</a>
        <a href="prices/popup/{{$popup_price->id}}/delete" class="button gradient w-button">verwijderen</a>
      </div>
    </li>
    @endforeach
  </ul>
</div>
@endsection
