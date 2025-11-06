@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Stal Hall - E-STALLS')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
    {{-- modal for hide/show  --}}
    <style>
        /* backdrop */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* modal box */
        .modal-hide {
            background: #fff;
            border-radius: 4px;
            padding: 25px 40px;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            animation: fadeIn .25s ease;

        }

        .modal-hide h2 {
            margin-top: 0;
        }

        /* .modal-hide button {
                            background: #f5f5f5;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            padding: 6px 12px;
                            cursor: pointer;
                            font-size: 14px;
                        } */

        .modal-hide button:hover {
            /* background: #e9e9e9; */
        }

        .btn-verbergen {
            border-radius: 20px;
            /* margin-left: 70px; */

            background-color: rgb(242, 84, 84);
        }

        .btn-show {
            border-radius: 20px;
            /* margin-left: 70px; */
            background-color: rgb(15, 173, 15);
        }

        .cancel {
            background-color: #cfa446;
            border-radius: 20px;
            padding: 9px 15px;
            color: white;
        }

        #modalTitle {
            font-size: 30px;
            margin: 20px 0;
            text-align: center;
        }

        #confirmation {
            color: #932e7f;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


    <div class="container w-container">
        <div class="header-container">
            <h1 class="dark">stallhall</h1>
            <a href="{{ url('admin/events') }}" class="button w-button">Back</a>
        </div>
        <ul role="list" class="dashboard-list w-list-unstyled">
            @foreach ($stalls as $key => $stall)
                <li class="dashboard-list-item w-clearfix" id="stall-{{ $stall->id }}">
                    <span class="key">{{ $key + 1 }}</span>
                    <div class="list-item-data" style="margin-right: 5rem">
                        <div class="important">
                            Kraam: {{ $stall->description }}
                        </div>
                        <div class="light">Leverancier:
                            <span class="important">
                                {{ App\Models\User::find($stall->vendorID)->first_name ?? '' }}
                            </span>
                        </div>
                        <div class="light" id="assign-vendor-{{ $stall->id }}">
                            @if ($stall->assign_vendor_id)
                                Leverancier toewijzen:
                                <span class="important">
                                    {{ App\Models\User::find($stall->assign_vendor_id)->first_name ?? '' }}
                                </span>
                            @else
                                Leverancier toewijzen:
                                <span class="no-vendor">Not assigned</span>
                            @endif
                        </div>
                        <div class="light">Logo:
                            @if (!$stall->logo_url)
                                <img width="150" src="{{ asset('uploads/stalls/logo') }}/{{ $stall->logo_url }}"
                                    alt="Logo">
                            @endif
                        </div>
                    </div>

                    <div class="list-item-action">
                        @if ($stall->visibility == 1)
                            <button id="" class="btn-verbergen w-button openBtn" data-name="verbergen"
                                data-id="{{ $stall->id }}">Verbergen</button>
                        @else
                            <button id="" class="btn-show w-button openBtn" data-name="show"
                                data-id="{{ $stall->id }}">Show</button>
                        @endif
                        <button class="button w-button assign-btn" data-stall-id="{{ $stall->id }}"
                            data-stall-name="{{ $stall->description }}">
                            <i class="fas fa-user-plus"></i> Leverancier toewijzen
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Backdrop + modal -->
    <div class="modal-backdrop" id="backdrop">
        <form action="{{ route('admin.stall.visibility') }}" method="post">
            @csrf
            <div class="modal-hide" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
                <h2 id="modalTitle">Bevestiging!</h2>
                <p id="confirmation"></p>
                <input id="stallIdInput" type="hidden" name="stall_id" value="">
                <input id="visibitity" type="hidden" name="visibility" value="">

                <div style="margin: 20px auto; display: flex; justify-content:center; gap: 15px">
                    <button type="button" id="closeBtn" class="cancel">Annuleren</button>
                    <button type="submit" id="btn" class="w-button"></button>

                </div>
            </div>
        </form>
    </div>

    <!-- Assign Vendor Modal -->
    <div class="modal" id="assignVendorModal">
        <div class="modal-content">
            <form id="assignVendorForm" method="POST" action="{{ route('assign.vendor.stalls') }}">
                @csrf
                <input type="hidden" name="stall_id" id="formStallId" value="">

                <div class="modal-header" style="padding: 0 1.5rem">
                    <h3 class="modal-title">Leverancier toewijzen</h3>
                    <button type="button" class="close-button" id="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="light">Leverancier toewijzen voor: <span id="stallName" class="important"></span></p>

                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="vendorSearch" placeholder="Search vendors...">
                    </div>

                    <div class="form-group">
                        <div class="vendor-list" id="vendorList">
                            <div class="loading-text">
                                <i class="fas fa-spinner fa-spin"></i> Loading vendors...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button button-outline" id="cancelAssign">Annuleren</button>
                    <button type="submit" class="button w-button" id="confirmAssign">
                        Leverancier toewijzen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('assignVendorModal');
            const assignButtons = document.querySelectorAll('.assign-btn');
            const closeModal = document.getElementById('closeModal');
            const cancelAssign = document.getElementById('cancelAssign');
            const vendorList = document.getElementById('vendorList');
            const vendorSearch = document.getElementById('vendorSearch');
            const formStallId = document.getElementById('formStallId');
            let _vendors = @json($vendors);
            let currentStallId = null;

            // Open modal when assign button is clicked
            assignButtons.forEach(button => {
                button.addEventListener('click', function() {
                    currentStallId = this.getAttribute('data-stall-id');
                    const stallName = this.getAttribute('data-stall-name');

                    document.getElementById('stallName').textContent = stallName;
                    formStallId.value = currentStallId;
                    modal.classList.add('active');
                    vendorSearch.value = '';
                    vendorList.innerHTML =
                        '<div class="loading-text"><i class="fas fa-spinner fa-spin"></i> Loading vendors...</div>';
                    renderVendors(_vendors);
                });
            });

            // Close modal
            function closeModalFunction() {
                modal.classList.remove('active');
                currentStallId = null;
                vendorSearch.value = '';
            }

            closeModal.addEventListener('click', closeModalFunction);
            cancelAssign.addEventListener('click', closeModalFunction);


            // Function to render vendors in the list
            function renderVendors(vendorArray) {
                if (vendorArray.length === 0) {
                    vendorList.innerHTML = '<div class="vendor-item"><p>No vendors found.</p></div>';
                    return;
                }

                vendorList.innerHTML = '';
                vendorArray.forEach(vendor => {
                    const vendorItem = document.createElement('div');
                    vendorItem.className = 'vendor-item';
                    vendorItem.dataset.vendorId = vendor.id;

                    vendorItem.innerHTML = `
                    <div class="vendor-radio">
                        <input type="radio" name="vendor_id" id="vendor-${vendor.id}" value="${vendor.id}">
                    </div>
                    <label class="vendor-info" for="vendor-${vendor.id}">
                        <div class="vendor-name">${vendor.first_name} ${vendor.last_name}</div>
                        <div class="vendor-email">${vendor.email}</div>
                    </label>
                `;

                    vendorList.appendChild(vendorItem);
                });
            }

            // Search functionality
            vendorSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                if (_vendors) {
                    const filteredVendors = _vendors.filter(vendor =>
                        vendor.first_name.toLowerCase().includes(searchTerm) ||
                        vendor.last_name.toLowerCase().includes(searchTerm) ||
                        vendor.email.toLowerCase().includes(searchTerm)
                    );
                    renderVendors(filteredVendors);
                }
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModalFunction();
                }
            });
        });
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- js for hide/show modal  --}}
    <script>
        const openBtn = document.querySelectorAll(".openBtn");
        const closeBtn = document.getElementById("closeBtn");
        const backdrop = document.getElementById("backdrop");

        function openModal() {
            backdrop.style.display = "flex";
            closeBtn.focus();
        }

        function closeModal() {
            backdrop.style.display = "none";
        }

        // openBtn.addEventListener("click", openModal);

        openBtn.forEach(button => {
            button.addEventListener('click', function() {
                openModal();
                let msg = this.getAttribute('data-name');
                console.log(this.getAttribute('data-name'))

                const message = document.getElementById('confirmation');

                message.innerText = `Weet u zeker dat u deze kraam wilt ${msg}?`;

                const btn = document.getElementById('btn');
                btn.innerText = msg.charAt(0).toUpperCase() + msg.slice(1) //to capitalized first letter

                if (btn.classList.contains('btn-show')) {
                    btn.classList.remove('btn-show');
                }
                if (btn.classList.contains('btn-verbergen')) {
                    btn.classList.remove('btn-verbergen');
                }
                btn.classList.add(`btn-${msg}`);

                let stallId = this.getAttribute('data-id');

                document.getElementById('stallIdInput').value = stallId;
                document.getElementById('visibitity').value = msg;

            });
        });

        closeBtn.addEventListener("click", closeModal);

        // Close on backdrop click
        backdrop.addEventListener("click", e => {
            if (e.target === backdrop) closeModal();
        });
    </script>
@endsection
