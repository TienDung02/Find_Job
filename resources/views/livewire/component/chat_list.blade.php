@foreach($data_chat_list as $chat_list)
    @if($chat_list->user_1 == Session::get('user_data.id'))
        <li>
            <a data-messages-id="{{$chat_list->id}}" class="d-flex row m-0 position-relative change-messages">
                <div class="message-avatar col-2 p-0">
                    <img class="rounded-circle"
                         src="{{asset($chat_list->user2->avatar)}}"
                         alt="">
                </div>
                <div class="message-by col-10 position-relative">
                    <div class="message-by-headline d-flex">
                        <h5>{{$chat_list->user2->first_name . ' ' . $chat_list->user2->last_name}} </h5>
                        <span class="position-absolute end-0 top-0 text-secondary">{{getDayDifference($chat_list)}}</span>
                    </div>
                    <div class="d-flex short-messages w-100">
                        @if($chat_list->last_messages_sender == Session::get('user_data.id'))
                            <p class="m-0">  You: {{truncateText($chat_list->last_messages, 30)}}</p>
                            @if ($chat_list->status_user_2 == 'Seen')
                                <span class="{{$chat_list->status_user_2}} position-absolute end-0 rounded-circle">
                                                                            <i class="bi bi-check-all"></i>
                                                                        @elseif($chat_list->status_user_1 == 'Sent')
                                        <span class="{{$chat_list->status_user_1}} position-absolute end-0 rounded-circle">
                                                                            <i class="bi bi-check"></i>
                                                                        @endif
                                                                        </span>
                                    @else
                                        <p class="m-0 {{$chat_list->status_user_1 == 'Unread' ? 'fw-semibold' : ''}} ">   {{$chat_list->user2->first_name}}: {{truncateText($chat_list->last_messages, 30)}}</p>
                                        @if($chat_list->status_user_1 == 'Unread')
                                            <span class="{{$chat_list->status_user_1}} position-absolute end-0 rounded-circle">
                                                                            @if($chat_list->messages_unread < 5)
                                                    {{$chat_list->messages_unread}}
                                                @else
                                                    5+
                                                @endif
                                                                            </span>
                            @endif
                        @endif
                    </div>
                    @if($chat_list->last_messages_sender == Session::get('user_data.id') && $chat_selected->status_user_1 == 'Fail')
                        <span class="fs-6 text-danger position-absolute end-0">An error occurred, message sending failed.
                    @endif
                </div>
            </a>
        </li>
    @elseif($chat_list->user_2 == Session::get('user_data.id'))
        <li>
            <a data-messages-id="{{$chat_list->id}}" class="d-flex row m-0 position-relative change-messages">
                <div class="message-avatar col-2 p-0">
                    <img class="rounded-circle"
                         src="{{asset($chat_list->user1->avatar)}}"
                         alt="">
                </div>
                <div class="message-by col-10 position-relative">
                    <div class="message-by-headline d-flex">
                        <h5>{{$chat_list->user1->first_name . ' ' . $chat_list->user1->last_name}}</h5>
                        <span class="position-absolute end-0 top-0 text-secondary">{{getDayDifference($chat_list)}}</span>
                    </div>
                    <div class="d-flex short-messages w-100">

                        @if($chat_list->last_messages_sender == Session::get('user_data.id'))
                            <p class="m-0">  You: {{truncateText($chat_list->last_messages, 30)}}</p>
                            @if ($chat_list->status_user_1 == 'Seen')
                                <span class="{{$chat_list->status_user_1}} position-absolute end-0 rounded-circle">
                                                                            <i class="bi bi-check-all"></i>
                                                                        @elseif($chat_list->status_user_2 == 'Sent')
                                        <span class="{{$chat_list->status_user_2}} position-absolute end-0 rounded-circle">
                                                                            <i class="bi bi-check"></i>
                                                                        @endif
                                                                        </span>
                                    @else
                                        <p class="m-0 {{$chat_list->status_user_2 == 'Unread' ? 'fw-semibold' : ''}}">   {{$chat_list->user1->first_name}}: {{truncateText($chat_list->last_messages, 30)}}</p>
                                        @if($chat_list->status_user_2 == 'Unread')
                                            <span class="{{$chat_list->status_user_2}} position-absolute end-0 rounded-circle">
                                                                            @if($chat_list->messages_unread < 5)
                                                    {{$chat_list->messages_unread}}
                                                @else
                                                    5+
                                                @endif
                                                                            </span>
                            @endif
                        @endif
                    </div>
                    @if($chat_list->last_messages_sender == Session::get('user_data.id') && $chat_selected->status_user_2 == 'Fail')
                        <span class="fs-6 text-danger position-absolute end-0">An error occurred, message sending failed.
                    @endif
                </div>
            </a>
        </li>
    @endif
@endforeach
