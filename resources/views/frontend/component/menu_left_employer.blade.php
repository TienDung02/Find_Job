<aside class="my_profile_menu_left">
    <div class="menu_left">
        <ul class="nav-link menu_profile">
            <h4>Main</h4>
            <li class="{{ Str::contains(request()->path(), 'messages') ? 'active' : '' }}">
                <a href="{{route('chat')}}">Messages &nbsp; <span>2</span></a>
            </li>
            <li class="{{ Str::contains(request()->path(), 'bookmark') ? 'active' : '' }}">
                <a href="{{route('bookmark_employer.index')}}">Bookmarks</a>
            </li>
            <h4>Employer</h4>
            <li class="{{ Str::contains(request()->path(), 'job/add') ? 'active' : '' }}">
                <a href="{{route('job.add')}}">Add Jobs</a>
            </li>
            <li class="{{ Str::contains(request()->path(), 'job/manage') ? 'active' : '' }}">
                <a href="{{route('job.manage')}}">Manage Jobs</a>
            </li>
            <li class="{{ Str::contains(request()->path(), 'application') ? 'active' : '' }}">
                <a href="{{route('application.manage')}}">Manage Applications</a>
            </li>
            <li class="">
                <a href="{{route('resume.browser')}}">Browse Resumes</a>
            </li>
            <li class="{{ Str::contains(request()->path(), 'company') ? 'active' : '' }}">
                <a href="{{route('company.add')}}">Company</a>
            </li>
            <h4>Account</h4>
            <li class="{{ Str::contains(request()->path(), 'profile') ? 'active' : '' }}">
                <a href="{{route('profile')}}">My Profile</a>
            </li>
            <li  class="{{ Str::contains(request()->path(), 'change-password') ? 'active' : '' }}">
                <a href="{{route('changePassword')}}">Change Password</a>
            </li>
            <li>
                <a href="/logout">Logout</a>
            </li>
        </ul>
    </div>
</aside>
