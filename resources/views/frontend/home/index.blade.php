@extends('frontend.layout.layout')
@section('content')
@include('frontend.component.banner')
<!-- Content
================================================== -->

<!-- Categories -->
<div class="container">
    <div class="sixteen columns">
        <h3 class="margin-bottom-25">Popular Categories</h3>

        <ul id="popular-categories">
            <li class="w-25 mb-4">
                <a>
                    <i class="bi bi-graph-up"></i>
                    <h4 class="mb-2">Accouting / Finance</h4>
                    <span>(32)</span>
                </a>
            </li>
            <li class="w-25">
                <a>
                    <i class="bi bi-truck"></i>
                    <h4 class="mb-2">Automotive Jobs</h4>
                    <span>(32)</span>
                </a>
            </li>
            <li class="w-25">
                <a>
                    <i class="bi bi-tools"></i>
                    <h4 class="mb-2">Construction / Facilities</h4>
                    <span>(32)</span>
                </a>
            </li>
            <li class="w-25">
                <a>
                    <i class="bi bi-mortarboard"></i>
                    <h4 class="mb-2">Education / Training</h4>
                    <span>(32)</span>
                </a>
            </li>

            <li class="w-25 ">
                <a>
                    <i class="bi bi-activity"></i>
                    <h4 class="mb-2">Healthcare</h4>
                    <span>(32)</span>
                </a>
            </li>
            <li class="w-25">
                <a>
                    <i class="bi bi-question-lg"></i>
                    <h4 class="mb-2">Restarant / Food Service</h4>
                    <span>(32)</span>
                </a>
            </li>
            <li class="w-25">
                <a>
                    <i class="bi bi-globe"></i>
                    <h4 class="mb-2">Transportation / Logistics</h4>
                    <span>(32)</span>
                </a>
            </li>
            <li class="w-25">
                <a>
                    <i class="bi bi-laptop"></i>
                    <h4 class="mb-2">Telecommunication</h4>
                    <span>(32)</span>
                </a>
            </li>

        </ul>
        <div class="clearfix"></div>
        <div class="margin-top-30"></div>
        <a href="{{route('category.browser')}}" class="button centered">Browse All Categories</a>
        <div class="margin-bottom-50"></div>
    </div>
</div>


