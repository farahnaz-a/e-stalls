@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="{{url('vendor/request-auction-product')}}" enctype="multipart/form-data" class="create-account" style="position: relative;">
          @csrf
          <h1 class="dark">Veiling-item aanbieden resterend:{{ $remaining_items }}</h1>
          <input type="text" class="text-field nomaxw w-input" maxlength="256" name="name" placeholder="Titel van veiling-item" required="">
          <label>Beschrijving </label>
          <textarea maxlength="5000" name="desc" required="" class="w-input"></textarea>
          {{-- <input type="number" class="text-field nomaxw w-input" maxlength="256" name="item" placeholder="Item" required=""> --}}
          <input type="number" class="text-field nomaxw w-input" maxlength="256" name="min_bid" placeholder="Bieden vanaf €" required="">
          {{-- <input type="number" class="text-field nomaxw w-input" min="1" name="min_step" placeholder="Minimaal overbieden €" required=""> --}}
          <!-- <input type="text" class="text-field nomaxw w-input" name="start_time" placeholder="Bieden start om (HH:MM)" required="">
          <input type="text" class="text-field nomaxw w-input" name="end_time" placeholder="Bieden eindigt om (HH:MM)" required=""> -->
          <label>Afbeelding van item</label>
          <input type="file" class="text-field nomaxw w-input" id="imageInput" name="product_image" required="">
          <!-- <div class="ad-price">De prijs voor deze advertentie is:<br>€200,00</div> -->
          <div class="disclaimer">Het kan even duren voor het veiling-item geplaatst wordt. <br>Wij zullen deze eerst controleren.</div><input type="submit" value="Aanbieden" data-wait="Please wait..." class="button w-button">
          <img class="imagePreview" src="" alt="Image Preview" style="display:none; width: 50px; height: 50px;position:absolute;bottom: 0 ;right: 50px">
        </form>
      </div>
    </div>
  </div>
</div>
@push('js')
  <script>
    $(document).ready(function(){
      $('#imageInput').change(function(ev) {
          let input = ev.target;
          if (input.files[0]) {
              let reader = new FileReader();
              reader.onload = function(e) {
                  $('.imagePreview').attr('src', e.target.result).show();
              }
              reader.readAsDataURL(input.files[0]);
          }
      });
    })
  </script>
@endpush
@endsection

