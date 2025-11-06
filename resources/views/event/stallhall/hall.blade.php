@extends('layouts.event')
@section('wfdata', '61caf41b43a756050ed32548')
@section('title', 'Stall Hall - E-STALLS')
@section('content')
<div class="event-bar wf-section">
  <div class="container w-container">
    <h1 class="hall-heading">Stall Hall</h1>
  </div>
</div>
<div class="container special w-container">
  <img src="{{url('/')}}/images/Stall-Hall.jpg" sizes="100vw">
  <div class="w-layout-grid stalls">
    <a id="w-node-_66e00058-51d5-6b5f-cfb2-bffec2b4f073-0ed32548" data-w-id="66e00058-51d5-6b5f-cfb2-bffec2b4f073" href="{{url('/')}}/event/{{$event->id}}/auctionhall" class="stall special w-inline-block">
      <div class="stall-name special">Auction Hall</div>
    </a>
    @if (!empty($stalls))
      @foreach ($stalls as $stall)
    
        @if ($stall[3] == "0")
        <a id="w-node-_65b7f5fe-6565-9476-373d-c028f6727e03-0ed32548" data-w-id="65b7f5fe-6565-9476-373d-c028f6727e03" href="{{url('/')}}/event/{{$event->id}}/stallhall/{{$stall[0]}}" class="stall {{$stall[4]}} w-inline-block"><img src="{{ asset('uploads/stalls/logo') }}/{{$stall[2]}}" loading="lazy" alt="" class="image-2">
          <div class="stall-name {{$stall[5]}}">{{$stall[1]}}</div>
        </a>
        @else
        <a id="w-node-_0702c70b-3c45-bc49-e3ec-c8787363a8fe-0ed32548" data-w-id="0702c70b-3c45-bc49-e3ec-c8787363a8fe" href="{{url('/')}}/event/{{$event->id}}/stallhall/{{$stall[0]}}" class="stall {{$stall[4]}} w-inline-block"><img src="{{ asset('uploads/stalls/logo') }}/{{$stall[2]}}" loading="lazy" alt="" class="image-2">
          <div class="stall-name {{$stall[5]}}">{{$stall[1]}}</div>
        </a>
        @endif
      @endforeach
    @endif
    <a id="w-node-efb883e7-982a-7326-09f3-0cee34888f1c-0ed32548" data-w-id="efb883e7-982a-7326-09f3-0cee34888f1c" href="{{url('/')}}/event/{{$event->id}}/moviehall" class="stall special w-inline-block">
      <div class="stall-name special">Movie Hall</div>
    </a>
  </div>
</div>
<div class="people wf-section"><img src="{{url('/')}}/images/2295-5.jpg" loading="lazy" id="w-node-b5d298a3-0a72-012a-fbf6-469db8ba1004-0ed32548" sizes="100px" srcset="{{url('/')}}/images/2295-5.jpg 500w, {{url('/')}}/images/2295-5.jpg 510w" alt="" class="image-3"><img src="{{url('/')}}/images/2295-8.jpg" loading="lazy" id="w-node-ed2e8155-ea93-4ba7-f448-abce8175e445-0ed32548" sizes="100px" srcset="{{url('/')}}/images/2295-8.jpg 500w, {{url('/')}}/images/2295-8.jpg 511w" alt="" class="image-3"><img src="{{url('/')}}/images/2298-4.jpg" loading="lazy" id="w-node-_379ab3f4-f375-d91d-5b86-5c87163d6525-0ed32548" sizes="100px" srcset="{{url('/')}}/images/2298-4.jpg 500w, {{url('/')}}/images/2298-4.jpg 510w" alt="" class="image-3"><img src="{{url('/')}}/images/2295-7.jpg" loading="lazy" id="w-node-de9b621e-f19a-1c0d-a8f6-ad1fee9d2770-0ed32548" alt="" class="image-3 mobilehid"><img src="{{url('/')}}/images/2298-5.jpg" loading="lazy" id="w-node-_1cc0ad04-36ea-0f8a-83ad-e3479b62315f-0ed32548" sizes="(max-width: 991px) 100vw, 120px" srcset="{{url('/')}}/images/2298-5.jpg 500w, {{url('/')}}/images/2298-5.jpg 623w" alt="" class="image-3 wider"></div>
@endsection
