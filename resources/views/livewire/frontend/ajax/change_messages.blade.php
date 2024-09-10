<div>
    @if($check_messages_prev == true)
        <div class="w-100 d-flex justify-content-center border-bottom hover-button mt-3"><a class="w-100 text-center pb-2" href="#">Previous Message</a></div>
    @endif
    @foreach($messages_selected as $key => $messages)
        @if($messages->sender_id != Session::get('user_data.id'))
            @if($key > 0 && $messages_selected[$key-1]->sender_id == $messages->sender_id)
                <div class="message-bubble d-flex width-65 mt-2">
                    <div class="message-avatar width-5 max-width-5 min-width-5 p-0"></div>
                    <div class="message-text max-width-90 ms-4 rounded-3">
                        <p>{{$messages->content}} {{$messages->id}}</p>
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
                        <p>{{$messages->content}} {{$messages->id}}</p>
                    </div>
                </div>
            @endif
        @elseif($messages->sender_id == Session::get('user_data.id'))
            @if($key > 0 && $messages_selected[$key-1]->sender_id == $messages->sender_id)
                <div class="message-bubble mt-2 me d-flex justify-content-end">
                    <div class="message-text max-width-60 me-4 rounded-3">
                        @if($messages->status_receiver == 'Unread')
                            <p>{{$messages->content}} {{$messages->id}}</p>
                            <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Sent')
                            <p>{{$messages->content}} {{$messages->id}}</p>
                            <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Fail')
                            <p>{{$messages->content}} {{$messages->id}}</p>
                            <p class="d-flex justify-content-end"><span class="fs-6 text-danger  end-0">An error occurred, message sending failed.</span></p>
                        @endif
                    </div>
                </div>
            @else
                <div class="message-bubble mt-2 me d-flex justify-content-end">
                    <div class="message-text max-width-60 me-4 rounded-3">
                        @if($messages->status_receiver == 'Unread')
                            <p>{{$messages->content}} {{$messages->id}}</p>
                            <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Sent')
                            <p>{{$messages->content}} {{$messages->id}}</p>
                            <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                        @elseif($messages->status_sender == 'Fail')
                            <p>{{$messages->content}} {{$messages->id}}</p>
                            <p class="d-flex justify-content-end"><span class="fs-6 text-danger  end-0">An error occurred, message sending failed.</span></p>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    @endforeach
</div>
