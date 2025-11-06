@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="{{url('vendor/coupons/add')}}" enctype="multipart/form-data" class="create-account">
          @csrf
          <h1 class="dark">Coupon toevoegen</h1>
          <input type="text" class="text-field nomaxw w-input" maxlength="256" name="name" placeholder="Naam" required="">
          <input type="number" class="text-field nomaxw w-input" step="0.01" name="item" placeholder="Beschikbaarheid van coupons" required="">
          <input type="number" class="text-field nomaxw w-input" step="0.01" name="price" placeholder="Prijs €" required="">
          <textarea maxlength="5000" name="desc" required="" class="w-input" placeholder="Beschrijving"></textarea>
          <input type="file" class="text-field nomaxw w-input" name="image" id="imageInput" required>
          <input type="submit" value="Toevoegen" data-wait="Please wait..." class="button w-button">
          <img class="imagePreview" style="height: 100px; width: auto"></img>
        </form>
      </div>
    </div>
  </div>
</div>
@push('js')
  <script>
    $(document).ready(function(){
      $('.imagePreview').hide()
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
