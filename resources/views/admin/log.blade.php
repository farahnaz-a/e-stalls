@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container w-container">
  <h1 class="dark">Log:</h1>
  <ul role="list" class="dashboard-list w-list-unstyled">
    {{-- @dd($log) --}}
    @if($log)
    @foreach(json_decode($log->log, true)['actions'] as $line)
    <li class="dashboard-list-item w-clearfix">
      {{$line}}
    </li>
    @endforeach
    @else
    <li class="dashboard-list-item w-clearfix">
      No log available.
    </li>
    @endif
  </ul>
</div>
@endsection
