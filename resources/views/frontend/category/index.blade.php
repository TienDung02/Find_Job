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

		<div class="six columns">
			<a href="../job/add.blade.php" class="button">Post a Job, It’s Free!</a>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div id="categories">
	<!-- Categories Group -->
    @foreach($data_categories as $parent_category)
        @if($parent_category->parent_id == 0)
	<div class="categories-group">
            <div class="container">
                <div class="four columns me-5">
                    <h4>{{$parent_category->name}}</h4>
                </div>
                <div class="container">
                        <div class="grid-container grid grid-3 d-grid menu" style="grid-template-columns: repeat(3, minmax(0, 1fr));">
                            @foreach($parent_category->children as $child)
                                 <div class="grid-item item_browse_category dropdown mb-3">
                                     <a href="{{route('job.index', $child->id)}}" class="dropbtn text-uppercase">{{$child->name }}</a>
                                     @if(($child->children)->isNotEmpty())
                                     <div class="dropdown-content ms-5">
                                         @foreach($child->children as $grandChild)
                                            <a href="{{route('job.index', $grandChild->id)}}">{{$grandChild->name}}</a>
                                         @endforeach
                                     </div>
                                     @endif
                                 </div>
                            @endforeach
                        </div>
                </div>
            </div>

	</div>
        @endif
    @endforeach
</div>

@stop
