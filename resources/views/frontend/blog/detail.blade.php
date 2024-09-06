@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>


<!-- Titlebar
================================================== -->
<div id="titlebar" >
	<div class="container">

		<div class="sixteen columns">
			<h2>Blog</h2>
{{--			<h2>{{dd($blog_comments)}}</h2>--}}
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

			<!-- Post -->
			<div class="post-container">
				<div class="post-img"><a  class="d-flex justify-content-center"><img src="{{asset($blog->img)}}" alt="" class="object-fit-cover"></a></div>
				<div class="post-content">
					<a href="#"><h3> {{$blog->title}} </h3></a>
					<div class="meta-tags">
						<span>{{$blog->updated_at}}</span>
						<span><a href="#">{{$blog->comments()->count()}} {{$blog->comments()->count() > 1 ? 'comments' : 'comment'}}</a></span>
					</div>
					<div class="clearfix"></div>
					<div class="margin-bottom-25"></div>

					<p>{{$blog->desc}}</p>

{{--					<div class="post-quote">--}}

{{--					</div>--}}

                    <p>
                        {{$blog->content}}
                    </p>

				</div>
			</div>

			<!-- Comments -->
			<section class="comments">
			<h4>Comments <span class="comments-amount">({{$blog->comments()->count()}})</span></h4>

				<ul id="loading">
                    @foreach($blog_comments as $blog_comment)
                        @php
                            $blog_comment_array = $blog_comment->toArray();
                             $images = array_filter($blog_comment_array, function($key) {
                                return preg_match('/^img_\d+$/', $key);
                            }, ARRAY_FILTER_USE_KEY);
                        @endphp
                        @if($blog_comment->user->role == 2)
                            @php $user = $blog_comment->candidate @endphp
                        @elseif($blog_comment->user->role == 3)
                            @php $user = $blog_comment->employer @endphp
                        @endif
					<li>
						<div class="avatar"><img src="{{$user->avatar}}" alt="" /></div>
						<div class="comment-content"><div class="arrow-comment"></div>
							<div class="comment-by">{{$user->first_name . ' ' . $user->last_name}}<span class="date">{{getDayDifference($blog_comment)}}</span>
								<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
							</div>
                            <div class="text-center d-flex flex-wrap">

                                @foreach($images as $key => $img)
                                    @if(isset($img) && $img != '')
                                        <img class="img-comment ms-2 me-2" src="{{asset($img)}}">
                                    @endif
                                @endforeach
                            </div>

							<p>{{$blog_comment['content']}}</p>
						</div>
                        @if($blog_comment->reply()->count() > 1)
                        <div class="mt-4 mb-4"> <a id="load-reply" data-comment-id="{{$blog_comment->id}}"> {{$blog_comment->reply()->count() . ' comments'}} &nbsp;<i class="bi bi-caret-down-fill"></i></a> </div>
                        @elseif($blog_comment->reply()->count() == 1)
                        <div class="mt-4 mb-4"> <a id="load-reply" data-comment-id="{{$blog_comment->id}}"> {{$blog_comment->reply()->count() . ' comment'}} &nbsp;<i class="bi bi-caret-down-fill"></i></a> </div>
                        @endif
                        <ul class="reply-{{$blog_comment->id}} d-none"></ul>
					</li>
                    @endforeach
				 </ul>
				@if($have_more == 1)
					<span id="get-url" data-url="{{route('blog.load_more_comment')}}" data-url-reply="{{route('blog.reply_comment', $blog->id)}}" data-id="{{$blog->id}}"></span>
					<div class="w-100 border-bottom margin-bottom-40"><a id="load-more" class="cursor-pointer text-href fw-semibold border-top  pt-2 pb-2 d-flex w-100 justify-content-center" data-next-page="1">Load More </a></div>
				@else
					<div class="w-100 border-bottom margin-bottom-40">
						<div class="d-flex border-top pt-2 pb-2 w-100 justify-content-center fw-semibold">No Comments</div>
					</div>
				@endif
			</section>


			<div class="clearfix"></div>
			<div class="margin-top-35"></div>


			<!-- Add Comment -->
			<h4 class="comment border-bottom">Add Comment</h4>
			<div class="margin-top-20"></div>

			<!-- Add Comment Form -->
            <div class="d-flex">
            <div class="col-2"><a href="{{route('blog.detail', Session::get('user_data.id'))}}">
                    <img class="w-75 img-comment object-fit-contain" src="{{Session::get('user_data.avatar')}}" alt=""></a>
            </div>
			<form id="" class="margin-bottom-90 border border-radius-5 col-10" action="{{route('blog.comment', $blog->id)}}" method="post" enctype="multipart/form-data">
                @csrf
				<fieldset>

                    <input type="file" name="uploaded_images[]" id="file-list" class="file-img d-none" multiple>
{{--                    <div id="images"></div>--}}
					<div class="margin-bottom-40">
                        <div class="d-flex p-2">
                            <a class="img-comment btn-add-img d-none btn-select-img mt-2"><i class="bi bi-plus-lg"></i></a>
                            <div id="image-preview" class="text-center d-flex flex-wrap">
                            </div>
                        </div>
                        <textarea id="myTextarea" name="content" class="border-0"></textarea>
                        <div class="d-flex position-relative pt-4 ">
                            <div class=" icon-textarea position-absolute start-0"><a class="text-secondary ms-3 emoji hover-button"><i class="bi bi-emoji-smile"></i></a><a class="ms-4 text-secondary hover-button btn-select-img"><i class="bi bi-image"></i></a></div>
                            <div class="icon-textarea position-absolute end-0"><a class="text-secondary me-5 hover-button"><button style="height: 40px" class="d-flex align-items-center"><i class="bi bi-send"></i></button></a></div>

                        </div>
                    </div>

				</fieldset>


			</form>
            </div>

		</div>
	</div>
	<!-- Blog Posts / End -->


