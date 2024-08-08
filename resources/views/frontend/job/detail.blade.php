@extends('frontend.layout.layout')
@section('content')
    <div class="clearfix margin-top-90"></div>

<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="ten columns">
            <span><a href="browser.blade.php">{{$data_jobs->category->name}}</a></span>
            <h2>{{$data_jobs->title}}<span  class="ms-3 rounded-2 {{$data_jobs->jobType->name}}">{{$data_jobs->jobType->name}}</span></h2>
        </div>
            <div class="six columns">
                <a href="#" class="button dark alert_login"><i class="fa fa-star"></i> Bookmark This Job</a>
            </div>
                <div class="six columns">
                    <a href="../bookmark/remove_bookmark_process.php?job_id="
                       class="button dark"><i class="fa fa-star"></i>Remove Bookmark</a>
                </div>
                <div class="six columns">
                    <a href="" class="button bg-info"><i class="fa fa-star"></i> Bookmark This Job</a>
                </div>
    </div>
</div>


<!-- Content
================================================== -->
<div class="container">

    <!-- Recent Jobs -->
    <div class="eleven columns">
        <div class="padding-right">

            <!-- Company Info -->
            <div class="company-info">
                <img src="{{asset($data_jobs->company->company_logo)}}" alt="">
                <div class="content">
                    <h4>{{$data_jobs->company->company_name}}</h4>
{{--                    <span><a href="#"><i class="fa fa-link"></i> {{$data_jobs->company->Website}}</a></span>--}}
{{--                    <span><a href="#"><i class="fa fa-link"></i> {{$data_jobs->company->Twitter}}</a></span>--}}
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form">
                <div class="WYSIWYG " cols="40" rows="3" name="description" spellcheck="true"> {{$data_jobs->description}}</div>
            </div>
            <br>

        </div>
    </div>


    <!-- Widgets -->
    <div class="five columns">

        <!-- Sort by -->
        <div class="widget">
            <h4>Overview</h4>

            <div class="job-overview">

                <ul>
                    <li >
                        <i class="fa fa-map-marker"></i>
                        <div>
                            <strong>Location:</strong>
                            <span>{{$data_jobs->company->location->name}}</span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-user"></i>
                        <div>
                            <strong>Job Title:</strong>
                            <span>{{$data_jobs->title}}</span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <div>
                            <strong>Date Posted:</strong>
                            <span>{{getDayDifference($data_jobs)}}</span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <div>
                            <strong>Expiration date:</strong>
                            <span>{{$data_jobs->closing_day}}</span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-money"></i>
                        <div>
                            <strong>Salary:</strong>
                            <span>{{$data_jobs->minimum_salary . '$ '}} <i class="bi bi-arrow-right"></i> {{$data_jobs->maximum_salary . '$'}}</span>
                        </div>
                    </li>
                </ul>
                    <a href="#small-dialog" class="popup-with-zoom-anim button">Apply For This Job</a>
                <div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">

                    <div class="small-dialog-headline">
                        <h2>Apply For This Job</h2>
                    </div>


                    <div class="small-dialog-content">
                        <form action="" enctype="multipart/form-data" method="post">
                            <input type="text" placeholder="Full Name" name="full_name" value=""/>

                            <textarea name="message" placeholder="Your message / cover letter sent to the employer"></textarea>

                            <!-- Upload CV -->
                            <div class="upload-info"><strong>Upload your CV (optional)</strong> <span>Max. file size: 5MB</span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="controlContainer d-flex">
                                <div class="container">
                                    <div class="row">
                                        <label class="upload-btn col-md-3 h-100"><i class="fa fa-upload"></i>  &nbsp;Browse
                                            <div class="inputFileHolder">
                                                <input id="fileInput2" name="cv" class="fileInput fileInput2"
                                                       title="Choose file to upload" type="file">
                                            </div>
                                        </label>

                                        <div class=" col-md-8 h-100">
                                            <input class="inputFileMaskText2 h-100" readonly="readonly" placeholder="Choose file.." type="text" id="inputFileMaskText2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>

                            <button class="send">Send Application</button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Widgets / End -->


</div>
@stop
