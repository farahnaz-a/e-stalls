@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container w-container">
  
  <form action="{{url('admin/accounts/' . $vendor->ownerID . '/save')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div><label for="logo">Logo advertentie</label><input id="logo" type="checkbox" {{ (str_contains($vendor->permissions, 'logo') && str_contains($vendor->permissions, 'approved')) ? 'checked' : '' }} name="logo"></div>
    <div><label for="movie">Video plaatsen</label><input id="movie" type="checkbox" {{ (str_contains($vendor->permissions, 'movie') && str_contains($vendor->permissions, 'approved')) ? 'checked' : '' }} name="movie"></div>
    <div><label for="stall">Stall plaatsen</label><input id="stall" type="checkbox" {{ (str_contains($vendor->permissions, 'stall') && str_contains($vendor->permissions, 'approved')) ? 'checked' : '' }} name="stall"></div>
    <div><label for="auction">Veiling-items plaatsen</label><input id="auction" type="checkbox" {{ (str_contains($vendor->permissions, 'auction') && str_contains($vendor->permissions, 'approved')) ? 'checked' : '' }} name="auction"></div>
    <div><label for="goodiebag">Goodiebag Item aanbieden</label><input id="goodiebag" type="checkbox" {{ (str_contains($vendor->permissions, 'goodiebag') && str_contains($vendor->permissions, 'approved')) ? 'checked' : '' }} name="goodiebag"></div>
    <input type="submit" value="Opslaan" data-wait="Even geduld a.u.b..." class="button w-button">
  </form>
  
</div>
@endsection
