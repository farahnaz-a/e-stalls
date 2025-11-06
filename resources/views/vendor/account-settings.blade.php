@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@include('includes.passwork-toggler.index')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form class="create-account">
          <h1 class="dark">Account instellingen</h1>
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="name" data-name="Name" placeholder="Voornaam" id="name"><input type="text" class="text-field dobule w-input" maxlength="256" name="name-2" data-name="Name 2" placeholder="Achternaam" id="name-2"></div>
        <div class="double">
              <input type="email" class="text-field w-input" maxlength="256" name="name-3" data-name="Name 3" placeholder="E-Mail" id="name-3">
              <div data-password="wrapper" style="padding-left: 0">
                <input data-password="input" type="password" style="padding-left: 5px" class="text-field dobule w-input" maxlength="256" name="name-2" data-name="Name 2" placeholder="Wachtwoord" id="name-2">
                <button type="button" data-password="toggler">
                    <i data-password="icon" class="far fa-eye"></i>
                </button>
              </div>
        </div>
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="name-3" data-name="Name 3" placeholder="Straat + nummer" id="name-3"><input type="text" class="text-field dobule w-input" maxlength="256" name="name-2" data-name="Name 2" placeholder="Postcode" id="name-2"></div>
          <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="name-3" data-name="Name 3" placeholder="Plaats" id="name-3"><input type="text" class="text-field dobule w-input" maxlength="256" name="name-2" data-name="Name 2" placeholder="Land" id="name-2"></div><input type="submit" value="Updaten" data-wait="Please wait..." class="button w-button">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
