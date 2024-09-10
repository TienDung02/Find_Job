<aside class="my_profile_menu_left">
    <div class="menu_left">
        <ul class="nav-link menu_profile">
                <h4>Main</h4>
            <li class="{{ Str::contains(request()->path(), 'messages') ? 'active' : '' }}">
                <a href="{{route('messages.index')}}">Messages &nbsp; <span>2</span></a>
            </li>
            <li class="{{ Str::contains(request()->path(), 'bookmark') ? 'active' : '' }}">
                <a href="{{route('bookmark_candidate.index')}}">Bookmarks</a>
            </li>
            <li class="{{ Str::contains(request()->path(), 'job/alert-job') ? 'active' : '' }}">
                <a href="{{route('alert.index')}}">Job Alerts &nbsp; <span>2</span></a>
            </li>
                <h4>Browser Listings</h4>
            <li>
                <a href="{{route('job.browser')}}">Browse Jobs</a>
            </li>
            <li>
                <a href="{{route('industry.browser')}}">Browse Industries</a>
            </li>
                <h4>Candidate</h4>
            <li class="{{ Str::contains(request()->path(), 'resume/add') || Str::contains(request()->path(), 'resume/edit') ? 'active' : '' }}">
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
