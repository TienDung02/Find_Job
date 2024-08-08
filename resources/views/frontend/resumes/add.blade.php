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
<div id="titlebar" class="single ">
	<div class="">

		<div class="sixteen columns">
			<h2 class="p-0"><i class="fa fa-plus-circle"></i> Add Resume</h2>
            <nav id="breadcrumbs">
                <ul>
                    <li>You are here:</li>
                    <li><a href="#">Home</a></li>
                    <li>Add Resumes</li>
                </ul>
            </nav>
		</div>

	</div>
</div>

<!-- Notice -->
<div class="notification notice closeable ">
    <p><span>Have an account?</span> If you don’t have an account you can create one below by entering your email address. A password will be automatically emailed to you.</p>
</div>

<!-- Content
================================================== -->
<div >

	<!-- Submit Page -->
	<div class="sixteen columns">
		<div class="submit-page">

            <div class="d-flex flex-wrap p-5">

			<!-- Email -->
			<div class="form w-50 p-3">
				<h5>Your Name</h5>
				<input class="search-field me-3" type="text" placeholder="Your full name" value=""/>
			</div>

			<!-- Email -->
			<div class="form w-50 p-3">
				<h5>Your Email</h5>
				<input class="search-field" type="text" placeholder="mail@example.com" value=""/>
			</div>

			<!-- Title -->
			<div class="form w-50 p-3">
				<h5>Professional Title</h5>
				<input class="search-field" type="text" placeholder="e.g. Web Developer" value=""/>
			</div>

			<!-- Location -->
			<div class="form w-50 p-3">
				<h5>Location</h5>
				<input class="search-field" type="text" placeholder="e.g. London, UK" value=""/>
			</div>

			<!-- Logo -->
			<div class="form w-50 p-3">
				<h5>Photo <span>(optional)</span></h5>
				<label class="upload-btn rounded-end-0">
				    <input type="file" multiple />
				    <i class="fa fa-upload"></i> Browse
				</label>
				<span class="fake-input">No file selected</span>
			</div>

			<!-- Email -->
			<div class="form w-50 p-3">
				<h5>Video <span>(optional)</span></h5>
				<input class="search-field" type="text" placeholder="A link to a video about you" value=""/>
			</div>

            </div>

			<!-- Description -->
			<div class="form p-5">
				<h5>Resume Content</h5>
				<textarea class="WYSIWYG" name="summary" cols="40" rows="3" id="summary" spellcheck="true"></textarea>
			</div>


			<!-- Add URLs -->
			<div class="form with-line p-5">
				<h5>URL(s) <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Adding URL(s) -->
					<div class="form boxed box-to-clone url-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" placeholder="Name" value=""/>
						<input class="search-field" type="text" placeholder="http://" value=""/>
					</div>

					<a href="#" class="button gray add-url add-box"><i class="fa fa-plus-circle"></i> Add URL</a>
					<p class="note">Optionally provide links to any of your websites or social network profiles.</p>
				</div>
			</div>


			<!-- Education -->
			<div class="form with-line p-5">
				<h5>Education <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Education -->
					<div class="form boxed box-to-clone education-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" placeholder="School Name" value=""/>
						<input class="search-field" type="text" placeholder="Qualification(s)" value=""/>
						<input class="search-field" type="text" placeholder="Start / end date" value=""/>
						<textarea name="desc" id="desc" cols="30" rows="10" placeholder="Notes (optional)"></textarea>
					</div>

					<a href="#" class="button gray add-education add-box"><i class="fa fa-plus-circle"></i> Add Education</a>
				</div>
			</div>


			<!-- Experience  -->
			<div class="form with-line p-5">
				<h5>Experience <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Experience -->
					<div class="form boxed box-to-clone experience-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" placeholder="Employer" value=""/>
						<input class="search-field" type="text" placeholder="Job Title" value=""/>
						<input class="search-field" type="text" placeholder="Start / end date" value=""/>
						<textarea name="desc1" id="desc1" cols="30" rows="10" placeholder="Notes (optional)"></textarea>
					</div>

					<a href="#" class="button gray add-experience add-box"><i class="fa fa-plus-circle"></i> Add Experience</a>
				</div>
			</div>


			<div class="divider margin-top-0 padding-reset"></div>
            <div class="me-5    ">
                <div class="w-100 me-5 p-4 position-relative">
                    <a href="#" class="button big position-absolute end-0 top-0">Preview <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
		</div>
	</div>

</div>

</div>
</div>
@stop
