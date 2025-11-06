@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="place-movie/add" enctype="multipart/form-data" class="create-account">
          @csrf
          <h1 class="dark">Movie plaatsen</h1>
          <input type="text" class="text-field nomaxw w-input" maxlength="256" name="name" placeholder="Naam" required="">
          <input type="text" class="text-field nomaxw w-input" maxlength="256" name="video_url" placeholder="URL van video (youtube)" required="">
          <label>Thumbnail</label>
          <input type="file" class="text-field nomaxw w-input" name="thumbnail" onchange="previewImage(this)">

          <div id="image-preview" style="display: none;">
            <img src="#" width="100px" id="movie-logo">
          </div>

          <!-- <div class="ad-price">De prijs voor deze advertentie is:<br>€200,00</div> -->
          <div class="disclaimer">Het kan even duren voor de movie geplaatst wordt. <br>Wij zullen deze eerst controleren.</div><input type="submit" value="Adverteren" data-wait="Please wait..." class="button w-button">
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function previewImage(input) {
    if (input.files[0]) {
      document.getElementById('movie-logo').src = URL.createObjectURL(input.files[0]);
      document.getElementById('image-preview').style.display = 'block';
    } else {
      document.getElementById('movie-logo').src = "#";
      document.getElementById('image-preview').style.display = 'none';
    }
  }
</script>
@endsection
