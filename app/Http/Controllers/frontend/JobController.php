<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\Employer;
use App\Models\Industry;
use App\Models\Job;
use App\Models\ApplyJob;
use App\Models\JobType;
use App\Models\Province;
use App\Models\Tag;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
class JobController extends Controller
{
    public function browser(Request $request)
    {
        $data_tag = Tag::query()->get();
        $count_job = Job::query()->count();
        $full_time = Job::where('job_type_id', 1)->count();
        $part_time = Job::where('job_type_id', 2)->count();
        $intern = Job::where('job_type_id', 3)->count();
        $freelance = Job::where('job_type_id', 4)->count();
        $tempo = Job::where('job_type_id', 5)->count();
        $jobTypes = [
            1 => $full_time,
            2 => $part_time,
            3 => $intern,
            4 => $freelance,
            5 => $tempo,
        ];
        $data_jobs = $this->getTable($request);
        $data_province = Province::query()->get();
        $data_district = District::query()->get();
        return view('frontend.job.browser', compact( 'data_jobs', 'data_tag', 'jobTypes', 'count_job', 'data_province', 'data_district'));
    }
    public function manage()
    {
        $id_user = \auth()->user()->id;
        $id_employer = Employer::query()->where('user_id', $id_user)->value('id');
        $id_company = Company::query()->where('employer_id', $id_employer)->value('id');
        $data_job = Job::query()->where('company_id', $id_company)->paginate(5);
        return view('frontend.job.manage', compact('data_job'));
    }
    public function create()
    {
        $data_tag = Tag::query()->get();
        $data_type_job = JobType::query()->get();
        $data_category = Category::query()->get();
        return view('frontend.job.add', compact('data_tag', 'data_type_job', 'data_category'));
    }
    public function edit($id)
    {
        $data_jobs = job::query()->findOrFail($id);
        $data_tag = Tag::query()->get();
        $data_type_job = JobType::query()->get();
        $data_category = Category::query()->get();
        return view('frontend.job.add', compact('data_tag', 'data_type_job', 'data_category', 'data_jobs'));
    }
    public function detail($id)
    {
        $data = checkUser();
        $data_jobs = job::query()->findOrFail($id);
        $check_bookmark = 0;
        if (Auth::check()) {
            $check_bookmark = Bookmark::query()->where('job_id', $id)->where('user_id', \auth()->user()->id)->first();
            if ($check_bookmark){
                $check_bookmark = 1;
            }else{
                $check_bookmark = 2;
            }
        }
        return view('frontend.job.detail', compact('data', 'data_jobs', 'check_bookmark'));
    }
    public function applyJob(Request $request, $id_job){
        $insert_applyJob = new ApplyJob();
        $job = Job::find($id_job);
        $insert_applyJob->job_id = $id_job;
        $insert_applyJob->company_id = $job->company->id;
        $insert_applyJob->candidate_id = session('user_data')['id'];
        $insert_applyJob->full_name = $request->input('full_name');
        $insert_applyJob->email = session('user_data')['email'];
        $insert_applyJob->message = $request->input('message');
        $file = $request->file('cv');
        if ($file){
            $path = $file->store('uploads', 'public');
            $url = asset('storage/' . $path);
            $insert_applyJob->cv = $url;
        }else{
            $insert_applyJob->cv = '';
        }
        $applyJobExists = ApplyJob::where('job_id', $id_job)
            ->where('candidate_id', session('user_data')['id'])
            ->first();
        if ($applyJobExists){
            $applyJobExists->delete();
        }
        if ($insert_applyJob->save()) {
            Session::put('alert_', [
                'alert_type' => 'success',
                'alert_title' => 'Apply success',
                'alert_text' => '',
                'alert_reload' => 'false',
            ]);
            return back();
        } else {
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Apply fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return back();
        }
    }
    public function addBookmark($id)
    {
        $insert_bookmark = new Bookmark();
        $insert_bookmark->job_id = $id;
        $insert_bookmark->user_id = \auth()->user()->id;
        $insert_bookmark->type_bookmark = 0;
        if ($insert_bookmark->save()) {
            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Bookmark success',
                'alert_text' => '',
                'alert_reload' => 'false',
            ]);
            return back();
        } else {
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Bookmark fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return back();
        }
    }
    public function removeBookmark($id)
    {
        $remove_bookmark = Bookmark::query()->where('job_id', $id)->where('user_id', \auth()->user()->id)->first();
        if ($remove_bookmark){
            if ($remove_bookmark->delete()) {
                Session::put('alert_2', [
                    'alert_type' => 'success',
                    'alert_title' => 'Remove success',
                    'alert_text' => '',
                    'alert_reload' => 'false',
                ]);
                return back();
            } else {
                Session::put('alert_', [
                    'alert_type' => 'error',
                    'alert_title' => 'Bookmark fail',
                    'alert_text' => 'Something went wrong, please try again later!',
                    'alert_reload' => 'false',
                ]);
                return back();
            }
        }
        Session::put('alert_', [
            'alert_type' => 'error',
            'alert_title' => 'Bookmark fail',
            'alert_text' => 'cant find!',
            'alert_reload' => 'false',
        ]);
        return back();

    }
    public function store(Request $request)
    {
        $insert_job = new Job();
        $employer_id = Employer::query()->where('user_id', \auth()->user()->id)->value('id');
        $company = Company::query()->where('employer_id', $employer_id)->first();
        $insert_job->company_id = $company->id;
        $insert_job->title = $request->input('job_title');
        $location = $company->province->name . ', ' . $company->district->name . ', ' . $company->ward->name;
        $insert_job->location = $location;
        $insert_job->job_type_id = $request->input('job_type');

        $category = $request->input('category');
        $category = implode(', ', $category);

        $tag = $request->input('tag');
        $tag = implode(', ', $tag);


        $insert_job->category_id = $category;
        $insert_job->tag_id = $tag;

        $insert_job->spotlight = null;
        $insert_job->description = $request->input('description') ?? ' ';
        $insert_job->job_requirements = $request->input('job_requirements') ?? ' ';
        $insert_job->benefit = $request->input('job_benefit') ?? ' ';

        $type_salary = $request->input('type_salary');
        if ($type_salary == 1){
            $insert_job->minimum_salary = $request->input('minimum_salary') ?? ' ';
            $insert_job->maximum_salary = $request->input('maximum_salary') ?? ' ';
            $insert_job->salary = null;
        }elseif ($type_salary == 2){
            $insert_job->minimum_salary = null;
            $insert_job->maximum_salary = null;
            $insert_job->salary = $request->input('salary_fixed') ?? ' ';
        }else{
            $insert_job->minimum_salary = null;
            $insert_job->maximum_salary = null;
            $insert_job->salary = null;
        }

        $insert_job->type_salary = $type_salary;

        $insert_job->closing_day = $request->input('closing-date') ?? ' ';
        $insert_job->active = 0;
        $insert_job->fill = 0;

//        dd($insert_job);

        if ($insert_job->save()) {
            $employer = Employer::find($employer_id);
            $free_jobs_count = $employer->free_jobs_count;
            $employer->free_jobs_count = $free_jobs_count - 1;
            if ($employer->save()) {
                Session::put('alert_2', [
                    'alert_type' => 'success',
                    'alert_title' => 'Added Job successfully!',
                    'alert_reload' => 'false',
                ]);
                return redirect()->route('job.manage');
            } else {
                Session::put('alert_', [
                    'alert_type' => 'error',
                    'alert_title' => 'Add fail',
                    'alert_text' => 'Something went wrong, please try again later!',
                    'alert_reload' => 'false',
                ]);
                return redirect()->back();
            }
        } else {
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Add fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
        }
    }
    public function update(Request $request, $id) {
        $update_job = Job::query()->findOrFail($id);
        $update_job->title = $request->input('job_title');
        $update_job->job_type_id = $request->input('job_type');
        $category = $request->input('category');
        $category = implode(', ', $category);

        $tag = $request->input('tag');
        $tag = implode(', ', $tag);


        $update_job->category_id = $category;
        $update_job->tag_id = $tag;

        $update_job->spotlight = null;
        $update_job->description = $request->input('description') ?? ' ';
        $update_job->job_requirements = $request->input('job_requirements') ?? ' ';
        $update_job->benefit = $request->input('job_benefit') ?? ' ';
        $type_salary = $request->input('type_salary');
        if ($type_salary == 1){
            $update_job->minimum_salary = $request->input('minimum_salary') ?? ' ';
            $update_job->maximum_salary = $request->input('maximum_salary') ?? ' ';
            $update_job->salary = null;
        }elseif ($type_salary == 2){
            $update_job->minimum_salary = null;
            $update_job->maximum_salary = null;
            $update_job->salary = $request->input('salary_fixed') ?? ' ';
        }else{
            $update_job->minimum_salary = null;
            $update_job->maximum_salary = null;
            $update_job->salary = null;
        }

        $update_job->type_salary = $type_salary;
        $update_job->closing_day = $request->input('closing-date') ?? ' ';

//        dd($insert_job);

        if ($update_job->save()) {
            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Update Job successfully!',
                'alert_reload' => 'false',
            ]);
            return redirect()->route('job.manage');
        } else {
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Update fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
        }
    }
    public function fill($id){
        $job = Job::query()->findOrFail($id);
        $job->fill = 1;
        if ($job->save()){
            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Fill Job successfully!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
        }else{
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Fill fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
        }
    }
    public function destroy($id){
        $job = Job::query()->findOrFail($id);
        if ($job->delete()){
            redirect()->back();
        }else{
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Delete fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
        }
    }
    public function suggest(Request $request){
        $keyword = $request->input('keyword');
        $type = $request->input('type');

        $query_province = Province::query();
        $query_district = District::query();
        $query_industry = Industry::query();

        if ($request->input('province')){
            $results = $query_district->where('province_id', $request->input('province'))->where('name', 'like', "%$keyword%")->get();
        }

        if ($type == 'province'){
            $results = $query_province->where('name', 'like', "%$keyword%")->get();
        }
        if ($type == 'district'){
            $results = $query_district->where('name', 'like', "%$keyword%")->get();
        }
        if ($type == 'industry'){
            $results = $query_industry->where('name', 'like', "%$keyword%")->get();
        }

        $data = $results->map(function ($item) {
            return [
                'id_data' => $item->id,
                'name' => $item->name,
            ];
        });
        return response()->json($data);
    }
    public function __invoke(Request $request)
    {
        $searchQuery = trim($request->get('query')) ?? '';
        $data_jobs = Job::search($searchQuery)->paginate(7);
        $data_tag = Tag::query()->get();
        $count_job = Job::query()->count();
        $full_time = Job::where('job_type_id', 1)->count();
        $part_time = Job::where('job_type_id', 2)->count();
        $intern = Job::where('job_type_id', 3)->count();
        $freelance = Job::where('job_type_id', 4)->count();
        $tempo = Job::where('job_type_id', 5)->count();
        $jobTypes = [
            1 => $full_time,
            2 => $part_time,
            3 => $intern,
            4 => $freelance,
            5 => $tempo,
        ];
        return view('frontend.job.browser', compact( 'data_jobs', 'data_tag', 'jobTypes', 'count_job'));
    }
    public function select_search(Request $request){
        $data_tag = Tag::query()->get();
        $data_jobs = $this->getTable($request);
        return view('frontend.job.ajax.select_search_result', compact( 'data_jobs', 'data_tag'));
    }
    public function getTable ($request) {
        $now = Carbon::now();
        if (isset($request->type) && $request->type != ''){
            if ($request->type == "province"){
                $data_jobs = Job::query()->where('province_id', $request->value)->paginate(7);
            }elseif ($request->type == "district"){
                $data_jobs = Job::query()->where('district_id', $request->value)->paginate(7);
            }
            return $data_jobs;
        }else{
            if (isset($request->job_type) && $request->job_type != ''){
                if ($request->job_type == 0){
                    $data_jobs = Job::query()->paginate(7);
                }else{
                    $data_jobs = Job::query()->where('job_type_id', $request->job_type)->paginate(7);
                }
                return $data_jobs;
            }else{
                if ($request->value == "oldest"){
                    $data_jobs = Job::query()
                        ->orderBy('created_at', 'asc')
                        ->paginate(7);
                }elseif ($request->value == "expiry"){
                    $data_jobs = Job::query()
                        ->orderByRaw('ABS(DATEDIFF(closing_day, ?))', [$now])
                        ->paginate(7);
                }elseif ($request->value == "recent"){
                    $data_jobs = Job::query()
                        ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, created_at, ?))', [$now])
                        ->paginate(7);
                }else{
                    $data_jobs = job::query()->latest()->paginate(7);
                }
                return $data_jobs;
            }
        }
    }
    public function select2_search(Request $request){
        $data_tag = Tag::query()->get();
        $data_jobs = $this->getTable($request);
        return view('frontend.job.ajax.select_search_result', compact( 'data_jobs', 'data_tag'));
    }
    public function checkbox_search(Request $request){
        $data_tag = Tag::query()->get();
        $data_jobs = $this->getTable($request);
        return view('frontend.job.ajax.select_search_result', compact( 'data_jobs', 'data_tag'));
    }
    public function tag_search(Request $request, $id){
        $data_tag = Tag::query()->get();
        $data_jobs = Job::query()
            ->where('tag_id', 'like', $id . ', %')
            ->orWhere('tag_id', 'like', '%, ' . $id . ', %')
            ->orWhere('tag_id', 'like', '%, ' . $id)
            ->orWhere('tag_id', '=', $id)
            ->paginate(7);

        $full_time = Job::where('job_type_id', 1)->count();
        $part_time = Job::where('job_type_id', 2)->count();
        $intern = Job::where('job_type_id', 3)->count();
        $freelance = Job::where('job_type_id', 4)->count();
        $tempo = Job::where('job_type_id', 5)->count();
        $jobTypes = [
            1 => $full_time,
            2 => $part_time,
            3 => $intern,
            4 => $freelance,
            5 => $tempo,
        ];

        $data_province = Province::query()->get();
        $data_district = District::query()->get();
        $count_job = Job::query()->count();
        return view('frontend.job.browser', compact( 'data_jobs', 'data_tag', 'jobTypes', 'count_job', 'data_province', 'data_district'));
    }
}
