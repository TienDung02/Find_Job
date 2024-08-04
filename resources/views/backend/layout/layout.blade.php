<!DOCTYPE html>
<html lang="en">
@include('backend.component.head')
<body>
<div id="admin_wrapper">
    @include('backend.component.header')
    <main>
        @include('backend.component.menu_left')
        @yield('content')
    </main>
</div>
@include('backend.component.script')
<script>

</script>
</body>
</html>
