<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $data = null;
        if ($user) {
            if ($user->role == 2) {
                $data = Candidate::where('user_id', $user->id)->firstOrFail();
            } elseif ($user->role == 3) {
                $data = Employer::where('user_id', $user->id)->firstOrFail();
            }
        }
        $data_blogs = blog::query()->latest()->paginate(3);
        return view('frontend.blog.index', compact('data', 'data_blogs'));
    }
//    public function manage(Request $request)
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
//        return view('frontend.resumes.manage', compact('data'));
//    }
    public function detail(Request $request, $id)
    {
        $user = Auth::user();
        $data = null;
        if ($user) {
            if ($user->role == 2) {
                $data = Candidate::where('user_id', $user->id)->firstOrFail();
            } elseif ($user->role == 3) {
                $data = Employer::where('user_id', $user->id)->firstOrFail();
            }
        }
        $blog = blog::query()->findOrFail($id);
        return view('frontend.blog.detail', compact('data', 'blog'));
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
