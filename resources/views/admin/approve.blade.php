@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('css')
 <link rel="stylesheet" href="{{ asset('plugins/venobox/css/venobox.min.css') }}">
  <style>
    .page-header{
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    .search-area{
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .search-area input {
      flex: 1 1 300px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .search-results-header {
      margin: 20px 0;
      padding: 10px;
      background: #f5f5f5;
      border-radius: 4px;
    }
    .filter-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 15px;
    }
    .filter-tag {
      background: #e0e0e0;
      padding: 5px 10px;
      border-radius: 20px;
      display: flex;
      align-items: center;
    }
    .filter-tag button {
      background: transparent;
      border: none;
      margin-left: 5px;
      cursor: pointer;
    }
    .no-results {
      text-align: center;
      padding: 30px;
      background: #f9f9f9;
      border-radius: 8px;
      margin: 20px 0;
    }
  </style>

@endsection
@section('content')
<div class="container w-container">
  <div class="page-header">
    <h1 class="dark">Goedkeuren</h1>
    <div style="flex: 1 1 100%;">
      <form method="GET" action="{{ url()->current() }}" class="search-form">
        <div class="search-area">
          <input type="text" name="search" placeholder="Zoek op naam, titel, URL..."
                 value="{{ request('search') }}">

          <button type="submit" class="button w-button" style="background-color: #363e5d;">Zoeken</button>
          @if(request()->has('search'))
            <a href="{{ url()->current() }}" class="button w-button" style="background-color: #ccc;">Reset</a>
          @endif
        </div>
      </form>

      @if(request()->has('search'))
        <div class="search-results-header">
          <h3>Zoekresultaten</h3>
          <div class="filter-tags">
            <div class="filter-tag">
              Zoekterm: "{{ request('search') }}"
              <button onclick="removeParam('search')">&times;</button>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>

  @if($movies->count() + $logos->count() + $auctions->count() + $stalls->count() + $awaiting_vendors->count() == 0)
    <div class="no-results">
      <h3>Geen items gevonden</h3>
      <p>Er zijn geen items die aan je zoekcriteria voldoen.</p>
      <a href="{{ url()->current() }}" class="button w-button">Alle items tonen</a>
    </div>
  @else
    <ul role="list" class="dashboard-list w-list-unstyled">
      @foreach($movies as $movie)
        <li class="dashboard-list-item w-clearfix">
          <div class="w-clearfix">
            <div class="type-of-purchase">
              <div>Movie</div>
            </div>
            <div class="item-date">{{ Carbon\Carbon::parse($movie->created_at)->format('d-m-Y H:i:s') }}</div>
          </div>
          <div class="list-item-data">
            <div class="important">Titel: {{$movie->video_name}}</div>
            <div class="light">Event: <strong>{{$events->find($movie->eventID)->name}}</strong></div>
            <div class="light">Verkoper: <strong class="vendor">{{$vendors->find($movie->vendorID)->name}}</strong></div>
          </div>
          <div class="list-item-action">
             @php
                $url = $movie->video_url;
                if (!Str::startsWith($url, 'http')) {
                    $url = 'https://www.youtube.com/watch?v=' . $url;
                    }
            @endphp
            <a data-autoplay="true" data-vbtype="video" href="{{$url}}" class="movies button w-button" >movie bekijken</a>
            <a href="movies/{{$movie->id}}/accept" class="button gradient w-button">goedkeuren</a>
            <a href="movies/{{$movie->id}}/decline" class="button purple marg w-button">afkeuren</a>
          </div>
        </li>
      @endforeach
      @foreach($logos as $logo)
        <li class="dashboard-list-item w-clearfix">
          <div class="w-clearfix">
            <div class="type-of-purchase">
              <div>Logo</div>
            </div>
            <div class="item-date">{{ Carbon\Carbon::parse($logo->created_at)->format('d-m-Y H:i:s')  }}</div>
          </div>
          <div class="list-item-data">
            <div class="important">Url: {{$logo->redirect_url}}</div>
            <div class="light">Logo:
              <img width="200" src="{{ asset('uploads/vendor/logoad') }}/{{ $logo->logo_url }}" alt="Logo">
            </div>
            <div class="light">Verkoper: <strong class="vendor">{{$vendors->find($logo->vendorID)->name}}</strong></div>
          </div>
          <div class="list-item-action">
            <a href="logos/{{$logo->id}}/accept" class="button gradient w-button">goedkeuren</a>
            <a href="logos/{{$logo->id}}/decline" class="button purple marg w-button">afkeuren</a>
          </div>
        </li>
      @endforeach
      @foreach($auctions as $auction)
        <li class="dashboard-list-item w-clearfix">
          <div class="w-clearfix">
            <div class="type-of-purchase" style="background-color:orange;">
              <div>Veiling-item</div>
            </div>
            <div class="item-date">{{ Carbon\Carbon::parse($auction->created_at)->format('d-m-Y H:i:s') }}</div>
          </div>
          <div class="list-item-data">
            <div class="important">Naam item: {{$auction->name}}</div>
            <div class="important">Bieden vanaf: {{$auction->min_bid}}</div>
            {{-- <div class="important">Minimaal overbieden: {{$auction->min_step}}</div> --}}
            <div class="light">Event: <strong>{{$events->find($auction->eventID)->name}}</strong></div>
            <div class="light">Verkoper: <strong class="vendor">{{$vendors->find($auction->vendorID)->name ?? ''}}</strong></div>
          </div>
          <div class="list-item-action">
            <a href="preview/auction/{{$auction->eventID}}/{{$auction->id}}" class="button w-button" target="_blank">Veiling-item bekijken</a>
            <a href="auctions/{{$auction->id}}/accept" class="button gradient w-button">goedkeuren</a>
            <a href="auctions/{{$auction->id}}/decline" class="button purple marg w-button">afkeuren</a>
          </div>
        </li>
      @endforeach
      @foreach($stalls as $stall)
      <li class="dashboard-list-item w-clearfix">
        <div class="w-clearfix">
          <div class="type-of-purchase" style="background-color:orange;">
            <div>Stall</div>
          </div>
          <div class="item-date">{{ Carbon\Carbon::parse($stall->created_at)->format('d-m-Y H:i:s') }}</div>
        </div>
        <div class="list-item-data">
          <div class="important">Naam bedrijf: {{$stall->vendor->name ?? ''}}</div>
          <div class="light">Logo:
            <img width="200" src="{{ asset('uploads/stalls/logo') }}/{{ $stall->logo_url }}" alt="Logo">
          </div>
        </div>
        <div class="list-item-action">
          <a href="{{url('admin/preview/stall/'.$stall->eventID.'/'.$stall->id.'')}}" class="button w-button" target="_blank">Bekijk kraam</a>
          <a href="stalls/{{$stall->id}}/accept" class="button gradient w-button">goedkeuren</a>
          <a href="stalls/{{$stall->id}}/decline" class="button purple marg w-button">afkeuren</a>
        </div>
      </li>
      @endforeach
      @foreach($awaiting_vendors as $vendor)
      <li class="dashboard-list-item w-clearfix">
        <div class="w-clearfix">
          <div class="type-of-purchase" style="background-color:orange;">
            <div>Verkoper</div>
          </div>
          <div class="item-date">{{ Carbon\Carbon::parse($vendor->created_at)->format('d-m-Y H:i:s') }}</div>
        </div>
        <div class="list-item-data">
          <div class="important">Naam bedrijf: {{$vendor->name}}</div>
          <div class="light">E-Mail: <strong>{{$users->find($vendor->ownerID)->email ?? ''}}</strong></div>
          <div class="light">Over bedrijf: <strong class="vendor">{{$vendor->about}}</strong></div>
          @if (str_contains($vendor->permissions, 'auction'))
            <div class="light">Veilingitems: <strong class="vendor">{{$vendor->auction_item_count}}</strong></div>
          @endif
          <div class="light">Opties: <br/>
                @php
                    $item_index = 1;
                @endphp
              @foreach(array_filter(explode(',', $vendor->permissions)) as $index => $permission)
                    @if (isset($vendor_approve_items[str_replace(['[', ']', '"'], '', $permission)]))
                    <div style="display: flex; margin-top: 5px">
                        {{ $item_index++ }}.  &nbsp; <strong class="vendor"> {{ $vendor_approve_items[str_replace(['[', ']', '"'], '', $permission)] }}</strong>
                            @if (str_contains($vendor->permissions, 'approved'))
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-left: 5px" xml:space="preserve" class=""><g><g fill-rule="evenodd" clip-rule="evenodd"><path fill="#4bae4f" d="M256 0C114.8 0 0 114.8 0 256s114.8 256 256 256 256-114.8 256-256S397.2 0 256 0z" opacity="1" data-original="#4bae4f"></path><path fill="#ffffff" d="M379.8 169.7c6.2 6.2 6.2 16.4 0 22.6l-150 150c-3.1 3.1-7.2 4.7-11.3 4.7s-8.2-1.6-11.3-4.7l-75-75c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0l63.7 63.7 138.7-138.7c6.2-6.3 16.4-6.3 22.6 0z" opacity="1" data-original="#ffffff"></path></g></g></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; margin-left: 5px" xml:space="preserve" class=""><g><path fill="#f44336" d="M256 0C114.836 0 0 114.836 0 256s114.836 256 256 256 256-114.836 256-256S397.164 0 256 0zm0 0" opacity="1" data-original="#f44336"></path><path fill="#fafafa" d="M350.273 320.105c8.34 8.344 8.34 21.825 0 30.168a21.275 21.275 0 0 1-15.086 6.25c-5.46 0-10.921-2.09-15.082-6.25L256 286.164l-64.105 64.11a21.273 21.273 0 0 1-15.083 6.25 21.275 21.275 0 0 1-15.085-6.25c-8.34-8.344-8.34-21.825 0-30.169L225.836 256l-64.11-64.105c-8.34-8.344-8.34-21.825 0-30.168 8.344-8.34 21.825-8.34 30.169 0L256 225.836l64.105-64.11c8.344-8.34 21.825-8.34 30.168 0 8.34 8.344 8.34 21.825 0 30.169L286.164 256zm0 0" opacity="1" data-original="#fafafa"></path></g></svg>
                            @endif
                        <br/>
                    </div>
                    @endif
              @endforeach
          </div>
        </div>
        <div class="list-item-action">
          <a href="vendors/{{$vendor->id}}/accept" class="button gradient w-button">goedkeuren</a>
          <a href="vendors/{{$vendor->id}}/decline" class="button purple marg w-button">afkeuren</a>
        </div>
      </li>
      @endforeach
    </ul>
  @endif
</div>
@endsection

@section('js')

  <script>
    $(document).ready(function() {
      // Function to remove URL parameters
      window.removeParam = function(parameter) {
        const url = new URL(window.location.href);
        url.searchParams.delete(parameter);
        window.location.href = url.toString();
      };
    });
  </script>
  <script src="{{ asset('plugins/venobox/js/venobox.min.js') }}"></script>
    <script>
        new VenoBox({
            selector: '.movies',
        });
    </script>
@endsection
