<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\Bookmark;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\District;
use App\Models\Employer;
use App\Models\Blog;
use App\Models\Industry;
use App\Models\Job;
use App\Models\Province;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\DataModel;


class BookmarkCandidateController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $id_jobs = Bookmark::query()->where('user_id', Session::get('user_data.id'))->pluck('job_id');
            $data_jobs = Job::query()->whereIn('id', $id_jobs)->paginate(7);
            $data_tags = Tag::query()->get();
            $full_time = Job::where('job_type_id', 1)->whereIn('id', $id_jobs)->count();
            $part_time = Job::where('job_type_id', 2)->whereIn('id', $id_jobs)->count();
            $intern = Job::where('job_type_id', 3)->whereIn('id', $id_jobs)->count();
            $freelance = Job::where('job_type_id', 4)->whereIn('id', $id_jobs)->count();
            $tempo = Job::where('job_type_id', 5)->whereIn('id', $id_jobs)->count();
            $jobTypes = [
                1 => $full_time,
                2 => $part_time,
                3 => $intern,
                4 => $freelance,
                5 => $tempo,
            ];
            return view('frontend.bookmark.candidate_bookmark', compact('data_tags', 'jobTypes', 'data_jobs'));
        }
        return redirect()->route('home.index');
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
    public function select_search(Request $request){
        $data_tag = Tag::query()->get();
        $data_jobs = $this->getTable($request);
        return view('frontend.bookmark.ajax.select_search_jobs_result', compact( 'data_jobs', 'data_tag'));
    }
    public function getTable ($request) {
        $now = Carbon::now();
        $id_jobs = Bookmark::query()->where('user_id', Session::get('user_data.id'))->pluck('job_id');
        if (isset($request->type) && $request->type != ''){
            if ($request->type == "province"){
                $data_jobs = Job::query()->where('province_id', $request->value)->whereIn('id', $id_jobs)->paginate(7);
            }elseif ($request->type == "district"){
                $data_jobs = Job::query()->where('district_id', $request->value)->whereIn('id', $id_jobs)->paginate(7);
            }
            return $data_jobs;
        }else{
            if (isset($request->job_type) && $request->job_type != ''){
                if ($request->job_type == 0){
                    $data_jobs = Job::query()->whereIn('id', $id_jobs)->paginate(7);
                }else{
                    $data_jobs = Job::query()->where('job_type_id', $request->job_type)->whereIn('id', $id_jobs)->paginate(7);
                }
                return $data_jobs;
            }elseif (isset($request->id) && $request->id != ''){
                $company_ids = Company::query()->where('industry_id', $request->id)->pluck('id');
                $data_jobs = Job::query()->whereIn('company_id', $company_ids)->whereIn('id', $id_jobs)->paginate(7);
                return $data_jobs;
            }else{
                if ($request->value == "oldest"){
                    $data_jobs = Job::query()
                        ->orderBy('created_at', 'asc')->whereIn('id', $id_jobs)
                        ->paginate(7);
                }elseif ($request->value == "expiry"){
                    $data_jobs = Job::query()
                        ->orderByRaw('ABS(DATEDIFF(closing_day, ?))', [$now])->whereIn('id', $id_jobs)
                        ->paginate(7);
                }elseif ($request->value == "recent"){
                    $data_jobs = Job::query()
                        ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, created_at, ?))', [$now])->whereIn('id', $id_jobs)
                        ->paginate(7);
                }else{
                    $data_jobs = job::query()->whereIn('id', $id_jobs)->latest()->paginate(7);
                }
                return $data_jobs;
            }
        }
    }
    public function select2_search(Request $request){
        $data_tag = Tag::query()->get();
        $data_jobs = $this->getTable($request);
        return view('frontend.bookmark.ajax.select_search_jobs_result', compact( 'data_jobs', 'data_tag'));
    }
    public function checkbox_search(Request $request){
        $data_tag = Tag::query()->get();
        $data_jobs = $this->getTable($request);
        return view('frontend.bookmark.ajax.select_search_jobs_result', compact( 'data_jobs', 'data_tag'));
    }
    public function __invoke(Request $request)
    {
        $id_jobs = Bookmark::query()->where('user_id', Session::get('user_data.id'))->pluck('job_id');

        if ($query = $request->get('query')){
            $filters = 'id IN [' . implode(',', $id_jobs->toArray()) . ']';
            $data_jobs = Job::search($query, function ($meilisearch, $query, $options) use ($filters) {
                $options['filter'] = $filters;
                return $meilisearch->search($query, $options);
            })->paginate(7);
        }

        $data_tag = Tag::query()->get();
        $count_job = Job::query()->count();
        $full_time = Job::where('job_type_id', 1)->whereIn('id', $id_jobs)->count();
        $part_time = Job::where('job_type_id', 2)->whereIn('id', $id_jobs)->count();
        $intern = Job::where('job_type_id', 3)->whereIn('id', $id_jobs)->count();
        $freelance = Job::where('job_type_id', 4)->whereIn('id', $id_jobs)->count();
        $tempo = Job::where('job_type_id', 5)->whereIn('id', $id_jobs)->count();
        $jobTypes = [
            1 => $full_time,
            2 => $part_time,
            3 => $intern,
            4 => $freelance,
            5 => $tempo,
        ];
        $data_tags = Tag::query()->get();
        return view('frontend.bookmark.candidate_bookmark', compact( 'data_jobs', 'data_tag', 'jobTypes', 'count_job', 'data_tags'));
    }
}
