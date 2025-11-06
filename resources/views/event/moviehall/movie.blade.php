@extends('layouts.event')
@section('wfdata', '61f2956a2ac9c25d87c0a075')
@section('title', 'Movie Hall - E-STALLS')
@section('content')
<style>
  iframe{
    height: 780px !important;
    top: 130px !important;
  }

  .site-center-aligned{
    height: 800px !important;
  }

</style>
{{-- <div class="event-bar movie-hall wf-section">
  <div class="container w-container">
    <h1 class="hall-heading">Movie</h1>
  </div>
</div> --}}

<div class="movie-section wf-section">
  {{-- <div style="--plyr-color-main: #cfa446;" class="plyr__video-embed" id="player"> --}}
  <div style="--plyr-color-main: #cfa446;" class="plyr__video-embed">
  <iframe
    src="https://www.youtube.com/embed/{{$movie->video_url}}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
    allowfullscreen
    allowtransparency
    allow="autoplay"
  ></iframe>
</div>
</div>
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css">
<script src="https://cdn.plyr.io/3.6.12/plyr.js"></script>
<script>
  const player = new Plyr('#player');
</script>
@endsection
