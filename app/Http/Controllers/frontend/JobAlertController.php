<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\Blog;
use App\Models\Frequency;
use App\Models\JobAlert;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\DataModel;


class JobAlertController extends Controller
{
    public function index(Request $request)
    {
        $data_alerts = JobAlert::query()->where('candidate_id', DB::table('candidates')->where('user_id', \auth()->user()->id)->value('id'))->paginate(5);
        $data_tags = Tag::query()->get();
        $data_frequencies = Frequency::query()->get();
        return view('frontend.job.alerts', compact('data_alerts','data_tags', 'data_frequencies'));
    }
    public function change_active(Request $request, $id, $active)
    {
        $active = $active == 1 ? 0 : 1;
        $alert= JobAlert::query()->find($id);
        $alert->active = $active;
        if ($alert->save()){
            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Bookmark success',
                'alert_text' => '',
                'alert_reload' => 'false',
            ]);
            return back();
        }else{
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Bookmark fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return back();
        }
    }

}
