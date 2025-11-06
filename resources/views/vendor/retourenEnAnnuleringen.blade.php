@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form class="create-account">
          <h1 class="dark">Retouren en annuleringen</h1>
           <div>
              <a href="{{ route('vendor.return.list') }}">Retourformulier</a>
            </div>
            <div>
              <a href="{{ route('vendor.cancel.list') }}">Annuleringsformulieren</a>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection