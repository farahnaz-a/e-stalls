@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('vendor-css')
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('vendor-js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<div class="normal-section gradient wf-section">
    <div class="w-form-success" style="margin: 20px; display: {{ session('success') ? '':'none' }}">
        <div>{{ session('success') }}</div>
    </div>
  <div class="container center w-container">
    {{-- <div class="w-layout-grid grid-2"> --}}
      <div class="login-form" style="width: 460px;">
        <form method="POST" action="" enctype="multipart/form-data" class="create-account">
          @csrf
          <h3 class="dark">Product bewerken</h3>
          <input type="text" class="text-field nomaxw w-input" maxlength="256" name="name" value="{{$product->name}}" placeholder="Naam" required>
          <input type="number" class="text-field nomaxw w-input" step="0.01" name="price" value="{{$product->price}}" placeholder="Prijs €" required>
          <textarea maxlength="5000" name="desc" class="w-input" required  placeholder="Beschrijving">{{$product->description}}</textarea>
            {{-- <input type="text" class="text-field nomaxw w-input" maxlength="256" name="size" value="{{$product->size}}" placeholder="Maat"> --}}
          <label>Productafbeelding</label>
          <input type="file" class="text-field nomaxw w-input" id="productimage" name="thumbnail[]" value="{{$product->image_url}}" multiple accept="image/*">
          <div class="row">
            {{-- <img src="{{ asset($product->image_url) }}" id="img" width="130" style="margin-bottom:20px; border-radius: 4%;"> --}}
            <div class="col-md-6  position-relative">
                <img src="{{ asset('uploads/products') }}/{{ $product->image_url }}" width="100%" style="margin-bottom:20px; border-radius: 4%;">
                @if ($product->productImages->count())
                    <button type="submit" name="remove_image" value="main-image" class="removeProductImage" style="font-size: 20px; padding: 3px 9px; background-color: #ea3e3e; color: white; border: none; border-radius: 5px; cursor: pointer; position: absolute; top: 0; right: 15px;">x</button>
                @endif
            </div>
            @foreach ($product->productImages as $image)
                <div class="col-md-6 position-relative">
                    <img src="{{ asset('uploads/products') }}/{{ $image->image }}" width="100%" style="margin-bottom:20px; border-radius: 4%;">
                    <button type="submit" name="remove_image" value="{{ $image->id }}" class="removeProductImage" style="font-size: 20px; padding: 3px 9px; background-color: #ea3e3e; color: white; border: none; border-radius: 5px; cursor: pointer; position: absolute; top: 0; right: 15px;">x</button>
                </div> 
            @endforeach
            <div class="col-12">
                <div class="row" id="productImageWrapper">
                </div>
            </div>
          </div>
          <input type="submit" value="Toevoegen" data-wait="Please wait..." class="button w-button">
        </form>
      </div>
    {{-- </div> --}}
  </div>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('body').on('change', '#productimage', function(){
                let html_wrap = '<div class="col-12"><hr></div>';
                $.each(this.files, function(i, d){
                    html_wrap += `
                    <div class="col-md-6">
                        <img src="${window.URL.createObjectURL(d)}"  width="100%" style="margin-bottom:20px; border-radius: 4%;">
                    </div>
                    `;
                    
                })
                $("#productImageWrapper").html(html_wrap);
                //  onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])"
            })
            
        })
    </script>
@endpush