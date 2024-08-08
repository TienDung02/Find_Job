<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = checkUser();
        $data_jobs = job::query()->where('category_id', $id)->paginate(7);
        return view('frontend.job.browser', compact('data', 'data_jobs'));
    }
    public function browser(Request $request)
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
        $data_jobs = job::query()->latest()->paginate(7);
        return view('frontend.job.browser', compact('data', 'data_jobs'));
    }
    public function alert(Request $request)
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
        return view('frontend.job.alerts', compact('data'));
    }
    public function manage(Request $request)
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
        return view('frontend.job.manage', compact('data'));
    }
    public function create(Request $request)
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
        return view('frontend.job.add', compact('data'));
    }
    public function detail(Request $request, $id)
    {
        $data = checkUser();
        $data_jobs = job::query()->findOrFail($id);
        return view('frontend.job.detail', compact('data', 'data_jobs'));
    }

}
