@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container w-container">
  <h1 class="dark">Events</h1>
  <a style="margin-bottom: 10px; background-color:green;" href="events/add" class="button w-button">Nieuw Event</a>
  @if($filter != "archive") <a style="margin-bottom: 10px; background-color:grey;" href="?filter=archive" class="button w-button">Archief</a>
  @else <a style="margin-bottom: 10px; background-color:red;" href="{{url('/')}}/admin/events" class="button w-button">Live events</a>
  @endif
  <ul role="list" class="dashboard-list w-list-unstyled">
    @foreach($events as $event)
    @if($filter != "archive")
    @if($event->status != "archive")
    <li class="dashboard-list-item w-clearfix">
      <div class="list-item-data">
        <div class="important">Event: {{$event->name}}</div>
        <div class="light">Datum: {{ Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</div>
        <div class="light">Ticket Prijs: €{{$event->price}}</div>
      </div>
      <div class="list-item-action">
        <a href="events/{{$event->id}}" class="button gradient w-button">bewerken</a>
        <a href="events/{{$event->id}}/archive" class="button gradient w-button" style="background-color:grey">archiveren</a>
        <a href="events/{{$event->id}}/delete" class="button gradient w-button">verwijderen</a>
        <a href="{{ url('admin/events/'.$event->id.'/stalls') }}"
          class="button gradient w-button">
            stallhall
        </a>
        <a href="{{ url('admin/events/'.$event->id.'/movies') }}"
          class="button gradient w-button">
            moviehall
        </a>
        <a href="{{ url('admin/events/'.$event->id.'/products') }}"
          class="button gradient w-button">
            Products
        </a>
      </div>
    </li>
    @endif
    @else
    @if($event->status == "archive")
    <li class="dashboard-list-item w-clearfix">
      <div class="list-item-data">
        <div class="important">Event: {{$event->name}}</div>
        <div class="light">Datum: {{ Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</div>
        <div class="light">Ticket Prijs: €{{$event->price}}</div>
      </div>
      <div class="list-item-action">
        <a href="events/{{$event->id}}" class="button gradient w-button">bewerken</a>
        <a href="events/{{$event->id}}/live" class="button gradient w-button" style="background-color:red">live zetten</a>
        <a href="events/{{$event->id}}/delete" class="button gradient w-button">verwijderen</a>
        <a href="{{ url('admin/events/'.$event->id.'/stalls') }}"
          class="button gradient w-button"
          style="background-color: #3490dc;">
            Stallenhal
        </a>
        <a href="{{ url('admin/events/'.$event->id.'/movies') }}"
          class="button gradient w-button"
          style="background-color: #6574cd;">
            Film Hall
        </a>
      </div>
    </li>
    @endif
    @endif
    @endforeach
  </ul>
</div>
@endsection
