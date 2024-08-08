<header>
    <div class="ms-5 me-5 h-100 position-relative">
        <div class="sixteen columns">
{{--            <h1>--}}
{{--                @php--}}
{{--                    dd($data);--}}
{{--                @endphp--}}

{{--            </h1>--}}
            <!-- Logo -->
            <div id="logo">
                <h1><a class="logo2" href="{{Route('home.index')}}"><img src="{{asset('/storage/uploads/logo2.png')}}" alt="Work Scout" style="padding: 0" /></a></h1>
                <h1><a class="logo1 d-none" href="{{Route('home.index')}}"><img src="{{asset('/storage/uploads/logo.png')}}" alt="Work Scout" style="padding: 0" /></a></h1>
            </div>

            <!-- Menu -->
            <nav id="navigation" class="menu">
                <ul id="responsive">

                    <li><a href="#">Pages</a>
                        <ul>
                            <li><a href="../job/job-page-alt.php">Job Page Alternative</a></li>
                            <li><a href="../resumes/index.blade.php">Resume Page</a></li>
                            <li><a href="../shortcodes.php">Shortcodes</a></li>
                            <li><a href="../pricing-tables.php">Pricing Tables</a></li>
                            <li><a href="../contact/contact.php">Contact</a></li>
                        </ul>
                    </li>

                    <li class="{{ auth()->user()->role == 2 ? '' : 'd-none' }}"><a href="#">For Candidates</a>
                        <ul>
                            <li><a href="{{route('job.browser')}}">Browse Jobs</a></li>
                            <li><a href="{{route('category.browser')}}">Browse Categories</a></li>
                            <li><a href="{{route('resume.add')}}">Add Resume</a></li>
                            <li><a href="{{route('resume.manage')}}">Manage Resumes</a></li>
                            <li><a href="{{route('job.alert')}}">Job Alerts</a></li>
                        </ul>
                    </li>

                    <li class="{{ auth()->user()->role == 3 ? '' : 'd-none' }}"><a href="#">For Employers</a>
                        <ul>
                            <li><a href="{{route('job.add')}}">Add Job</a></li>
                            <li><a href="{{route('job.manage')}}">Manage Jobs</a></li>
                            <li><a href="{{route('application.manage')}}">Manage Applications</a></li>
                            <li><a href="{{route('resume.browser')}}">Browse Resumes</a></li>
                            <li><a href="{{route('company.add')}}">Add Company</a></li>
                        </ul>
                    </li>

                    <li><a href="{{route('blog.index')}}">Blog</a></li>
                </ul>
                <div class="avatar_user position-absolute">
                    <ul id="responsive" class="m-0 w-100 h-100">
                        <li class="h-100 w-100 m-0 menu-dropdown">
                            <img src="{{$data->avatar}}">
                            <ul class="ul-dropdown">
                                <li><a href="/profile/index">My Profile</a></li>
                                <li><a href="../category/index.blade.php">Messenger</a></li>
                                <li>
                                    <a href="/logout" >{{ __('Logout') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Navigation -->
{{--                <div id="mobile-navigation">--}}
{{--                    <a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>--}}
{{--                </div>--}}

            </nav>

            <!-- Navigation -->
            <div id="mobile-navigation" class="position-absolute end-0">
                <a href="" class="menu-trigger"><i class="fa fa-reorder"></i></a>
            </div>

        </div>
    </div>
</header>
