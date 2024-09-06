<aside class="  menu_01 d-block">
    <div class="menu_left  ">
        <ul>
            <li class="">
                <a class="fw-semibold"><i class="bi bi-speedometer2"></i>Dashboard</a>
            </li>
            <li class="{{ Str::is('admin.messages.*', request()->route()->getName()) ? 'menu_active' : '' }}">
                <a class="fw-semibold" href="{{route("admin.messages.index")}}"><i class="bi bi-chat-dots"></i>Messages</a>
            </li>
            <li class="{{ Str::is('admin.category.*', request()->route()->getName()) ? 'menu_active' : '' }}">
                <a class="fw-semibold" href="{{route("admin.category.index")}}"><i class="bi bi-card-list"></i>Category</a>
            </li>
            <li class="{{Str::is('admin.candidate.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.candidate.index")}}"><i class="bi bi-person-video2"></i>Candidate</a>
            </li>
            <li class="{{Str::is('admin.job.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.job.index")}}"><i class="bi bi-briefcase"></i>Recent Jobs</a>
            </li>
            <li class="{{Str::is('admin.company.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.company.index")}}"><i class="bi bi-building"></i>Company</a>
            </li>
            <li class="{{Str::is('admin.user.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.user.index")}}"><i class="bi bi-person-circle"></i>User</a>
            </li>
            <li class="{{Str::is('admin.blog.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.blog.index")}}"><i class="bi bi-pen"></i>Blog</a>
            </li>
        </ul>
    </div>
</aside>
<aside class=" hide_menu_  menu_02 menu_left_2">
    <div class="menu_left  ">
        <ul>
            <li class="">
                <a class="fw-semibold"><i class="bi bi-speedometer2"></i></a>
            </li>
            <li class="{{Str::is('admin.category.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.messages.index")}} "><i class="bi bi-chat-dots"></i></a>
            </li>
            <li class="{{Str::is('admin.category.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.category.index")}} "><i class="bi bi-card-list"></i></a>
            </li>
            <li class="{{Str::is('admin.candidate.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.candidate.index")}}"><i class="bi bi-person-video2"></i></a>
            </li>
            <li class="{{Str::is('admin.job.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.job.index")}}"><i class="bi bi-briefcase"></i></a>
            </li>
            <li class="{{Str::is('admin.company.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.company.index")}}"><i class="bi bi-building"></i></a>
            </li>
            <li class="{{Str::is('admin.user.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.user.index")}}"><i class="bi bi-person-circle"></i></a>
            </li>
            <li class="{{Str::is('admin.blog.*', request()->route()->getName()) ? 'menu_active' : ''}}">
                <a class="fw-semibold" href="{{route("admin.blog.index")}}"><i class="bi bi-pen"></i></a>
            </li>
        </ul>
    </div>
</aside>
