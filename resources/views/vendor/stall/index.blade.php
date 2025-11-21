@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<style>
  /* Hide the checkbox */
  #modal-toggle {
    display: none;
  }

  /* Modal overlay */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 999;
  }

  /* Show the overlay when checkbox is checked */
  #modal-toggle:checked ~ .modal-overlay {
    visibility: visible;
    opacity: 1;
  }

  /* Modal box */
  .modal-box {
    background: #fff;
    padding: 20px;
    width: 300px;
    border-radius: 8px;
    position: relative;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  /* Modal Title */
  .modal-box h2 {
    margin-top: 0;
  }

  /* Close icon styling */
  .close-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #333;
    text-decoration: none;
    cursor: pointer;
  }

  /* Trigger Button */
  .open-modal-btn {
    padding: 10px 20px;
    text-decoration: none;
    cursor: pointer;
    margin-top: 20px;
  }

  .modal-box p {
    font-size: 16px;
    padding-top: 35px;
  }

  .custom-heading {
      display: flex;
      align-items: center;
      gap: 15px;
      flex-wrap: wrap;
  }

  .custom-heading h1 {
      margin: 0;
  }

  .inline-checkbox {
      display: inline-flex;
      align-items: center;
      margin-left: 20px;
  }
  .inline-checkbox .form-check-input {
      margin-right: 8px;
  }
