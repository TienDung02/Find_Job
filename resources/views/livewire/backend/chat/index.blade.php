@extends('backend.layout.layout')

@section('content')
    <div class="contain">
        <section class="pb-0">
            <div class="title-table">
                <h4>Messages</h4>
            </div>
        </section>
        <div class="padding-50">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="messages-container margin-top-0 ">
                        <div class="messages-headline">
                            <h4 class="fw-semibold">Inbox</h4>
                        </div>
                        <div class="messages-container-inner d-flex  min-height-60vh max-height-70vh ">
                            <div class="messages-inbox pb-5">
                                <ul class="">
                                    <li class="active-message">
                                        <a href="" class="d-flex row m-0">
                                            <div class="message-avatar col-2 p-0">
                                                <img class="rounded-circle"
                                                     src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                     alt="">
                                            </div>
                                            <div class="message-by col-10 position-relative">
                                                <div class="message-by-headline d-flex">
                                                    <h5>Kathy Brown </h5>
                                                    <span class="position-absolute end-0 top-0 text-secondary">2 hours ago</span>
                                                </div>
                                                <div class="d-flex short-messages w-100">
                                                    <p class="m-0 fw-semibold">{{truncateText('Hello, I want to talk about your great listing!
                                                    Morbi velit eros, sagittis in facilisis non, rhoncus et erat.
                                                     Nam posuere tristique sem, eu ultricies', 30)}}</p>
                                                    <span
                                                        class="Temporary position-absolute end-0 rounded-circle">2</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="active-message">
                                        <a href="" class="d-flex row m-0">
                                            <div class="message-avatar col-2 p-0">
                                                <img class="rounded-circle"
                                                     src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                     alt="">
                                            </div>
                                            <div class="message-by col-10 position-relative">
                                                <div class="message-by-headline d-flex">
                                                    <h5>Kathy Brown </h5>
                                                    <span class="position-absolute end-0 top-0 text-secondary">2 hours ago</span>
                                                </div>
                                                <div class="d-flex short-messages">
                                                    <p class="m-0 fw-nomal">You: {{truncateText('Hello, I want to talk about your great listing!
                                                    Morbi velit eros, sagittis in facilisis non, rhoncus et erat.
                                                     Nam posuere tristique sem, eu ultricies', 30)}}</p>
                                                    <span
                                                        class="bg-secondary position-absolute end-0 rounded-circle text-white"><i
                                                            class="bi bi-check-lg"></i></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="active-message">
                                        <a href="" class="d-flex row m-0">
                                            <div class="message-avatar col-2 p-0">
                                                <img class="rounded-circle"
                                                     src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                     alt="">
                                            </div>
                                            <div class="message-by col-10 position-relative">
                                                <div class="message-by-headline d-flex">
                                                    <h5>Kathy Brown </h5>
                                                    <span class="position-absolute end-0 top-0 text-secondary">2 hours ago</span>
                                                </div>
                                                <div class="d-flex short-messages">
                                                    <p class="m-0 fw-normal">You: {{truncateText('Hello, I want to talk about your great listing!
                                                    Morbi velit eros, sagittis in facilisis non, rhoncus et erat.
                                                     Nam posuere tristique sem, eu ultricies', 30)}}</p>
                                                    <span
                                                        class="Full-Time position-absolute end-0 rounded-circle text-white"><i
                                                            class="bi bi-check-all"></i></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="active-message">
                                        <a href="" class="d-flex row m-0">
                                            <div class="message-avatar col-2 p-0">
                                                <img class="rounded-circle"
                                                     src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                     alt="">
                                            </div>
                                            <div class="message-by col-10 position-relative">
                                                <div class="message-by-headline d-flex">
                                                    <h5>Kathy Brown </h5>
                                                    <span class="position-absolute end-0 top-0 text-secondary">2 hours ago</span>
                                                </div>
                                                <div class="d-flex short-messages">
                                                    <p class="m-0 fw-semibold">{{truncateText('Hello, I want to talk about your great listing!
                                                    Morbi velit eros, sagittis in facilisis non, rhoncus et erat.
                                                     Nam posuere tristique sem, eu ultricies', 30)}}</p>
                                                    <span class="Temporary position-absolute end-0 rounded-circle">5+</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="message-content pb-5 position-relative d-grid">
                                <div class="message-content-block padding-50 pb-0">
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble d-flex width-65">
                                        <div class="message-avatar width-5 max-width-5 min-width-5 p-0">
                                            <img class="rounded-circle"
                                                 src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=70"
                                                 alt="">
                                        </div>
                                        <div class="message-text max-width-90 ms-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                    <div class="message-bubble me d-flex justify-content-end">
                                        <div class="message-text max-width-60 me-4 rounded-3">
                                            <p>Hello, I want to talk about your great listing! Morbi velit eros,
                                                sagittis in facilisis non, rhoncus et erat. Nam posuere tristique
                                                sem, eu ultricies tortor lacinia neque imperdiet vitae.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-send-block border-top bottom-0 w-100 ps-5 pe-5 pt-0 ps-0">
                                    <form id="" class="h-100" action="" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="uploaded_images[]" id="file-list"
                                               class="file-img d-none" multiple>
                                        <div class="position-relative h-100">

                                            <div class="d-flex mt-3">
                                                <div class="width-10 d-flex align-items-center">
                                                    <a class="text-secondary hover-button btn-select-img fs-2 w-50 d-flex align-items-center"><i
                                                            class="bi bi-image"></i></a>
                                                    <a class="text-secondary ms-3 emoji hover-button col-1 fs-2 w-50"><i
                                                            class="bi bi-emoji-smile"></i></a>
                                                </div>
                                                <div class="width-85 position-relative border">
                                                    <div class="d-flex p-2">
                                                        <a class="img-comment btn-add-img d-none btn-select-img mt-2 text-info"><i
                                                                class="bi bi-plus-lg"></i></a>
                                                        <div id="image-preview"
                                                             class="text-center d-flex flex-wrap m-0 border-0">
                                                        </div>
                                                    </div>
                                                    <textarea id="myTextarea" name="content" style="height: 58px"
                                                              class="border-0"></textarea>
                                                </div>
                                                <div class="icon-textarea width-5 d-flex align-items-center">
                                                    <a class="text-secondary me-5 hover-button">
                                                        <button style="height: 40px; width: 40px"
                                                                class="d-flex align-items-center border-radius-5 border-0 text-white d-flex align-items-center ms-4">
                                                            <i class="bi bi-send m-auto"></i>
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
@stop
