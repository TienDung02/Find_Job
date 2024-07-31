<!DOCTYPE html>
<html lang="en">
@include('.backend.component.admin_head')
<body>
    <div id="admin_wrapper">
        @include('.backend.component.admin_header')
        <main>
            @include('backend.component.admin_menu_left')
            @yield('content')
        </main>
    </div>
    @include('.backend.component.admin_script')
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     toggleInput();
        // });
    </script>
</body>
</html>
