@extends('layouts.main')

@section('title', 'E-STALLS Dashboard')

@include('includes.passwork-toggler.index')

    @push('css')
        <style>
            .countdown-body {
                background-color: rgb(228, 239, 250);
                padding: 20px;
                width: 250px;
                text-align: center;
                border-radius: 20px
            }

            .timer-body {
                display: flex;
                gap: 7px;
                justify-content: center;
            }

            .time-block {
                position: relative;
                display: inline-block;
                text-align: center;
                width: 55px;
            }

            .time-block::after {
                content: "";
                position: absolute;
                left: 0;
                top: 37%;
                width: 100%;
                height: 1px;
                background: rgb(199, 199, 199);
                opacity: 0.8;
                transform: translateY(-50%);
                z-index: 0;
            }

            .time {
                color: rgb(0, 0, 151);
                font-weight: 900;
                font-size: 25px;

                padding: 5px 8px;

                border: 1px solid rgb(199, 199, 199);
                border-radius: 5px;
                margin: 5px 0;

                position: relative;
                z-index: 1;
            }

            .bg-white {
                background-color: white;
                border-radius: 5px;
            }

            .timer-body>span {
                font-size: 40px;
                color: rgb(61, 61, 61);
            }

            .time-block>span {
                color: rgb(0, 0, 85);
            }

               .afgelopen{
                color: red;
                font-size: 24px;
                font-weight:900;
            }
            .event-end {
                text-align: center;
                background: linear-gradient(90deg, #752a7c, #5a2661);
                color: white;
                width: 250px;
                padding: 20px;
                border-radius: 20px;
                font-size: 24px;
                font-weight: bold;
                }
        </style>
    @endpush

@section('content')
  <div class="normal-section gradient wf-section">
    <div class="container center w-container">
      <div class="w-layout-grid grid-2">
        <div class="live-events">
          @foreach ($events as $key=>$event)
            @if (is_active($event->id) == true)
                <h1 class="dark" style="text-align:center">Dit event is nu LIVE:</h1>
                <div data-w-id="036de8c7-5912-2917-fc6f-249bd1e49d20" style="margin-left: 75px !important;" class="event-block">
                  <div class="top-event-bar center">
                    <div class="event-block-date">Stopt om: <strong class="bold-text">{{ $event->end_time }}</strong></div>
                  </div>
                  <div class="event-block-name">{{ $event->name }}</div>
                  <div class="centered marg-top">
                    <a href="{{ url('/') }}/event/{{ $event->id }}" class="button w-button">Event betreden</a>
                  </div>
                </div>
            @elseif ($event->start_date == date("Y-m-d"))
               <div style="margin: 10px 0 20px 75px; display: none;" id="ptag{{ $key }}" class="countdown-body">Het event
                                <b>{{ $event->name }}</b> begint over <br>
                                {{-- <span id="time{{ $key }}"></span> --}}
                                <div class="timer-body">
                                    <div class="time-block">
                                        <div class="bg-white">
                                            <div class="time" id="hours{{ $key }}"></div>
                                        </div>
                                        <span>uren</span>
                                    </div>
                                    <span>:</span>
                                    <div class="time-block">
                                        <div class="bg-white">
                                            <div class="time" id="minutes{{ $key }}"></div>
                                        </div>
                                        <span>minuten</span>
                                    </div>
                                    <span>:</span>
                                    <div class="time-block">
                                        <div class="bg-white">
                                            <div class="time" id="second{{ $key }}"></div>
                                        </div>
                                        <span>seconden</span>
                                    </div>
                                </div>
                            </div>
                            <div id="another-div{{ $key }}" style="display: none;">
                                   <h1 class="dark" style="text-align:center">Dit event is nu LIVE:</h1>
                                <div data-w-id="036de8c7-5912-2917-fc6f-249bd1e49d20" style="margin-left: 75px !important;"
                                    class="event-block">
                                    <div class="top-event-bar center">
                                        <div class="event-block-date">Stopt om: <strong
                                                class="bold-text">{{ $event->end_time }}</strong></div>
                                    </div>
                                    <div class="event-block-name">{{ $event->name }}</div>
                                    <div class="centered marg-top">
                                        <a href="{{ url('/') }}/event/{{ $event->id }}" class="button w-button">Event
                                            betreden</a>
                                    </div>
                                </div>
                            </div>
              <p style="margin: 10px 0 20px 60px;" id="eventMessage"></p>

              <script>

                var countDownDate{{ $key }} = new Date("{{$event->start_date}}T{{$event->start_time}}:00").getTime();
                var endtime{{ $key }} = new Date("{{ $event->end_date }}T{{ $event->end_time }}:00").getTime();
                var ptag_status{{ $key }} = false;
                var another_div_status{{ $key }} = false;
                var event_end_status{{ $key }} = false;

                var x{{ $key }} = setInterval(function() {
                    //   document.getElementById("ptag{{ $key }}").style.display = "block";

                  var now{{ $key }} = new Date().getTime();

                  var distance{{ $key }} = countDownDate{{ $key }} - now{{ $key }};

                  if(distance{{ $key }} > -1 && endtime{{ $key }} > now{{ $key }}){
                     if(!ptag_status{{ $key }}){
                        document.getElementById("ptag{{ $key }}").style.display = "block";
                        ptag_status{{ $key }} = true;
                        }

                      // Time calculations for days, hours, minutes and seconds
                      var days{{ $key }} = Math.floor(distance{{ $key }} / (1000 * 60 * 60 * 24));
                      var hours{{ $key }} = Math.floor((distance{{ $key }} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                      var minutes{{ $key }} = Math.floor((distance{{ $key }} % (1000 * 60 * 60)) / (1000 * 60));
                      var seconds{{ $key }} = Math.floor((distance{{ $key }} % (1000 * 60)) / 1000);

                      // Display the result in the element with id="demo"
                    //   document.getElementById("time{{ $key }}").innerHTML = "   " + hours{{ $key }} + " uur "
                    //   + minutes{{ $key }} + " minuten " + seconds{{ $key }} + " seconden ";

                     document.getElementById("hours{{ $key }}").innerHTML = String(hours{{ $key }}).padStart(2, '0');
                     document.getElementById("minutes{{ $key }}").innerHTML = String(minutes{{ $key }}).padStart(2, '0');
                     document.getElementById("second{{ $key }}").innerHTML = String(seconds{{ $key }}).padStart(2, '0');

                      // If the count down is finished, write some text
                      if (distance{{ $key }} < 0) {
                        location.reload();
                        clearInterval(x);
                        document.getElementById("time{{ $key }}").style.display = 'none';
                        document.getElementById("eventMessage").innerHTML = "The event has started or is over.";
                        // location.reload();
                      }
                  }
                    else if(distance{{ $key }} < -1 &&   now{{ $key }} < endtime{{ $key }} )
                    {
                    // document.getElementById("ptag{{ $key }}").style.display = "none";
                    // document.getElementById("another-div{{ $key }}").style.display = 'block';
                        if(!another_div_status{{ $key }}){

                            $('#ptag{{ $key }}').slideUp();
                            $("#another-div{{ $key }}").slideDown();
                            another_div_status{{ $key }} = true;
                        }
                    }

                  else{
                    if(!event_end_status{{ $key }}){
                        // document.getElementById("ptag{{ $key }}").style.display = "block";
                        // document.getElementById("another-div{{ $key }}").style.display = 'none';
                        $('#another-div{{ $key }}').slideUp();
                        $('#ptag{{ $key }}').slideDown();
                        document.getElementById("ptag{{ $key }}").innerHTML = `Het event is <br><span class="afgelopen">AFGELOPEN</span> `;
                        document.getElementById("ptag{{ $key }}").classList.remove("countdown-body");
                        document.getElementById("ptag{{ $key }}").classList.add("event-end");
                        event_end_status{{ $key }} = true;
                    }
                  }
                }, 1000);


              </script>

            @endif
          @endforeach
        </div>
        <div class="login-form">
          <form action="authupdate" method="post" class="create-account">
            @csrf
            <h1 class="dark">Account instellingen</h1>
            <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="first_name" required value="{{ $user->first_name }}">
              <input type="text" class="text-field dobule w-input" maxlength="256" name="last_name" required value="{{ $user->last_name }}"></div>
            <div class="double">
                <input type="email" class="text-field w-input" maxlength="256" name="email" required value="{{ $user->email }}">
                <div data-password="wrapper">
                    <input data-password="input" type="password" style="padding-left: 5px" class="text-field dobule w-input" maxlength="256" name="password" required placeholder="Wachtwoord">
                    <button type="button" data-password="toggler">
                        <i data-password="icon" class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="street" required id="Straatnummer" value="{{ $user->street }}">
              <input type="text" class="text-field dobule w-input" maxlength="256" name="zip" required id="Postcode" value="{{ $user->zip }}"></div>
            <div class="double"><input type="text" class="text-field w-input" maxlength="256" name="town" id="town" required value="{{ $user->town }}">
              <input type="text" class="text-field dobule w-input" maxlength="256" name="country" required value="{{ $user->country }}"></div>
              <input type="submit" value="Updaten" data-wait="Please wait..." class="button w-button">
              <a href="{{url('/')}}/vernietig-account" class="button w-button" style="background: grey;">Account opzeggen</a>
                 <div class="alert alert-danger">
                    <ul>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        @endif
                        <li id="addressValidationError" style="color: red; display: none">De combinatie van postcode en huisnummer komt ons niet bekend voor</li>
                    </ul>
                </div>
          </form>
        </div>
        <div class="login-form">
          <h1 class="dark">Overige acties</h1>
          <div>
            <a href="user/chat-box">Chat Box</a>
          </div>
          <div>
            <a href="dashboard/bestellingen">Bekijk bestellingen</a>
          </div>
          <div>
            <a href="dashboard/instellingen">Andere instellingen</a>
          </div>
          @if(auth()->user()->permission == 1)
            <div>
              <a href="{{ route('user.return.list') }}">Retourformulier</a>
            </div>
            <div>
              <a href="{{ route('user.cancel.list') }}">Annuleringsformulieren</a>
            </div>
          @else
            <div>
              <a href="{{ route('admin.return.list') }}">Retourformulier</a>
            </div>
            <div>
              <a href="{{ route('admin.cancel.list') }}">Annuleringsformulieren</a>
            </div>
          @endif

      </div>
    </div>
  </div>
</div>
  <div class="review-section wf-section">
    <div class="w-container">
      <h2 class="small">Wat deelnemers van onze events vinden</h2>
      <div data-delay="4000" data-animation="slide" class="reviews-slider w-slider" data-autoplay="false" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
        <div class="mask-2 w-slider-mask">
          <div class="w-slide">
            <div class="review"><img src="images/undraw_male_avatar_323b.png" loading="lazy" alt="">
              <div class="review-name">Max v C.</div>
              <p>&quot;E-STALLS is een erg uniek concept, zeker de moeite waard om een ticket te kopen!&quot;</p>
            </div>
          </div>
          <div class="w-slide">
            <div class="review"><img src="images/undraw_male_avatar_323b.png" loading="lazy" alt="">
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
  @endsection
@push('js')
    <script>
        $(document).ready(function(){
            let verified = false;
            $('.create-account').on('submit', function(e){
                if(!verified){
                    e.preventDefault();

                    let postcode = $("#Postcode").val();
                    let street_number = $("#Straatnummer").val();
                    let town = $("#town").val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type  : "POST",
                        url   : "{{ route('address.verification') }}",
                        data  : {
                            postcode,
                            street_number,
                            town,
                        },
                        success: response => {
                            if(response){
                                $('#addressValidationError').slideUp();
                                verified = true;
                                $(this).submit();
                            }else{
                                $('#addressValidationError').slideDown();
                            }
                        },
                        error: errors => {
                            // console.log(error);
                        },
                    });
                }
            });
        });
    </script>
@endpush
