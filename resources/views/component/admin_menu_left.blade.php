<aside class="  menu_01 d-block">
    <div class="menu_left  ">
        <ul>
            <li class="">
                <a><i class="bi bi-speedometer2"></i>Dashboard</a>
            </li>
            <li class="{{Str::is('categories.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("categories.index")}}"><i class="bi bi-card-list"></i>Category</a>
            </li>
            <li class="{{Str::is('candidate.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("candidate.index")}}"><i class="bi bi-person-video2"></i>Candidate</a>
            </li>
            <li class="{{Str::is('job.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("job.index")}}"><i class="bi bi-briefcase"></i>Recent Jobs</a>
            </li>
            <li class="{{Str::is('company.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("company.index")}}"><i class="bi bi-building"></i>Company</a>
            </li>
            <li class="{{Str::is('user.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("user.index")}}"><i class="bi bi-person-circle"></i>User</a>
            </li>
            <li class="{{Str::is('blog.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("blog.index")}}"><i class="bi bi-pen"></i>Blog</a>
            </li>
        </ul>
    </div>
</aside>
<aside class=" hide_menu_  menu_02 menu_left_2">
    <div class="menu_left  ">
        <ul>
            <li class="">
                <a><i class="bi bi-speedometer2"></i></a>
            </li>
            <li class="{{Str::is('categories.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("categories.index")}} "><i class="bi bi-card-list"></i></a>
            </li>
            <li class="{{Str::is('candidate.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("candidate.index")}}"><i class="bi bi-person-video2"></i></a>
            </li>
            <li class="{{Str::is('job.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("job.index")}}"><i class="bi bi-briefcase"></i></a>
            </li>
            <li class="{{Str::is('company.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("company.index")}}"><i class="bi bi-building"></i></a>
            </li>
            <li class="{{Str::is('user.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("user.index")}}"><i class="bi bi-person-circle"></i></a>
            </li>
            <li class="{{Str::is('blog.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a href="{{route("blog.index")}}"><i class="bi bi-pen"></i></a>
            </li>
        </ul>
    </div>
</aside>
