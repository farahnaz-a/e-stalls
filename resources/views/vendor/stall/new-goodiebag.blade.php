@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<style>
  .file-input-container {
    margin: 10px 0;
    position: relative;
    display: inline-block;
    overflow: hidden;
  }

  .custom-file-button {
    display: inline-block;
    cursor: pointer;
    border: 1px solid grey;
  }

  input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
  }
</style>
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="{{url("vendor/set-goodiebag")}}" enctype="multipart/form-data" class="create-account">
          @csrf
          <h1 class="dark">Goodiebag informatie</h1>
          <input type="text" class="text-field nomaxw w-input" maxlength="256" name="contents" id="contents" placeholder="Welk item wil je aanbieden?" required="" value="{{$goodiebag->contents ?? ""}}">
          <textarea name="description" id="description" cols="10" rows="3" class="text-field nomaxw w-input" placeholder="Beschrijving van het item" required>{{$goodiebag->description ?? ""}}</textarea>
            <input type="number" class="text-field nomaxw w-input" step="1" name="stock" id="stock" placeholder="Aantal items" value="{{$goodiebag->stock ?? ""}}" required="">
            <input type="hidden" name="stallID" value="{{$stallID}}" required="">
            <label>Upload afbeelding</label>
            <div class="file-input-container">
              <button class="custom-file-button">bestand kiezen</button>
              <input 
                type="file" 
                class="text-field nomaxw w-input" 
                name="logo" 
                onchange="previewFunction(event)"
                required
              >
            </div>
            <div id="preview-area"></div>
            <input type="submit" value="Goodie bijwerken" data-wait="Please wait..." class="button w-button">
            <ul role="list" class="dashboard-list w-list-unstyled">
              <li class="dashboard-list-item w-clearfix" style="margin-top: 25px">
                <div class="list-item-data">
                  <div><strong style="color: black">Item: </strong><span id="contentsWrap">{{$goodiebag->contents ?? ''}}</span></div>
                  <div><strong style="color: black">Beschrijving: </strong><span id="descriptionWrap"> {{$goodiebag->description ?? ''}}</span></div>
                  <div><strong style="color: black">Aantal: </strong><span id="stockWrap"> {{$goodiebag->stock ?? ''}}</span></div>
                  @if (!empty($goodiebag->logo))
                      <img src="{{asset('uploads/goodiebag/logo')}}/{{ $goodiebag->logo }}" style="max-width:200px;">
                      {{-- <img src="{{asset('public/'.$goodiebag->logo)}}" style="max-width:200px;"> --}}
                  @endif
                </div>
              </li>
            </ul>
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
        $(document).ready(function(){
            $("#contents").blur(function(){
                $('#contentsWrap').text($(this).val());
            });
            $("#description").blur(function(){
                $('#descriptionWrap').text($(this).val());
            });
            $("#stock").blur(function(){
                $('#stockWrap').text($(this).val());
            });
        });
  </script>
@endpush