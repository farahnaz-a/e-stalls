
@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <form method="POST" action="{{url('admin/goodiebag/'.$goodiebag->id.'/update')}}" enctype="multipart/form-data" class="create-account">
          @csrf
          <h1 class="dark">goodiebag bewerken</h1>
          <input type="text" class="text-field nomaxw w-input" maxlength="256" name="contents" placeholder="Wat zit er in de goodiebag?" required="" value="{{$goodiebag->contents ?? ""}}">
          <textarea name="description" id="" cols="10" rows="3" class="text-field nomaxw w-input" placeholder="Beschrijving van de goodiebag...">{{$goodiebag->description ?? ""}}</textarea>
            <input type="number" class="text-field nomaxw w-input" step="1" name="stock" placeholder="Hoeveel maximaal verstrekken?" value="{{$goodiebag->stock ?? ""}}" required="">
            <label>Upload logo</label>
            <input type="file" class="text-field nomaxw w-input" name="logo">
            <input type="submit" value="bewerken" data-wait="Please wait..." class="button w-button">
            <ul role="list" class="dashboard-list w-list-unstyled">
              <li class="dashboard-list-item w-clearfix" style="margin-top: 25px">
                <div class="list-item-data">
                  <div class="important">Goodiebag: {{$goodiebag->contents ?? ''}}</div>
                  <div class="important">Beschrijving: {{$goodiebag->description ?? ''}}</div>
                  <div class="light">Aantal: {{$goodiebag->stock ?? ''}}</div>
                  @if (!empty($goodiebag->logo))
                      <img src="{{asset('uploads/goodiebag/logo')}}/{{ $goodiebag->logo }}" style="max-width:200px;">
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
