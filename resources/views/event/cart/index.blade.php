@extends('layouts.event')
@section('wfdata', '61cb0cf18c700143b8f1f856')
@section('title', 'Bestelling afronden - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container w-container">
    <div class="w-layout-grid checkout-gr">
      <div class="checkout-form w-form">
        <h2>Je gegevens</h2>
        <form action="/prpay" method="POST">
          @csrf
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="first_name" required placeholder="Voornaam" value="{{$user->first_name}}">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="last_name" required placeholder="Achternaam" value="{{$user->last_name}}"></div>
          <div class="double"><input type="email" class="text-field w-input" maxlength="256" name="email" required placeholder="E-Mail" value="{{$user->email}}">
            <input type="number" class="text-field dobule w-input" maxlength="256" name="phone" required placeholder="Telefoonnummer" ></div>
          <div class="double"><input type="text" style="text-transform: uppercase" class="text-field w-input" maxlength="256" required name="street" placeholder="Straat + nummer" value="{{$user->street}}">
            <input type="text" style="text-transform: uppercase" class="text-field dobule w-input" maxlength="256" name="zip" required placeholder="Postcode" value="{{$user->zip}}"></div>
          <div class="double"><input type="text" style="text-transform: uppercase" class="text-field w-input" maxlength="256" required name="town" data-name="Name 3" placeholder="Dorp/Stad" value="{{$user->town}}">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="country" required placeholder="Land" value="{{$user->country}}"></div>
            @if(!empty($products))<input type="submit" value="Afrekenen" data-wait="Please wait..." class="button w-button">@endif
        </form>
      </div>
      <div id="w-node-_63d068e1-c345-9561-249c-5c5dd51663c8-87ad2e9a" class="checkout-items">
        <h2>Dit heb je in je winkelmandje:</h2>
        <ul role="list" class="list w-list-unstyled">
          @if(empty($products))
          <li class="list-item w-clearfix">
            <div class="product-info">
              <div><strong class="black">Geen producten in winkelmandje!</strong></div>
            </div>
          </li>
          @else
          @foreach($products as $product)
          <li class="list-item w-clearfix">
            <div class="product-info">
              <div><strong class="black">{{$product['amount']}}x {{$product['name']}}</strong></div>
              <div class="product-information">Product verkocht door {{$product['vendor']}} </div>
            </div>
            <div class="product-numbers w-clearfix">
              <div class="text-block">€{{$product['price']}}</div>
              <a href="{{url('/')}}/event/{{$event->id}}/winkelwagen/delete?id={{$product['id']}}" class="delete">verwijderen</a>
            </div>
          </li>
          @endforeach
          @endif
        </ul>
        <div class="checkout-numbers w-clearfix">
          <div class="price-type">Winkelkosten</div>
          <div class="price-type price">{{$shipping_cost}}</div>
        </div>
        <div class="checkout-numbers w-clearfix">
          <div class="price-type">BTW</div>
          <div class="price-type price">€{{$tax}}</div>
        </div>
        <div class="checkout-numbers w-clearfix">
          <div class="price-type total">Totaal</div>
          <div class="price-type price total">€{{$total}}</div>
        </div>
        <div style="text-align: center">
          <img src="{{ asset('uploads/event-s/logos') }}/{{ $event->logo_url }}" alt="Event Logo" style="max-width: 200px">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
