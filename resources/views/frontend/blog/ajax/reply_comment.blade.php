@foreach($reply_comments as $reply)
    @if($reply->user->role == 2)
        @php $user = $reply->candidate @endphp
    @elseif($reply->user->role == 3)
        @php $user = $reply->employer @endphp
    @endif
    @php
        $reply_comment_array = $reply->toArray();
         $images = array_filter($reply_comment_array, function($key) {
            return preg_match('/^img_\d+$/', $key);
        }, ARRAY_FILTER_USE_KEY);
    @endphp
    <li >
        <div class="avatar"><img src="{{$user->avatar}}" alt="" /></div>
        <div class="comment-content"><div class="arrow-comment"></div>
            <div class="comment-by">{{$user->first_name . ' ' . $user->last_name}}<span class="date">{{getDayDifference($reply)}}</span>
                <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>

            </div>

            <div class="text-center d-flex flex-wrap">
                @foreach($images as $key => $img)
                    @if(isset($img) && $img != '')
                        <img class="img-comment ms-2 me-2" src="{{asset($img)}}">
                    @endif
                @endforeach
            </div>
            <p><a class="cursor-pointer text-href fw-semibold">{{'@'.$reply->user->user_name}}</a>&nbsp;{{$reply['content']}}</p>
        </div>
    </li>
@endforeach
{{--@if($blog_comment->reply()->count() > 1)--}}
{{--    <div class="mt-4 mb-4"> <a data-comment-id="{{$blog_comment->id}}"> {{$blog_comment->reply()->count() . ' comments'}} &nbsp;<i class="bi bi-caret-down-fill"></i></a> </div>--}}
{{--@endif--}}
