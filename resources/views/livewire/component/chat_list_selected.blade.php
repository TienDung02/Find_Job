@if($chat_selected->user_1 == Session::get('user_data.id'))
    <li>
        <a  class="d-flex row m-0 change-messages active-message" data-messages-id="{{$chat_selected->id}}">
            <div class="message-avatar col-2 p-0">
                <img class="rounded-circle"
                     src="{{asset($chat_selected->user2->avatar)}}"
                     alt="">
            </div>
            <div class="message-by col-10 position-relative">
                <div class="message-by-headline d-flex">
                    <h5> {{$chat_selected->user2->first_name . ' ' . $chat_selected->user2->last_name}}</h5>
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
                                    <p class="m-0"> {{$chat_selected->user2->first_name}}: {{truncateText($chat_selected->last_messages, 30)}}</p>
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
                @if($chat_selected->status_user_1 == 'Fail')
                    <span class="fs-6 text-danger position-absolute end-0">An error occurred, message sending failed.
                @endif
            </div>
        </a>
    </li>
@elseif($chat_selected->user_2 == Session::get('user_data.id'))
    <li>
        <a data-messages-id="{{$chat_selected->id}}" class="d-flex row m-0 change-messages active-message">
            <div class="message-avatar col-2 p-0">
                <img class="rounded-circle"
                     src="{{asset($chat_selected->user1->avatar)}}"
                     alt="">
            </div>
            <div class="message-by col-10 position-relative">
                <div class="message-by-headline d-flex">
                    <h5> {{$chat_selected->user1->first_name . ' ' . $chat_selected->user1->last_name}}</h5>
                    <span class="position-absolute end-0 top-0 text-secondary">{{getDayDifference($chat_selected)}}</span>
                </div>
                <div class="d-flex short-messages w-100">
                    <p class="m-0">
                    @if($chat_selected->last_messages_sender == Session::get('user_data.id'))
                        <p class="m-0"> You: {{truncateText($chat_selected->last_messages, 30)}}</p>
                        @if ($chat_selected->status_user_1 == 'Unread')
                            <span class="{{$chat_selected->status_user_2}} position-absolute end-0 rounded-circle">
                                                                        <i class="bi bi-check"></i>
                                                                    @elseif($chat_selected->status_user_1 == 'Seen')
                                    <span class="{{$chat_selected->status_user_1}} position-absolute end-0 rounded-circle">
                                                                        <i class="bi bi-check-all"></i>
                                                                    @endif
                                                                    </span>
                                @else
                                    <p class="m-0"> {{$chat_selected->user1->first_name}}: {{truncateText($chat_selected->last_messages, 30)}}</p>
                                    @if($chat_selected->status_user_2 == 'Unread')
                                        <span class="{{$chat_selected->status_user_2}} position-absolute end-0 rounded-circle">
                                                                        @if($chat_selected->messages_unread < 5)
                                                {{$chat_selected->messages_unread}}
                                            @else
                                                5+
                                            @endif
                                                                        </span>
                        @endif
                    @endif
                </div>
                @if($chat_selected->status_user_2 == 'Fail')
                    <span class="fs-6 text-danger position-absolute end-0">An error occurred, message sending failed.
                @endif
            </div>
        </a>
    </li>
@endif
