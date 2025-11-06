@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<style>
  .alert-text {
    max-width: 350px;
    display: flex;
    justify-content: center;
  }
  .alert-text button {
    margin-top: 0 !important;
  }
  /* Modal styles */
  .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.7);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s;
  }
  
  .modal-overlay.active {
      opacity: 1;
      visibility: visible;
  }
  
  .modal-content {
      background: white;
      border-radius: 8px;
      width: 90%;
      max-width: 500px;
      padding: 25px;
      position: relative;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }
  
  .close-button {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 24px;
      cursor: pointer;
      color: #7f8c8d;
      background: none;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
  }
  
  .close-button:hover {
      background: #f1f1f1;
      color: #e74c3c;
  }
  
  .modal-header {
      margin-bottom: 15px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
  }
  
  .modal-title {
      font-size: 20px;
      color: #2c3e50;
      font-weight: 600;
      margin: 0;
  }
  
  .modal-body {
      color: #555;
  }
</style>
<div class="normal-section gradient wf-section">
  <div class="w-form-success" style="margin: 20px; display: {{ session('success') ? '':'none' }}">
    <div>{{ session('success') }}</div>
  </div>
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      
      <div class="live-events" style="display: flex; flex-direction: column; align-items: center;">
        <h1 class="dark">Jij bent beheerder van</h1>
        <div data-w-id="036de8c7-5912-2917-fc6f-249bd1e49d20" class="event-block vendor">
          <div class="top-event-bar center"></div>
          <div class="event-block-name notopmarg">{{ $vendor->name ?? '' }}</div>
        </div>

        {{-- Check completion status and approval status --}}
        @php
            $vendor = getCurrentVendor();
            $allOptionsCompleted = true;

            // Check completion status for each permission
            if (str_contains($vendor->permissions, 'logo')) {
                if (!$vendor->logo) {
                    $allOptionsCompleted = false;
                }
            }
            if (str_contains($vendor->permissions, 'movie')) {
                if (!$vendor->movie) {
                    $allOptionsCompleted = false;
                }
            }
            if (str_contains($vendor->permissions, 'stall')) {
                if (!$vendor->stall) {
                    $allOptionsCompleted = false;
                }
            }
            if (str_contains($vendor->permissions, 'auction')) {
                if (($vendor->auction_item_count - $vendor->getAllAuction->count()) > 0) {
                    $allOptionsCompleted = false;
                }
            }
            if (str_contains($vendor->permissions, 'goodiebag')) {
                if (!$vendor->goodiebag) {
                    $allOptionsCompleted = false;
                }
            }
        @endphp

        {{-- Status Button - Shows when vendor is not approved --}}
        @if(!str_contains($vendor->permissions, 'approved'))
            <div class="alert-text">
                <button class="button gradient w-button" style="margin-left: 0;margin-top:15px !important" id="statusButton">Status</button>
                <div class="modal-overlay" id="statusModal">
                    <div class="modal-content">
                        <button class="close-button" id="closeModal">&times;</button>
                        <div class="modal-header">
                            <h2 class="modal-title" style="color: #0d1218 !important">Accountstatus</h2>
                        </div>
                        <div class="modal-body">
                            <p style="color: #131212 !important">Welkom in je dashboard! Bedankt voor het aanmaken van je account. Zodra de door jou gekozen
                                opties zijn goedgekeurd, worden ze zichtbaar in je dashboard. We doen ons best om alles zo snel
                                mogelijk in orde te maken, zodat je snel aan de slag kunt.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($allOptionsCompleted)
              <div class="alert-text">
                <button class="button gradient w-button" style="margin-left: 0;margin-top:15px !important" id="statusButton">Status</button>
                <div class="modal-overlay" id="statusModal">
                    <div class="modal-content">
                        <button class="close-button" id="closeModal">&times;</button>
                        <div class="modal-header">
                            <h2 class="modal-title" style="color: #0d1218 !important">Accountstatus</h2>
                        </div>
                        <div class="modal-body">
                            <p style="color: #131212 !important">De door jou ingevulde gegevens worden momenteel gecontroleerd.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="alert-text" style="max-width: 350px; margin: 15px 0 0 0;">
          @if(!str_contains($vendor->permissions, 'approved'))
            <div class="alert-text">
              <button class="button gradient w-button" style="margin-left: 0" id="statusButton">Status</button>
              <div class="modal-overlay" id="statusModal">
                <div class="modal-content">
                    <button class="close-button" id="closeModal">&times;</button>
                    <div class="modal-header">
                        <h2 class="modal-title">Accountstatus</h2>
                    </div>
                    <div class="modal-body">
                        <p>Welkom in je dashboard! Bedankt voor het aanmaken van je account. Zodra de door jou gekozen
                        opties zijn goedgekeurd, worden ze zichtbaar in je dashboard. We doen ons best om alles zo snel
                        mogelijk in orde te maken, zodat je snel aan de slag kunt.</p>
                    </div>
                </div>
              </div>
            </div>
          @endif
        </div> --}}
      </div>
      <div class="login-form">
        <h1 class="dark" style="text-align: center">Overige acties</h1>
        <div>
          <a href="{{url('vendor/account-instellingen')}}">Account instellingen</a><br/>
          <a href="{{url('vendor/saldo')}}">Saldo</a><br/>
          <a href="{{url('vendor/verkoopoverzicht')}}">Verkoopoverzicht</a><br/>
          <a href="{{url('vendor/retouren-en-annuleringen')}}">Retouren en annuleringen</a><br/>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
  // Get DOM elements
  const statusButton = document.getElementById('statusButton');
  const statusModal = document.getElementById('statusModal');
  const closeModal = document.getElementById('closeModal');
  
  // Show modal when status button is clicked
  statusButton.addEventListener('click', () => {
      statusModal.classList.add('active');
  });
  
  // Hide modal when close button is clicked
  closeModal.addEventListener('click', () => {
      statusModal.classList.remove('active');
  });
  
  // Hide modal when clicking outside modal content
  statusModal.addEventListener('click', (e) => {
      if (e.target === statusModal) {
          statusModal.classList.remove('active');
      }
  });
</script>
@endsection
