@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
{{-- <div class="container w-container">
  <h1 class="dark">Ondernemer</h1>
  <ul role="list" class="dashboard-list w-list-unstyled">
    @foreach($items as $item)
    <li class="dashboard-list-item w-clearfix">
      <div class="list-item-data">
        <div class="important"><span class="light">Vendor options:</span> {{$item->offer}}</div>
        <div class="important"><span class="light">Voornaam:</span> {{$item->first_name}}</div>
        <div class="important"><span class="light">Achternaam:</span> {{$item->last_name}}</div>
        <div class="important"><span class="light">E-Mail:</span> {{$item->email}}</div>
        <div class="important"><span class="light">Tel. Nummer:</span> {{$item->phone}}</div>
        <div class="important"><span class="light">Bericht:</span> {{$item->message}}</div>
      </div>
    </li>
    @endforeach
  </ul>
</div> --}}


<div class="container w-container">
  <h1 class="dark">Ondernemer</h1>
  @if($filter != "archive") <a style="margin-bottom: 10px; background-color:grey;" href="?filter=archive" class="button w-button">Archief</a>
  @else <a style="margin-bottom: 10px; background-color:red;" href="{{url('/')}}/admin/ondernemer" class="button w-button">Live Ondernemer</a>
  @endif
  <ul role="list" class="dashboard-list w-list-unstyled">
    @foreach($items as $item)
      @if($filter != "archive")
        @if($item->status != "archive")
          <li class="dashboard-list-item w-clearfix">
            <div class="list-item-data">
              <div class="important">Vendor options: {{$item->offer}}</div>
              <div class="light">Voornaam: {{$item->first_name}}</div>
              <div class="light">Achternaam: {{$item->last_name}}</div>
              <div class="light">Email: {{$item->email}}</div>
              <div class="light">Tel. Nummer: {{$item->phone}}</div>
              <div class="light">Bericht: {{$item->message}}</div>
            </div>
            <div class="list-item-action">
              <a href="{{url('admin/ondernemer/'.$item->id.'/archive')}}" class="button w-button" style="background-color:grey; display:inline-block;">archiveren</a>
              
              <form action="{{url('admin/ondernemer/'.$item->id.'/delete')}}" method="post" style="display:inline-block;">
                @csrf
                <button type="submit" class="button gradient w-button">verwijderen</button>
              </form>
            </div>
          </li>
        @endif
      @else
        @if($item->status == "archive")
          <li class="dashboard-list-item w-clearfix">
            <div class="list-item-data">
              <div class="important">Vendor options: {{$item->offer}}</div>
              <div class="light">Voornaam: {{$item->first_name}}</div>
              <div class="light">Achternaam: {{$item->last_name}}</div>
              <div class="light">Email: {{$item->email}}</div>
              <div class="light">Tel. Nummer: {{$item->phone}}</div>
              <div class="light">Bericht: {{$item->message}}</div>
            </div>
            <div class="list-item-action">
              <a href="ondernemer/{{$item->id}}/live" class="button w-button" style="background-color:red">live zetten</a>
              <a href="ondernemer/{{$item->id}}/delete" class="button gradient w-button">verwijderen</a>
            </div>
          </li>
        @endif
      @endif
    @endforeach
  </ul>
</div>
@endsection
