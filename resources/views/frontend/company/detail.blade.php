@extends('frontend.layout.layout')
@section('content')
    <div class="clearfix margin-top-90"></div>

<!-- Titlebar
================================================== -->
<div id="titlebar" style="background-image: url(http://findjob.local/storage/uploads/banner_company.jpg);">
    <div class="container">
        <div class="ten columns">
            <div class="company-info position-relative pb-0 border-0">
                <a href=""><img class="border-radius-5" src="{{asset($company->company_logo)}}" alt=""></a>
                <div class="content mt-2">
                    <a href="" ><h4 class="fw-semibold mb-3 text-white">{{$company->company_name}}</h4>
                        <h5 class="text-white">{{$company->company_tagline}}</h5></a>
                    <div class="mt-3 d-flex">
                        @if($company->company_website)
                            <span class="me-4"><a class="text-white" href="{{$company->company_website}}"><i class="fa fa-link"></i> Website </a></span>
                        @endif
                        @if($company->twitter)
                            <span class="me-4"><a class="text-white" href="{{$company->twitter}}"><i class="fa fa-link"></i> twitter </a></span>
                        @endif
                        @if($company->facebook)
                            <span><a class="text-white" href="{{$company->facebook}}"><i class="fa fa-link"></i> Website </a></span>
                        @endif

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="six columns">
            <div class="two-buttons d-flex flex-wrap-reverse text-end margin-top-55">

                <div class="w-100">
                    <a href="#small-dialog" class="popup-with-zoom-anim button position-static"><i class="fa fa-envelope"></i> Send Message</a>
                </div>

                <div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
                    <div class="small-dialog-headline">
                        <h2>Send Message to John Doe</h2>
                    </div>

                    <div class="small-dialog-content">
                        <form action="#" method="get" >
                            <input type="text" placeholder="Full Name" value=""/>
                            <input type="text" placeholder="Email Address" value=""/>
                            <textarea placeholder="Message"></textarea>

                            <button class="send">Send Application</button>
                        </form>
                    </div>
                </div>
                <div class="w-100">
                    @if(isset($check_bookmark) && $check_bookmark == 2)
                        <a href="{{route('job.bookmark', 1)}}" class="button button position-static"><i class="fa fa-star"></i> Bookmark This Company</a>
                    @elseif(isset($check_bookmark) && $check_bookmark == 1)
                        <a href="{{route('job.remove-bookmark', 1)}}" class="button dark position-static"><i class="fa fa-star"></i> Remove Bookmark</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Content
================================================== -->
<div class="container">

    <!-- Recent Jobs -->
    <div class="eleven columns">
        <div class="padding-right">
            <h2>General information</h2>
            <!-- Company Info -->
            <div class="form">
                @if($company->description != '')
                <h4 class="mb-3 mt-3">Job Description</h4>
                <div class="WYSIWYG " cols="40" rows="3" name="description" spellcheck="true"> {!! $company->description !!} </div>
                @endif
            </div>
            <br>

        </div>
    </div>
    <div class="eleven columns">
        <div class="padding-right">

            <!-- Company Info -->
            <div class="form">
                @if($company->description != '')
                <h4 class="mb-3 mt-3">Job Description</h4>
                <div class="WYSIWYG " cols="40" rows="3" name="description" spellcheck="true"> {!! $company->description !!} </div>
                @endif
            </div>
            <br>

        </div>
    </div>


    <!-- Widgets -->
    <div class="five columns">

        <!-- Sort by -->
        <div class="widget">
            <!-- Job Spotlight -->
            <h4 class="margin-bottom-5">Jobs Available</h4>

            <div class="clearfix"></div>

            <!-- Showbiz Container -->
            <div id="job-spotlight" class="showbiz-container">
                <div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1">
                    <div class="overflowholder">
                        @foreach($data_jobs as $job)
                            <div class="job-spotlight">
                                <a href="{{route('job.detail', $job->id)}}" class="cursor-pointer text-decoration-underline link-underline-opacity-25 link-underline-dark"><h4>{{$job->title}}<span class="ms-4 {{$job->jobType->name}}">{{$job->jobType->name}}</span></h4></a>
                                <span><i class="fa fa-briefcase"></i> {{$job->company->company_name}}</span>
                                <span><i class="fa fa-map-marker"></i>{{$job->company->province->name}}</span>
                                @if(auth()->check())
                                    @if($job->type_salary == 1)
                                        <span><i class="fa fa-money"></i> &nbsp;{{$job->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$job->maximum_salary . '$'}}</span>
                                    @elseif($job->type_salary == 2)
                                        <span><i class="fa fa-money"></i> &nbsp;{{$job->salary . '$' }}</span>
                                    @else
                                        <span><i class="fa fa-money"></i> &nbsp;</span>
                                    @endif
                                @elseif(!auth()->check())
                                    <span><a href="{{route('auth.login')}}" class="Login-to-view"><i class="fa fa-money"></i>Login to view salary</a></span>
                                @endif
                                <div class="d-flex flex-wrap">
                                    @php
                                        $array_tag_id = explode(', ', $job->tag_id);
                                    @endphp
                                    @foreach($data_tags as $tag)
                                        @if (in_array($tag->id, $array_tag_id))
                                            <a href="{{route('job.tag_search', $tag->id)}}" >
                                                <span class='job-tag rounded-pill'>{{$tag->name}}</span>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                                <p>{{truncateText($job->description, 120)}}</p>
                                <a href="{{route('job.detail', $job->id)}}" class="button">View Detail</a>
                            </div>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>

    </div>
    <!-- Widgets / End -->


</div>
@stop
