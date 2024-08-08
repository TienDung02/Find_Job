
@extends('frontend.layout.layout')
@section('content')
    <div class="clearfix margin-top-90"></div>

    <div class="d-flex main-application">
        @include('.frontend.component.menu_left_employer')
        <div class="" style="margin: auto; width: calc(100% - 260px);background-color: #f7f7f7">
            <!-- Titlebar
            ================================================== -->
            <div id="titlebar" class="single">
                <div class="container">

                    <div class="sixteen columns">
                        <h2>Manage Applications</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="#">Home</a></li>
                                <li>Job Dashboard</li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>


            <!-- Content
            ================================================== -->

            <div class="container">

                <!-- Table -->
                <div class="sixteen columns">

                    <p class="margin-bottom-25" style="float: left;">The job applications for <strong><a href="#"></a></strong> are listed below.</p>
                    <strong><a href="#" class="download-csv">Download CSV</a></strong>

                </div>


                <div class="eight columns">
                    <!-- Select -->
                    <select data-placeholder="Filter by status" class="chosen-select-no-single">
                        <option value="">Filter by status</option>
                        <option value="new">New</option>
                        <option value="interviewed">Interviewed</option>
                        <option value="offer">Offer extended</option>
                        <option value="hired">Hired</option>
                        <option value="archived">Archived</option>
                    </select>
                    <div class="margin-bottom-15"></div>
                </div>

                <div class="eight columns">
                    <!-- Select -->
                    <select data-placeholder="Newest first" class="chosen-select-no-single">
                        <option value="">Newest first</option>
                        <option value="name">Sort by name</option>
                        <option value="rating">Sort by rating</option>
                    </select>
                    <div class="margin-bottom-35"></div>
                </div>


                <!-- Applications -->
                <div class="sixteen columns">

                    <!-- Application #1 -->
                    <div class="application">
                        <div class="app-content">

                            <!-- Name / Avatar -->
                            <div class="info">
                                <img src="

					" alt="">
                                <span></span>
                                <ul>
                                    <li><a href="#"><i class="fa fa-file-text"></i> Download CV</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> Contact</a></li>
                                </ul>
                            </div>
                            <!-- Buttons -->
                            <div class="buttons">
                                <a href="#one-1" class="button gray app-link"><i class="fa fa-pencil"></i> Edit</a>
                                <a href="#two-1" class="button gray app-link"><i class="fa fa-sticky-note"></i> Add Note</a>
                                <a href="#three-1" class="button gray app-link"><i class="fa fa-plus-circle"></i> Show Details</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!--  Hidden Tabs -->
                        <div class="app-tabs">
                            <a href="#" class="close-tab button gray"><i class="fa fa-close"></i></a>
                            <!-- First Tab -->
                            <div class="app-tab-content" id="one-1">
                                <div class="select-grid">
                                    <select data-placeholder="Application Status" class="chosen-select-no-single">
                                        <option value="">Application Status</option>
                                        <option value="new">New</option>
                                        <option value="interviewed">Interviewed</option>
                                        <option value="offer">Offer extended</option>
                                        <option value="hired">Hired</option>
                                        <option value="archived">Archived</option>
                                    </select>
                                </div>
                                <div class="select-grid">
                                    <input style="padding: 9px 18px;" type="number" min="1" max="5" placeholder="Rating (out of 5)">
                                </div>
                                <div class="clearfix"></div>
                                <a href="#" class="button margin-top-15">Save</a>
                                <a href="#" class="button gray margin-top-15 delete-application">Delete this application</a>
                            </div>
                            <!-- Second Tab -->
                            <div class="app-tab-content"  id="two-1">
                                <textarea placeholder="Private note regarding this application"></textarea>
                                <a href="#" class="button margin-top-15">Add Note</a>
                            </div>
                            <!-- Third Tab -->
                            <div class="app-tab-content"  id="three-1">
                                <i>Full Name:</i>
                                <span></span>

                                <i>Email:</i>
                                <span><a href="mailto:john.doe@example.com"></a></span>

                                <i>Message:</i>
                                <span></span>
                            </div>
                        </div>
                        <!-- Footer -->
                        <div class="app-footer">

                            <div class="rating no-stars">
                                <div class="star-rating"></div>
                                <div class="star-bg"></div>
                            </div>

                            <ul>
                                <li><i class="fa fa-file-text-o"></i> New</li>
                                <li><i class="fa fa-calendar"></i></li>
                            </ul>
                            <div class="clearfix"></div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
