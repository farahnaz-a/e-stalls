{{-- @extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('css')
  <style>
    .title-header{
      display: flex; 
      justify-content: left; 
      align-items: center;
    }
    .margin-right{
      margin-right: 8px;
    }
  </style>
@endsection
@section('content')
<div class="container w-container">
  <div class="title-header">
    <h1 class="dark margin-right">Veilingen</h1>
    @if(request()->filter != "archive") <a style="margin-bottom: 10px; background-color:grey;" href="?filter=archive" class="button w-button">Archief</a>
    @else <a style="margin-bottom: 10px; background-color:red;" href="{{url('/')}}/admin/auctions" class="button w-button">Live Veilingen</a>
    @endif
  </div>
<!--  <a style="margin-bottom: 10px; background-color:green;" href="events/add" class="button w-button">Nieuwe veiling</a> -->
  <ul role="list" class="dashboard-list w-list-unstyled">
    @foreach($auctions as $auction)
    @if(request()->filter == "archive")
    @if($auction->status == "archive")
    <li class="dashboard-list-item w-clearfix">
      <div class="list-item-data">
        <div class="important">Veiling: {{$auction->name}}</div>
        <div class="light">Eindbod: €{{$auction->current_bid}}</div>
        <div class="light">Status: {{$auction->status}}</div>
      </div>
      <div class="list-item-action">
        <a href="auction-log/{{$auction->id}}" class="button w-button">Bekijk veiling-log</a>
        <a href="auctions/{{$auction->id}}/archive" class="button w-button" style="background-color:grey">{{ $auction->status = $auction->status == 'archive' ? 'live zetten':'archiveren' }}</a>
        <a href="auctions/{{$auction->id}}/settings" class="button gradient w-button" style="margin-left: 0px;">Veiling settings</a>
      </div>
    </li>
    @endif
    @else
    @if($auction->status != "archive")
    <li class="dashboard-list-item w-clearfix">
      <div class="list-item-data">
        <div class="important">Veiling: {{$auction->name}}</div>
        <div class="light">Eindbod: €{{$auction->current_bid}}</div>
        <div class="light">Status: {{$auction->status}}</div>
      </div>
      <div class="list-item-action">
        <a href="auction-log/{{$auction->id}}" class="button w-button">Bekijk veiling-log</a>
        <a href="auctions/{{$auction->id}}/archive" class="button w-button" style="background-color:grey">{{ $auction->status = $auction->status == 'archive' ? 'live zetten':'archiveren' }}</a>
        <a href="auctions/{{$auction->id}}/settings" class="button gradient w-button" style="margin-left: 0px;">Veiling settings</a>
      </div>
    </li>
    @endif
    @endif
    @endforeach
  </ul>
</div>
@endsection --}}



