
@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('css')
  <style>
    .page-header{
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 15px;
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
    .inline-container {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .inline-form {
      margin: 0;
    }
    .vendor-info {
      background: #f9f9f9;
      border-radius: 8px;
      /* padding: 15px;
      margin-bottom: 20px; */
    }
    .vendor-info-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .vendor-details {
      margin-bottom: 10px;
    }
    .goodiebag-content {
      background: white;
      /* padding: 15px; */
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .event-header {
      background: #363e5d;
      color: white;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
  </style>
  <link href="{{ url('/') }}/select2/select2.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="container w-container">
  <div class="page-header">
    <h1 class="dark">Goodiebag</h1>
    <div>
      <a style="margin-bottom: 10px;" href="{{url('admin/goodiebag/popup/prices/add')}}" class="button gradient w-button">Nieuwe Goodiebag Prijs</a>
      @if($filter != "archive")
        <a style="margin-bottom: 10px; background-color:grey;" href="?filter=archive" class="button w-button">Archief</a>
      @else
        <a style="margin-bottom: 10px; background-color:red;" href="{{url('/')}}/admin/goodiebag" class="button w-button">Live goodiebag</a>
      @endif
    </div>
  </div>

  <div class="page-header">
    <div class="search-area">
      <form action="" method="get" style="display: flex; gap: 10px; flex-wrap: wrap;">
        <div style="margin-top: 5px">
          <input type="hidden" name="filter" value="{{ $filter }}">
          <select name="filter-event" class="select2">
            <option value="">Selecteer evenement</option>
            @foreach ($events as $event)
              <option value="{{ $event->id }}" {{ $selectedEvent && $selectedEvent->id == $event->id ? 'selected' : '' }}>
                {{ $event->name }}
              </option>
            @endforeach
          </select>
        </div>
       <div>
         <button type="submit" class="button w-button">Filter</button>
          @if($selectedEvent)
            <a href="?filter={{ $filter }}" class="button w-button" style="background-color: #ccc;">Reset</a>
          @endif
       </div>
      </form>
    </div>
  </div>

  @if($selectedEvent)
    <div class="event-header">
      <h3>Goodiebag {{ $selectedEvent->name }}</h3>
    </div>
  @endif

  @if($goodiebags->count() > 0)
    <div class="vendor-list">
      @if(!$selectedEvent)
        @foreach($goodiebags as $index => $goodiebag)
          <div class="vendor-info">
            <div class="vendor-info-header">
                <h4>Vendor: {{ $goodiebag->getVendor ? $goodiebag->getVendor->name : $goodiebag->vendor->name ?? 'Onbekende vendor' }}</h4>
                <div class="list-item-action">
                    <div class="inline-container">
                      <form action="{{ url('admin/goodiebag/'.$goodiebag->id.'/delete') }}" method="POST" class="inline-form">
                        @csrf
                        <button type="submit" class="button w-button">Verwijderen</button>
                      </form>
                      <a href="{{ url('admin/goodiebag/'.$goodiebag->id.'/edit') }}" class="button gradient w-button">Bewerken</a>
                      @if($filter != "archive")
                        <a href="{{ url('admin/goodiebag/'.$goodiebag->id.'/archive') }}" class="button w-button" style="background-color:grey">Archiveren</a>
                      @else
                        <a href="{{ url('admin/goodiebag/'.$goodiebag->id.'/live') }}" class="button w-button" style="background-color:red">Live zetten</a>
                      @endif
                  </div>
                </div>
              </div>
            <h4>Item {{ $index + 1 }}: {{ $goodiebag->contents }} from vendor: {{ $goodiebag->getVendor ? $goodiebag->getVendor->name : $goodiebag->vendor->name ?? 'N/A' }}</h4>
              <h4>Event: {{ $goodiebag->event->name ?? '' }}</h4>
            <div class="goodiebag-content">
                <div><strong>Email:</strong>
                    @if ($goodiebag->getVendor)
                        {{ $goodiebag->getVendor->user->email ?? 'N/A' }}
                    @elseif ($goodiebag->vendor)
                        {{ $goodiebag->vendor->user->email ?? 'N/A' }}
                    @else
                        N/A
                    @endif
                </div>
                <div><strong>Aantal:</strong> {{ $goodiebag->stock }} items</div>

                <div class="light" style="margin-top: 10px;">
                    <strong>Logo:</strong>
                    @if($goodiebag->logo)
                      <img src="{{ asset('uploads/goodiebag/logo') }}/{{ $goodiebag->logo }}"
                          style="height: 100px; width:120px"
                          alt="Goodiebag Logo">
                    @endif
                </div>
            </div>
          </div>
        @endforeach
      @else
        <div>
            {{-- <div class="vendor-info-header">
                <h4>Goodiebag: {{ $selectedEvent ?? 'Onbekend evenement' }}</h4>
            </div> --}}
            <ul role="list" class="dashboard-list w-list-unstyled">
              @foreach($goodiebags as $index => $goodiebag)
                <li class="dashboard-list-item w-clearfix">
                  <h4>Item {{ $index + 1 }}: {{ $goodiebag->contents }} from vendor: {{ $goodiebag->getVendor ? $goodiebag->getVendor->name : $goodiebag->vendor->name ?? 'N/A' }}</h4>
                  <div>
                    <div><strong>Email:</strong>
                        @if ($goodiebag->getVendor)
                            {{ $goodiebag->getVendor->user->email ?? 'N/A' }}
                        @elseif ($goodiebag->vendor)
                            {{ $goodiebag->vendor->user->email ?? 'N/A' }}
                        @else
                            N/A
                        @endif
                    </div>
                      <div><strong>How many items:</strong> {{ $goodiebag->stock }}</div>
                  </div>
                </li>
              @endforeach
            </ul>
            {{-- @foreach($goodiebags as $index => $goodiebag)
            <div style="margin-bottom: 20px">
                <h4>Item {{ $index + 1 }}: {{ $goodiebag->contents }} from vendor: {{ $goodiebag->vendor->name ? $goodiebag->vendor->name : (App\Models\User::where('id', $goodiebag->vendor_id)->first()->name) ?? 'N/A' }}</h4>
                <div class="goodiebag-content">
                    <div><strong>Email:</strong> {{ $goodiebag->vendor->user->email ?? 'N/A' }}</div>
                    <div><strong>How many items:</strong> {{ $goodiebag->stock }}</div>
                </div>
            </div>
            @endforeach --}}
        </div>
      @endif
    </div>
  @else
    <div class="no-results" style="text-align: center; padding: 30px; background: #f9f9f9; border-radius: 8px;">
      <h3>Geen goodiebags gevonden</h3>
      <p>Er zijn geen goodiebags die aan je criteria voldoen.</p>
      @if($selectedEvent)
        <a href="?filter={{ $filter }}" class="button w-button">Toon alle goodiebag items</a>
      @endif
    </div>
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
    });

    const navigationEntries = performance.getEntriesByType('navigation');
    if (navigationEntries.length > 0 && navigationEntries[0].type === 'reload') {
      if (window.location.search) {
        window.location.href = "{{ url('/admin/goodiebag') }}";
      }
    }
  </script>
@endsection
