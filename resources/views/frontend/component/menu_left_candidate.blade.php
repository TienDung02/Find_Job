<aside class="my_profile_menu_left">
    <div class="menu_left">
        <ul class="nav-link menu_profile">
                <h4>Main</h4>
            <li class="">
                <a href="">Messenger &nbsp; <span>2</span></a>
            </li>
            <li class="">
                <a href="">Bookmarks</a>
            </li>
            <li class="">
                <a href="{{route('job.alert')}}">Job Alerts &nbsp; <span>2</span></a>
            </li>
                <h4>Browser Listings</h4>
            <li class="">
                <a href="{{route('job.browser')}}">Browse Jobs</a>
            </li>
            <li class="">
                <a href="{{route('category.browser')}}">Browse Categories</a>
            </li>
                <h4>Candidate</h4>
            <li class="{{ Str::contains(request()->path(), 'add') ? 'active' : '' }}">
                <a href="{{route('resume.add')}}">Add Resume</a>
            </li>
            <li class="{{ Str::contains(request()->path(), 'manage') ? 'active' : '' }}">
                <a href="{{route('resume.manage')}}">Manage Resume</a>
            </li >


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