</style>
{{-- <div class="stepper-container" style="width: 600px; height: 500px; background-color: red; padding: 30px; margin: 0 auto;">
    <div class="step1" style="width: 500px; height: 400px; background-color: white; margin: 0 auto;">

    </div>
    <div class="step2" style="width: 500px; height: 400px; background-color: orange; display: none; margin: 0 auto;">

    </div>
    <div class="step3" style="width: 500px; height: 400px; background-color: black; display: none; margin: 0 auto;">

    </div>
    <div class="step4" style="width: 500px; height: 400px; background-color: green; display: none; margin: 0 auto;">
        
    </div>
    <div style="text-align: center">
        <button class="stepper-btn" data-direction="left">Previous</button>
        <button class="stepper-btn" data-direction="right">Next</button>
    </div>
</div> --}}
<div class="normal-section gradient wf-section">
   <div class="w-form-success" style="margin: 20px; display: {{ session('success') ? '':'none' }}">
    <div>{{ session('success') }}</div>
  </div>
  <div class="container center w-container">
    <div class="w-layout-grid grid-2" style="width:100%;">
      @if(empty($stall))
      <div class="login-form">
        <form method="POST" action="request-stall" enctype="multipart/form-data" class="create-account">
            @csrf
            <h1 class="dark">Stall aanvragen</h1>
            <input type="text" class="text-field nomaxw w-input" maxlength="256" name="description" placeholder="Beschrijving stall" required="">
            <label>Upload logo</label>
            <input type="file" class="text-field nomaxw w-input" name="logo" required="">

            <select name="shipping_cost" class="select-field w-input" required>
                <option disabled value="" selected>Selecteer verzendkosten</option>
                <option value="3.95">-€3,95</option>
                <option value="6.95">-€6,95</option>
                <option value="geen">-Geen verzendkosten</option>
            </select>
            <input type="number" class="text-field nomaxw w-input" placeholder="Vul het minimale bedrag voor gratis verzending in!" name="free_shipping_above" required>

            <!-- <div class="ad-price">De prijs voor deze advertentie is:<br>€200,00</div> -->
            {{-- <div class="disclaimer">Na het aanvragen zal jouw stall zichtbaar zijn op het event.</div> --}}
            <div class="disclaimer">Zodra je op ‘Aanmaken’ hebt geklikt, kun je verder met het inrichten van je stall.</div>
            <input type="submit" value="aanmaken" data-wait="Please wait..." class="button w-button">
        </form>
      </div>
      @else
      <div class="login-form" style="width:100%">
        <form method="POST" action="request-stall" enctype="multipart/form-data" class="create-account">
          @csrf
          <h1 class="dark">Stall informatie
          @if ($stall->enabled != 1)
            <a href="stall/edit" class="edit-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                    <path d="M14.6716 6.763L5.58013 15.8544L5.41376 18.8492L8.40856 18.6829L17.5 9.59142M14.6716 6.763L16.0204 5.41421C16.8014 4.63316 18.0677 4.63316 18.8488 5.41421V5.41421C19.6298 6.19526 19.6298 7.46159 18.8488 8.24264V8.24264L17.5 9.59142M14.6716 6.763L17.5 9.59142" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
          @endif
          @if ($stall->enabled == 2)
            <a href="stall/re-send" style="font-size: 16px">
             <label class="button w-button">Opnieuw verzenden</label>
            </a>
            {{-- <a href="stall/edit" style="text-decoration: none;margin-left:25px;">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 30 30">
                <path d="M 15 3 C 12.031398 3 9.3028202 4.0834384 7.2070312 5.875 A 1.0001 1.0001 0 1 0 8.5058594 7.3945312 C 10.25407 5.9000929 12.516602 5 15 5 C 20.19656 5 24.450989 8.9379267 24.951172 14 L 22 14 L 26 20 L 30 14 L 26.949219 14 C 26.437925 7.8516588 21.277839 3 15 3 z M 4 10 L 0 16 L 3.0507812 16 C 3.562075 22.148341 8.7221607 27 15 27 C 17.968602 27 20.69718 25.916562 22.792969 24.125 A 1.0001 1.0001 0 1 0 21.494141 22.605469 C 19.74593 24.099907 17.483398 25 15 25 C 9.80344 25 5.5490109 21.062074 5.0488281 16 L 8 16 L 4 10 z"></path>
              </svg>
            </a> --}}
          @endif
          </h1>
          <p style="width:100%; max-width: 500px;"> {{$stall->description}}</p>
          <!-- <input type="text" class="text-field nomaxw w-input" maxlength="256" name="description" placeholder="Beschrijving stall" required="" value="{{$stall->description}}"> -->
          <label>Huidige logo:</label>
          <img src="{{ asset('uploads/stalls/logo') }}/{{ $stall->logo_url }}" style="max-width:200px;">
          <br/>
          <!--
          <label>Upload logo</label>
          <input type="file" class="text-field nomaxw w-input" name="logo" required="">
          div class="disclaimer">Na het aanvragen zal jouw stall zichtbaar zijn op het event.</div><input type="submit" value="Bewerken" data-wait="Please wait..." class="button w-button">
        -->
        <label for="modal-toggle" class="button w-button open-modal-btn">Mijn stall is klaar voor het event!</label>

        </form>
        <form method="post" action="{{ url('send/stall/request') . '?data=' . urlencode(json_encode($stall)) }}">
          @csrf
          <input type="checkbox" id="modal-toggle">
          <label for="modal-toggle" class="modal-overlay">
            <div class="modal-box" onclick="event.stopPropagation();">
              <label for="modal-toggle" class="close-icon">&times;</label>
              <p>Weet je zeker dat je stall klaar is voor goedkeuring?</p>
              <button type="submit" class="button w-button">Verzenden</button>
            </div>
          </label>
        </form>
      </div>
      @endif

      <div class="login-form">
          <h1 class="dark">Producten</h1>
          <a style="margin-bottom: 10px; background-color:green;" href="products/add" class="button w-button">+</a>

            <div class="products-grid">
                @foreach($products as $product)
                <div class="product-card">
                    <figure class="product-card__header">
                        {{-- <img class="product-card__header__bg" src="{{asset('public/'.$product->image_url) }}" alt="{{$product->name}}" loading="lazy"> --}}
                        <img class="product-card__header__bg" src="{{ asset('uploads/products') }}/{{ $product->image_url }}" alt="{{$product->name}}" loading="lazy">
                    </figure>
                    <div class="product-card__body">
                        <h3 class="product-card__body__title">Product: {{$product->name}}</h3>
                        <p class="product-card__body__text light">Prijs: {{$product->price}}</p>
                        <p class="product-card__body__text light">Aantal: {{$product->stock}}</p>
                        @if ($product->size == 'yes')
                            <p class="product-card__body__text light">Maat: 
                                @foreach ($product->productSize as $size)
                                    {{ $size->name }} - {{ $size->stock }}{{ $loop->last ? '':', ' }}
                                @endforeach
                            </p>
                        @endif
                        <div class="product-card__body__actions">
                            <a href="product/{{$product->id}}" class="button w-button">bewerken</a>
                            <a href="products/{{$product->id}}/delete" class="button gradient w-button">verwijderen</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
          {{-- <ul role="list" class="dashboard-list w-list-unstyled">
              <li class="dashboard-list-item w-clearfix">
                <div class="list-item-data">
                  <div class="important">Product: {{$product->name}}</div>
                  <div class="light">Prijs: {{$product->price}}</div>
                </div>
                <div class="list-item-action">
                  <a href="product/{{$product->id}}" class="button w-button">bewerken</a>
                  <a href="products/{{$product->id}}/delete" class="button gradient w-button">verwijderen</a>
                </div>
              </li>
          </ul> --}}
      </div>
      <div class="login-form">
        @if($stall_exists)
          {{-- <form method="POST" action="set-goodiebag" enctype="multipart/form-data" class="create-account"> --}}
          <form method="POST" action="set-stall-sample" enctype="multipart/form-data" class="create-account">
            @csrf
            <div class="d-flex justify-content-between align-items-center">
                <div class="custom-heading">
                    <h1 class="dark mb-0">Sample informatie</h1>
                    <span class="inline-checkbox">
                        <div class="form-check">
                            <input type="checkbox" id="geenSampleCheckbox" class="form-check-input" {{ $stall->no_sample ? 'checked':'' }}>
                            <span for="geenSampleCheckbox" class="form-check-label">Geen sample</span>
                        </div>
                    </span>
                </div>
            </div>

            <div id="goodiebagForm" style="display: {{ $stall->no_sample ? 'none':'' }}">
              <input type="hidden" name="stallID" value="{{$stall->id}}">

              <input type="text" class="text-field nomaxw w-input" maxlength="256" name="sample_contents" placeholder="Welke sample wil je aanbieden?" required="" value="{{$stall->sample_contents}}">
                <input type="number" class="text-field nomaxw w-input" step="1" min="1" name="sample_stock" placeholder="Hoeveel maximaal verstrekken?" value="{{$stall->sample_stock == '0' ? '' : $stall->sample_stock }}" required="">
                @if(!$stall->sample_logo)
                    <label>Upload afbeelding</label>
                    <input type="file" class="text-field nomaxw w-input" name="sample_logo" required>
                @endif
                <input type="submit" value="Sample bijwerken" data-wait="Please wait..." class="button w-button">
                <ul role="list" class="dashboard-list w-list-unstyled">
                  <li class="dashboard-list-item w-clearfix" style="margin-top: 25px">
                    <div class="list-item-data">
                      <div class="important">Sample: {{$stall->sample_contents}}</div>
                      <div class="light">Aantal: {{$stall->sample_stock}}</div>
                      @if($stall->sample_logo)
                        <img src="{{ asset('uploads/stalls/sample-logo') }}/{{ $stall->sample_logo }}" style="max-width:200px;">
                      @endif
                    </div>
                  </li>
                </ul>

              {{-- @if(empty($goodiebag))
                <input type="text" class="text-field nomaxw w-input" maxlength="256" name="contents" placeholder="Welke sample wil je aanbieden?" required="">
                <input type="number" class="text-field nomaxw w-input" step="1" name="stock" placeholder="Hoeveel maximaal verstrekken?" required="">
                <div class="disclaimer">Er verschijnt een ‘gratis sample claimen’ knop in jouw stall.</div>
                <input type="submit" value="Sample toevoegen" data-wait="Please wait..." class="button w-button">
              @else
                <input type="text" class="text-field nomaxw w-input" maxlength="256" name="contents" placeholder="Welke sample wil je aanbieden?" required="" value="{{$goodiebag->contents}}">
                <input type="number" class="text-field nomaxw w-input" step="1" name="stock" placeholder="Hoeveel maximaal verstrekken?" value="{{$goodiebag->stock}}" required="">
                <label>Upload logo</label>
                <input type="file" class="text-field nomaxw w-input" name="logo">
                <input type="submit" value="Sample bijwerken" data-wait="Please wait..." class="button w-button">
                <ul role="list" class="dashboard-list w-list-unstyled">
                  <li class="dashboard-list-item w-clearfix" style="margin-top: 25px">
                    <div class="list-item-data">
                      <div class="important">Sample: {{$goodiebag->contents}}</div>
                      <div class="light">Aantal: {{$goodiebag->stock}}</div>
                      @if($goodiebag->logo)
                        <img src="{{ '/public'.$goodiebag->logo }}" style="max-width:200px;">
                      @endif
                    </div>
                  </li>
                </ul>
              @endif --}}

            </div>
          </form>
          
            <form action="{{ route('stall.no-sample.change') }}" method="POST" id="noSampleForm">
                @csrf
                <input type="hidden" name="stall_id" value="{{ $stall->id }}">
            </form>
          @endif
      </div>
      <div class="login-form">
          <h1 class="dark">Coupons</h1>
          <a style="margin-bottom: 10px; background-color:green;" href="coupons/add" class="button w-button">+</a>
          <ul role="list" class="dashboard-list w-list-unstyled">
            @foreach($coupons as $coupon)
            <li class="dashboard-list-item w-clearfix">
              <div class="list-item-data">
                <div class="important">Coupon: {{$coupon->name}}</div>
                <div class="light">Prijs: {{$coupon->price}}</div>
                <div class="light">Item: {{$coupon->item}}</div>
                {{-- <img src="{{asset($coupon->image_url)}}" alt="Coupon" style="height: 100px; width: auto"> --}}
                <img src="{{ asset('uploads/event-s/thumbnails') }}/{{ $coupon->image_url }}" alt="Coupon" style="height: 100px; width: auto">
              </div>
              <div class="list-item-action">
                <a href="coupon/{{$coupon->id}}" class="button w-button">bewerken</a>
                <a href="coupons/{{$coupon->id}}/delete" class="button gradient w-button">verwijderen</a>
              </div>
            </li>
            @endforeach
          </ul>
      </div>
    </div>
  </div>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('geenSampleCheckbox');
      const goodiebagForm = document.getElementById('goodiebagForm');
      const form = document.getElementById('noSampleForm');

      checkbox.addEventListener('change', function() {
        form.submit();
        // if (checkbox.checked) {
        //     goodiebagForm.style.display = 'none';
        //  } else {
        //      goodiebagForm.style.display = 'block';
        //  }
      });
  });
</script>
@endsection

{{-- @push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let step = 1;
        let max_step = 4;

        $(document).ready(function(){
            $('body').on('click', '.stepper-btn', function(){
                let slide_direction = $(this).data('direction');
                if(slide_direction == 'left' && step !=1){

                    $('.step'+step).hide("slide", { direction: 'right' }, 200, function () {
                        $('.step'+(--step)).show("slide", { direction: 'left' }, 200);
                    }); 


                    // $('.step'+step).slideUp();
                    // $('.step'+(--step)).slideDown();
                }else if(slide_direction == 'right' && step != max_step){ 
                    // $('.step'+step).slideUp();
                    // $('.step'+(++step)).slideDown();

                     $('.step'+step).hide("slide", { direction: 'left' }, 200, function () {
                        $('.step'+(++step)).show("slide", { direction: 'right' }, 200);
                    }); 

                }
            })
        });
    </script>
@endpush --}}