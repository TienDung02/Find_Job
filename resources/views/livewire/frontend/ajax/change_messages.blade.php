<div>
    @if($check_messages_prev == true)
        <div class="w-100 d-flex justify-content-center border-bottom hover-button mt-3 mb-3"><a class="w-100 text-center pb-2 fw-semibold add-messages-prev" data-page="{{$page}}" data-messages-id="{{$chat_id}}">Previous Message</a></div>
    @endif
    @foreach($messages_selected as $key => $messages)
        @php
            $previousMessage = $key > 0 ? $messages_selected[$key - 1] : null;
            $interval = $previousMessage ? $messages->created_at->diff($previousMessage->created_at) : null;
            $dateOnly = $messages->created_at->format('Y-m-d');
            $timeOnly = $messages->created_at->format('h:i A');
            $imgColumns = ['img_1', 'img_2', 'img_3', 'img_4', 'img_5', 'img_6', 'img_7', 'img_8', 'img_9', 'img_10', 'img_11', 'img_12', 'img_13', 'img_14', 'img_15', 'img_16', 'img_17', 'img_18', 'img_19', 'img_20'];
            $imgValues = $messages->only($imgColumns);
        @endphp
        @if($interval && $interval->days > 3)
            <div class="w-100 d-flex justify-content-center hover-button mt-3 mb-3">
                <a class="w-25 text-center text-secondary pb-2 fs-6">{{ $dateOnly }}</a>
            </div>
        @endif
        @if($messages->sender_id != Session::get('user_data.id'))
            @if($key > 0 && $messages_selected[$key-1]->sender_id == $messages->sender_id)
                <div class="message-bubble d-flex width-65 mt-2">
                    <div class="message-avatar width-5 max-width-5 min-width-5 p-0"></div>
                    <div class="message-text max-width-90 ms-4 rounded-3">
                        <div class="w-100 img-messages">
                            @foreach($imgValues as $img)
                                @if($img)
                                    <img class="  grid-item" src="{{asset($img)}}" alt="">
                                @endif
                            @endforeach
                        </div>
                        <p>{{$messages->content}}</p>
                        <i class="d-flex justify-content-end fs-6">{{$timeOnly}}</i>
                    </div>
                </div>
            @else
                <div class="message-bubble d-flex width-65">
                    <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                        <img class="rounded-circle"
                             src="{{asset($messages->sender->avatar)}}"
                             alt="">
                    </div>
                    <div class="message-text max-width-90 ms-4 rounded-3">
                        <div class="w-100 img-messages">
                            @foreach($imgValues as $img)
                                @if($img)
                                    <img class="  grid-item" src="{{asset($img)}}" alt="">
                                @endif
                            @endforeach
                        </div>
                        <p>{{$messages->content}}</p>
                        <i class="d-flex justify-content-end fs-6">{{$timeOnly}}</i>
                    </div>
                </div>
            @endif
        @elseif($messages->sender_id == Session::get('user_data.id'))
            @if($key > 0 && $messages_selected[$key-1]->sender_id == $messages->sender_id)
                <div class="message-bubble mt-2 me d-flex justify-content-end">
                    <div class="message-text max-width-60 me-4 rounded-3">
                        @if($messages->status_receiver == 'Unread')
                            <div class="w-100 img-messages">
                                @foreach($imgValues as $img)
                                    @if($img)
                                        <img class="  grid-item" src="{{asset($img)}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <p>{{$messages->content}}</p>
                            <p class="d-flex justify-content-end"><i class="fs-6 me-4">{{$timeOnly}}</i><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Sent')
                            <div class="w-100 img-messages">
                                @foreach($imgValues as $img)
                                    @if($img)
                                        <img class="  grid-item" src="{{asset($img)}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <p>{{$messages->content}} </p>
                            <p class="d-flex justify-content-end"><i class="fs-6 me-4">{{$timeOnly}}</i><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Fail')
                            <div class="w-100 img-messages">
                                @foreach($imgValues as $img)
                                    @if($img)
                                        <img class="  grid-item" src="{{asset($img)}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <p>{{$messages->content}}</p>
                            <p class="d-flex justify-content-end"><i class="fs-6 me-4">{{$timeOnly}}</i><span class="fs-6 text-danger  end-0">An error occurred, message sending failed.</span></p>
                        @endif
                    </div>
                </div>
            @else
                <div class="message-bubble me d-flex justify-content-end">
                    <div class="message-text max-width-60 me-4 rounded-3">
                        @if($messages->status_receiver == 'Unread')
                            <div class="w-100 img-messages">
                                @foreach($imgValues as $img)
                                    @if($img)
                                        <img class="  grid-item" src="{{asset($img)}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <p>{{$messages->content}} </p>
                            <p class="d-flex justify-content-end"><i class="fs-6 me-4">{{$timeOnly}}</i><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Sent')
                            <div class="w-100 img-messages">
                                @foreach($imgValues as $img)
                                    @if($img)
                                        <img class="  grid-item" src="{{asset($img)}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <p>{{$messages->content}}</p>
                            <p class="d-flex justify-content-end"><i class="fs-6 me-4">{{$timeOnly}}</i><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Fail')
                            <div class="w-100 img-messages">
                                @foreach($imgValues as $img)
                                    @if($img)
                                        <img class="  grid-item" src="{{asset($img)}}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <p>{{$messages->content}}</p>
                            <p class="d-flex justify-content-end"><i class="fs-6 me-4">{{$timeOnly}}</i><span class="fs-6 text-danger  end-0">An error occurred, message sending failed.</span></p>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    @endforeach
</div>
