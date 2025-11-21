@foreach ($messages as $message)
    <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
        <div class="message-avatar">
            <img src="https://ui-avatars.com/api/?name={{ $message->sender_id == Auth::id() ?  ($message->sender->first_name.' '.$message->sender->last_name) : ($message->receiver->first_name.' '.$message->receiver->last_name) }}&amp;size=300" alt="">
        </div>
        <div class="message-content">
            <div class="message-bubble">
                {{ $message->message }}
            </div>
        </div>
    </div>
@endforeach