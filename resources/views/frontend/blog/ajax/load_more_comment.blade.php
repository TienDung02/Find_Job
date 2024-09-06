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
{{--            <h2>{{'- '. $blog_comment->reply()->count().' -'}}</h2>--}}
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
<span id="have-more" data-have-more="{{$have_more}}"></span>
