@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="container bmarge w-container">
  <h1 class="dark">Veilingtijd bijwerken</h1>
    <form action="{{url('/')}}/admin/auctions/{{$auction->id}}/time-update" method="post" enctype="multipart/form-data">
      <h2 class="light"><strong class="important">Event: </strong>{{ App\Models\Event::find($auction->eventID)->name }}</h2>
      @csrf
      <h2>Algemeen</h2>
      <label for="name">Hoelaat start de veiling? {{ $auction->start_time != '00:00' ? 'Current start time '.$auction->start_time : '' }}</label>
      <input type="time" class="w-input" maxlength="256" value="{{ $auction->start_time }}" name="start_time" required="" placeholder="HH:mm">
      <label for="name">Hoelaat eindigt de veiling? {{ $auction->end_time != '00:00' ? 'Current end time '.$auction->end_time : '' }}</label>
      <input type="time" class="w-input" maxlength="256" value="{{ $auction->end_time }}" name="end_time" required="" placeholder="HH:mm">
      <input type="submit" value="Update!" data-wait="Even geduld a.u.b..." class="button w-button">
    </form>
</div>
@endsection
