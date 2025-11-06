@extends('layouts.main')

@section('wfdata', '61c3411371cfe629f81dc750')
@section('title', 'E-STALLS Events')

@section('content')
<div class="hero-section wf-section">
  <div class="container w-container">
    <h1 class="small-hero-head">Geplande Events</h1>
  </div>
</div>
<div class="events-section wf-section">
  <div class="container w-container">
    <div class="w-layout-grid events-collection">
      @foreach ($events as $event)
        @if ($event->status == "live")
          @php
            $less_than_10_percent = false;
            $max_tickets = $event->max_tickets;
            $sell_tickets = $event->sell_count;
            if($sell_tickets > (($max_tickets*90)/100)){
                $less_than_10_percent = true;
            }
          @endphp
          <div id="w-node-fc1d87b1-6975-1c5d-e45c-c96b6ec99c39-f81dc750" data-w-id="fc1d87b1-6975-1c5d-e45c-c96b6ec99c39" class="event-block" style="background-image: linear-gradient(90deg, rgba(54, 62, 93, 0.8), rgba(147, 46, 127, 0.8) 54%, rgba(207, 164, 70, 0.8)), url('{{ asset('uploads/event-s/thumbnails') }}/{{ $event->thumbnail_url }}'); !important">
            <div class="top-event-bar w-clearfix" style="display: flex; justify-content: space-between; align-items: center;">
              <div class="event-block-date">{{ date('d-m-Y', strtotime($event->start_date)) }}</div>
              <div class="tickets-left {{ $less_than_10_percent ? 'almost-end' : '' }}">{{ $event->max_tickets - $event->sell_count }}</div>
              <div>
                <div class="info-icon" data-event-id="{{ $event->id }}" style="cursor: pointer;">
                  <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#363e5d" stroke-width="2"/>
                    <path d="M12 16V12" stroke="#363e5d" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 8H12.01" stroke="#363e5d" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </div>
              </div>

              <!-- Info Icon (fixed size, perfectly centered) -->
              
            </div>
            <div class="event-block-name">{{ $event->name }}</div>
            <div class="event-block-price">€{{ number_format($event->price, 2) }}</div>
            <div class="centered">
              <!-- Ticket Button (takes majority of space) -->
              <div style="flex: 1;">
                @if(($event->max_tickets - $event->sell_count) > 0)
                  <a href="{{url('/')}}/ticket-kopen/{{$event->id}}" class="button w-button" style="width: 100%;">Ticket Kopen</a>
                @else
                  <a href="javascript:void(0)" class="button w-button" style="width: 100%;">UITVERKOCHT</a>
                @endif
              </div>
            </div>
            
            <!-- Hidden event details -->
            <div class="event-details" id="event-details-{{ $event->id }}" style="display: none;">
              <h3>{{ $event->name }}</h3>
              <p><strong>Evenementinformatie:</strong> {{ $event->information }}</p>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>

<!-- Modal Structure -->
<div id="info-modal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 1000;">
  <div class="modal-content" style="background: white; margin: 10% auto; padding: 30px; width: 80%; max-width: 600px; border-radius: 8px; position: relative;">
    <span class="close-modal" style="position: absolute; top: 15px; right: 20px; font-size: 30px; cursor: pointer;">&times;</span>
    <div id="modal-data"></div>
  </div>
</div>

<div class="review-section wf-section">
  <div class="w-container">
    <h2 class="small">Wat deelnemers van onze events vinden</h2>
    <div data-delay="4000" data-animation="slide" class="reviews-slider w-slider" data-autoplay="false" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
      <div class="mask-2 w-slider-mask">
        <div class="w-slide">
          <div class="review"><img src="{{url('/')}}/images/undraw_male_avatar_323b.png" loading="lazy" alt="">
            <div class="review-name">Max v C.</div>
            <p>&quot;E-STALLS is een erg uniek concept, zeker de moeite waard om een ticket te kopen!&quot;</p>
          </div>
        </div>
        <div class="w-slide">
          <div class="review"><img src="{{url('/')}}/images/undraw_male_avatar_323b.png" loading="lazy" alt="">
            <div class="review-name">Isa L.</div>
            <p>&quot;Via E-STALLS ben ik veel te weten gekomen over belangrijke brands én heb ik een aantal leuke producten gekocht.&quot;</p>
          </div>
        </div>
      </div>
      <div class="left-arrow w-slider-arrow-left">
        <div class="w-icon-slider-left"></div>
      </div>
      <div class="right-arrow w-slider-arrow-right">
        <div class="w-icon-slider-right"></div>
      </div>
      <div class="hidden w-slider-nav w-round"></div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const modal = document.getElementById('info-modal');
    const closeBtn = document.querySelector('.close-modal');
    
    // Add click event to all info icons
    document.querySelectorAll('.info-icon').forEach(icon => {
      icon.addEventListener('click', function() {
        const eventId = this.getAttribute('data-event-id');
        const eventDetails = document.getElementById(`event-details-${eventId}`).innerHTML;
        
        document.getElementById('modal-data').innerHTML = eventDetails;
        modal.style.display = 'block';
      });
    });
    
    // Close modal
    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });
    
    // Close when clicking outside modal
    window.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
</script>

<style>
  .modal-content {
    box-shadow: 0 4px 20px rgba(0,0,0,0.25);
  }
  
  .info-icon svg {
    transition: transform 0.3s ease;
  }
  
  .info-icon:hover svg {
    transform: scale(1.1);
  }
  
  .event-details h3 {
    margin-top: 0;
    color: #363e5d;
    border-bottom: 2px solid #932e7f;
    padding-bottom: 10px;
  }
</style>
@endsection