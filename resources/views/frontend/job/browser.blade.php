@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar" class="background-job no-repe">
	<div class="container">
		<div class="ten columns">
			<span class="text-white">We found {{$count_job}} jobs matching:</span>
				<h2 class="text-primary-emphasis fw-semibold">Web, Software & IT</h2>
		</div>

	</div>
</div>

<!-- Content
================================================== -->
<div class="container main-application">
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div id="main-list" class="padding-right">

		<form action="{{ route('job.meili') }}" method="get" class="list-search">
			<button><i class="fa fa-search"></i></button>
			<input type="search" id="query" name="query" placeholder="job title, keywords or company name" value=""/>
			<div class="clearfix"></div>
		</form>

        <ul class="job-list">
            @if(isset($results) && $results->isNotEmpty())
                @php
                    $data_jobs = $results
                @endphp
            @endif
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
								<span><i class="fa fa-briefcase"></i> {{$job->company->company_name}}</span>
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
		<div class="clearfix"></div>

		<div class="pagination-container mb-5">
            <div class="paginate " id="pagination-links">
                {{$data_jobs->withQueryString()->appends($_GET)->links('.frontend.component.paginate')}}
            </div>
		</div>

	</div>
	</div>


	<!-- Widgets -->
	<div class="five columns">

		<!-- Sort by -->
		<div class="widget">
			<h4>Sort by</h4>

            <span id="url-select-search" data-url="{{route('job.select_search')}}"></span>
			<!-- Select -->
			<select data-placeholder="Choose Category" class="chosen-select-no-single" id="select-search-job">
				<option selected="selected" value="recent">Newest</option>
				<option value="oldest">Oldest</option>
				<option value="expiry">Expiring Soon</option>
			</select>

		</div>

		<!-- Location -->
		<div class="widget">
			<h4>Location</h4>
			<span id="formSearch" data-url-suggest="{{ route('job.suggest') }}" data-url-checkbox="{{route('job.checkbox_search')}}"></span>
			<span id="get_table" data-url="{{ route('job.select2_search') }}"></span>
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

        <!-- Job Type -->
        <div class="widget">
            <h4>Job Type</h4>

			<ul class="checkboxes">
				<li>
					<input id="check-1" type="checkbox" name="check" value="0" checked>
					<label for="check-1">Any Type</label>
				</li>
				<li>
					<input id="check-2" type="checkbox" name="check" value="1">
					<label for="check-2">Full-Time <span>({{$jobTypes[1]}})</span></label>
				</li>
				<li>
					<input id="check-3" type="checkbox" name="check" value="2">
					<label for="check-3">Part-Time <span>({{$jobTypes[2]}})</span></label>
				</li>
				<li>
					<input id="check-4" type="checkbox" name="check" value="3">
					<label for="check-4">Internship <span>({{$jobTypes[3]}})</span></label>
				</li>
				<li>
					<input id="check-5" type="checkbox" name="check" value="4">
					<label for="check-5">Freelance <span>({{$jobTypes[4]}})</span></label>
				</li>
				<li>
					<input id="check-6" type="checkbox" name="check" value="5">
					<label for="check-6">Temporary <span>({{$jobTypes[5]}})</span></label>
				</li>
			</ul>


		</div>

	</div>

</div>
@stop
