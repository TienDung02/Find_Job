@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>

<div class="d-flex">
    @if(auth()->user()->role == 2)
        @include('.frontend.component.menu_left_candidate')
    @else
        @include('.frontend.component.menu_left_employer')
    @endif
    <div class="clearfix"></div>

    <div class="m-auto bg-white" style="width: calc(100% - 260px);background-color: #f6f6f6">
        <!-- Titlebar
        ================================================== -->
        <div id="titlebar" class="single">
            <div class=" ms-5">

                <div class="sixteen columns">
                    <h2 class="p-0">Resumes Bookmarked</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li>You are here:</li>
                            <li><a href="{{route('home.index')}}">Home</a></li>
                            <li>Bookmark</li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>


        <!-- Content
        ================================================== -->
        <div class="container main-application">
            <!-- Recent Jobs -->
            <div class="eleven columns">
            <div id="main-list" class="padding-right">

                <form action="{{ route('bookmark_employer.meili') }}" method="get" class="list-search">
                    <button><i class="fa fa-search"></i></button>
                    <input type="search" id="query" name="query" placeholder="Name, keywords or skills" value=""/>
                    <div class="clearfix"></div>
                </form>

                <ul class="resumes-list">
                    @foreach($data_resumes as $resume)
                        <li>
                            <div class="content ">
                                <img src="{{$resume->photo ? asset($resume->photo) : asset('storage/uploads/user_black.png')}}" alt="">
                                <div class="resumes-list-content">
                                    <a href="{{route('resume.detail', $resume->id)}}" class="cursor-pointer text-decoration-underline">
                                        <h4 class="Login-to-view">
                                            {{$resume->full_name}}
                                        </h4>
                                    </a>
                                    <h5 class="text-decoration-none">{{$resume->professional_title}}</h5>

                                    <div class="mt-3">
                                        <span><i class="fa fa-map-marker"></i>{{$resume->province_id ? $resume->province->name : ''}}</span>
                                        @if($resume->type_salary == 1)
                                            <span><i class="fa fa-money"></i>&nbsp;{{$resume->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$resume->maximum_salary . '$'}}</span>
                                        @elseif($resume->type_salary == 2)
                                            <span><i class="fa fa-money"></i>&nbsp;{{$resume->salary . '$' }}</span>
                                        @else
                                            <span><i class="fa fa-money"></i>&nbsp;Deal</span>
                                        @endif
                                    </div>
                                    <div class="skills">
                                        @php
                                            $array_tag_id = explode(', ', $resume->tag_id);
                                        @endphp
                                        @foreach($data_tags as $tag)
                                            @if (in_array($tag->id, $array_tag_id))
                                                <span class='job-tag border-radius-5'>{{$tag->name}}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
                <div class="clearfix"></div>
            </div>
            </div>


            <!-- Widgets -->
            <div class="five columns">

                <!-- Sort by -->
                <div class="widget">
                    <h4>Sort by</h4>

                    <!-- Select -->
                    <span id="url-select-search" data-url="{{route('bookmark_employer.select_search')}}"></span>
                    <select data-placeholder="Choose Category" class="chosen-select-no-single" id="select-search">
                        <option selected="selected" value="recent">Relevance</option>
                        <option value="DESC">Hourly Rate – Highest First</option>
                        <option value="ASC">Hourly Rate – Lowest First</option>
                    </select>

                </div>

                <!-- Location -->
                <div class="widget">
                    <h4>Location</h4>
                    <span id="formSearch" data-url-suggest="{{ route('bookmark_employer.suggest') }}" data-url-checkbox="{{route('bookmark_employer.checkbox_search')}}"></span>
                    <span id="get_table" data-url="{{ route('bookmark_employer.select2_search') }}"></span>
                    <form action="#" method="get">
                        <div class="form-group select2-company mb-4">
                            <select class="js-example-basic-single form-control" id="first_suggest" data-type="province" data-placeholder="Province" name="province">
                            </select>
                        </div>
                        <div class="form-group select2-company">
                            <select class="js-example-basic-single form-control" id="second_suggest" data-type="district" data-placeholder="District" name="district">
                            </select>
                        </div>
                    </form>
                </div>

            </div>
            <!-- Widgets / End -->


        </div>
    </div>
</div>

@stop
