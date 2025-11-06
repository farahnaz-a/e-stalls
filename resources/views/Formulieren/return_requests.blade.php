@extends('layouts.admin')
{{-- @section('wfdata', '6221e4bcc0ed2f0edb5997e8') --}}
@section('title', 'Admin Paneel - E-STALLS')
@section('css')

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #06d6a0;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --light-gray: #e2e8f0;
            --danger: #ef4444;
            --success: #22c55e;
            --border: 1px solid #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --radius: 3px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-body {
            padding-top: 0.5rem !important;
        }

        .modal.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius);
            width: 90%;
            max-width: 500px;
            box-shadow: var(--shadow);
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .close-button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
            transition: color 0.3s ease;
        }

        .close-button:hover {
            color: var(--danger);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 0.5rem;
        }

        p {
            margin-bottom: 0.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        select {
            width: 100%;
            padding: 0.75rem;
            border-radius: var(--radius);
            border: var(--border);
            background-color: white;
            font-size: 1rem;
            color: var(--dark);
            transition: border-color 0.3s ease;
        }

        select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .vendor-badge {
            display: inline-flex;
            align-items: center;
            background-color: var(--light-gray);
            padding: 0.25rem 0;
            border-radius: 20px;
            font-size: 0.875rem;
            gap: 0.5rem;
        }

        .vendor-badge i {
            color: var(--success);
        }

        .no-vendor {
            color: var(--gray);
            font-style: italic;
        }

        .search-container {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .search-container i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .search-container input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border-radius: var(--radius);
            border: var(--border);
            font-size: 1rem;
        }

        .search-container input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .vendor-list {
            max-height: 300px;
            overflow-y: auto;
            border: var(--border);
            border-radius: var(--radius);
        }

        .vendor-item {
            padding: 1rem;
            border-bottom: var(--border);
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
        }

        .vendor-item:last-child {
            border-bottom: none;
        }

        .vendor-item:hover {
            background-color: var(--light);
        }

        .vendor-item.selected {
            background-color: rgba(67, 97, 238, 0.1);
            border-left: 3px solid var(--primary);
        }

        .vendor-radio {
            margin-right: 1rem;
        }

        .vendor-info {
            flex: 1;
        }

        .vendor-name {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .vendor-email {
            font-size: 0.875rem;
            color: var(--gray);
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .loading-container {
            display: flex;
            justify-content: center;
            padding: 2rem;
        }

        .loading-text {
            text-align: center;
            color: var(--gray);
            font-weight: 500;
        }

        .vendor-role {
            font-size: 0.8rem;
            background: var(--light-gray);
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 4px;
        }

        .vendor-status {
            font-size: 0.8rem;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 4px;
        }

        .status-active {
            background-color: rgba(6, 214, 160, 0.2);
            color: #06a77d;
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: #c8a415;
        }

        .status-inactive {
            background-color: rgba(239, 68, 68, 0.2);
            color: #d63030;
        }

        @media (max-width: 768px) {
            .dashboard-list-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .list-item-action {
                width: 100%;
                justify-content: flex-end;
            }
        }

        #cancelAssign {
            color: #fff;
            background: rgb(242, 84, 84);
            padding: 0 15px;
        }

        .dashboard-list-item {
            display: flex;
            justify-content: space-between;
            /* align-items: center; */
            width: 100%;
        }

        .key {
            display: flex;
            justify-content: center;
            width: 10px;
            min-width: 10px;
            margin-right: 1rem;
        }

        .list-item-data {
            flex: 1;
        }

        .list-item-action {
            margin-left: auto;
            padding-left: 1rem;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* for adjustment  */
        .dashboard-list-item {
            display: block;
        }
    </style>

@endsection

@section('content')
    <div class="container w-container">
        <div class="page-header">
            <h1 class="dark">Retourlijst</h1>
        </div>
        <form method="get" action="{{ route('admin.return.list') }}">
            @csrf
            <div class="search-area" style="display: flex;">
                <input type="text" name="search" placeholder="Zoeken op order-ID, naam of e-mailadres" class="w-input"
                    style="margin-right: 8px;padding: 15px 5px;">
                <button type="submit"class="button gradient w-button" style="margin-left: 0; margin-top: 0;">
                    Zoeken
                </button>
            </div>
        </form>
        <ul role="list" class="dashboard-list w-list-unstyled">
            @foreach ($returnRequests as $order)
                <li class="dashboard-list-item">
                    <div class="item-date">{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }} <div>
                            <button class="btnn"
                                onclick="getVendorsOfThisEvent({{ $order->getOrder->product_code ?? '' }}, {{ $order->id }})"
                                style=" margin: 25px 35px; padding: 10px; background-color: #cfa446; border-radius:50px">Doorsturen
                                naar</button>
                        </div>
                    </div>

                    <div class="list-item-data">
                        <div class="important">Order ID: <strong>#{{ sprintf('%06d', $order->order_number) }}</strong></div>
                        <div class="important">Gekocht door: {{ $order->name }}</div>
                        <div class="light"></strong> E-Mail: <strong>{{ $order->email }}</strong></div>
                        <div class="light">Aankoop bedrag: €{{ number_format($order->getOrder->price ?? 0, 2) }}</div>

                        <!-- Event Details -->
                        <div class="light">Ticket voor:
                            <strong>
                                @if ($order->event)
                                    {{ $order->event->name }} ({{ date('d-m-Y', strtotime($order->event->start_date)) }})
                                @else
                                    Onbekend evenement
                                @endif
                            </strong>
                        </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Forward Vendor Modal -->
    <div class="modal" id="assignVendorModal">
        <div class="modal-content">
            <form id="assignVendorForm" method="POST" action="{{ route('forward.vendor.return.request') }}">
                @csrf
                <div class="modal-header" style="padding: 0 1.5rem">
                    <h3 class="modal-title">Voorwaartse leverancier</h3>
                    <button type="button" class="close-button" id="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="light">Voorwaartse leverancier voor: <span id="stallName" class="important"></span></p>
                    <div class="form-group">
                        <div class="vendor-list" id="vendorList">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button button-outline" id="cancelAssign">Annuleren</button>
                    <button type="submit" class="button w-button" id="confirmAssign">
                        Voorwaartse leverancier
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>

        const allBtn = document.querySelectorAll('.btnn');
        const modal = document.getElementById('assignVendorModal');

        allBtn.forEach(button => {
            button.addEventListener('click', function() {
                modal.classList.add('active');
            })
        });

        const closeModal = document.getElementById('closeModal');
        const cancelAssign = document.getElementById('cancelAssign');

        function closeModalFunction() {
            modal.classList.remove('active');

        }

        closeModal.addEventListener('click', closeModalFunction);
        cancelAssign.addEventListener('click', closeModalFunction);
    </script>
    <script>
        function getVendorsOfThisEvent(eventId, returnId) {
            $.ajax({
                type: "GET",
                url: "{{ route('get.vendors.return') }}",
                data: {
                    'id': eventId,
                    'return_id': returnId
                },
                dataType: 'json',
                success: (vendorArray) => {
                    const vendorList = document.getElementById('vendorList');
                    vendorList.innerHTML = '';

                    let returnId = vendorArray.returnId;

                    vendorArray.vendors.forEach(vendor => {
                        const vendorItem = document.createElement('div');
                        vendorItem.className = 'vendor-item';
                        vendorItem.innerHTML = `
                    <div class="vendor-radio">
                        <input type="radio" name="user_id" id="vendor-${vendor.ownerID}" value="${vendor.ownerID}">
                        <input type="hidden" name="return_id" value="${returnId}">
                    </div>
                    <label class="vendor-info" for="vendor-${vendor.ownerID}">
                        <div class="vendor-name">${vendor.name} </div>
                    </label>
                `;
                        vendorList.appendChild(vendorItem);
                    });
                }
            })
        }
    </script>
@endsection
