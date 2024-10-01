<ul id="myList">
    @if($data_chat_list !== null && !$data_chat_list->isEmpty())
        @foreach($data_chat_list as $chat_list)
            <li wire:click.prevent="selectChat({{ $chat_list->id }})" class="item {{$chat_list->id == $chatSelected_id ? 'active-message' : ''}} cursor-pointer Send-Messages">
                <a data-messages-id="{{$chat_list->id}}" class="d-flex row m-0 position-relative">
                    <div class="message-avatar col-2 p-0">
                        <img class="rounded-circle"
                             src="{{asset($chat_list->anotherUser()->avatar)}}"
                             alt="{{$chatSelected_id}}">
                    </div>
                    <div class="message-by col-10 position-relative">
                        <div class="message-by-headline d-flex">
                            <h5>{{$chat_list->anotherUser()->first_name . ' ' . $chat_list->anotherUser()->last_name}}</h5>
                            <span class="position-absolute end-0 top-0 text-secondary">{{getDayDifference($chat_list)}}</span>
                        </div>
                        <div class="d-flex short-messages w-100">
                            @if($chat_list->last_messages_sender == Session::get('user_data.id'))
                                <p class="m-0">  You: {{truncateText($chat_list->last_messages, 30)}} </p>
                                @if ($chat_list->statusReceiver() == 'Seen')
                                    <span class="{{$chat_list->statusReceiver()}} position-absolute end-0 rounded-circle">
                                    <i class="bi bi-check-all"></i>
                                @elseif($chat_list->statusSender() == 'Sent')
                                    <span class="{{$chat_list->statusSender()}} position-absolute end-0 rounded-circle">
                                    <i class="bi bi-check"></i>
                                @endif
                                    </span>
                            @else
                                <p class="m-0 {{$chat_list->statusReceiver() == 'Unread' ? 'fw-semibold' : ''}} ">{{$chat_list->anotherUser()->first_name}}: {{truncateText($chat_list->last_messages, 30)}}   </p>
                                @if($chat_list->statusReceiver() == 'Unread')
                                    <span class="{{$chat_list->statusReceiver()}} position-absolute end-0 rounded-circle">
                                    @if($chat_list->messages_unread < 5)
                                        {{$chat_list->messages_unread}}
                                    @else
                                        5+
                                    @endif
                                    </span>
                                @endif
                            @endif
                        </div>
                        @if($chat_list->last_messages_sender == Session::get('user_data.id') && $chat_list->statusSender() == 'Fail')
                            <span class="fs-6 text-danger position-absolute end-0">An error occurred, message sending failed.
                        @endif
                    </div>
                </a>
            </li>
        @endforeach
    @else
        <li class="d-none"><div class="h-100 d-flex justify-content-center align-items-center fw-semibold fs-2">&nbsp;</div></li>
    @endif
</ul>
