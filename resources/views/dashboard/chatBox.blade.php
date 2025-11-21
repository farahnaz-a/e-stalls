@extends('layouts.main')
@section('title', 'E-STALLS Chat Box')
 @push('css')

    <style>


        .body {
            font-family: sans-serif ;
            /* height: 100vh; */
            /* overflow: hidden; */
        }

        .container1 {
            max-width: 1160px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            height: 80vh;
            padding: 10px;
            box-shadow: 0px 0px 8px -6px black;
            border-radius: 5px;
        }

        /* Mobile Header */
        .mobile-header {
            padding: 3px 20px;
            background: white;
            border: 1px solid #e5e7eb;
            border-left: none;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: inset;
        }

        .menu-btn {
            background: none;
            border: none;
            padding: 5px;
            cursor: pointer;
            color: #6b7280;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            position: relative;
            flex-shrink: 0;
        }

        .avatar img, .message-avatar img{
            border-radius: 50%;
        }
        .me {

            /* background-image: url('/user-images/images.jpeg'); */
             background-size: cover;
        }
        .user{
              background-image: url('/user-images/premium_photo-1690407617542-2f210cf20d7e.jpeg');
             background-size: cover;
        }

        .avatar.online::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: #10b981;
            border: 2px solid white;
            border-radius: 50%;
        }

        .header-info {
            flex: 1;
            min-width: 0;
        }

        .header-info h3 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px 15px;
            background-image: url("{{ asset('user-images/chat-bg.svg') }}");
            background-color: #F2F0F7;
            background-repeat: repeat;
            background-color: #f4d0d82b;
            background-size: 180px;
        }

        .message {
            margin-bottom: 16px;
            display: flex;
            gap: 10px;
            text-align: left;
        }

        .message.sent {
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 12px;
            flex-shrink: 0;
        }

        .message-content {
            max-width: 70%;
        }

        .message-bubble {
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.4;
        }

        .message.received .message-bubble {
            background: white;
            color: #111827;
            border-bottom-left-radius: 4px;
        }

        .message.sent .message-bubble {
             background-image:  linear-gradient(216deg, #363e5d, #932e7f 25%, #cfa446);
            color: white;
            border-bottom-right-radius: 4px;
        }
        .message-input-area {
            padding: 15px;
            background: white;
            border-top: 1px solid #e5e7eb;
        }

        .input-wrapper {
            display: flex;
            align-items: flex-end;
            gap: 12px;
        }

        .attach-btn {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            color: #6b7280;
            cursor: pointer;
            padding: 7px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            flex-shrink: 0;
            border-radius: 7px;

        }

        .attach-btn:hover {
             background-image:  linear-gradient(216deg, #363e5d, #932e7f 25%, #cfa446);
            color: white;
        }

        .message-input-wrapper {
            flex: 1;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 7px;
            padding: 4px 15px;
            min-width: 0;
        }

        .message-input-wrapper:focus-within {
            border-color: #af2d02;

            background: white;
        }

        .message-input {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 1rem;
            outline: none;
            color: #111827;
            resize: none;
            min-height: 22px;
            max-height: 100px;
            font-family: inherit;
        }

        .message-input::placeholder {
            color: #9ca3af;
        }

        .send-btn {
            background: #f3f4f6;
            border: none;
            color: black;
            padding: 10px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
             transition: all 0.2s;
            flex-shrink: 0;
        }

        .send-btn:hover {
             box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
             color: white;
             background-image:  linear-gradient(216deg, #363e5d, #932e7f 25%, #cfa446);
        }



        .file-input {
            display: none;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .sidebar {
            position: fixed;
            /* display: none; */
            left: -280px;
            width: 280px;
            height: 100%;
            background: white;
            z-index: 999;
            display: flex;
            /* border-left: 1px solid gray; */
            flex-direction: column;
            transition: left 0.3s ease;
            /* box-shadow: 2px 0 10px 5px rgba(0, 0, 0, 0.1); */
           box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

        }

        .sidebar.active {
            left: 0;
            top: 0px;
            /* display: block;
            position: absolute; */
        }

        @media (min-width: 768px) {
            .sidebar {
                /* margin-top: 200px !important; */
                position: static;
                left: 0;
                width: 300px;
                box-shadow: none;
            }

            .sidebar-overlay {
                display: none !important;
            }

            .menu-btn {
                display: none;
            }

            .container1 {
                flex-direction: row;
            }

            .mobile-header {
                /* display: none; */
            }

            .chat-messages {
                /* flex: 1; */
                 overflow-y: auto;
            }
        }
        @media (max-width: 767px)
        {
             .chat-messages {
                flex: 1;
                 overflow-y: auto;
            }
             .container1 {
                height: 85vh;
             }
              .sidebar {
                 margin-top: 100px !important;
                position: absolute;
                top: 0px;
                height: 85vh;
              }
             .search-box{
                flex: 1;
             }
             .search-box input{
                width: 100%;
             }

        }
        @media (max-width: 439px){
            .sidebar{
                height: 85vh;
                /* width: 80%;      */
            }
        }
        @media (max-width: 349px){
            .sidebar{
                height: 89vh;
                /* width: 80%;      */
            }
        }

        .sidebar-header {
            padding: 15px;
            border: 1px solid #e5e7eb;
            /* border-right: 1px solid #e5e7eb; */
        }

        .header-top {
            display: flex;
            align-items: center;
            gap: 10px;

        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            min-width: 0;
        }

        .user-profile .chat-name {
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-box {
            position: relative;
            /* flex: 1; */
            min-width: 0;
        }

        .search-box input {
            /* width: 100%; */
            padding: 8px 10px 8px 30px;
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            font-size: 12px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #a53001;
             /* border-image:  linear-gradient(216deg, #363e5d, #932e7f 25%, #cfa446); */
        }

        .search-icon {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .chats-section {
            padding: 12px 0;
            overflow-y: auto;
            flex: 1;
        }

        .chats-title {
            padding: 0 15px 8px;
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
        }

        .chat-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .chat-item:active {
            background: #f3f4f6;
        }

        .chat-item.active {
            /* background: #8b5cf6; */
            background-image:  linear-gradient(216deg, #363e5d, #932e7f 25%, #cfa446);
             box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3)

        }

        .chat-item.active .chat-name,
        .chat-item.active .chat-id {
            color: white;
        }

        .chat-item.active .chat-avatar {
            box-shadow: 0 0 0 3px white;
        }

        .chat-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
             /* background-image: url("/user-images/pexels-italo-melo-881954-2379004.jpg"); */
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 13px;
            flex-shrink: 0;
        }

        .chat-info {
            flex: 1;
            min-width: 0;
        }

        .chat-name {
            font-weight: 500;
            font-size: 13px;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-id {
            font-size: 11px;
            color: #6b7280;
        }
        .footer {
            margin-top: 0px !important;
        }

        .start-chat{
            text-align: center;
            margin-top: 20vh;
        }
        .start-chat-button{
            border-radius: 50%;
            padding: 1.8rem 2rem;
            box-shadow: 0 4px 8px 0 rgba(34, 41, 47, 0.12) !important;
            background: #FFFFFF;
            color: #6E6B7B;
            margin-bottom: 1rem !important;
        }
        .start-chat-text{ 
            background: #FFFFFF;
            box-shadow: 0 4px 8px 0 rgba(34, 41, 47, 0.12) !important;
            color: #6E6B7B;
            font-size: 1.286rem;    
            padding: 0.5rem 1rem;
            border-radius: calc(0.357rem * 4);
            cursor: pointer; 
        }

    </style>


 @endpush
@section('content')

    <div class="body container1">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="header-top">
                    <div class="user-profile">
                        <div class="avatar me online" style="background-image: url('https://ui-avatars.com/api/?name={{ \Auth::user()->first_name.' '.\Auth::user()->last_name }}&amp;size=300')"></div>
                        <div>
                            <div class="chat-name">{{ \Auth::user()->first_name }}</div>
                        </div>
                    </div>
                    <div class="search-box">
                        <svg class="search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        <input type="text" id="search" placeholder="Search chats">
                    </div>
                </div>
            </div>

            <div class="chats-section">
                <div class="chats-title">Chats</div>
                <div class="chat-list">
                    @php
                        $render_user_arr = [];
                    @endphp
                    @foreach ($messages as $message)
                        @php
                            if($message->sender_id == \Auth::id()){
                                if(in_array($message->receiver_id, $render_user_arr)){
                                    continue;
                                }
                                $message_user = $message->receiver;
                                $render_user_arr[] = $message->receiver_id; 
                            }else{
                                if(in_array($message->sender_id, $render_user_arr)){
                                    continue;
                                }
                                $message_user = $message->sender;
                                $render_user_arr[] = $message->sender_id; 
                            }
                        @endphp
                        <div class="chat-item" data-id="{{ $message_user->id }}" data-name="{{ $message_user->first_name.' '.$message_user->last_name }}">
                            <div class="chat-avatar" style="background-image: url('https://ui-avatars.com/api/?name={{ $message_user->first_name.' '.$message_user->last_name }}&amp;size=300')"></div>
                            <div class="chat-info">
                                <div class="chat-name">{{ $message_user->first_name }}</div>
                                <div class="chat-id chat-id{{ $message_user->id }}">{{ $message->message }}</div>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($users->whereNotIn('id', $render_user_arr) as $user)
                        <div class="chat-item" data-id="{{ $user->id }}" data-name="{{ $user->first_name.' '.$user->last_name }}">
                            <div class="chat-avatar" style="background-image: url('https://ui-avatars.com/api/?name={{ $user->first_name.' '.$user->last_name }}&amp;size=300')"></div>
                            <div class="chat-info">
                                <div class="chat-name">{{ $user->first_name }}</div>
                                <div class="chat-id chat-id{{ $user->id }}"></div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="chat-item" onclick="selectChat(this)">
                        <div class="chat-avatar"></div>
                        <div class="chat-info">
                            <div class="chat-name">TH48896 🇧🇩</div>
                            <div class="chat-id">Bangladesh</div>
                        </div>
                    </div>

                    <div class="chat-item" onclick="selectChat(this)">
                        <div class="chat-avatar"></div>
                        <div class="chat-info">
                            <div class="chat-name">EU48906 🇺🇸</div>
                            <div class="chat-id">United States</div>
                        </div>
                    </div>

                    <div class="chat-item active" onclick="selectChat(this)">
                        <div class="chat-avatar"></div>
                        <div class="chat-info">
                            <div class="chat-name">AT48916 🇺🇸</div>
                            <div class="chat-id">United States</div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div style="flex: 1; display: flex; flex-direction: column; min-width: 0;  overflow-y: auto;">
            <!-- Mobile Header -->
            <div class="mobile-header">
                <button class="menu-btn" onclick="toggleSidebar()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                <div class="avatar online" id="currentUserAvatar" style="display: none;">
                    <img src="https://ui-avatars.com/api/?name={{ \Auth::user()->first_name.' '.\Auth::user()->last_name }}&amp;size=300" alt="">
                </div>
                <div class="header-info">
                    <h3 id="currentUserName"></h3>
                </div>
            </div>

            <!-- Chat Messages Area -->
            <div class="chat-messages"> 
                {{-- <div class="start-chat">
                    <button class="start-chat-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square" style="height: 4rem; width: 4rem; font-size: 4rem;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </button><br>
                    <span class="start-chat-text">Start Conversation</span>
                </div> --}}
                {{-- <div class="message received">
                    <div class="message-avatar user"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Hello! How can I help you today?
                        </div>
                    </div>
                </div>
 
                <div class="message sent">
                    <div class="message-avatar me"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Hi! I need some information about your services.
                        </div>
                    </div>
                </div>

                <div class="message received">
                    <div class="message-avatar user"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Sure! I'd be happy to help. What specific information are you looking for?
                        </div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar me"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Can you tell me about your pricing plans?
                        </div>
                    </div>
                </div>
                <div class="message received">
                    <div class="message-avatar user"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Sure! I'd be happy to help. What specific information are you looking for?
                        </div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar me"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Can you tell me about your pricing plans?
                        </div>
                    </div>
                </div>
                <div class="message received">
                    <div class="message-avatar user"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Sure! I'd be happy to help. What specific information are you looking for?
                        </div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar me"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Can you tell me about your pricing plans?
                        </div>
                    </div>
                </div>
                <div class="message received">
                    <div class="message-avatar user"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Sure! I'd be happy to help. What specific information are you looking for?
                        </div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar me"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Can you tell me about your pricing plans?
                        </div>
                    </div>
                </div>
                <div class="message received">
                    <div class="message-avatar user"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Sure! I'd be happy to help. What specific information are you looking for?
                        </div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar me"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Can you tell me about your pricing plans?
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Message Input Area -->
            <div class="message-input-area">
                <div class="input-wrapper">
                    {{-- <button class="attach-btn" onclick="document.getElementById('fileInput').click()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                        </svg>
                    </button>
                    <input type="file" id="fileInput" class="file-input"> --}}

                    <div class="message-input-wrapper">
                        <textarea class="message-input" placeholder="Type your message or use speech to text" rows="1"></textarea>
                    </div>

                    <button class="send-btn"> 
                        Send
                    </button>
                </div>
            </div>
        </div>
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    </div>

@endsection
@push('js')
   <script>

        let last_message = '';
        let selected_user_id;

        setInterval(() => {
            let user_id = selected_user_id;
            if(selected_user_id && last_message){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type  : "POST",
                    url   : "{{ route('chat.message.render') }}",
                    data  : {user_id, last_message},
                    success: response => {
                    last_message = response.last_message;
                    if(response.last_messages_count){
                        $(".chat-messages").append(response.message); 
                            $('.chat-messages').animate({
                            scrollTop: $('.chat-messages')[0].scrollHeight
                        }, 400); 
                    }
                    },
                    error: errors => {
                    },
                });
            }
        }, 3000);

        $(document).ready(function(){
            $("body").on('input', '#search', function(){
			    let searchValue = $(this).val().toLowerCase();
                $(".chat-item").filter(function() {
                    $(this).toggle($(this).find(".chat-info").text().toLowerCase().indexOf(searchValue) > -1)
                });
            }); 

            $('body').on('click', '.chat-item', function(){
                let name = $(this).data('name');
                let user_id = $(this).data('id');
                $('#currentUserAvatar').show();
                $('#currentUserAvatar').find('img').attr('src', "https://ui-avatars.com/api/?name="+name+"&amp;color=FFFFFF&amp;size=300");
                $('#currentUserName').text(name); 
                selected_user_id = user_id;
                $('.chat-item').removeClass('active');
                $(this).addClass('active');
                $('.message-input').val('');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type  : "POST",
                        url   : "{{ route('chat.message') }}",
                        data  : {user_id},
                        success: response => {
                            last_message = response.last_message; 
                            $(".chat-messages").html(response.message); 
                            $('.chat-messages').animate({
                                scrollTop: $('.chat-messages')[0].scrollHeight
                            }, 400);  
                        },
                        error: errors => {  
                        },
                    });
            })
            $('body').on('click', '.send-btn', function(){
                let message = $('.message-input').val(); 
                let user_id = selected_user_id;            
                if(user_id){
                    if(!message){                     
                        $('.message-input').focus();
                    }else{
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type  : "POST",
                            url   : "{{ route('chat.message.send') }}",
                            data  : {user_id, message, last_message},
                            success: response => {
                            last_message = response.last_message;
                                $(".chat-messages").append(response.message);
                                $(".chat-id"+user_id).text(message);
                                $('.message-input').val('');
                                 $('.chat-messages').animate({
                                    scrollTop: $('.chat-messages')[0].scrollHeight
                                }, 400); 
                            },
                            error: errors => {
                            },
                        });
                    }
                }
            })
        });


        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // function selectChat(element) {
        //     document.querySelectorAll('.chat-item').forEach(item => {
        //         item.classList.remove('active');
        //     });
        //     element.classList.add('active');

        //     // Close sidebar on mobile after selection
        //     if (window.innerWidth < 768) {
        //         toggleSidebar();
        //     }
        // }

        // Handle file selection
        // document.getElementById('fileInput').addEventListener('change', function(e) {
        //     const files = e.target.files;
        //     if (files.length > 0) {
        //         console.log('Selected files:', files); 
        //     }
        // });

        // Auto-resize textarea
        const textarea = document.querySelector('.message-input');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });
    </script>
@endpush
