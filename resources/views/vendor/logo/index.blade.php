@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="place-logo-ad/add" enctype="multipart/form-data" class="create-account">
          @csrf
          <h1 class="dark">Logo adverteren</h1>
          {{-- <input type="text" class="text-field nomaxw w-input" maxlength="256" name="redirect_url" placeholder="Redirect link van logo" required=""> --}}
          <label>Upload logo <small style="color: red">(210x140)</small></label>
          <input type="file" class="text-field nomaxw w-input" name="logo" accept="image/*" required="" onchange="previewFunction(event)">
          <div id="preview-area"></div>
          <!-- <div class="ad-price">De prijs voor deze advertentie is:<br>€200,00</div> -->
          <input type="submit" value="Adverteren" data-wait="Please wait..." class="button w-button">
        <div style="color: red; margin-top: 10px">
            <ul>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                @endif  
            </ul>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
    function previewFunction(event){
        const img = document.createElement("img");
        img.src = URL.createObjectURL(event.target.files[0])
        img.alt = event.target.files[0].name
        img.style.maxHeight = '100px'
        document.querySelector('#preview-area').style.marginBottom = '15px'
        document.querySelector('#preview-area').innerHTML = ''
        document.querySelector('#preview-area').append(img)
    }
</script>
@endpush
