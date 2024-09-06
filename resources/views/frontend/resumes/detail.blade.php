
@extends('frontend.layout.layout')
@section('content')
<div class="clearfix"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar" class="resume margin-top-90">
	<div class="container">
		<div class="ten columns">
			<div class="resume-titlebar">
				<img src="{{$resumes->photo ? asset($resumes->photo) : asset('storage/uploads/user_black.png')}}" alt="">
				<div class="resumes-list-content">
					<h4>{{$resumes->full_name}}<span>{{$resumes->professional_title}}</span></h4>
					<span class="icons"><i class="fa fa-map-marker"></i>
					{{$resumes->province != '' ? $resumes->province->name . ',' : ''}}&nbsp;
					{{$resumes->district != '' ? $resumes->district->name . ',' : ''}}&nbsp;
					{{$resumes->ward != '' ? $resumes->ward->name : ''}}
					</span>
					@if($resumes->type_salary == 1)
						<span><i class="fa fa-money"></i>&nbsp;{{$resumes->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$resumes->maximum_salary . '$'}}</span>
					@elseif($resumes->type_salary == 2)
						<span><i class="fa fa-money"></i>&nbsp;{{$resumes->salary . '$' }}</span>
					@else
						<span><i class="fa fa-money"></i>&nbsp;Deal</span>
					@endif
					<span class="icons"><a href="mailto:{{$resumes->email}}"><i class="fa fa-envelope"></i>{{$resumes->email}}</a></span>
					<div class="skills">
						@php
							$array_tag_id = explode(', ', $resumes->tag_id);
						@endphp
						@foreach($data_tag as $tag)
							@if (in_array($tag->id, $array_tag_id))
                                <a href="{{route('job.tag_search', $tag->id)}}" >
                                    <span class='job-tag rounded-pill'>{{$tag->name}}</span>
                                </a>
							@endif
						@endforeach
					</div>
					<div class="clearfix"></div>

				</div>
			</div>
		</div>

		<div class="six columns">
			<div class="two-buttons">

				<a href="#small-dialog" class="popup-with-zoom-anim button"><i class="fa fa-envelope"></i> Send Message</a>

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
				@if($type == 1)
					@if(isset($check_bookmark) && $check_bookmark == 2)
						<a href="{{route('resume.bookmark', $resumes->id)}}" class="button button margin-top-55"><i class="fa fa-star"></i> Bookmark This Resume</a>
					@elseif(isset($check_bookmark) && $check_bookmark == 1)
						<a href="{{route('resume.remove-bookmark', $resumes->id)}}" class="button dark "><i class="fa fa-star"></i> Remove bookmark</a>
					@endif
				@endif
			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="eight columns">
        <div class="padding-right">

            @if($resumes->resume_content != '')
                <h3 class="mb-3 mt-3">About Me</h3>
                <div class="WYSIWYG " cols="40" rows="3" name="description" spellcheck="true"> {!! $resumes->resume_content !!} </div>
            @endif

            <!-- Education -->
            <div class="eight columns">

                <h3 class="margin-bottom-20">Education</h3>

                <!-- Resume Table -->
                <dl class="resume-table">
                    @foreach($educations as $edu)
                        <dt>
                            <small class="date">{{$edu->start_day }} <i class="bi bi-arrow-right"></i> {{$edu->end_day}}</small>
                            <strong>{{$edu->school_name}}</strong>
                            <strong>{{$edu->qualification}}</strong>
                        </dt>
                        <dd>
                            <p>{{$edu->note}}</p>
                        </dd>
                    @endforeach

                </dl>

            </div>

        </div>
	</div>


	<!-- Experience -->
	<div class="eight columns">

		<h3 class="margin-bottom-20">Experience</h3>

		<!-- Resume Table -->
		<dl class="resume-table">
			@foreach($experiences as $exp)
				<dt>
					<small class="date">{{$exp->start_day }} <i class="bi bi-arrow-right"></i> {{$exp->end_day}}</small>
					<strong>Company: {{$exp->employer}}</strong>
					<strong>position: {{$exp->job_title}}</strong>
				</dt>
				<dd>
					<p>{{$exp->note}}</p>
				</dd>
			@endforeach

		</dl>

	</div>

    <!-- Network Profiles -->
    <div class="eight columns ms-0">

        <h3 class="margin-bottom-20 fs-3">Network Profile</h3>

        <!-- Resume Table -->
        <dl class="resume-table">
            @foreach($networkProfiles as $nwpProfile)
                <dt>
                    <p>{{$nwpProfile->name}}</p>
                    <p>{{$nwpProfile->url}}</p>
                </dt>
            @endforeach

        </dl>

    </div>


</div>


@stop
