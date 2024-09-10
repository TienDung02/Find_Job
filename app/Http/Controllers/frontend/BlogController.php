<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\DataModel;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $data_blogs = blog::query()->latest()->paginate(3);
        return view('frontend.blog.index', compact( 'data_blogs'));
    }
    public function detail(Request $request, $id)
    {
        $blog = blog::query()->findOrFail($id);
        $blog_comments = BlogComment::query()->where('blog_id', $id)->where('reply_to', 0)->paginate(3);
        $reply_comments = BlogComment::query()->get();
        $have_more = 1;
        $blog_comments_next = BlogComment::query()->where('blog_id', $id)->where('reply_to', 0)->get();
        if ($blog_comments_next->isEmpty()) {
            $have_more = 0;
        }
        return view('frontend.blog.detail', compact('blog', 'blog_comments', 'reply_comments', 'have_more'));
    }
    public function loadMoreComments(Request $request)
    {
        $page = $request->input('pageParam');
        $id = $request->input('id');
        $perPage = 3;
        $skip = 3;
        $offset = ($page - 1) * $perPage + $skip;
        $blog_comments = BlogComment::where('blog_id', $id)->skip($offset)->take($perPage)->where('reply_to', 0)->get();
        $reply_comments = BlogComment::query()->get();
        $have_more = 1;
        $blog_comments_next = BlogComment::where('blog_id', $id)->skip($offset + 3)->take(1)->where('reply_to', 0)->get();
        if ($blog_comments_next->isEmpty()) {
            $have_more = 0;
        }

        return view('frontend.blog.ajax.load_more_comment', compact('blog_comments', 'reply_comments', 'have_more'));
    }
    public function replyComments(Request $request)
    {
        $id = $request->input('id');
        $reply_comments = BlogComment::where('reply_to', $id)->paginate(3);
        $reply_comments_2 = BlogComment::query()->get();
        return view('frontend.blog.ajax.reply_comment', compact(  'reply_comments', 'reply_comments_2'));
    }

    public function addComment(Request $request, $id)
    {
        print_r($request->all());die;
        $insert_blogComment = new BlogComment();
        $insert_blogComment->blog_id = $id;
        $insert_blogComment->user_id = Session::get('user_data.id');
        $insert_blogComment->content = $request->input('content');
        $insert_blogComment->reply_to = '0';

        foreach ($request->uploaded_images as $key => $file) {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $columnName = 'img_' . ($key + 1);
                $path = $file->store('uploads', 'public'); // Lưu tệp vào thư mục 'uploads'
                $url = asset('storage/' . $path); // Tạo đường dẫn URL
                $insert_blogComment->$columnName = $url; // Gán URL vào cột tương ứng
            }
        }

        $insert_blogComment->save();
        $blog = blog::query()->findOrFail($id);
        $blog_comments = BlogComment::query()->where('blog_id', $id)->get();
        return view('frontend.blog.detail', compact('blog', 'blog_comments'));
    }
//    public function browser(Request $request)
//    {
//        $user = Auth::user();
//        $data = null;
//        if ($user) {
//            if ($user->role == 2) {
//                $data = Candidate::where('user_id', $user->id)->firstOrFail();
//            } elseif ($user->role == 3) {
//                $data = Employer::where('user_id', $user->id)->firstOrFail();
//            }
//        }
//        return view('frontend.resumes.browser', compact('data'));
//    }

}
