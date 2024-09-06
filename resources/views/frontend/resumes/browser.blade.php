@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<span>We've found 92 resumes for:</span>
			<h2>Web, Software & IT</h2>
		</div>

		<div class="six columns">
			<a href="add.blade.php" class="button">Post a Resume, It’s Free!</a>
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
			<input type="text" placeholder="Search freelancer services (e.g. logo design)" value=""/>
			<div class="clearfix"></div>
		</form>

		<ul class="resumes-list">
			@foreach($resumes as $resume)
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
								@foreach($data_tag as $tag)
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

		<div class="pagination-container mb-5">
			<div class="paginate " id="pagination-links">
				{{$resumes->withQueryString()->appends($_GET)->links('.frontend.component.paginate')}}
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
				<option selected="selected" value="recent">Relevance</option>
				<option value="">Hourly Rate – Highest First</option>
				<option value="">Hourly Rate – Lowest First</option>
			</select>

		</div>

		<!-- Skills -->
		<div class="widget">
			<h4>Skills</h4>

			<!-- Select -->
			<form action="#" method="get">
				<select data-placeholder="Select Skills" class="chosen-select" multiple>
					<option value="">Adobe Photoshop</option>
					<option value="">PHP</option>
					<option value="">HTML</option>
					<option value="">CSS</option>
					<option value="">JavaScript</option>
					<option value="">jQuery</option>
					<option value="">MySQL</option>
					<option value="">WordPress</option>
				</select>
				<div class="margin-top-15"></div>
				<button class="button">Filter</button>
			</form>
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
