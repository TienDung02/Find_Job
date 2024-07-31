<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="{{ config('const.app_name') }}">
    <meta name="keywords" content="{{ config('const.app_name') }}" />
    <meta name="author" content="{{ config('const.app_name') }}">
    <title>{{ config('const.app_name') }}</title>
    <link rel="apple-touch-icon" sizes="32x32" href="/images/favicon.png" />
    <link rel="apple-touch-icon" sizes="64x64" href="/images/favicon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon.png" />
    <link rel="icon" type="image/png" sizes="64x64" href="/images/favicon.png" />
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/admin.css') }}?v={{time()}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/custom.css') }}?v={{time()}}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/table2csv.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}?v={{time()}}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body id="page-top">
@if (Auth::guard('admin')->check())
    @include('backend.elements.header')
    <!-- Sidebar -->
    @if(auth()->user()->type == 30 || auth()->user()->type == 28)
        @include ('backend.elements.sidebar_admin')
    @elseif(in_array(auth()->user()->type, [20,25]))
        @include ('backend.elements.sidebar_teacher_manager')
    {{--@elseif(in_array(auth()->user()->type, [20]))
        @include ('backend.elements.sidebar_teacher')--}}
    @elseif(in_array(auth()->user()->type, [16,17]))
        @include ('backend.elements.sidebar_hotline')

    @elseif(auth()->user()->type == 5)
        @include ('backend.elements.sidebar_event')
    @else
        @include ('backend.elements.sidebar_sale')
    @endif
@endif
<!-- End of Sidebar -->
<!-- Page Wrapper -->
    <div @if(Auth::guard('admin')->check()) id="wrapper" @else id="login-wrapper" @endif>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
            <!-- End -->
    @if(Auth::guard('admin')->check())
        @include('backend.elements.footer')
    @endif
    @section('post-js')
    @show
</body>
</html>

