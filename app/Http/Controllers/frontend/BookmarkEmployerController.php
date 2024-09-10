<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\Bookmark;
use App\Models\Candidate;
use App\Models\CandidateResume;
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
use Meilisearch\Client;

class BookmarkEmployerController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $id_resumes = Bookmark::query()->where('user_id', Session::get('user_data.id'))->pluck('resume_id');
            $data_resumes = CandidateResume::query()->whereIn('id', $id_resumes)->paginate(5);
            $data_tags = Tag::query()->get();
            return view('frontend.bookmark.employer_bookmark', compact('data_tags', 'data_resumes'));
        }
        return redirect()->route('home.index');
    }
    public function suggest(Request $request){
        $keyword = $request->input('keyword');
        $type = $request->input('type');

        $query_province = Province::query();
        $query_district = District::query();

        if ($request->input('province')){
            $results = $query_district->where('province_id', $request->input('province'))->where('name', 'like', "%$keyword%")->get();
        }

        if ($type == 'province'){
            $results = $query_province->where('name', 'like', "%$keyword%")->get();
        }
        if ($type == 'district'){
            $results = $query_district->where('name', 'like', "%$keyword%")->get();
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
        $data_resumes = $this->getTable($request);
        $data_tags = Tag::query()->get();
        return view('frontend.bookmark.ajax.select_search_resumes_result', compact( 'data_resumes', 'data_tags'));
    }
    public function getTable ($request) {
        $now = Carbon::now();
        $id_resumes = Bookmark::query()->where('user_id', Session::get('user_data.id'))->pluck('resume_id');
        if (isset($request->type) && $request->type != ''){
            if ($request->type == "province"){
                $data_resumes = CandidateResume::query()->where('province_id', $request->value)->whereIn('id', $id_resumes)->paginate(7);
            }elseif ($request->type == "district"){
                $data_resumes = CandidateResume::query()->where('district_id', $request->value)->whereIn('id', $id_resumes)->paginate(7);
            }
            return $data_resumes;
        }else{
            if ($request->value == "DESC"){
                $data_resumes = CandidateResume::orderByRaw("
                    CASE
                        WHEN type_salary = 2 THEN salary
                        WHEN type_salary = 1 THEN maximum_salary
                        WHEN type_salary = 3 THEN 0
                        ELSE NULL
                    END DESC
                ")->whereIn('id', $id_resumes)->paginate(5);
            }elseif ($request->value == "ASC"){
                $data_resumes = CandidateResume::orderByRaw("
                    CASE
                        WHEN type_salary = 2 THEN salary
                        WHEN type_salary = 1 THEN minimum_salary
                        WHEN type_salary = 3 THEN 0
                        ELSE NULL
                    END ASC
                ")->whereIn('id', $id_resumes)->paginate(5);
            }else{
                $data_resumes = CandidateResume::query()->whereIn('id', $id_resumes)->latest()->paginate(5);
            }
            return $data_resumes;
        }
    }
    public function select2_search(Request $request){
        $data_resumes = $this->getTable($request);
        $data_tags = Tag::query()->get();
        return view('frontend.bookmark.ajax.select_search_resumes_result', compact( 'data_resumes', 'data_tags'));
    }
    public function __invoke(Request $request)
    {
        $id_resumes = Bookmark::query()->where('user_id', Session::get('user_data.id'))->pluck('resume_id');
        $client = new Client('http://127.0.0.1:7700', 'masterKey');

        $client->index('candidate_resumes')->updateSettings([
            'filterableAttributes' => ['id', 'user_id', 'resume_id'],
        ]);
        if ($query = $request->get('query')) {
            $filters = 'id IN [' . implode(',', $id_resumes->toArray()) . ']';

            $data_resumes = CandidateResume::search($query, function ($meilisearch, $query, $options) use ($filters) {
                $options['filter'] = '';
                return $meilisearch->search($query, $options);
            })->paginate(5);
        }

        $data_tags = Tag::query()->get();
        return view('frontend.bookmark.employer_bookmark', compact( 'data_resumes', 'data_tags'));
    }
}
