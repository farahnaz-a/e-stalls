
@extends('layouts.event')
@section('wfdata', '61fb98a7fccdcaff59c6ec5a')
@section('title', 'Stall - E-STALLS')
@section('style-css')
  <style> 

  /* Hide the checkbox */

  </style>
@endsection
@section('vendor-css')
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('vendor-js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<!DOCTYPE html>
@if($remaining_seconds > 1800 && $remaining_seconds <= 3600)

  <script>
      function updateCountdown() {
          document.getElementById("count-notification").innerHTML = "<p>Het event eindigt over 1 uur! Zorg dat je niets mist</p>";
          remainingTime--;
      }
      setInterval(updateCountdown, 1000);
  </script>
@elseif( $remaining_seconds > 900 && $remaining_seconds <= 1800)

  <script>
      function updateCountdown() {
          document.getElementById("count-notification").innerHTML = "<p>Het event sluit over 30 minuten! Je hebt nog maar even de tijd om de beste deals te scoren.</p>";
          remainingTime--;
      }
      setInterval(updateCountdown, 1000);
  </script>
@elseif( $remaining_seconds > 300 && $remaining_seconds <= 900)

  <script>
      function updateCountdown() {
        document.getElementById("count-notification").innerHTML = "<p>Het event sluit over 15 minuten! Na het event heb je nog maar 30 minuten om je winkelmandje af te rekenen!</p>";
        remainingTime--;
      }
      setInterval(updateCountdown, 1000);
  </script>
@elseif( $remaining_seconds > 0 && $remaining_seconds <= 300)

  <script>
      let remainingTime = {{ $remaining_seconds }};

      function updateCountdown() {
          if (remainingTime <= 0) {
              document.getElementById("countdown").innerHTML = "Event Ended!";
              location.reload();
              return;
          }
          let minutes = Math.floor(remainingTime / 60);
          let seconds = remainingTime % 60;
          document.getElementById("countdown").innerHTML = `${minutes}m ${seconds}s remaining`;
          remainingTime--;
      }
      setInterval(updateCountdown, 1000);
  </script>
@endif
  <div class="stall-company-bar wf-section">
    <div class="o-container company-info w-container"><img src="{{ asset('uploads/stalls/logo') }}/{{ $stall->logo_url }}" loading="lazy" style="max-width: 200px;" alt="" class="company-logo">
      <div class="width-holder">
        <div class="stall-company-info">
          <h2>{{$vendor->name}}</h2>
          <p class="paragraph">{{$stall->description}}</p>
          <div id="countdown"></div>
          <div id="count-notification"></div>
          {{-- @if(!empty($goodiebag))
          @if(in_array($user->id, explode(',', $goodiebag->claimed_by)))
          Je hebt de goodiebag geclaimd!
          @else
          @if($goodiebag->stock >= 1)
          <a href="/goodiebag/{{$stall->id}}" class="button purple w-button">Claim je goodiebag! </a>
          <br><br><i>De goodiebag bevat {{$goodiebag->contents}} </i>
          @else
          <i>De goodiebags zijn op!</i>
          @endif
          @endif
          @endif --}}
          {{-- @if(!empty($coupons))
          @foreach ($coupons as $coupon)
          <a href="{{url('/')}}/event/{{$event->id}}/coupon/{{$coupon->id}}" class="button purple w-button">Claim je sample! </a>
          <div id="w-node-_0c1758cc-44bc-e261-b0bc-560ff1f3f29e-59c6ec5a" class="product">
            <div class="product-details-holder">
              <h3>{{$coupon->name}}</h3>
              <div class="product-pricing-button w-clearfix">
                <h4 class="stall-product-price">€<strong>{{number_format($coupon->price, 2)}}</strong></h4>
              </div>
            </div>
          </div>
          @endforeach
          @endif --}}
        </div>
      </div>
    </div>
  </div>
  <div class="stall-products wf-section">
    <div class="o-container w-container">
      <div class="w-layout-grid stall-products-grid">
        @foreach($coupons as $coupon)
        <div id="w-node-_0c1758cc-44bc-e261-b0bc-560ff1f3f29e-59c6ec5a" class="product">
          <button type="button"  data-toggle="modal" data-target="#couponDetailsModal{{$coupon->id}}" class="btn shadow-none product-image-holder">
            <img src="{{ asset('uploads/event-s/thumbnails') }}/{{ $coupon->image_url }}" loading="lazy" width="160" style="max-height:100px; width:auto;" alt="" class="product-image">
          </button>
          <div class="product-details-holder">
            <h3>{{$coupon->name}}</h3>
            <div class="product-pricing-button w-clearfix">
              <h4 class="stall-product-price">€<strong>{{number_format($coupon->price, 2)}}</strong></h4>
              <a href="{{url('/')}}/event/{{$event->id}}/coupon/{{$coupon->id}}" class="button purple add-to-cart w-button">+</a>
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
                         {{-- <img src="{{ asset('uploads/event-s/thumbnails') }}/{{ $coupon->image_url }}" alt="Coupon Image" style="height: 250px; margin: 0 auto; display: block; padding: 10px;">
                        <hr style="margin: 0; border: none; border-top: 1px solid #eee;">
                        <div style="padding: 16px; text-align: left">
                            <h2 style="margin: 0 0 10px; font-size: 22px; color: #333;">{{$coupon->name}}</h2>
                            <p style="margin: 0; font-size: 14px; color: #666;">{{ $coupon->description }}</p>
                        </div>  --}}


                        <div class="card shadow-sm">
                            <img src="{{ asset('uploads/event-s/thumbnails') }}/{{ $coupon->image_url }}" alt="Coupon Image" style="height: 250px; margin: 0 auto; display: block; padding: 10px;">
                            <div class="card-body">
                                <h5 class="card-title">{{$coupon->name}}</h5>
                                <p class="card-text text-muted">{{ $coupon->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold" style="color: #D0A446">€{{number_format($coupon->price, 2)}}</span>
                                <a href="{{url('/')}}/event/{{$event->id}}/coupon/{{$coupon->id}}" style="background-color: #932E7F" class="text-white btn btn-sm shadow-none">+</a>
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
        @foreach($products as $product)
        <div id="w-node-_0c1758cc-44bc-e261-b0bc-560ff1f3f29e-59c6ec5a" class="product">
          <button type="button"  data-toggle="modal" data-target="#productDetailsModal{{$product->id}}" class="btn shadow-none product-image-holder">
              <img src="{{ asset('uploads/products') }}/{{ $product->image_url }}" loading="lazy" width="160" style="max-height:100px; width: auto;" alt="" class="product-image">
          </button>
          <div class="product-details-holder">
            <h3>{{$product->name}}</h3>
            @if($product->stock > $product->sell_count)
            <div class="product-pricing-button w-clearfix">
                <h4 class="stall-product-price">€<strong>{{number_format($product->price, 2)}}</strong></h4>
                <a href="{{url('/')}}/event/{{$event->id}}/product/{{$product->id}}" class="button purple add-to-cart w-button">+</a>
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



                                <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold" style="color: #D0A446">€{{number_format($product->price, 2)}}</span>
                                <a href="{{url('/')}}/event/{{$event->id}}/product/{{$product->id}}" style="background-color: #932E7F" class="text-white btn btn-sm shadow-none">+</a>
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
     
    {{-- <input type="checkbox" id="modal-toggle">
    <label for="modal-toggle" class="modal-overlay">
    <div class="modal-box" onclick="event.stopPropagation();">
        <label for="modal-toggle" class="close-icon">&times;</label>
        <div style="width: 420px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; margin: 20px auto;">
            <img src="" id="couponImageWrap" alt="Coupon Image" style="height: 250px; margin: 0 auto; display: block; padding: 10px;">
            <hr style="margin: 0; border: none; border-top: 1px solid #eee;">
            <div style="padding: 16px; text-align: left">
                <h2 style="margin: 0 0 10px; font-size: 22px; color: #333;">Coupongegevens</h2>
                <p style="margin: 0; font-size: 14px; color: #666;"  id="couponInfo"></p>
            </div> 
        </div> 
    </div>
    </label>  --}}
  @endsection

  @section('script-js')
    <script>
        $(document).ready(function(){
            // $('.coupon-code-info').click(function(){
            //     let info = $(this).data('info');
            //     $('#couponInfo').text(info)
            //     $('#couponImageWrap').attr('src', $(this).find('img').attr('src'));
            //     $("#modal-toggle").prop('checked', true);
            // })
        });
    </script>
  @endsection