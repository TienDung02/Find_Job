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
                    @if(auth()->user()->role == 2)
                        <li>
                            <a class="{{ Str::contains(request()->path(), 'home/browser-job') || Str::contains(request()->path(), 'home/tag-search-job') || Str::contains(request()->path(), 'home/browser-search') ? 'active' : '' }}" href="{{route('job.browser')}}">Browse Jobs</a>
                        </li>
                        <li>
                            <a class="{{ Str::contains(request()->path(), 'home/browser-category') ? 'active' : '' }}" href="{{route('category.browser')}}">Browse Categories</a>
                        </li>
                        <li>
                            <a class="{{ Str::contains(request()->path(), 'resume/add') ? 'active' : '' }}" href="{{route('resume.add')}}">Add Resume</a>
                        </li>
                        <li>
                            <a class="{{ Str::contains(request()->path(), 'manage') ? 'active' : '' }}" href="{{route('resume.manage')}}">Manage Resumes</a>
                        </li>
                        <li>
                            <a class="{{ Str::contains(request()->path(), 'job/alert-job') ? 'active' : '' }}" href="{{route('alert.index')}}">Job Alerts</a>
                        </li>
                    @elseif(auth()->user()->role == 3)
                        <li><a class="cursor-pointer {{Session::get('user_data.free_jobs_count') == 0 ? 'Alert_buy_service_package' : ''}}"
                                    {{Session::get('user_data.free_jobs_count') == 0 ? '' : 'href='.route('job.add')}}>Add Job</a></li>
                        <li><a href="{{route('job.manage')}}">Manage Jobs</a></li>
                        <li><a href="{{route('application.manage')}}">Manage Applications</a></li>
                        <li><a href="{{route('resume.browser')}}">Browse Resumes</a></li>
                        <li><a href="{{route('company.add')}}">Company</a></li>
                    @endif

                    <li><a href="{{route('blog.index')}}">Blog</a></li>
                </ul>
                <div>
                <div class="avatar_user position-absolute user-name">
                    <span>{{Session::get('user_data.name')}}</span>
                </div>
                <div class="avatar_user position-absolute">

                    <ul id="responsive" class="m-0 w-100 h-100">
                        <li class="h-100 w-100 m-0 menu-dropdown">
                            <img src="{{Session::get('user_data.avatar')}}">
                            <ul class="ul-dropdown">
                                <li><a href="{{route('profile')}}">My Profile</a></li>
                                <li><a href="{{route('messages.index')}}">Messenger</a></li>
                                <li>
                                    <a href="/logout" >{{ __('Logout') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
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
