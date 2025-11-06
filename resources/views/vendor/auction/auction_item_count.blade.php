@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="{{route('auction_item_count')}}" class="create-account" style="position: relative;">
          @csrf
          <h1 class="dark">Aantal veiling-items</h1>
          <input type="number" class="text-field nomaxw w-input" name="auction_item_count" placeholder="Voer het totale item in dat u wilt invoeren" required>

          <input type="submit" value="Indienen" data-wait="Please wait..." class="button w-button">

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

