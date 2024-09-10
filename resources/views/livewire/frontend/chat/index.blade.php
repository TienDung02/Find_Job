@extends('frontend.layout.layout')
@section('content')

    <!-- Header
================================================== -->

    <div class="d-flex margin-top-90">
        @if(auth()->user()->role == 2)
            @include('frontend.component.menu_left_candidate')
        @else
            @include('frontend.component.menu_left_employer')
        @endif
        <div class="clearfix"></div>

        <div class="m-auto" style="width: calc(100% - 260px);background-color: #f6f6f6">
            <!-- Titlebar
            ================================================== -->
            <div id="titlebar" class="single mb-0 ms-5 pb-0">
                <div class="">

                    <div class="sixteen columns">
                        <h2 class="p-0">Messages</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="#">Home</a></li>
                                <li>Messages</li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

            <!-- Content
            ================================================== -->
            <div class="padding-50 border-radius-5 ">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="messages-container margin-top-0 ">
                            <div class="messages-headline">
                                <h4 class="fw-semibold">Inbox</h4>
                            </div>
                            <div class="messages-container-inner d-flex  min-height-60vh max-height-60vh ">
                                <div class="messages-inbox width-25">
                                    <ul class="h-100">
                                        <span id="get-url" data-url-change-messages="{{route('messages.change')}}"></span>
                                        @if(isset($chat_selected) && $chat_selected != null)
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
                                        @endif
                                        @if($data_chat_list->isNotEmpty())
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
                                        @else
                                            <li class="h-100"><div class="h-100 d-flex justify-content-center align-items-center fw-semibold fs-2">No message</div></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="message-content position-relative d-grid width-75">
                                    <div class="overflow-y-auto message-content-block p-5 pt-0 ">
                                        @if($selected_content_chat == 1)
                                            <div id="messages">
                                            @if($check_messages_prev == true)
                                                <div class="w-100 d-flex justify-content-center border-bottom hover-button mt-3"><a class="w-100 text-center pb-2" href="#">Previous Message</a></div>
                                            @endif
                                            @foreach($messages_selected as $key => $messages)
                                                @if($messages->sender_id != Session::get('user_data.id'))
                                                    @if($key > 0 && $messages_selected[$key-1]->sender_id == $messages->sender_id)
                                                        <div class="message-bubble d-flex width-65 mt-2">
                                                            <div class="message-avatar width-5 max-width-5 min-width-5 p-0"></div>
                                                            <div class="message-text max-width-90 ms-4 rounded-3">
                                                                <p>{{$messages->content}}</p>
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
                                                                <p>{{$messages->content}}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif($messages->sender_id == Session::get('user_data.id'))
                                                    @if($key > 0 && $messages_selected[$key-1]->sender_id == $messages->sender_id)
                                                        <div class="message-bubble mt-2 me d-flex justify-content-end">
                                                            <div class="message-text max-width-60 me-4 rounded-3">
                                                                @if($messages->status_receiver == 'Unread')
                                                                    <p>{{$messages->content}}</p>
                                                                    <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                                                                @elseif($messages->status_sender == 'Sent')
                                                                    <p>{{$messages->content}}</p>
                                                                    <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                                                                @elseif($messages->status_sender == 'Fail')
                                                                    <p>{{$messages->content}}</p>
                                                                    <p class="d-flex justify-content-end"><span class="fs-6 text-danger  end-0">An error occurred, message sending failed.</span></p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="message-bubble mt-2 me d-flex justify-content-end">
                                                            <div class="message-text max-width-60 me-4 rounded-3">
                                                                @if($messages->status_receiver == 'Unread')
                                                                    <p>{{$messages->content}}</p>
                                                                    <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                                                                @elseif($messages->status_sender == 'Sent')
                                                                    <p>{{$messages->content}}</p>
                                                                    <p class="d-flex justify-content-end"><i class="bi bi-check-all"></i></p>
                                                                @elseif($messages->status_sender == 'Fail')

                                                                    <p>{{$messages->content}}</p>
                                                                    <p class="d-flex justify-content-end"><span class="fs-6 text-danger  end-0">An error occurred, message sending failed.</span></p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                   @endif
                                                @endif
                                            @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="border-top bottom-0 w-100 ps-5 pe-5 pt-0 ps-0">
                                        <form id="" class="h-100" action="" method="post" enctype="multipart/form-data">
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
                                                        <textarea id="myTextarea" name="content"
                                                                  class="border-0"></textarea>
                                                    </div>
                                                    <div class="icon-textarea width-5 d-flex align-items-center">
                                                        <a class="text-secondary me-5 hover-button">
                                                            <button style="height: 40px"
                                                                    class="d-flex align-items-center">
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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
