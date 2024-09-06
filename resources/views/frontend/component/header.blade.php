<header >
    <div class="container">
        <div class="sixteen columns">

            <!-- Logo -->
            <div id="logo">
                <h1><a class="logo2" href="{{Route('home.index')}}"><img src="{{asset('/storage/uploads/logo2.png')}}" alt="Work Scout" style="padding: 0" /></a></h1>
                <h1><a class="logo1 d-none" href="{{Route('home.index')}}"><img src="{{asset('/storage/uploads/logo.png')}}" alt="Work Scout" style="padding: 0" /></a></h1>
            </div>

            <!-- Menu -->
            <nav id="navigation" class="menu">
                <ul id="responsive">
                    <li><a href="{{route('job.browser')}}">Job Page</a></li>
                    <li><a href="{{route('blog.index')}}">Blog</a></li>
                    <li><a href="../blog/index.blade.php">Contact</a></li>
                </ul>


                <ul class="float-right">
                    <li><a href="../login/index.blade.php#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
                    <li><a href="{{ route('auth.login') }}"><i class="fa fa-lock"></i> Log In</a></li>
                </ul>

            </nav>

            <!-- Navigation -->
            <div id="mobile-navigation">
                <a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
            </div>

        </div>
    </div>
</header>
