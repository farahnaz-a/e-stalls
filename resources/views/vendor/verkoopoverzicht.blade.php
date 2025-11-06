@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form class="create-account">
          <h1 class="dark">Verkoopoverzicht</h1>
          {{-- <p style="margin-bottom: 10px"><strong>Aantal stalls: {{$stall}} </strong></p> --}}
          <p style="margin-bottom: 10px"><strong>Aantal producten: {{$product}} </strong></p>
          <p style="margin-bottom: 10px"><strong>Aantal coupons: {{$coupon}} </strong></p>
          <p><strong>Aantal veiling-items: {{$auction}} </strong></p>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection