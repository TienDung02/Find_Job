@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<span>We found 1,412 jobs matching:</span>
			<h2>Web, Software & IT</h2>
		</div>

	</div>
</div>

<!-- Content
================================================== -->
<div class="container main-application">
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">

		<form action="#" method="get" class="list-search">
			<button><i class="fa fa-search"></i></button>
			<input type="text" placeholder="job title, keywords or company name" value=""/>
			<div class="clearfix"></div>
		</form>

        <ul class="job-list">
            @foreach($data_jobs as $job)
                <li class=" position-relative ">
                    <a href="detail.blade.php?id=" class="d-flex align-items-center {{$job->jobType->name}}">
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

			<!-- Select -->
			<select data-placeholder="Choose Category" class="chosen-select-no-single">
				<option selected="selected" value="recent">Newest</option>
				<option value="oldest">Oldest</option>
				<option value="expiry">Expiring Soon</option>
				<option value="ratehigh">Hourly Rate – Highest First</option>
				<option value="ratelow">Hourly Rate – Lowest First</option>
			</select>

		</div>

		<!-- Location -->
		<div class="widget">
			<h4>Location</h4>
			<form action="#" method="get">
				<input type="text" placeholder="State / Province" value=""/>
				<input type="text" placeholder="City" value=""/>

				<input type="text" class="miles" placeholder="Miles" value=""/>
				<label for="zip-code" class="from">from</label>
				<input type="text" id="zip-code" class="zip-code" placeholder="Zip-Code" value=""/><br>

				<button class="button">Filter</button>
			</form>
		</div>

		<!-- Job Type -->
		<div class="widget">
			<h4>Job Type</h4>

			<ul class="checkboxes">
				<li>
					<input id="check-1" type="checkbox" name="check" value="check-1" checked>
					<label for="check-1">Any Type</label>
				</li>
				<li>
					<input id="check-2" type="checkbox" name="check" value="check-2">
					<label for="check-2">Full-Time <span>(312)</span></label>
				</li>
				<li>
					<input id="check-3" type="checkbox" name="check" value="check-3">
					<label for="check-3">Part-Time <span>(269)</span></label>
				</li>
				<li>
					<input id="check-4" type="checkbox" name="check" value="check-4">
					<label for="check-4">Internship <span>(46)</span></label>
				</li>
				<li>
					<input id="check-5" type="checkbox" name="check" value="check-5">
					<label for="check-5">Freelance <span>(119)</span></label>
				</li>
			</ul>

		</div>

		<!-- Rate/Hr -->
		<div class="widget">
			<h4>Rate / Hr</h4>

			<ul class="checkboxes">
				<li>
					<input id="check-6" type="checkbox" name="check" value="check-6" checked>
					<label for="check-6">Any Rate</label>
				</li>
				<li>
					<input id="check-7" type="checkbox" name="check" value="check-7">
					<label for="check-7">$0 - $25 <span>(231)</span></label>
				</li>
				<li>
					<input id="check-8" type="checkbox" name="check" value="check-8">
					<label for="check-8">$25 - $50 <span>(297)</span></label>
				</li>
				<li>
					<input id="check-9" type="checkbox" name="check" value="check-9">
					<label for="check-9">$50 - $100 <span>(78)</span></label>
				</li>
				<li>
					<input id="check-10" type="checkbox" name="check" value="check-10">
					<label for="check-10">$100 - $200 <span>(98)</span></label>
				</li>
				<li>
					<input id="check-11" type="checkbox" name="check" value="check-11">
					<label for="check-11">$200+ <span>(21)</span></label>
				</li>
			</ul>

		</div>



	</div>
	<!-- Widgets / End -->


</div>
@stop
