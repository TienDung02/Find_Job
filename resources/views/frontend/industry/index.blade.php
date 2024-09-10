@extends('frontend.layout.layout')

@section('content')

<div class="clearfix margin-top-90"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar" class="photo-bg" style="background-image: url({{asset('/storage/uploads/all-categories-photo.jpg')}});">
	<div class="container">
		<div class="ten columns">
			<h2>All Categories</h2>
		</div>


	</div>
</div>


<!-- Content
================================================== -->
<div id="categories">
	<!-- Categories Group -->
	<div class="categories-group">
        <div class="container">
            <div class="container">
                <ul id="popular-categories">
                    @foreach($data_industries as $industry)
                        <li class="w-25 mb-4">
                            <a href="{{route('job.browser', $industry->id)}}">
                                {!! $industry->icon !!}
                                <h5 class="mb-2">{{$industry->name}}</h5>
                                <span>({{ $industry->jobs_count }})</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
	</div>
</div>

@stop
