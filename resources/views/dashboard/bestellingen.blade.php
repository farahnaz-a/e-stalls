@extends('layouts.main')

@section('title', 'E-STALLS Dashboard')

@section('content')
<div class="normal-section gradient wf-section">
  <div class="container w-container">
    <div class="w-layout-grid grid-2">
      <div id="w-node-dae53740-31f4-fd5e-9c0e-55b249c8b2ba-275285bd" class="live-events orders">
        <h1 class="dark">Jouw orders</h1>
        <ul role="list" class="dashboard-list w-list-unstyled">
          @foreach($orders as $order)
          @if($order->contents == 1)
          <li class="dashboard-list-item">
            <div class="w-clearfix">
              <div class="type-of-purchase">
                <div>Ticket aankoop</div>
              </div>
              <div class="item-date">{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</div>
            </div>
            <div class="list-item-data">
              <div class="light">Ticket For {{ $order->event->name ?? '' }} event</div>
            </div> </br>
            <div class="list-item-data">
              <div class="light">Ordernummer: {{ sprintf('%06d', $order->id) }}</div>
            </div> </br>
            <div class="list-item-data">
              <div class="light">Aankoop bedrag: €{{$order->price}}</div>
            </div>
          </li>
          @else
          <li class="dashboard-list-item">
            <div class="w-clearfix">
              <div class="type-of-purchase product">
                <div>Product aankoop</div>
              </div>
              <div class="item-date">{{$order->created_at}}</div>
            </div>
            <div class="light">Aankoop bedrag: €{{$order->price}}</div>
            <a href="/bestelling/{{$order->id}}" class="order-link">Bekijk bestelling</a>
          </li>
          @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
  <div class="review-section wf-section">
    <div class="w-container">
      <h2 class="small">Wat deelnemers van onze events vinden</h2>
      <div data-delay="4000" data-animation="slide" class="reviews-slider w-slider" data-autoplay="false" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
        <div class="mask-2 w-slider-mask">
          <div class="w-slide">
            <div class="review"><img src="images/undraw_male_avatar_323b.png" loading="lazy" alt="">
              <div class="review-name">Max v C.</div>
              <p>&quot;E-STALLS is een erg uniek concept, zeker de moeite waard om een ticket te kopen!&quot;</p>
            </div>
          </div>
          <div class="w-slide">
            <div class="review"><img src="images/undraw_male_avatar_323b.png" loading="lazy" alt="">
              <div class="review-name">Isa L.</div>
              <p>&quot;Via E-STALLS ben ik veel te weten gekomen over belangrijke brands én heb ik een aantal leuke producten gekocht.&quot;</p>
            </div>
          </div>
        </div>
        <div class="left-arrow w-slider-arrow-left">
          <div class="w-icon-slider-left"></div>
        </div>
        <div class="right-arrow w-slider-arrow-right">
          <div class="w-icon-slider-right"></div>
        </div>
        <div class="hidden w-slider-nav w-round"></div>
      </div>
    </div>
  </div>
  @endsection
