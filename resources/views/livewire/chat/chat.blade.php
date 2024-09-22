<div class="message-content position-relative d-grid width-75">

@if($messages !== false)

    <div class="overflow-y-auto message-content-block m-5 mt-0 me-0 pe-5 ">
        <div id="messages">
            @if(!$hasMoreMessages)
                <div class="w-100 text-center m-5">
                    <img class="rounded-circle m-auto w-25" src="{{asset($chat_selected->anotherUser()->avatar)}}" alt="">
                    <div class="fw-semibold fs-3 mt-4">{{$chat_selected->anotherUser()->first_name . ' ' . $chat_selected->anotherUser()->last_name}}</div>
                </div>
            @endif
            @foreach($messages_selected as $key => $messages)
                @php
                    $previousMessage = $key > 0 ? $messages_selected[$key - 1] : null;
                    $interval = $previousMessage ? $messages->created_at->diff($previousMessage->created_at) : null;
                    $imgColumns = ['img_1', 'img_2', 'img_3', 'img_4', 'img_5', 'img_6', 'img_7', 'img_8', 'img_9', 'img_10', 'img_11', 'img_12', 'img_13', 'img_14', 'img_15', 'img_16', 'img_17', 'img_18', 'img_19', 'img_20'];
                    $imgValues = $messages->only($imgColumns);
                @endphp
                @if($interval && $interval->days > 1)
                    <div class="w-100 d-flex justify-content-center hover-button mt-3 mb-3">
                        <a class="w-25 text-center text-secondary pb-2 fs-6">{{ $messages->created_at->format('Y-m-d') }}</a>
                    </div>
                @endif
                <div
                    @class([
                        'me justify-content-end' => $messages->sender_id == Session::get('user_data.id'),
                        "message-bubble d-flex"  => true,
                        'width-55' => $messages->sender_id !== Session::get('user_data.id'),
                    ])>
                    <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                        <img
                            @class([
                               'd-none' => ($key > 0 && $messages_selected[$key-1]->sender_id == $messages->sender_id) || $messages->sender_id == Session::get('user_data.id'),
                               'rounded-circle' => true,
                               ])
                            src="{{asset($messages->sender->avatar)}}"
                            alt="">
                    </div>
                    <div class="message-text ms-4 rounded-3 {{$messages->sender_id == Session::get('user_data.id') ? 'max-width-55' : 'max-width-90'}}">
                        <div class="w-100 img-messages">
                            @foreach($imgValues as $img)
                                @if($img)
                                    <img class="  grid-item" src="{{asset($img)}}" alt="">

                                @endif
                            @endforeach
                        </div>
                        <p>{{$messages->content}}</p>
                        <p class="d-flex justify-content-end">
                            <i class="d-flex justify-content-end fs-7">{{$messages->created_at->format('h:i A')}}</i>
                            @if($messages->sender_id == Session::get('user_data.id'))
                                <i @class([
                                'bi bi-check-all' => $messages->status_sender == 'Sent',
                                'bi bi-check' => $messages->status_receiver == 'Unread',
                                'ms-3' => true,
                            ])></i>
                            @endif
                        </p>
                        <p @class([
                            'alert-send-fail' => true,
                            'd-flex justify-content-end' => $messages->sender_id == Session::get('user_data.id') && $messages->status_sender == 'Fail',
                        ])>
                            <span class="fs-6 text-danger  end-0">An error occurred, message sending failed.</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="border-top bottom-0 w-100 ps-5 pe-5 pt-0 ps-0">
        <form class="h-100" method="POST" enctype="multipart/form-data" wire:submit.prevent="submitForm({{$chat_selected->id}})" >
            @csrf
            <input type="file" name="uploaded_images[]" id="file-list"
                   class="file-img d-none" multiple>
            <div class="position-relative h-100">
                <div class="d-flex mt-3">
                    <div class="width-10 d-flex align-items-center">
                        <a class="text-secondary hover-button btn-select-img fs-2 w-50"><i
                                class="bi bi-image"></i></a>
                        <a class="text-secondary ms-3 emoji hover-button col-1 fs-2 w-50"><i
                                class="bi bi-emoji-smile"></i></a>
                    </div>
                    <div class="width-85 position-relative border">
                        <div class="d-flex p-2">
                            <a class="img-comment btn-add-img d-none btn-select-img mt-2"><i
                                    class="bi bi-plus-lg"></i></a>
                            <div id="image-preview"
                                 class="text-center d-flex flex-wrap">
                            </div>
                        </div>
                        <textarea id="myTextarea" name="content" wire:model="content" autofocus
                                  class="border-0"></textarea>
                    </div>
                    <div class="icon-textarea width-5 d-flex align-items-center">
                        <a class="text-secondary me-5 hover-button">
                            <button style="height: 40px"
                                    class="d-flex align-items-center Send-Messages">
                                <i class="bi bi-send"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="d-flex position-relative pt-4 ">
                    <div class=" icon-textarea position-absolute start-0">
                    </div>
                </div>
            </div>
        </form>
    </div>

@else
    <li class="h-100 list-group-item"><div class="h-100 d-flex justify-content-center align-items-center fw-semibold fs-2">No Messages</div></li>
@endif

</div>

{{--<li class="h-100 list-group-item"><div class="h-100 d-flex justify-content-center align-items-center fw-semibold fs-2">Hello</div></li>--}}
