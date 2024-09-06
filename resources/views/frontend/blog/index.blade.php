@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>

<!-- Titlebar
================================================== -->
<div id="titlebar" >
	<div class="container">

		<div class="sixteen columns">
			<h2>Blog</h2>
			<span>Keep up to date with the latest news</span>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">

	<!-- Blog Posts -->
	<div class="eleven columns">
		<div class="padding-right">

            @foreach($data_blogs as $blog)
			<!-- Post -->
			<div class="post-container">
				<div class="post-img"><a class="d-flex justify-content-center" href="{{route('blog.detail', $blog->id)}}"><img src="{{asset($blog->img)}}" alt=""></a><div class="hover-icon"></div></div>
				<div class="post-content">
					<a href="#"><h3>{{$blog->title}}</h3></a>
					<div class="meta-tags">
						<span>{{getDayDifference($blog)}}</span>
						<span><a href="#">{{$blog->comments()->count()}} {{$blog->comments()->count() > 1 ? 'comments' : 'comment'}}</a></span>
					</div>
					<p>{{truncateText($blog->desc, 200)}}</p>
					<a class="button" href="{{route('blog.detail', $blog->id)}}">Read More</a>
				</div>
			</div>
            @endforeach


			<!-- Pagination -->
			<div class="pagination-container mb-5">
                <div class="paginate " id="pagination-links">
                    {{$data_blogs->withQueryString()->appends($_GET)->links('.frontend.component.paginate')}}
                </div>
			</div>

		</div>
	</div>
	<!-- Blog Posts / End -->


	<!-- Widgets -->
	<div class="five columns blog">

		<!-- Search -->
		<div class="widget">
			<h4>Search</h4>
			<div class="widget-box search">
				<div class="input"><input class="search-field" type="text" placeholder="To search type and hit enter" value=""/></div>
			</div>
		</div>

		<div class="widget">
			<h4>Got any questions?</h4>
			<div class="widget-box">
				<p>If you are having any questions, please feel free to ask.</p>
				<a href="../contact/contact.php" class="button widget-btn"><i class="fa fa-envelope"></i> Drop Us a Line</a>
			</div>
		</div>

		<!-- Tabs -->
		<div class="widget">

			<ul class="tabs-nav blog">
				<li class="active"><a href="#tab1">Popular</a></li>
				<li><a href="#tab2">Featured</a></li>
				<li><a href="#tab3">Recent</a></li>
			</ul>

			<!-- Tabs Content -->
			<div class="tabs-container">

				<div class="tab-content" id="tab1">

					<!-- Recent Posts -->
					<ul class="widget-tabs">

						<!-- Post #1 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">How to "Woo" a Recruiter and Land Your Dream Job</a></h5>
								<span>September 12, 2015</span>
							</div>
							<div class="clearfix"></div>
						</li>

						<!-- Post #2 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">Hey Job Seeker, It’s Time To Get Up And Get Hired</a></h5>
								<span>October 10, 2015</span>
							</div>
							<div class="clearfix"></div>

						</li>

						<!-- Post #3 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">11 Tips to Help You Get New Clients Through Cold Calling</a></h5>
								<span>August 27, 2015</span>
							</div>
							<div class="clearfix"></div>
						</li>
					</ul>

				</div>

				<div class="tab-content" id="tab2">

					<!-- Featured Posts -->
					<ul class="widget-tabs">

						<!-- Post #1 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">Hey Job Seeker, It’s Time To Get Up And Get Hired</a></h5>
								<span>October 10, 2015</span>
							</div>
							<div class="clearfix"></div>

						</li>

						<!-- Post #2 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">How to "Woo" a Recruiter and Land Your Dream Job</a></h5>
								<span>September 12, 2015</span>
							</div>
							<div class="clearfix"></div>
						</li>

						<!-- Post #3 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">11 Tips to Help You Get New Clients Through Cold Calling</a></h5>
								<span>August 27, 2015</span>
							</div>
							<div class="clearfix"></div>
						</li>
					</ul>
				</div>

				<div class="tab-content" id="tab3">

					<!-- Recent Posts -->
					<ul class="widget-tabs">

						<!-- Post #1 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">11 Tips to Help You Get New Clients Through Cold Calling</a></h5>
								<span>August 27, 2015</span>
							</div>
							<div class="clearfix"></div>
						</li>

						<!-- Post #2 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">Hey Job Seeker, It’s Time To Get Up And Get Hired</a></h5>
								<span>October 10, 2015</span>
							</div>
							<div class="clearfix"></div>

						</li>

						<!-- Post #3 -->
						<li>
							<div class="widget-thumb">
								<a href="detail.blade.php"><img src="" alt="" /></a>
							</div>

							<div class="widget-text">
								<h5><a href="detail.blade.php">How to "Woo" a Recruiter and Land Your Dream Job</a></h5>
								<span>September 12, 2015</span>
							</div>
							<div class="clearfix"></div>
						</li>
					</ul>
				</div>

			</div>
		</div>


		<div class="widget">
			<h4>Social</h4>
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>

		</div>

		<div class="clearfix"></div>
		<div class="margin-bottom-40"></div>

	</div>
	<!-- Widgets / End -->


</div>


@stop
