@extends('layouts.event')
@section('wfdata', '61fba61da630f92aab004bfd')
@section('title', 'Auction  - E-STALLS')

@section('vendor-css')
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('vendor-js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
@endsection


@section('content')
<section id="feature-section" class="feature-section wf-section">
  <div class="flex-container w-container">
    <div class="feature-image-mask"><img src="{{ asset('uploads/stalls/logo') }}/{{ $stall->logo_url }}" alt="" class="feature-image"></div>
    <div class="product-info">
        <h2 class="product-name">{{$stall->description}}</h2>
        <h5 class="light">Verzendkosten:@if($stall->shipping_cost == '3.95')
                                                -€3,95 
                                                @elseif ($stall->shipping_cost == '6.95')
                                                -€6,95
                                                @else
                                                -Geen verzendkosten
                                                @endif
        </h5>
        <h5 class="light">Minimale bestel bedrag voor gratis verzenden:{{ $stall->free_shipping_above }}</h5>
        <hr>
        <h3><strong>Sample informatie</strong></h3>
        @if ($stall->no_sample)
            <h5>Geen sample</h5>
        @else
            <h5 class="light">Sample:{{ $stall->sample_contents }}</h5>
            <h5 class="light">Aantal:{{ $stall->sample_stock }}</h5>
            @if($stall->sample_logo)
                <img src="{{ asset('uploads/stalls/sample-logo') }}/{{ $stall->sample_logo }}" style="max-width:200px;">
            @endif
        @endif
    </div>


    {{-- <div class="list-item-action">
        <a href="stalls/{{$stall->id}}/accept" class="button gradient w-button">goedkeuren</a>
        <a href="stalls/{{$stall->id}}/decline" class="button purple marg w-button">afkeuren</a>
    </div> --}}
    <div class="list-item-action">
        <a href="{{url('admin/stalls/'.$stall->id.'/accept')}}" class="button gradient w-button">goedkeuren</a>
        <a href="{{url('admin/stalls/'.$stall->id.'/decline')}}" class="button purple marg w-button">afkeuren</a>
    </div>
  </div>

  {{-- Create a card of product --}}
  {{-- <div class="flex-container w-container">
    @foreach ($products as $product)
    <div class="product-card" style="margin-right: 10px; padding: 4px;">
      <div class="product-image-mask">
          <img src="{{ asset('uploads/products') }}/{{ $product->image_url }}" style="height: 100px;width:120px" alt="Goodiebag Logo">
      </div>
      <div class="product-info">
        <h2 class="product-name">{{$product->name}}</h2>
        <div class="product-price">€{{$product->price}}</div> 
      </div>
    </div>
    @endforeach --}}

    <div class="stall-products wf-section">
        <div class="o-container w-container">
            <h1 style="color: black">Coupons</h1>
            <div class="w-layout-grid stall-products-grid">
                @foreach($coupons as $coupon)
                    <div id="w-node-_0c1758cc-44bc-e261-b0bc-560ff1f3f29e-59c6ec5a" class="product">
                    <button type="button"  data-toggle="modal" data-target="#couponDetailsModal{{$coupon->id}}" class="btn shadow-none product-image-holder">
                        <img src="{{ asset('uploads/event-s/thumbnails') }}/{{ $coupon->image_url }}" loading="lazy" width="160" style="max-height:100px; width:auto;" alt="" class="product-image">
                    </button>
                    <div class="product-details-holder">
                        <h3>{{$coupon->name}}</h3>
                        <div class="product-pricing-button w-clearfix align-items-center justify-content-between">
                            <h4 class="stall-product-price">€<strong>{{number_format($coupon->price, 2)}}</strong></h4>
                            <button type="button"  data-toggle="modal" data-target="#couponDetailsModal{{$coupon->id}}" class="btn shadow-none mb-1" style="color: #932E7F">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#932E7F" stroke-width="2"></path>
                                    <path d="M12 16V12" stroke="#932E7F" stroke-width="2" stroke-linecap="round"></path>
                                    <path d="M12 8H12.01" stroke="#932E7F" stroke-width="2" stroke-linecap="round"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    </div>
                
                    @push('all-modals')
                        <!-- Modal -->
                        <div class="modal fade" id="couponDetailsModal{{$coupon->id}}" tabindex="-1" aria-labelledby="couponDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header"> 
                                    <h5 class="modal-title">Coupongegevens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card shadow-sm">
                                        <img src="{{ asset('uploads/event-s/thumbnails') }}/{{ $coupon->image_url }}" alt="Coupon Image" style="height: 250px; margin: 0 auto; display: block; padding: 10px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$coupon->name}}</h5>
                                            <p class="card-text text-muted">{{ $coupon->description }}</p>
                                            <div class="">
                                            <span class="fw-bold" style="color: #D0A446; display: block; margin-bottom: 8px">Prijs: €{{number_format($coupon->price, 2)}}</span>
                                            <span class="fw-bold" style="color: #D0A446; display: block; margin-bottom: 8px">Item: {{ $coupon->item }}</span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endpush
                
                @endforeach 
            </div>
            <hr>
            <h1 style="color: black">Producten</h1>
            <div class="w-layout-grid stall-products-grid">
                @foreach($products as $product)
                    <div id="w-node-_0c1758cc-44bc-e261-b0bc-560ff1f3f29e-59c6ec5a" class="product">
                    <button type="button"  data-toggle="modal" data-target="#productDetailsModal{{$product->id}}" class="btn shadow-none product-image-holder">
                        <img src="{{ asset('uploads/products') }}/{{ $product->image_url }}" loading="lazy" width="160" style="max-height:100px; width: auto;" alt="" class="product-image">
                    </button>
                    <div class="product-details-holder">
                        <h3>{{$product->name}}</h3>
                        @if($product->stock > $product->sell_count)
                        <div class="product-pricing-button w-clearfix  align-items-center justify-content-between">
                            <h4 class="stall-product-price">€<strong>{{number_format($product->price, 2)}}</strong></h4>
                            <button  type="button"  class="btn shadow-none mb-1" data-toggle="modal" data-target="#productDetailsModal{{$product->id}}" style="color: #932E7F">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#932E7F" stroke-width="2"></path>
                                    <path d="M12 16V12" stroke="#932E7F" stroke-width="2" stroke-linecap="round"></path>
                                    <path d="M12 8H12.01" stroke="#932E7F" stroke-width="2" stroke-linecap="round"></path>
                                </svg>
                            </button>
                        </div>
                        @else
                            <div class="product-pricing-button w-clearfix">
                                <h4 class="stall-product-price">€<strong>{{number_format($product->price, 2)}}</strong></h4>
                            </div>
                            <small style="color: red">Out of Stock!</small>
                        @endif
                    </div>
                    </div>
                    @push('all-modals')
                        <!-- Modal -->
                        <div class="modal fade" id="productDetailsModal{{$product->id}}" tabindex="-1" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header"> 
                                    <h5 class="modal-title">Productgegevens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> 
                                    <div class="card shadow-sm">
                                        <img src="{{ asset('uploads/products') }}/{{ $product->image_url }}" alt="Coupon Image" style="height: 250px; margin: 0 auto; display: block; padding: 10px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$product->name}}</h5>
                                            <p class="card-text text-muted">{{ $product->description }}</p>
                                            @if ($product->size == 'yes')
                                                <div class="mb-3">
                                                    <h6>Maten:</h6>
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($product->productSize as $size)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $size->name }}<span class="badge">Nog {{ $size->stock }} op voorraad</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif



                                            <div>
                                                <span class="fw-bold" style="color: #D0A446; display: block; margin-bottom: 8px">Prijs: €{{number_format($product->price, 2)}}</span>
                                                <span class="fw-bold" style="color: #D0A446; display: block; margin-bottom: 8px">Aantal: {{ $product->stock }} </span>
                                                <span class="fw-bold" style="color: #D0A446; display: block; margin-bottom: 8px">BTW: {{ $product->tax }}% </span>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endpush
                @endforeach
            </div>
        </div>
    </div>
  </div>


</section>
@endsection
