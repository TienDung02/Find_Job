<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatus;
use App\Models\ApplyJob;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index(Request $request, $id = null)
    {
        $user_id = \auth()->user()->id;
        $employer_id = Employer::query()->where('user_id', $user_id)->value('id');
        $company_id = Company::query()->where('employer_id', $employer_id)->value('id');
        $job_id = 0;
        if ($id){
            $apply_jobs = ApplyJob::query()->where('job_id', $id)->paginate(3);
            $next = ApplyJob::where('company_id', $company_id)->where('job_id', $id)->skip(3)->take(1)->get();
            $job_id = $id;
        }else{
            $apply_jobs = ApplyJob::query()->where('company_id', $company_id)->paginate(3);
            $next = ApplyJob::where('company_id', $company_id)->skip(3)->take(1)->get();
        }
        $application_status = ApplicationStatus::query()->get();
        $have_more = 1;

        if ($next->isEmpty()) {
            $have_more = 0;
        }
        return view('frontend.employer.manage-applications', compact('apply_jobs', 'application_status', 'have_more', 'job_id'));
    }
    public function loadMoreApplications(Request $request)
    {
        $user_id = \auth()->user()->id;
        $id = $request->input('id');
        $employer_id = Employer::query()->where('user_id', $user_id)->value('id');
        $company_id = Company::query()->where('employer_id', $employer_id)->value('id');
        $page = $request->input('pageParam');
        $perPage = 3;
        $skip = 3;
        $offset = ($page - 1) * $perPage + $skip;
        if ($id){
            $apply_jobs = ApplyJob::where('company_id', $company_id)->where('job_id', $id)->skip($offset)->take($perPage)->get();
            $next = ApplyJob::where('company_id', $company_id)->where('job_id', $id)->skip($offset + 3)->take(1)->get();
        }else{
            $apply_jobs = ApplyJob::where('company_id', $company_id)->skip($offset)->take($perPage)->get();
            $next = ApplyJob::where('company_id', $company_id)->skip($offset + 3)->take(1)->get();
        }
        $have_more = 1;
        $application_status = ApplicationStatus::query()->get();
        if ($next->isEmpty()) {
            $have_more = 0;
        }
        return view('frontend.employer.ajax.load_more_applications', compact('apply_jobs',  'have_more', 'application_status'));
    }

    public function update(Request $request, $id){
        $application_update = ApplyJob::query()->findOrFail($id);
        $type = $request->input('type');
        if ($type == 'edit'){
            $rating = floatval($request->input('rating'));
            $application_update->status_id = $request->input('status');

            if ($rating !== null) {
                $candidate = Candidate::query()->findOrFail($application_update->candidate->id);
                $candidate_rating = floatval($candidate->rating);

                if ($application_update->rating !== null) {
                    $rating_before = floatval($application_update->rating);
                    $candidate_rating_before = ($candidate_rating * 2) - $rating_before;
                    $candidate->rating = ($rating + $candidate_rating_before) / 2;
                } else {
                    $candidate->rating = ($rating + $candidate_rating) / 2;
                }

                $application_update->rating = $rating;
                if ($candidate->save()){
                }else{
                    Session::put('alert_', [
                        'alert_type' => 'error',
                        'alert_title' => 'Save fail',
                        'alert_text' => 'Something went wrong, please try again later!',
                        'alert_reload' => 'false',
                    ]);
                    return redirect()->back();
                }
            }
            if ($application_update->save()){
                Session::put('alert_2', [
                    'alert_type' => 'success',
                    'alert_title' => 'Save successfully!',
                    'alert_reload' => 'true',
                ]);
                return redirect()->back();
            }else{
                Session::put('alert_', [
                    'alert_type' => 'error',
                    'alert_title' => 'Save fail',
                    'alert_text' => 'Something went wrong, please try again later!',
                    'alert_reload' => 'false',
                ]);
                return redirect()->back();
            }
        }else if ($type == 'add-node'){
            $application_update->note = $request->input('note');
            if ($application_update->save()){
                Session::put('alert_2', [
                    'alert_type' => 'success',
                    'alert_title' => 'Save successfully!',
                    'alert_reload' => 'true',
                ]);
                return redirect()->back();
            }else{
                Session::put('alert_', [
                    'alert_type' => 'error',
                    'alert_title' => 'Save fail',
                    'alert_text' => 'Something went wrong, please try again later!',
                    'alert_reload' => 'false',
                ]);
                return redirect()->back();
            }
        }
    }

    public function destroy(Request $request, $id){
        $application = ApplyJob::query()->findOrFail($id);
        if ($application->delete()){
            redirect()->back();
        }else{
//            Session::put('alert_', [
//                'alert_type' => 'error',
//                'alert_title' => 'Delete fail',
//                'alert_text' => 'Something went wrong, please try again later!',
//                'alert_reload' => 'false',
//            ]);
            return redirect()->back();
        }
    }
}
