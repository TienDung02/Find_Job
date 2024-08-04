@include('frontend.component.head')
<div class="clearfix"></div>



@include('frontend.component.header')
{{--@include('frontend.component.header_2')--}}
@include('frontend.component.banner')







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
</body>
</html>















