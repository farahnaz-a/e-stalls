@extends('layouts.event')
@section('wfdata', '61fba1ebd8aaa339c8c1949b')
@section('title', 'Auction Hall - E-STALLS')
@section('content')
<div class="event-bar auction-hall wf-section">
  <div class="container w-container">
    <h1 class="hall-heading">Auction Hall</h1>
  </div>
</div>
<div class="stall-products wf-section">
  <div class="container w-container">
    @if(!$event->auction_hall_closed)
      <div class="w-layout-grid stall-products-grid auction-grid">
        @foreach($auctions as $auction)
        @if($auction->status == "live")
        <a href="{{url('/')}}/event/{{$event->id}}/auction/{{$auction->id}}" id="w-node-f0c7cc99-d15b-b98f-12bd-0632b548f5f4-c8c1949b" class="product auction-prodct"style="text-decoration:none; color: #191919;">
          <div class="product">
            <div class="product-image-holder"><img src="{{ asset('uploads/auctions/prodimgs') }}/{{ $auction->image_url }}" loading="lazy" width="160" alt="" class="product-image"></div>
            <div class="product-details-holder">
              <h3>{{$auction->name}}</h3>
              <div class="product-pricing-button w-clearfix">
                <h4 class="stall-product-price"> Laatste bod: €<strong>{{$auction->current_bid}}</strong></h4>
              </div>
            </div>
            <!-- <div class="left-time">20 minuten over</div> -->
          </div>
        </a>
        @endif
        @endforeach
        <h2 class="open-auctions">Open Veilingen</h2>
      </div>
    @else
    <div class="centered">
        <img src="{{ asset('images') }}/close-auctions2.png" alt="Close" loading="Lazy" height="500">
      {{-- <img src="{{asset('public/auctions/close-auctions.png')}}" alt="Close" loading="Lazy"> --}}
      <h3 class="">Tijdens dit event is de Auctionhall gesloten.</h3>
    </div>
    @endif
  </div>
</div>
@endsection
