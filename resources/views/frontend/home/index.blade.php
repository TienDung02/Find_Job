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
                        <a href="{{route('job.detail', $job->id)}}" class="d-flex align-items-center {{$job->jobType->name}}">
                            <img  src="{{asset($job->company->company_logo)}}">
                            <div class="job-list-content ms-5">
                                <h4>
                                   {{$job->title}}
                                </h4>
                                <div class="job-icons ">
                                    <span><i class="fa fa-briefcase"></i>{{$job->company->company_name}}</span>
                                    <span><i class="fa fa-map-marker"></i>{{$job->location->name}}</span>
                                    <span><i class="fa fa-money"></i>{{$job->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$job->minimum_salary . '$'}}</span>
                                </div>
                                <span class="mt-2"><i class="bi bi-calendar2-week"></i> {{getDayDifference($job)}} </span>
                            </div>
                            <span class="p-2 border text-white position-absolute end-0 me-5 {{$job->jobType->name}}">{{$job->jobType->name}}</span>
                        </a>
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

        <!-- Navigation -->
        <div class="showbiz-navigation">
            <div id="showbiz_left_1" class="sb-navigation-left"><i class="fa fa-angle-left"></i></div>
            <div id="showbiz_right_1" class="sb-navigation-right"><i class="fa fa-angle-right"></i></div>
        </div>
        <div class="clearfix"></div>

        <!-- Showbiz Container -->
        <div id="job-spotlight" class="showbiz-container">
            <div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1">
                <div class="overflowholder">
                    <ul>
                        <li>
                            <div class="job-spotlight">
                                <a href="#"><h4>Social Media: Advertising Coordinator <span class="part-time">Part-Time</span></h4></a>
                                <span><i class="fa fa-briefcase"></i> Mates</span>
                                <span><i class="fa fa-map-marker"></i> New York</span>
                                <span><i class="fa fa-money"></i> $20 / hour</span>
                                <p>As advertising & content coordinator, you will support our social media team in producing high quality social content for a range of media channels.</p>
                                <a href="../job/detail.blade.php" class="button">Apply For This Job</a>
                            </div>
                        </li>
                        <li>
                            <div class="job-spotlight">
                                <a href="#"><h4>Prestashop / WooCommerce Product Listing <span class="freelance">Freelance</span></h4></a>
                                <span><i class="fa fa-briefcase"></i> King</span>
                                <span><i class="fa fa-map-marker"></i> London</span>
                                <span><i class="fa fa-money"></i> $25 / hour</span>
                                <p>Etiam suscipit tellus ante, sit amet hendrerit magna varius in. Pellentesque lorem quis enim venenatis pellentesque.</p>
                                <a href="../job/detail.blade.php" class="button">Apply For This Job</a>
                            </div>
                        </li>
                        <li>
                            <div class="job-spotlight">
                                <a href="#"><h4>Logo Design <span class="freelance">Freelance</span></h4></a>
                                <span><i class="fa fa-briefcase"></i> Hexagon</span>
                                <span><i class="fa fa-map-marker"></i> Sydney</span>
                                <span><i class="fa fa-money"></i> $10 / hour</span>
                                <p>Proin ligula neque, pretium et ipsum eget, mattis commodo dolor. Etiam tincidunt libero quis commodo.</p>
                                <a href="../job/detail.blade.php" class="button">Apply For This Job</a>
                            </div>
                        </li>
                    </ul>
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
            <div class="recent-post-img"><a href="{{route('blog.detail', $blog->id)}}"><img src="{{asset($blog->img)}}" alt=""></a>
                <div class="hover-icon"></div>
            </div>
            <a href="../blog/detail.blade.php"><h4>{{$blog->title}}</h4></a>
            <div class="meta-tags">
                <span>{{getDayDifference($blog)}}</span>
                <span><a href="#">0 Comments</a></span>
            </div>
            <p>{{truncateText($blog->desc, 150)}}</p>
            <a href="../blog/detail.blade.php" class="button position-absolute end-0 me-4">Read More</a>
        </div>

    </div>
    @endforeach
    </div>
</div>
@stop

