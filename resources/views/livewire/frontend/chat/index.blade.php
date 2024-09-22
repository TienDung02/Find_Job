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
            @livewireStyles


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
                                        <li>
                                        </li>
                                            <livewire:chat.conversation :wire:key="'conversation-'.uniqid()"/>
                                    </ul>
                                </div>
                                <livewire:chat.chat :wire:key="'chat-'.uniqid()" id="chatComponent" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <script src="{{ mix('js/app.js') }}"></script>
            @livewireScripts
            <script>
                Livewire.on('notificationReceived', event => {
                    console.log('Notification received:', event);
                });
            </script>
        </div>
    </div>
@stop
