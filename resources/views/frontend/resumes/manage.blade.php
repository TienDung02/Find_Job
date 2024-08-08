@extends('frontend.layout.layout')
@section('content')


<!-- Header
================================================== -->

<div class="d-flex margin-top-90">
@if(auth()->user()->role == 2)
    @include('.frontend.component.menu_left_candidate')
@else
    @include('.frontend.component.menu_left_employer')
@endif
<div class="clearfix"></div>
<div class="padding-50 " style="    margin: auto;width: calc(100% - 260px);">
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">

		<div class="sixteen columns">
			<h2>Manage Resumes</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Manage Resumes</li>
				</ul>
			</nav>
		</div>

</div>


<!-- Content
================================================== -->
	<!-- Table -->
	<div class="sixteen columns pe-3">

		<p class="margin-bottom-25">Your resume can be viewed, edited or removed below.</p>

		<table class="manage-table resumes responsive-table ">

			<tr>
				<th><i class="fa fa-user"></i> Name</th>
				<th><i class="fa fa-file-text"></i> Title</th>
				<th><i class="fa fa-map-marker"></i> Location</th>
				<th><i class="fa fa-calendar"></i> Date Posted</th>
				<th></th>
			</tr>

			<!-- Item #1 -->
			<tr>
				<td class="title"><a href="#">John Doe</a></td>
				<td>Front End Web Developer</td>
				<td>New York</td>
				<td>September 30, 2015</td>
				<td class="action">
					<a href="#"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#"><i class="fa  fa-eye-slash"></i> Hide</a>
					<a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>
				</td>
			</tr>

			<!-- Item #1 -->
			<tr>
				<td class="title"><a href="#">John Doe</a></td>
				<td>Logo Designer</td>
				<td>New York</td>
				<td>August 12, 2015</td>
				<td class="action">
					<a href="#"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#"><i class="fa  fa-eye-slash"></i> Hide</a>
					<a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>
				</td>
			</tr>

		</table>

		<br>
        <div class="w-100 position-relative">
            <a href="#" class="button position-absolute end-0">Add Resume</a>
        </div>

	</div>

</div>
</div>

@stop
