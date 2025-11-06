
@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
    <div class="w-layout-grid grid-2">
      <div class="login-form">
        <h1 class="dark">Goodiebag Pop-Up Prijs aanmaken</h1>
        <form action="{{url("admin/goodiebag/popup/prices/new")}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" class="text-field nomaxw w-input" maxlength="256" name="contents" placeholder="Welk item wil je aanbieden?" required="" value="">
            <textarea name="description" id="" cols="10" rows="3" class="text-field nomaxw w-input" placeholder="Beschrijving van het item" required></textarea>
            <input type="number" class="text-field nomaxw w-input" step="1" name="stock" placeholder="Aantal items" value="" required="">
            <label>Upload logo</label>
            <input type="file" class="text-field nomaxw w-input" name="logo">

            <label for="name-7">Event</label>
            <select name="eventID" id="eventID" class="text-field nomaxw w-select" required="">
                <option value="">Kies event..</option>
                @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->name}}</option>
                @endforeach
            </select>
            <label for="name-7">Vendor</label>
            <select name="vendorID" id="vendorID" class="text-field nomaxw w-select" required="">
                <option value="">Kies vendor..</option>
                
            </select>
            {{-- <label for="name-7">Stall</label>
                <select name="stallID" class="text-field nomaxw w-select" required="">
                <option value="">Kies stall..</option>
                @foreach($stalls as $stall)
                <option value="{{$stall->id}}">{{$stall->description}}</option>
                @endforeach
            </select> --}}
            
              <input type="submit" value="bewerken" data-wait="Please wait..." class="button w-button">
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('#eventID').change(function(){
                let event_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type  : "POST",
                    url   : "{{ route('admin.goodiebag.event-change') }}",
                    data  : {
                        event_id,
                    },
                    success: response => { 
                        $('#vendorID').html(response);
                    },
                    error: errors => { 
                    },

                });
            });
        })
    </script>
@endsection