@extends('layouts.event')
@section('wfdata', '61fba61da630f92aab004bfd')
@section('title', 'Coupon - E-STALLS')
@section('content')
<section id="feature-section" class="feature-section wf-section">
  <div class="flex-container w-container">
    <div class="feature-image-mask"><img src="{{ asset('uploads/event-s/thumbnails') }}/{{ $coupon->image_url }}" alt="" class="feature-image"></div>
    <div class="product-info">
      <h2 class="product-name">{{$coupon->name}}</h2>
      <h3 class="product-prijs">€ {{number_format($coupon->price, 2)}}</h3>
      <div class="text-block-3">Van: {{$vendor->name}}</div>
      <p class="beschrijving-product">{{$coupon->description}}</p>
      <div class="w-form">
        <form method="POST" action="{{url('/')}}/event/{{$event->id}}/atc" class="product-action">
          @csrf
          <div class="bid-price"><input type="hidden" name="couponID" value="{{$coupon->id}}"><input type="number" class="text-field bid-price w-input" min="0" name="amount" required placeholder="Aantal" id="Price">
          </div><input type="submit" value="In winkelwagen" data-wait="Please wait..." class="button purple w-button">
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
