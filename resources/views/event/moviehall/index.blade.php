@extends('layouts.event')
@section('wfdata', '61f28c8aa8fcfe68dcd0db32')
@section('title', 'Movie Hall - E-STALLS')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('plugins/venobox/css/venobox.min.css') }}">
@endsection
@section('content')
  <div class="event-bar movie-hall wf-section">
    <div class="container w-container">
      <h1 class="hall-heading">Movie Hall</h1>
    </div>
  </div>
  <div class="container special w-container">
    <div class="w-layout-grid movies-grid">
    @foreach($movies as $movie)
        @php
            $url = $movie->video_url;
            if (!Str::startsWith($url, 'http')) {
                $url = "http://youtu.be/$url";
            }
        @endphp
      {{-- <a style="background-image: linear-gradient(90deg, rgba(54, 62, 93, 0.8), rgba(147, 46, 127, 0.8) 58%, rgba(207, 164, 70, 0.8)), url('{{ asset('uploads/vendor/mvtmb') }}/{{ $movie->thumbnail_url }}') !important;" id="w-node-_12ba3be9-43c6-2a1a-6374-5e68896ffefe-dcd0db32" href="{{url('/') . '/event/' . $event->id . '/movie/' . $movie->id }}" class="movie-block w-inline-block"><img src="{{url('/')}}/images/Group-75.png" loading="lazy" alt="" class="play-button"> --}}
      <a style="background-image: linear-gradient(90deg, rgba(54, 62, 93, 0.8), rgba(147, 46, 127, 0.8) 58%, rgba(207, 164, 70, 0.8)), url('{{ asset('uploads/vendor/mvtmb') }}/{{ $movie->thumbnail_url }}') !important;" id="w-node-_12ba3be9-43c6-2a1a-6374-5e68896ffefe-dcd0db32" data-autoplay="true" data-vbtype="video" href="{{$url}}" class="movie-block w-inline-block"><img src="{{url('/')}}/images/Group-75.png" loading="lazy" alt="" class="play-button">
        <div class="movie-name">{{$movie->video_name}}</div>
        <div class="press-to-play">klik om af te spelen</div>
      </a>

      @endforeach
    {{-- <div id="w-node-_087ce150-7cab-0355-ffcf-a2f4c8c255d6-d4a0dfcb" class="hero-content">
        <h1>Ontvang goodiebags, couponcodes, scoor de nieuwste producten/diensten van diverse brands en maak kans op waanzinnige prijzen.</h1>
        <a href="http://youtu.be/Tnnd_Wk_vhE" class="popup-btn button w-button" data-autoplay="true" data-vbtype="video">Waarom E-STALLS?</a>
    </div> --}}
    </div>
  </div>

@endsection
@section('vendor-js')
    <script src="{{ asset('plugins/venobox/js/venobox.min.js') }}"></script>
    <script>
        new VenoBox({
            selector: '.movie-block',
        });
    </script>
@endsection
