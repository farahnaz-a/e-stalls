@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Admin Paneel - E-STALLS')
@section('content')
<style>
  .order-checkbox {
    width: 20px;
    height: 20px;
    accent-color: #007bff;
    cursor: pointer;
    margin: 0;
  }

  .order-checkbox:hover {
    accent-color: #0056b3;
  }
  
</style>
<div class="container w-container">
  <h1 class="dark">Aankopen</h1>
  
  <!-- Success/Error Messages -->
  @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
      {{ session('success') }}
    </div>
  @endif
  
  @if(session('error'))
    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
      {{ session('error') }}
    </div>
  @endif
  
  <!-- Filter Buttons -->
  <div style="margin-bottom: 20px;">
    @if($filter != "archive") 
      <a style="margin-bottom: 10px; background-color:green;" href="orders?filter=tickets" class="button w-button">Tickets</a>
      <a style="margin-bottom: 10px; background-color:green;" href="orders?filter=other" class="button w-button">Andere aankopen</a>
      <a style="margin-bottom: 10px; background-color:grey;" href="orders?filter=archive" class="button w-button">Archief</a>
    @else 
      <a style="margin-bottom: 10px; background-color:red;" href="{{url('/')}}/admin/orders" class="button w-button">Live Tickets</a>
    @endif
  </div>
  
  <!-- Search Form -->
  <form method="GET" action="{{ url()->current() }}" class="search-form" style="margin-bottom: 30px;">
    <input type="hidden" name="filter" value="{{ $filter }}">
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
      <input type="text" name="search" placeholder="Zoek op naam, e-mail, order ID..." value="{{ request('search') }}" 
             style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; flex-grow: 1;">
      <button type="submit" class="button w-button" style="background-color: #363e5d;">Zoeken</button>
      @if(request()->has('search'))
        <a href="{{ url()->current() }}?filter={{ $filter }}" class="button w-button" style="background-color: #ccc;">Reset</a>
      @endif
    </div>
  </form>

  <!-- Bulk Action Form -->
  <form id="bulk-action-form" method="POST" style="margin-bottom: 20px;">
    @csrf
    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 4px;">
      <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
        <input type="checkbox" class="order-checkbox" id="select-all" style="margin: 0;">
        <span style="font-weight: bold;">Alles selecteren</span>
      </label>
      
      <div id="bulk-actions" style="display: none; gap: 10px;  align-items: center;">
        <span id="selected-count" style="color: #666;">0 geselecteerd</span>
        
        @if($filter == "archive")
          <button type="button" onclick="submitBulkAction('live')" class="button w-button" style="background-color: #28a745;">
            Live zetten
          </button>
        @else
          <button type="button" onclick="submitBulkAction('archive')" class="button w-button" style="background-color: #6c757d;">
            Archiveren
          </button>
        @endif
      </div>
    </div>
  </form>

  <ul role="list" class="dashboard-list w-list-unstyled">
    @foreach($orders as $order)
    @if ($filter != "archive")
      @if ($order->status != 'archive')
      @if($order->paid == "paid")
      @if($order->contents == 1)
        @if($filter != "other")
          <li class="dashboard-list-item" style="position: relative;">
            <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 10;">
              <input type="checkbox" class="order-checkbox" value="{{ $order->id }}" style="margin: 0; cursor: pointer;">
            </div>
            <div style="margin-left: 35px;">
              <div class="w-clearfix">
                <div class="type-of-purchase">
                  <div>Ticket aankoop</div>
                </div>
                <div class="item-date">{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</div>
              </div>
              <div class="list-item-data">
                <div class="important">Order ID: <strong>#{{ sprintf('%06d', $order->id) }}</strong></div>
                <div class="important">Gekocht door: {{$order->first_name}} {{$order->last_name}}</div>
                <div class="light">Contactgegevens: <strong>Tel. {{$order->phone_number}}</strong> E-Mail: <strong>{{$order->email}}</strong></div>
                <div class="light">Adres: <strong>{{$order->street}}</strong>, <strong>{{$order->zip}} {{$order->town}}</strong></div>
                <div class="light">Aankoop bedrag: €{{ number_format($order->price, 2) }}</div>
                
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

              <div class="list-item-action">
                <div class="inline-container">
                  <a href="{{ url('admin/order/'.$order->id.'/archive') }}" class="button w-button" style="background-color:grey">archiveren</a>
                </div>
              </div>
            </div>
          </li>
        @endif
      @else
        @if($filter != "tickets")
          <li class="dashboard-list-item" style="position: relative;">
            <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 10;">
              <input type="checkbox" class="order-checkbox" value="{{ $order->id }}" style="margin: 0; cursor: pointer;">
            </div>
            <div style="margin-left: 35px;">
              <div class="w-clearfix">
                <div class="type-of-purchase product">
                  <div>Product aankoop</div>
                </div>
                <div class="item-date">{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</div>
              </div>
              <div class="list-item-data">
                <div class="important">Order ID: <strong>#{{ sprintf('%06d', $order->id) }}</strong></div>
                <div class="important">Gekocht door: {{$order->first_name}} {{$order->last_name}}</div>
                <div class="light">Contactgegevens: <strong>Tel. {{$order->phone_number}}</strong> E-Mail: <strong>{{$order->email}}</strong></div>
                <div class="light">Adres: <strong>{{$order->street}}</strong>, <strong>{{$order->zip}} {{$order->town}}</strong></div>
                <div class="light">Aankoop bedrag: €{{ number_format($order->price, 2) }}</div>
                
                <!-- Product Details -->
                <div class="light">Product: 
                  <strong>
                    @if($order->product)
                      {{ $order->product->name }} ({{ $order->product->sku }})
                    @else
                      Onbekend product
                    @endif
                  </strong>
                </div>
                <div class="light">Verkoper: <strong class="vendor">
                  @if($order->vendor)
                    {{ $order->vendor->name }}
                  @else
                    Onbekende verkoper
                  @endif
                </strong></div>
              </div>
            </div>
          </li>
        @endif
      @endif
    @endif
      @endif
    @else
      @if ($order->status == 'archive')
        @if($order->paid == "paid")
          @if($order->contents == 1)
            @if($filter != "other")
              <li class="dashboard-list-item" style="position: relative;">
                <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 10;">
                  <input type="checkbox" class="order-checkbox" value="{{ $order->id }}" style="margin: 0; cursor: pointer;">
                </div>
                <div style="margin-left: 35px;">
                  <div class="w-clearfix">
                    <div class="type-of-purchase">
                      <div>Ticket aankoop</div>
                    </div>
                    <div class="item-date">{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</div>
                  </div>
                  <div class="list-item-data">
                    <div class="important">Order ID: <strong>#{{ sprintf('%06d', $order->id) }}</strong></div>
                    <div class="important">Gekocht door: {{$order->first_name}} {{$order->last_name}}</div>
                    <div class="light">Contactgegevens: <strong>Tel. {{$order->phone_number}}</strong> E-Mail: <strong>{{$order->email}}</strong></div>
                    <div class="light">Adres: <strong>{{$order->street}}</strong>, <strong>{{$order->zip}} {{$order->town}}</strong></div>
                    <div class="light">Aankoop bedrag: €{{ number_format($order->price, 2) }}</div>
                    
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
                  <div class="list-item-action">
                    <div class="inline-container">
                      <a href="{{ url('admin/order/'.$order->id.'/live') }}" class="button w-button" style="background-color:red">live zetten</a>
                    </div>
                  </div>
                </div>
              </li>
            @endif
          @else
            @if($filter != "tickets")
              <li class="dashboard-list-item" style="position: relative;">
                <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 10;">
                  <input type="checkbox" class="order-checkbox" value="{{ $order->id }}" style="margin: 0; cursor: pointer;">
                </div>
                <div style="margin-left: 35px;">
                  <div class="w-clearfix">
                    <div class="type-of-purchase product">
                      <div>Product aankoop</div>
                    </div>
                    <div class="item-date">{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</div>
                  </div>
                  <div class="list-item-data">
                    <div class="important">Order ID: <strong>#{{ sprintf('%06d', $order->id) }}</strong></div>
                    <div class="important">Gekocht door: {{$order->first_name}} {{$order->last_name}}</div>
                    <div class="light">Contactgegevens: <strong>Tel. {{$order->phone_number}}</strong> <br/>E-Mail: <strong>{{$order->email}}</strong></div>
                    <div class="light">Adres: <strong>{{$order->street}}</strong>, <strong>{{$order->zip}} {{$order->town}}</strong></div>
                    <div class="light">Aankoop bedrag: €{{ number_format($order->price, 2) }}</div>
                    
                    <!-- Product Details -->
                    <div class="light">Product: 
                      <strong>
                        @if($order->product)
                          {{ $order->product->name }} ({{ $order->product->sku }})
                        @else
                          Onbekend product
                        @endif
                      </strong>
                    </div>
                    <div class="light">Verkoper: <strong class="vendor">
                      @if($order->vendor)
                        {{ $order->vendor->name }}
                      @else
                        Onbekende verkoper
                      @endif
                    </strong></div>
                  </div>
                </div>
              </li>
            @endif
          @endif
        @endif
      @endif
    @endif
    @endforeach
  </ul>
  
  <!-- Pagination -->
  <div style="display: flex; justify-content: end;margin: 0 0 1.5rem 0;">
    @if($orders->hasPages())
      <div class="pagination">
        {{ $orders->appends(request()->query())->links() }}
      </div>
    @endif
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const selectAll = document.getElementById('select-all');
      const orderCheckboxes = document.querySelectorAll('.order-checkbox');
      const bulkActions = document.getElementById('bulk-actions');
      const selectedCount = document.getElementById('selected-count');
      const bulkForm = document.getElementById('bulk-action-form');

      // Select all functionality
      selectAll.addEventListener('change', function() {
          orderCheckboxes.forEach(checkbox => {
              checkbox.checked = this.checked;
          });
          updateBulkActions();
      });

      // Individual checkbox functionality
      orderCheckboxes.forEach(checkbox => {
          checkbox.addEventListener('change', function() {
              updateSelectAllState();
              updateBulkActions();
          });
      });

      function updateSelectAllState() {
          const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
          selectAll.checked = checkedBoxes.length === orderCheckboxes.length && orderCheckboxes.length > 0;
          selectAll.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < orderCheckboxes.length;
      }

      function updateBulkActions() {
          const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
          if (checkedBoxes.length > 0) {
              bulkActions.style.display = 'flex';
              selectedCount.textContent = checkedBoxes.length + ' geselecteerd';
          } else {
              bulkActions.style.display = 'none';
          }
      }

      // Global function for bulk actions
      window.submitBulkAction = function(action) {
          const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
          if (checkedBoxes.length === 0) {
              alert('Selecteer ten minste één order.');
              return;
          }

          // Set form action based on the action type
          if (action === 'archive') {
              bulkForm.action = '{{ url("admin/orders/bulk-archive") }}';
          } else if (action === 'live') {
              bulkForm.action = '{{ url("admin/orders/bulk-live") }}';
          }

          // Clear existing order_ids inputs
          const existingInputs = bulkForm.querySelectorAll('input[name="order_ids[]"]');
          existingInputs.forEach(input => input.remove());

          // Add selected order IDs to form
          checkedBoxes.forEach(checkbox => {
              const input = document.createElement('input');
              input.type = 'hidden';
              input.name = 'order_ids[]';
              input.value = checkbox.value;
              bulkForm.appendChild(input);
          });

          // Confirm action
          const actionText = action === 'archive' ? 'archiveren' : 'live zetten';
          if (confirm(`Weet je zeker dat je ${checkedBoxes.length} order(s) wilt ${actionText}?`)) {
              bulkForm.submit();
          }
      };

      // Initialize states
      updateSelectAllState();
      updateBulkActions();
  });
</script>

@endsection



