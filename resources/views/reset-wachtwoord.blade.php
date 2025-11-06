@extends('layouts.main')

@section('title', 'Account aanmaken')

@include('includes.passwork-toggler.index')

@push('css')
    <style>
        .text-field2 { 
            border: 1px #000;
            border-bottom: 1px solid rgba(0, 0, 0, .18);
            margin-bottom: 20px;
        }
    </style>
@endpush
@section('content')
  <div class="normal-section gradient wf-section">
    <div class="container center w-container">
      <div class="login-form">
        <form action="/reset-password" method="post" class="create-account">
          @csrf
          <h1 class="dark">Wachtwoord veranderen</h1>
            <input type="email" class="text-field2 w-input" maxlength="256" name="email" required placeholder="E-Mail">
            <div data-password="wrapper">
                <input data-password="input" type="password" class="text-field2 w-input" maxlength="256" id="pss" name="password" required placeholder="Nieuw wachtwoord">
                <button type="button" data-password="toggler">
                    <i data-password="icon" class="far fa-eye"></i>
                </button>
            </div>
            <div data-password="wrapper">
                <input data-password="input" type="password" class="text-field2 w-input" maxlength="256" name="password_confirmation" required placeholder="Herhaal nieuw wachtwoord">
                <button type="button" data-password="toggler">
                    <i data-password="icon" class="far fa-eye"></i>
                </button>
            </div>
            <input type="hidden" class="text-field2 w-input" maxlength="256" name="token" required value="{{ $token }}">
            <input type="submit" value="Aanvragen" data-wait="Please wait..." class="button w-button">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif
        </form>
      </div>
    </div>
  </div>

@endsection
