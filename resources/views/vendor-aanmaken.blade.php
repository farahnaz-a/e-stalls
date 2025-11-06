@extends('layouts.main')

@section('title', 'Account aanmaken')

@include('includes.passwork-toggler.index')

@section('content')
  <div class="normal-section gradient wf-section">
    <div class="container center w-container">
      <div class="login-form">
        <form action="{{url('vendor-aanmaken')}}" method="post" class="create-account">
          @csrf
          <h1 class="dark">Vendor-Account aanmaken</h1>
          <div class="double">
            <input type="text" class="text-field w-input" maxlength="256" name="first_name" required placeholder="Voornaam" id="name">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="last_name" required placeholder="Achternaam" id="name-2">
          </div>
            <div class="double">
                <input type="email" class="text-field w-input" maxlength="256" name="email" required placeholder="E-Mail" id="name-3">
                <div data-password="wrapper">
                    <input data-password="input" type="password" class="text-field dobule w-input" maxlength="256" name="password" required placeholder="Wachtwoord" id="name-2">
                    <button type="button" data-password="toggler">
                        <i data-password="icon" class="far fa-eye"></i>
                    </button>
                </div>
            </div>
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="street" required placeholder="Straat + nummer" id="Straatnummer">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="zip" required placeholder="Postcode" id="Postcode">
          </div>
          <div class="double">
            <input type="text" class="text-field w-input" maxlength="256" name="town" required placeholder="Plaats" id="town">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="country" required placeholder="Land" id="name-2">
          </div>
          <div class="double">
            <input type="text" class="text-field w-input" maxlength="256" name="vendor_name" required placeholder="Bedrijfsnaam">
            <input type="text" class="text-field dobule w-input" maxlength="256" name="vendor_about" required placeholder="Bedrijfsbeschrijving">
          </div>
          <select name="event"class="text-field nomaxw w-select">
            <option value="">Kies event..</option>
            @foreach($events as $event)
            <option value="{{$event->id}}">{{$event->name}}</option>
            @endforeach
          </select>
          <select name="permissions[]" multiple id="permissions" class="text-field nomaxw w-select">
            <option value="">Welke opties wil je?</option>
            <option value="logo">Logo advertentie</option>
            <option value="movie">Video plaatsen</option>
            <option value="stall">Stall plaatsen</option>
            <option value="auction">Veiling-items plaatsen</option>
            <option value="goodiebag">Goodiebag Item aanbieden</option>
          </select>
          <div class="auction-items" id="auction-items" style="display: none">
              <input type="number" class="text-field w-input" min="0" style="max-width: 100% !important" name="auction_item_count" placeholder="Aantal veiling-items" id="auction_item_count">
          </div>

            Houd ctrl ingedrukt om meerdere te selecteren.<br>
          <label class="w-checkbox checkbox-field">
            <input type="checkbox" id="checkbox" required class="w-checkbox-input">
              <span class="w-form-label" for="checkbox">Ik ga akkoord met het <a href="{{ url('/') }}/documents/privacy_policy.pdf">Privacy beleid</a> &amp; de <a href="{{ url('/') }}/documents/algemene_voorwaarden.pdf">Algemene Voorwaarden</a></span>
          </label>
          <input type="submit" value="Registreren" data-wait="Please wait..." class="button w-button">
          <p style="margin-top: 40px;">Al een account? <a href="inloggen">Log dan in.</a></p>
          <div class="alert alert-danger">
              <ul>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    @endif
                    <li id="addressValidationError" style="color: red; display: none">De combinatie van postcode en huisnummer komt ons niet bekend voor</li>
              </ul>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $("#permissions").change(function(){
                let selected_permissions = $(this).val();
                if($.inArray('auction', selected_permissions) !== -1){
                    $("#auction-items").slideDown();
                    $("#auction_item_count").attr('required', true);
                }else{
                    $("#auction-items").slideUp()
                    $("#auction_item_count").attr('required', false);
                    $("#auction_item_count").val('');
                }
            });

            let verified = false;
            $('.create-account').on('submit', function(e){
                if(!verified){
                    e.preventDefault();

                    let postcode = $("#Postcode").val();
                    let street_number = $("#Straatnummer").val();
                    let town = $("#town").val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type  : "POST",
                        url   : "{{ route('address.verification') }}",
                        data  : {
                            postcode,
                            street_number,
                            town
                        },
                        success: response => {
                            if(response){
                                $('#addressValidationError').slideUp();
                                verified = true;
                                $(this).submit();
                            }else{
                                $('#addressValidationError').slideDown();
                            }
                        },
                        error: errors => {
                            // console.log(error);
                        },
                    });
                }
            });
        });
    </script>
@endpush
