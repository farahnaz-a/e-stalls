@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="" enctype="multipart/form-data" class="create-account">
            @csrf
            <h1 class="dark">Stall Bewerking</h1>
            <textarea maxlength="50" name="description" required="" class="w-input">{{ $stall->description }}</textarea>
            @if($stall->logo_url)
                <label>Bestaand logo</label>
                <img src="{{ asset('uploads/stalls/logo') }}/{{ $stall->logo_url }}" style="width:200px" alt="logo" />
            @endif
            <label style="margin-top: 15px">Wijzig logo</label>
            <input type="file" class="text-field nomaxw w-input" name="logo">

            <select name="shipping_cost" class="select-field w-input" required>
                <option disabled value="" selected>Selecteer verzendkosten</option>
                <option value="3.95" @if($stall->shipping_cost == '3.95') selected @endif>-€3,95</option>
                <option value="6.95" @if($stall->shipping_cost == '6.95') selected @endif>-€6,95</option>
                <option value="0" @if($stall->shipping_cost == '0') selected @endif>-Geen verzendkosten</option>
            </select>
            <input type="number" value="{{ isset($stall->free_shipping_above) ? $stall->free_shipping_above:'' }}" class="text-field nomaxw w-input" placeholder="Voer het minimale bestelbedrag in voor gratis verzending" name="free_shipping_above" required>

            <input type="submit" value="Toevoegen" data-wait="Please wait..." class="button w-button">

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
