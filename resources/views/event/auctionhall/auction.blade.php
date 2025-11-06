@extends('layouts.event')
@section('wfdata', '61fba61da630f92aab004bfd')
@section('title', 'Auction  - E-STALLS')
@section('content')
<section id="feature-section" class="feature-section wf-section">
  <div class="flex-container w-container">
    <div class="feature-image-mask"><img src="{{ asset('uploads/auctions/prodimgs') }}/{{ $auction->image_url }}" alt="" class="feature-image"></div>
    <div class="product-info">
      <!-- <h4 class="bieding-sluit">Bieden sluit over {{$time_left}} minuten</h4> -->
      <h2 class="product-name">{{$auction->name}}</h2>
      <h3 class="product-prijs">Laatste bod: € {{$auction->current_bid}}</h3>
      <div class="text-block-3">Van: {{$vendor->name}}</div>
      <p class="beschrijving-product">{{$auction->description}}</p>
      @if($auction->SN == $userID)<div style="color:green; margin-bottom: 12px;">Jij hebt het hoogste bod!</div>@endif
      <div>
        <form action="placebid" method="POST" class="product-action">
          @csrf
          <input type="hidden" name="id" value="{{$auction->id}}">
          <div class="bid-price"><input type="number" class="text-field bid-price w-input" step="0.01" min="{{number_format($auction->current_bid + 1, 2)}}" value="{{ number_format($auction->current_bid + 1, 2) }}" name="Price" data-name="Price" placeholder="Prijs" id="Price">
            <div class="euro-sign">€</div>
          </div><input type="submit" value="Plaats bod" data-wait="Please wait..." class="button purple w-button">
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
