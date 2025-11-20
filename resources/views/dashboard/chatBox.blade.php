@extends('layouts.main')
 @push('css')

   <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        } */

        .body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            height: 100vh;
            overflow: hidden;

        }

        .chat-container {
            display: flex;
            height: 100vh;
        }

        .search-btn {
            padding: 8px;
            border-radius: 8px;
            background-color: #007bff;
            margin: 10px 0;
            border: none;
            color: white;
        }

        /* Sidebar */
        .user-list {
            width: 25%;
            background: #def8ff;
            overflow-y: auto;
            border-right: 1px solid #ccc;
            transition: 0.3s;
            position: relative;
        }

        /* Search box */
        .user-search {
            padding: 10px;
            background: #cfefff;
            border-bottom: 1px solid #bbb;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .user-search input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }

        .user {
            display: flex;
            align-items: center;
            padding: 12px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .user img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .user:hover {
            background: #e9f9ff;
        }

        /* Chat box */
        .chat-box {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: url('/istockphoto-1403848173-612x612.jpg');
            position: relative;
        }

        /* Top bar (Users Button like your first design) */
        .top-bar {
            background: #007bff;
            color: white;
            padding: 12px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            display: none;
        }

        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .message {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-end;
        }

        .message img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .message .text {
            max-width: 60%;
            padding: 10px 15px;
            border-radius: 15px;
            background: #fff;
            border: 1px solid #ddd;
            margin-left: 10px;
            color: black
        }

        .sent {
            flex-direction: row-reverse;
        }

        .sent .text {
            background: #007bff;
            color: white;
            margin-right: 10px;
            border-radius: 15px 15px 0 15px;
        }

        /* Input */
        .chat-input {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #ccc;
            position: relative;
        }

        .chat-input input {
            flex: 1;
            padding: 10px 15px;
            border-radius: 25px;
            border: 1px solid #bbb;
            outline: none;
        }

        .btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            font-size: 18px;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Attachment menu */
        .attachment-menu {
            position: absolute;
            bottom: 60px;
            left: 50px;
            display: none;
            background: white;
            padding: 8px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            gap: 10px;
            flex-direction: row;
        }

        .attachment-menu button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: #f0f0f0;
            font-size: 18px;
            cursor: pointer;
        }

          .footer{
                margin-top: 0 !important;
            }
        /* Responsive */
        @media(max-width: 768px) {
            .user-list {
                position: absolute;
                left: -100%;
                width: 70%;
                height: 100%;
                z-index: 200;
            }

            .user-list.show {
                left: 0;
            }

            .top-bar {
                display: block;
            }

        }
    </style>


 @endpush
@section('content')

      <div class="body">
         <div class="chat-container">

        <div class="user-list" id="userList">
            <div class="user-search"><input type="text" id="searchUser" placeholder="Search users..."> <button
                    class="search-btn">Search</button></div>
            <div class="user"><img src="https://i.pravatar.cc/45?img=1">
                <div><strong>Rahim</strong><br><small>Active now</small></div>
            </div>
            <div class="user"><img src="https://i.pravatar.cc/45?img=2">
                <div><strong>Karim</strong><br><small>Online</small></div>
            </div>
            <div class="user"><img src="https://i.pravatar.cc/45?img=3">
                <div><strong>Ayesha</strong><br><small>Offline</small></div>
            </div>
        </div>

        <div class="chat-box">
            <div class="top-bar" onclick="toggleUsers()">Chat Users</div>

            <div class="messages">
                <div class="message received"><img src="https://i.pravatar.cc/40?img=1">
                    <div class="text">Hey, how are you?</div>
                </div>
                <div class="message sent"><img src="https://i.pravatar.cc/40?img=5">
                    <div class="text">I'm good! What about you?</div>
                </div>
                <div class="message received"><img src="https://i.pravatar.cc/40?img=1">
                    <div class="text">All good here, let's catch up later.</div>
                </div>
            </div>

            <div class="chat-input">
                <button class="btn" id="attachBtn">📎</button>

                <div class="attachment-menu" id="attachmentMenu">
                    <button>🖼️</button>
                    <button>🎤</button>
                    <button>📄</button>
                </div>

                <input type="text" placeholder="Type a message..." />
                <button class="btn" style="background:#007bff;color:white;">➤</button>
            </div>
        </div>
    </div>
   </div>

@endsection
@push('js')
  <script>
        const menu = document.getElementById('attachmentMenu');
        const attachBtn = document.getElementById('attachBtn');
        const userList = document.getElementById('userList');
        const searchInput = document.getElementById('searchUser');

        attachBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';

            const rect = attachBtn.getBoundingClientRect();
            const parent = attachBtn.parentElement.getBoundingClientRect();
            menu.style.left = (rect.left - parent.left) + 'px';
        });

        document.addEventListener('click', (e) => {
            if (!menu.contains(e.target) && e.target !== attachBtn) menu.style.display = 'none';
        });

        function toggleUsers() { userList.classList.toggle('show'); }


    </script>
@endpush
