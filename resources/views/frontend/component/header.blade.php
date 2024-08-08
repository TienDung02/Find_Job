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

                    <li><a href="#">Pages</a>
                        <ul>
                            <li><a href="../job/job-page-alt.php">Job Page Alternative</a></li>
                            <li><a href="../resumes/index.blade.php">Resume Page</a></li>
                            <li><a href="../shortcodes.php">Shortcodes</a></li>
                            <li><a href="../pricing-tables.php">Pricing Tables</a></li>
                            <li><a href="../contact/contact.php">Contact</a></li>
                        </ul>
                    </li>

                    <li><a href="#">For Candidates</a>
                        <ul>
                            <li><a href="../job/browser.blade.php">Browse Jobs</a></li>
                            <li><a href="../category/index.blade.php">Browse Categories</a></li>
                            <li><a href="../resumes/add.blade.php">Add Resume</a></li>
                            <li><a href="../resumes/manage.blade.php">Manage Resumes</a></li>
                            <li><a href="../job/alerts.blade.php">Job Alerts</a></li>
                        </ul>
                    </li>

                    <li><a href="#">For Employers</a>
                        <ul>
                            <li><a href="../job/add.blade.php">Add Job</a></li>
                            <li><a href="../job/manage.blade.php">Manage Jobs</a></li>
                            <li><a href="../employer/manage-applications.blade.php">Manage Applications</a></li>
                            <li><a href="../resumes/browser.blade.php">Browse Resumes</a></li>
                            <li><a href="../company/add.blade.php">Add Company</a></li>
                        </ul>
                    </li>

                    <li><a href="../blog/index.blade.php">Blog</a></li>
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
