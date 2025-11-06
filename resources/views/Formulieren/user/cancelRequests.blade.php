@extends('layouts.main')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Cancel requests - E-STALLS')
@section('css')
    <style>
        .page-header {
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 10px;
            padding: 0 20px;
        }
    </style>
@endsection
@section('content')
<div class="container w-container">
  <div class="page-header">
    <div style="display: flex; flex-direction: row;justify-content: space-between; align-items: center; text-align: center;margin-bottom: 10px;">
      <h1 class="dark">Annuleer lijst</h1>
      <a class="button w-button" href="{{ url('annulering') }}">Annulering</a>
    </div>
    {{-- @if(App\Models\Order::where('paid_by', Illuminate\Support\Facades\Auth::id())->where('cancel_status', 0)->get()->count() > 0)
        <span>
            <a class="button gradient w-button" href="{{ url('annulering') }}">Annulering</a>
        </span>
    @endif --}}
    <ul role="list" class="dashboard-list w-list-unstyled">
      @forelse ($cancelRequests as $order)
          <li class="dashboard-list-item"> 
            <div class="w-clearfix">
              @if($order->status == 0) 
                <div class="type-of-purchase">
                    <div>Active</div>
                </div>
                @elseif($order->status == 1)
                <div class="type-of-purchase">
                    <div>Approved</div>
                </div>
                @endif
              <div class="item-date">{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</div>
            </div>
            <div class="list-item-data">
              <div class="important">Order ID: <strong>#{{ sprintf('%06d', $order->order_number) }}</strong></div>
              <div class="important">Gekocht door: {{$order->name}}</div>
              <div class="light"></strong> E-Mail: <strong>{{$order->email}}</strong></div>
              <div class="light">Aankoop bedrag: €{{ number_format($order->getOrder->price ?? 0, 2) }}</div>
              
              <!-- Event Details -->
              <div class="light">Ticket voor: 
                <strong>
                  @if($order->event)
                    {{ $order->event->name }} ({{ date('d-m-Y', strtotime($order->event->start_date)) }})
                  @else
                    Onbekend evenement
                  @endif
                </strong>
              </div>
            </div>
          </li>
      @empty
          <li class="dashboard-list-item">
            <div class="w-clearfix no-results">
              <div class="type-of-purchase">
                <div>Geen annuleringen gevonden</div>
              </div>
            </div>
          </li>
      @endforelse
    </ul>
  </div>
</div>
@endsection

@section('js')
@endsection