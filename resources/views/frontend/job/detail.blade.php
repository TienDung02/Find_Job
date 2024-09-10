@extends('frontend.layout.layout')
@section('content')
    <div class="clearfix margin-top-90"></div>

<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="ten columns">
            <span><a href="">{{$data_jobs->category->name}}</a></span>
            <h2>{{$data_jobs->title}}<span  class="ms-3 rounded-2 {{$data_jobs->jobType->name}}">{{$data_jobs->jobType->name}}</span></h2>
        </div>
        @if(isset($check_bookmark) && $check_bookmark == 2)
            <div class="six columns">
                <a href="{{route('job.bookmark', $data_jobs->id)}}" class="button button "><i class="fa fa-star"></i> Bookmark This Job</a>
            </div>
        @elseif(isset($check_bookmark) && $check_bookmark == 1)
            <div class="six columns">
                <a href="{{route('job.remove-bookmark', $data_jobs->id)}}" class="button dark "><i class="fa fa-star"></i> Remove Bookmark</a>
            </div>
        @endif
    </div>
</div>


<!-- Content
================================================== -->
<div class="container">

    <!-- Recent Jobs -->
    <div class="eleven columns">
        <div class="padding-right">

            <!-- Company Info -->
            <div class="company-info position-relative">
                <a href="{{route('company.detail', $data_jobs->company->id)}}"><img src="{{asset($data_jobs->company->company_logo)}}" alt=""></a>
                <div class="content mt-2">
                    <a href="{{route('company.detail', $data_jobs->company->id)}}"><h4>{{$data_jobs->company->company_name}}</h4>
                    <h5>{{$data_jobs->company->company_tagline}}</h5></a>
                    <span><a href="{{$data_jobs->company->company_website}}"><i class="fa fa-link"></i> Website </a></span>
                    <span><a href="{{$data_jobs->company->twitter}}"><i class="fa fa-link"></i>Twitter </a></span>
                </div>
                <div class="position-absolute top-0 end-0 view-company"><a href="{{route('company.detail', $data_jobs->company->id)}}" class="text-white">View Company &nbsp;<i class="bi bi-box-arrow-up-right"></i></a></div>
                <div class="clearfix"></div>
            </div>
            <div class="form">
                @if($data_jobs->description != '')
                <h4 class="mb-3 mt-3">Job Description</h4>
                <div class="WYSIWYG " cols="40" rows="3" name="description" spellcheck="true"> {!! $data_jobs->description !!} </div>
                @endif
            </div>
            <div class="form mt-5 border-top">
                @if($data_jobs->job_requirements != '')
                    <h4 class="mb-3 mt-3">Job Requirment</h4>
                    <div class="WYSIWYG " cols="40" rows="3" name="description" spellcheck="true"> {!! $data_jobs->job_requirements !!}</div>
                @endif
            </div>
            <div class="form mt-5 border-top">
                @if($data_jobs->benefit != '')
                    <h4 class="mb-3 mt-3">Benefit</h4>
                    <div class="WYSIWYG " cols="40" rows="3" name="description" spellcheck="true"> {!! $data_jobs->benefit !!}</div>
                @endif
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
                            <span>{{$data_jobs->company->province->name . ', ' . $data_jobs->company->district->name . ', ' . $data_jobs->company->ward->name}}</span>
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
                        <div class="d-flex">
                            <strong>Salary:</strong>
                            <div class="ms-2 position-static">
                            @if(auth()->check())
                                @if($data_jobs->type_salary == 1)
                                    <p>{{$data_jobs->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$data_jobs->maximum_salary . '$'}}</p>
                                @elseif($data_jobs->type_salary == 2)
                                    <p>{{$data_jobs->salary . '$' }}</p>
                                @else
                                    <p>Deal</p>
                                @endif
                            @elseif(!auth()->check())
                                <a href="{{route('auth.login')}}" class="border-0 cursor-pointer text-decoration-underline Login-to-view">Login to view salary</a>
                            @endif
                            </div>
                        </div>
                    </li>
                </ul>
                <a class="
                @if(!(auth()->check()))
                    alert_login
                @elseif(auth()->user()->role != 2)
                    alert-is-not-candidate
                @else
                    call-dialog
                @endif
                 button">Apply For This Job</a>
                <a href="#small-dialog" id="btn-dialog" class="popup-with-zoom-anim button d-none"></a>
                <div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup border-radius-5">

                    <div class="small-dialog-headline border-radius-5 rounded-top">
                        <h2>Apply For This Job</h2>
                    </div>

                    <div class="small-dialog-content border-radius-5">
                        <form action="{{route('job.apply', $data_jobs->id)}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="text" placeholder="Full Name" name="full_name" value=""/>

                            <textarea name="message" placeholder="Your message / cover letter sent to the employer"></textarea>

                            <!-- Upload CV -->
                            <div class="upload-info"><strong>Upload your CV (optional)</strong> <span>Max. file size: 5MB</span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="controlContainer d-flex">
                                <div class="container">
                                    <div class="row ">
                                        <label class="upload-btn col-md-3 btn-browser " for="fileInput3">
                                            <i class="fa fa-upload"></i>  &nbsp;Browse
                                            <div class="inputFileHolder">
                                                <input id="fileInput3" name="cv" class="fileInput fileInput2"
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