<div class="container">

    <!-- Recent Jobs -->
    <div class="eleven columns">
        <div class="padding-right">
            <h3 class="margin-bottom-25">Recent Jobs</h3>
            <ul class="job-list">
                @foreach($data_jobs as $job)
                    <li class=" position-relative ">
                        <div class="content d-flex align-items-center {{$job->jobType->name}}">
                            <img  src="{{asset($job->company->company_logo)}}">
                            <div class="job-list-content ms-5">
                                <a href="{{route('job.detail', $job->id)}}" class="cursor-pointer text-decoration-underline">
                                    <h4 class="Login-to-view">
                                       {{$job->title}}
                                    </h4>
                                </a>
                                <div class="job-icons ">
                                    <span><i class="fa fa-briefcase"></i> {{ $job->company->company_name}}</span>
                                    <span><i class="fa fa-map-marker"></i> {{$job->company->province->name}}</span>
                                    @if(auth()->check())
                                        @if($job->type_salary == 1)
                                            <span><i class="fa fa-money"></i>&nbsp;{{$job->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$job->maximum_salary . '$'}}</span>
                                        @elseif($job->type_salary == 2)
                                            <span><i class="fa fa-money"></i>&nbsp;{{$job->salary . '$' }}</span>
                                        @else
                                            <span><i class="fa fa-money"></i>&nbsp;Deal</span>
                                        @endif
                                    @elseif(!auth()->check())
                                            <span><a href="{{route('auth.login')}}" class="border-0 cursor-pointer text-decoration-underline Login-to-view"><i class="fa fa-money"></i>Login to view salary</a></span>
                                    @endif

                                </div>
                                <span class="mt-2"><i class="bi bi-calendar2-week"></i> {{getDayDifference($job)}} </span>
                                @php
                                    $array_tag_id = explode(', ', $job->tag_id);
                                @endphp
                                @foreach($data_tag as $tag)
                                    @if (in_array($tag->id, $array_tag_id))
                                        <a href="{{route('job.tag_search', $tag->id)}}" >
                                            <span class='job-tag rounded-pill'>{{$tag->name}}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <span class="p-2 border text-white position-absolute end-0 me-5 {{$job->jobType->name}}">{{$job->jobType->name}}</span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>
            <a href="{{route('job.browser')}}" class="button centered"><i class="fa fa-plus-circle"></i> Show More Jobs</a>
            <div class="margin-bottom-55"></div>
        </div>
    </div>

    <!-- Job Spotlight -->
    <div class="five columns">
        <h3 class="margin-bottom-5">Job Spotlight</h3>

        <div class="clearfix"></div>

        <!-- Showbiz Container -->
        <div id="job-spotlight" class="showbiz-container">
            <div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1">
                <div class="overflowholder">
                    @foreach($spotlight as $spl)
                        <div class="job-spotlight">
                            <a href="{{route('job.detail', $spl->id)}}" class="cursor-pointer text-decoration-underline link-underline-dark"><h4>{{$spl->title}}<span class="ms-4 {{$spl->jobType->name}}">{{$spl->jobType->name}}</span></h4></a>
                            <span><i class="fa fa-briefcase"></i> {{$spl->company->company_name}}</span>
                            <span><i class="fa fa-map-marker"></i>{{$spl->company->province->name}}</span>
                            @if(auth()->check())
                                @if($spl->type_salary == 1)
                                    <span><i class="fa fa-money"></i> &nbsp;{{$spl->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$spl->maximum_salary . '$'}}</span>
                                @elseif($spl->type_salary == 2)
                                    <span><i class="fa fa-money"></i> &nbsp;{{$spl->salary . '$' }}</span>
                                @else
                                    <span><i class="fa fa-money"></i> &nbsp;</span>
                                @endif
                            @elseif(!auth()->check())
                            <span><a href="{{route('auth.login')}}" class="Login-to-view"><i class="fa fa-money"></i>Login to view salary</a></span>
                            @endif
                            <div class="d-flex flex-wrap">
                                @php
                                    $array_tag_id = explode(', ', $spl->tag_id);
                                @endphp
                                @foreach($data_tag as $tag)
                                    @if (in_array($tag->id, $array_tag_id))
                                        <a href="{{route('job.tag_search', $tag->id)}}" >
                                            <span class='job-tag rounded-pill'>{{$tag->name}}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <p>{{truncateText($spl->description, 120)}}</p>
                            <a href="{{route('job.detail', $spl->id)}}" class="button">View Detail</a>
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>


    </div>
</div>



@if(auth()->check())
@else
{{--    @include('frontend.component.header')--}}
@endif

<!-- Infobox -->
<div class="infobox">
    <div class="container">
        <div class="sixteen columns">Start Building Your Own Job Board Now <a href="../login/index.blade.php">Get Started</a>
        </div>
    </div>
</div>


<!-- Recent Posts -->
<div class="container">
    <div class="sixteen columns">
        <h3 class="margin-bottom-25">Recent Posts</h3>
    </div>
    <div>
    @foreach($data_blogs as $blog)

    <div class="one-third column h-100">

        <div class="recent-post position-relative">
            <div class="recent-post-img"><a class="d-flex justify-content-center" href="{{route('blog.detail', $blog->id)}}"><img class="object-fit-cover" src="{{asset($blog->img)}}" alt=""></a>
                <div class="hover-icon"></div>
            </div>
            <a href="../blog/detail.blade.php"><h4>{{$blog->title}}</h4></a>
            <div class="meta-tags">
                <span>{{getDayDifference($blog)}}</span>
                <span><a>{{$blog->comments()->count()}} {{$blog->comments()->count() > 1 ? 'comments' : 'comment'}}</a></span>
            </div>
            <p>{{truncateText($blog->desc, 150)}}</p>
            <a href="{{route('blog.detail', $blog->id)}}" class="button position-absolute end-0 me-4">Read More</a>
        </div>

    </div>
    @endforeach
    </div>
</div>
@stop