@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('css')
  <style>
    .title-header{
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .filter-container {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    .search-form {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
    .search-form input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .no-results {
      text-align: center;
      padding: 30px;
      background: #f9f9f9;
      border-radius: 8px;
      margin: 20px 0;
    }
    .auction-info {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 10px;
    }
    .auction-info div {
      background: rgba(54, 62, 93, 0.1);
      padding: 8px 12px;
      border-radius: 4px;
    }
 
    .search-area{
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    .button {
      margin: 0 !important;
    }
    .search-area button{
      margin-left: 10px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__clear{
        margin-left: 8px;
    }
    .search-input{
        height: 28px;
        border: 1px solid #b4b4b4; 
        border-radius: 4px;
    }

  </style>
  
  <link href="{{ url('/') }}/select2/select2.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="container w-container">
  <div class="title-header">
    <div>
      <h1 class="dark">Veilingen</h1>
    </div>
    <div class="filter-container">
      @if(request()->filter != "archive")
        <a href="?filter=archive" class="button w-button" style="background-color:grey;">Archief</a>
      @else 
        <a href="{{url('/')}}/admin/auctions" class="button w-button" style="background-color:red;">Live Veilingen</a>
      @endif
    </div>
  </div>
  <!-- Search Form -->
    <div class="search-area">
        <form action="{{ url()->current() }}" method="get" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center; margin-bottom: 15px">
            <div>
                <input type="hidden" name="filter" value="{{ request('filter') }}">
                <select name="filter_event" class="select2" id="eventList">
                    <option value="">Selecteer evenement</option>
                    @foreach ($events as $event)    
                        <option value="{{ $event->id }}" {{ request('filter_event') && request('filter_event') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
            <div> 
                <select name="filter_vendor" class="select2-ii" id="vendorList">
                    <option value="">Selecteer vendor</option>
                    @if (request('filter_event') && $events->where('id', request('filter_event'))->first())
                        @foreach ($events->where('id', request('filter_event'))->first()->getVendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ request('filter_vendor') && request('filter_vendor') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <input type="text" name="search" class="search-input" placeholder="Zoek op veilingnaam..." value="{{ request('search') }}">
            <div>
                <button type="submit" class="button w-button">Zoeken</button>
                @if(request()->has('search'))
                    <a href="{{ url()->current() }}?filter={{ request('filter') }}" class="button w-button" style="background-color: #ccc;">Reset</a>
                @endif
            </div>
        </form>
    </div>


  @if($auctions->count() == 0)
    <div class="no-results">
      <h3>Geen veilingen gevonden</h3>
      <p>Er zijn geen veilingen die aan je zoekcriteria voldoen.</p>
      <a href="{{ url()->current() }}?filter={{ request('filter') }}" class="button w-button">Alle veilingen tonen</a>
    </div>
  @else
    <ul role="list" class="dashboard-list w-list-unstyled">
      @foreach($auctions as $auction)
        <li class="dashboard-list-item w-clearfix">
          <div class="list-item-data">
            <div class="important">Event: {{ App\Models\Event::find($auction->eventID)->name }}</div>
            <div class="important">Vendor: {{ $auction->getVendor->name ?? '' }}
            </div>
            <div class="important">Veiling: {{$auction->name}}</div>
            <div class="auction-info">
              <div>Startbod: €{{ number_format($auction->min_bid, 2) }}</div>
              <div>Eindbod: €{{ number_format($auction->current_bid, 2) }}</div>
              <div>Status: {{ $auction->status }}</div>
              
              {{-- Safe date formatting --}}
              @php
                $safeFormat = function($value) {
                    try {
                        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i');
                    } catch (\Exception $e) {
                        return 'Ongeldige datum';
                    }
                };
              @endphp
              
                @if($auction->start_time)
                    <div>Starttijd: {{ $safeFormat($auction->event->start_date.' '. $auction->start_time) }}</div>
                @endif
                @if($auction->end_time)
                    <div>Eindtijd: {{ $safeFormat($auction->event->start_date.' '. $auction->end_time) }}</div>
                @endif
                {{-- @if($auction->duration)
                    <div>Looptijd: {{ $auction->duration }} minuten</div>
                @endif --}}
            </div>
          </div>
          <div class="list-item-action">
            <a href="auction-log/{{$auction->id}}" class="button w-button">Bekijk veiling-log</a>
            <a href="auctions/{{$auction->id}}/archive" class="button w-button" style="background-color:grey;">
              {{ $auction->status == 'archive' ? 'Live zetten' : 'Archiveren' }}
            </a>
            <a href="auctions/{{$auction->id}}/settings" class="button gradient w-button">Veiling settings</a>
          </div>
        </li>
      @endforeach
    </ul>
  @endif
</div>
@endsection

@section('js')
  <script src="{{ url('/') }}/select2/select2.min.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2({        
        placeholder: "Selecteer evenement",
        allowClear: true,
        width: '100%',
      });
      $('.select2-ii').select2({        
        placeholder: "Selecteer vendor",
        allowClear: true,
        width: '100%',
      });
      $("#eventList").on('change', function(e){
        let event = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    : "POST",
            url     : "{{ route('admin.event.change.vendor') }}",
            data    : {event},
            success: (response) => {
                $("#vendorList").html(response)
            }
        });

      })
    });
  </script>
@endsection