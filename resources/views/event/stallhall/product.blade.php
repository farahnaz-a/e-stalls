@extends('layouts.event')
@section('wfdata', '61fba61da630f92aab004bfd')
@section('title', 'product - E-STALLS')
@section('vendor-css')
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ asset("css/jquery.bbslider.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('vendor-js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.bbslider.min.js') }}" type="text/javascript"></script>
@endsection
@section('content')
<section id="feature-section" class="feature-section wf-section">
  <div class="flex-container w-container">
    <div class="feature-image-mask">
        <div>
            <img src="{{ asset('uploads/products') }}/{{ $product->image_url }}" alt="" class="feature-image">
        </div>
        @foreach ($product->productImages as $image)
        <div>
            <img src="{{ asset('uploads/products') }}/{{ $image->image }}" alt="" class="feature-image">
        </div>
        @endforeach
    </div>
    <div class="product-info">
      <h2 class="product-name">{{$product->name}}</h2>
      <h3 class="product-prijs">€ {{number_format($product->price, 2)}}</h3>
      {{-- @if ($product->size)
        <div class="text-block-3">Maat: {{$product->size}}</div>  
      @endif --}}
      <div class="text-block-3">Van: {{$vendor->name}}</div>
       @if ($product->size == 'yes')
        <div class="my-3">
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

      <p class="beschrijving-product">{{$product->description}}</p>
      <div class="w-form">
        <form method="POST" action="{{url('/')}}/event/{{$event->id}}/atc" class="product-action">
          @csrf
          <div class="bid-price"><input type="hidden" name="productID" value="{{$product->id}}"><input type="number" class="text-field bid-price w-input" min="0" name="amount" required placeholder="Aantal" id="Price">
          </div><input type="submit" value="In winkelwagen" data-wait="Please wait..." class="button purple w-button">
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
@section('script-js')
    <script>
        $(document).ready(function(){
            $('.feature-image-mask').bbslider({
                auto:  true,
                timer: 3000,
                loop:  true, 
            });
        });
    </script>
@endsection