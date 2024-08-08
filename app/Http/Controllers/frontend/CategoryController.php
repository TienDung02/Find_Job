<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $data_categories = Category::query()->where('parent_id', 0)->get();


        return view('frontend.category.index', compact('data', 'data_categories'));
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
//    public function create(Request $request)
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
//        return view('frontend.resumes.add', compact('data'));
//    }

}
