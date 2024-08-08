<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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
        $data_jobs = job::query()->latest()->limit(5)->get();
        $data_blogs = Blog::query()->latest()->limit(3)->get();

        return view('frontend.home.index', compact('data', 'data_jobs', 'data_blogs'));
    }
}
