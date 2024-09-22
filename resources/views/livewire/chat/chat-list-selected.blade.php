<li class="item active-message">
@if($chat_selected)
    <a  class="d-flex row m-0" data-messages-id="{{$chat_selected->id}}">
        <div class="message-avatar col-2 p-0">
            <img class="rounded-circle"
                 src="{{asset($chat_selected->anotherUser()->avatar)}}"
                 alt="">
        </div>
        <div class="message-by col-10 position-relative">
            <div class="message-by-headline d-flex">
                <h5> {{$chat_selected->anotherUser()->first_name . ' ' . $chat_selected->anotherUser()->last_name}}</h5>
                <span class="position-absolute end-0 top-0 text-secondary">{{getDayDifference($chat_selected)}}</span>
            </div>
            <div class="d-flex short-messages w-100">
                @if($chat_selected->last_messages_sender == Session::get('user_data.id'))
                    <p class="m-0"> You: {{truncateText($chat_selected->last_messages, 30)}}</p>
                    @if($chat_selected->status_user_2 == 'Unread')
                        <span class="{{$chat_selected->status_user_1}} position-absolute end-0 rounded-circle">
                        <i class="bi bi-check"></i>
                @elseif ($chat_selected->status_user_2 == 'Seen')
                                <span class="{{$chat_selected->status_user_2}} position-absolute end-0 rounded-circle">
                        <i class="bi bi-check-all"></i>
                @endif
                </span>
                            @else
                                <p class="m-0"> {{$chat_selected->anotherUser()->first_name}}: {{truncateText($chat_selected->last_messages, 30)}}</p>
                                @if($chat_selected->status_user_1 == 'Unread')
                                    <span class="{{$chat_selected->status_user_1}} position-absolute end-0 rounded-circle">
                        @if($chat_selected->messages_unread < 5)
                                            {{$chat_selected->messages_unread}}
                                        @else
                                            5+
                                        @endif
                    </span>
                    @endif
                @endif
            </div>
            @if($chat_selected->statusSender() == 'Fail')
                <span class="fs-6 text-danger position-absolute end-0">An error occurred, message sending failed.
            @endif
        </div>
    </a>
@else
    <div class="h-100 d-flex justify-content-center align-items-center fw-semibold fs-2">No Messages</div>
@endif
</li>
