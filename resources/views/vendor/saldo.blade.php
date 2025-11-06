@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<style>
    .no-items {
        width: 100%;
        text-align: center;
        color: #999;
    }
    p.no-items {
        margin: 10px 0;
    }
    .login-form {
        padding: 10px 20px;
    }
</style>
<div class="normal-section gradient wf-section">
    <div class="container center w-container">
        <div class="w-layout-grid grid-2">
            <div class="login-form">
                <form class="create-account">
                    <h1 class="dark" style="margin-bottom: 10px">Saldo</h1>
                    <p class="no-items">Totale productverkoop: €{{ number_format($total_product_sell, 2, ',', '.') }}</p>
                    <p class="no-items">Totale couponverkoop: €{{ number_format($total_coupon_sell, 2, ',', '.') }}</p>
                    <p class="no-items">Totale veilingverkopen: €{{ number_format($total_auction_sell, 2, ',', '.') }}</p>
                    <strong>Jouw totale saldo is: €{{ number_format($total_sell, 2, ',', '.') }}</strong>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="normal-section gradient wf-section">
    <div class="container center w-container">
        @if (!empty($soldItems['products']))
            <h2>Producten</h2> 
            @foreach ($soldItems['products'] as $item)
                <div class="sale-item">
                    {{ $item['name'] }}, <br/>
                    ordernummer: {{ $item['order_number'] }}, <br/>
                    verkocht aan: {{ $item['sold_to'] }}, <br/>
                    prijs: €{{ number_format($item['price'], 2, ',', '.') }}
                </div>
            @endforeach
        @else
            <p class="no-items">Totale productverkoop: €0</p>
        @endif

        @if (!empty($soldItems['coupons']))
            <h2>Coupons</h2>
            @foreach ($soldItems['coupons'] as $item)
                <div class="sale-item">
                    {{ $item['name'] }}, 
                    ordernummer: {{ $item['order_number'] }}, 
                    verkocht aan: {{ $item['sold_to'] }}, 
                    prijs: €{{ number_format($item['price'], 2, ',', '.') }}
                </div>
            @endforeach
        @else
            <p class="no-items">Totale couponverkoop: €0</p>
        @endif

        @if (!empty($soldItems['auctions']))
            <h2>Veiling-items</h2>
            @foreach ($soldItems['auctions'] as $item)
                <div class="sale-item">
                    {{ $item['name'] }}, 
                    ordernummer: {{ $item['order_number'] }}, 
                    verkocht aan: {{ $item['sold_to'] }}, 
                    prijs: €{{ number_format($item['price'], 2, ',', '.') }}
                </div>
            @endforeach
        @else
            <p class="no-items">Totale veilingverkopen: €0</p>
        @endif
    </div>
</div> --}}
@endsection