{{--	<!-- Widgets -->--}}
{{--	<div class="five columns blog">--}}

{{--		<!-- Search -->--}}
{{--		<div class="widget">--}}
{{--			<h4>Search</h4>--}}
{{--			<div class="widget-box search">--}}
{{--				<div class="input"><input class="search-field" type="text" placeholder="To search type and hit enter" value=""/></div>--}}
{{--			</div>--}}
{{--		</div>--}}

{{--		<div class="widget">--}}
{{--			<h4>Got any questions?</h4>--}}
{{--			<div class="widget-box">--}}
{{--				<p>If you are having any questions, please feel free to ask.</p>--}}
{{--				<a href="../contact/contact.php" class="button widget-btn"><i class="fa fa-envelope"></i> Drop Us a Line</a>--}}
{{--			</div>--}}
{{--		</div>--}}

{{--		<!-- Tabs -->--}}
{{--		<div class="widget">--}}

{{--			<ul class="tabs-nav blog">--}}
{{--				<li class="active"><a href="#tab1">Popular</a></li>--}}
{{--				<li><a href="#tab2">Featured</a></li>--}}
{{--				<li><a href="#tab3">Recent</a></li>--}}
{{--			</ul>--}}

{{--			<!-- Tabs Content -->--}}
{{--			<div class="tabs-container">--}}

{{--				<div class="tab-content" id="tab1">--}}

{{--					<!-- Recent Posts -->--}}
{{--					<ul class="widget-tabs">--}}

{{--						<!-- Post #1 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-01.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">How to "Woo" a Recruiter and Land Your Dream Job</a></h5>--}}
{{--								<span>September 12, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}
{{--						</li>--}}

{{--						<!-- Post #2 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-02.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">Hey Job Seeker, It’s Time To Get Up And Get Hired</a></h5>--}}
{{--								<span>October 10, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}

{{--						</li>--}}

{{--						<!-- Post #3 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-03.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">11 Tips to Help You Get New Clients Through Cold Calling</a></h5>--}}
{{--								<span>August 27, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}
{{--						</li>--}}
{{--					</ul>--}}

{{--				</div>--}}

{{--				<div class="tab-content" id="tab2">--}}

{{--					<!-- Featured Posts -->--}}
{{--					<ul class="widget-tabs">--}}

{{--						<!-- Post #1 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-02.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">Hey Job Seeker, It’s Time To Get Up And Get Hired</a></h5>--}}
{{--								<span>October 10, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}

{{--						</li>--}}

{{--						<!-- Post #2 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-01.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">How to "Woo" a Recruiter and Land Your Dream Job</a></h5>--}}
{{--								<span>September 12, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}
{{--						</li>--}}

{{--						<!-- Post #3 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-03.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">11 Tips to Help You Get New Clients Through Cold Calling</a></h5>--}}
{{--								<span>August 27, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}
{{--						</li>--}}
{{--					</ul>--}}
{{--				</div>--}}

{{--				<div class="tab-content" id="tab3">--}}

{{--					<!-- Recent Posts -->--}}
{{--					<ul class="widget-tabs">--}}

{{--						<!-- Post #1 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-03.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">11 Tips to Help You Get New Clients Through Cold Calling</a></h5>--}}
{{--								<span>August 27, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}
{{--						</li>--}}

{{--						<!-- Post #2 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-02.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">Hey Job Seeker, It’s Time To Get Up And Get Hired</a></h5>--}}
{{--								<span>October 10, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}

{{--						</li>--}}

{{--						<!-- Post #3 -->--}}
{{--						<li>--}}
{{--							<div class="widget-thumb">--}}
{{--								<a href="blog-single-post.html"><img src="images/blog-widget-01.png" alt="" /></a>--}}
{{--							</div>--}}

{{--							<div class="widget-text">--}}
{{--								<h5><a href="blog-single-post.html">How to "Woo" a Recruiter and Land Your Dream Job</a></h5>--}}
{{--								<span>September 12, 2015</span>--}}
{{--							</div>--}}
{{--							<div class="clearfix"></div>--}}
{{--						</li>--}}
{{--					</ul>--}}
{{--				</div>--}}

{{--			</div>--}}
{{--		</div>--}}


{{--		<div class="widget">--}}
{{--			<h4>Social</h4>--}}
{{--				<ul class="social-icons">--}}
{{--					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>--}}
{{--					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>--}}
{{--					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>--}}
{{--					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>--}}
{{--				</ul>--}}
{{--		</div>--}}

{{--		<div class="clearfix"></div>--}}
{{--		<div class="margin-bottom-40"></div>--}}

{{--	</div>--}}
{{--	<!-- Widgets / End -->--}}


</div>
@stop
