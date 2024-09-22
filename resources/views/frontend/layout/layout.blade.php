@include('frontend.component.head')
<div class="clearfix"></div>

@if(auth()->check())
    @include('frontend.component.header_2')
@else
    @include('frontend.component.header')
@endif

@yield('content')


<!-- Footer
================================================== -->
<div class="margin-top-15"></div>

@include('.frontend.component.footer')

<!-- Back To Top Button -->
<div id="backtotop" class="d-none"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->
<!-- Scripts
================================================== -->

@include('.frontend.component.script')
@if (isset(session('alert_')['alert_type']))
    <script>
        alert_after_load('{{session('alert_')['alert_title']}}', '{{session('alert_')['alert_type']}}', '{{session('alert_')['alert_text']}}', '{{session('alert_')['alert_reload']}}')
        @php
            $userData = Illuminate\Support\Facades\Session::get('alert_', []);
            unset($userData['alert_title']);
            unset($userData['alert_type']);
            unset($userData['alert_text']);
            Illuminate\Support\Facades\Session::put('alert_', $userData);
        @endphp
    </script>
@endif
@if (isset(session('alert_2')['alert_type']))
    <script>
        alert_after_load_2('{{session('alert_2')['alert_title']}}', '{{session('alert_2')['alert_type']}}', '{{session('alert_2')['alert_reload']}}')
        @php
            $userData = Illuminate\Support\Facades\Session::get('alert_2', []);
            unset($userData['alert_title']);
            unset($userData['alert_type']);
            Illuminate\Support\Facades\Session::put('alert_2', $userData);
        @endphp
    </script>
@endif
</body>
</html>















