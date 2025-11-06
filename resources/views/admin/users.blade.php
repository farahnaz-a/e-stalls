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
    }
    .search-area{
      display: flex;
      justify-content: space-between;
      align-items: center;
      /* margin-bottom: 20px; */
    }
    .search-area input{
      margin-right: 10px;
      margin-bottom: 0px !important;
    }

  /* Hide the checkbox */
  #modal-toggle {
    display: none;
  }

  /* Modal overlay */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 999;
  }

  /* Show the overlay when checkbox is checked */
  #modal-toggle:checked ~ .modal-overlay {
    visibility: visible;
    opacity: 1;
  }

  /* Modal box */
  .modal-box {
    background: #fff;
    padding: 20px;
    width: 300px;
    border-radius: 8px;
    position: relative;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  /* Modal Title */
  .modal-box h2 {
    margin-top: 0;
  }

  /* Close icon styling */
  .close-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #333;
    text-decoration: none;
    cursor: pointer;
  }

  /* Trigger Button */
  .open-modal-btn { 
    text-decoration: none;
    cursor: pointer;
    display: inline;
    background: #CFA446;
    padding: 5px 5px 0px 5px;
    border-radius: 50%;
  }

  .modal-box p {
    font-size: 16px;
    padding-top: 35px;
  }

  .custom-heading {
      display: flex;
      align-items: center;
      gap: 15px;
      flex-wrap: wrap;
  }

  .custom-heading h1 {
      margin: 0;
  }

  .inline-checkbox {
      display: inline-flex;
      align-items: center;
      margin-left: 20px;
  }
  .inline-checkbox .form-check-input {
      margin-right: 8px;
  }

  </style>
@endsection
@section('content')
<div class="container w-container">
  <div class="page-header">
    <h1 class="dark">Accounts</h1>
    <div>
      <form action="" method="get">
        <div class="search-area">
          <input type="text" class="text-field w-input" placeholder="Zoeken op gebruiker of e-mail" name="search" value="{{ request()->get('search') }}">
          <button type="submit" class="button w-button">Zoeken</button>
        </div>
      </form>
    </div>
  </div>
  <ul role="list" class="dashboard-list w-list-unstyled">
    @forelse($users as $user)
    <li class="dashboard-list-item w-clearfix">
      <div class="list-item-data">
        <div class="important">Naam: {{$user->first_name}} {{$user->last_name}}</div>
        <div class="light">Email: {{$user->email}}<strong></strong></div>
        @if($user->permission == 2)
        <div class="light">Is verkoper van: <strong class="purple">{{$vendors->where('ownerID', $user->id)->first()->name ?? ''  }}</strong><strong class="vendor"></strong></div>
        @endif
        @if(!empty($user->entered_event))
        @if(!empty($events->find($user->entered_event)->name))
        <div class="light"><strong>Zit nu in event </strong><strong class="vendor">{{$events->find($user->entered_event)->name}}</strong></div>
        @endif
        @endif
        @if($user->permission == 2 && $user->getVendor)
        @if (str_contains($user->getVendor->permissions, 'auction'))
            <div class="light" style="margin-top: 3px">Veilingitems: <strong class="vendor">{{$user->getVendor->auction_item_count}}</strong> 
                <label for="modal-toggle" class="open-modal-btn" data-vendor-id="{{ $user->getVendor->id }}" data-item-limit="{{ $user->getVendor->auction_item_count }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none">
                        <path d="M14.6716 6.763L5.58013 15.8544L5.41376 18.8492L8.40856 18.6829L17.5 9.59142M14.6716 6.763L16.0204 5.41421C16.8014 4.63316 18.0677 4.63316 18.8488 5.41421V5.41421C19.6298 6.19526 19.6298 7.46159 18.8488 8.24264V8.24264L17.5 9.59142M14.6716 6.763L17.5 9.59142" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
            </div> 
        @endif
          <div class="light">Opties: <br/>
                @php
                    $item_index = 1;
                @endphp
              @foreach(array_filter(explode(',', $user->getVendor->permissions)) as $index => $permission)
                    @if (isset($vendor_approve_items[str_replace(['[', ']', '"'], '', $permission)]))
                        {{ $item_index++ }}. <strong class="vendor"> {{ $vendor_approve_items[str_replace(['[', ']', '"'], '', $permission)] }}</strong><br/>
                    @endif
              @endforeach
          </div>
        @endif
      </div>
      <div class="list-item-action">
        @if($user->permission == 1)
        <!-- WEGGEHAALD IVM VENDOR OVERHAUL <a href="accounts/{{$user->id}}/vendor" class="button w-button">vendor maken</a> -->
        @elseif($user->permission == 2)
        <!-- WEGGEHAALD IVM VENDOR OVERHAUL <a href="accounts/{{$user->id}}/customer" class="button w-button">reguliere klant maken</a> -->
        <a href="accounts/{{$user->id}}/permissions" class="button w-button">rechten bewerken</a>
        @else
        <b>Admin Account</b>
        @endif
        @if($user->permission != 3)
        <a href="accounts/{{$user->id}}/delete" class="button gradient w-button">account verwijderen</a>
        @endif
      </div>
    </li>
    @empty
        <li class="dashboard-list-item w-clearfix" style="text-align: center">
            Geen account gevonden
        </li>
    @endforelse
  </ul>
</div>
<form method="post" action="{{ route('admin.vendor.auction-item.update') }}">
    @csrf
    <input type="checkbox" id="modal-toggle">
    <label for="modal-toggle" class="modal-overlay">
    <div class="modal-box" onclick="event.stopPropagation();">
        <label for="modal-toggle" class="close-icon">&times;</label>
        <label for="auction_item_count" style="text-align: left">Veilingitems</label>
        <input type="hidden" name="vendor_id" id="auction_vendor_id">
        <input type="number" class="w-input" name="auction_item_count" id="auction_item_count" required value="">
        <button type="submit" class="button w-button">Bijwerken</button>
    </div>
    </label>
</form>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('body').on('click', '.open-modal-btn', function(){
            $("#auction_vendor_id").val($(this).data('vendor-id'));
            $("#auction_item_count").val($(this).data('item-limit'));
        })      
    });
</script>
@endsection
