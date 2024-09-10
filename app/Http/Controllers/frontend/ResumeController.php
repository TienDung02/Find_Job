<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateNetworkProfile;
use App\Models\CandidateResume;
use App\Models\District;
use App\Models\Employer;
use App\Models\Industry;
use App\Models\Province;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class ResumeController extends Controller
{
    public function detail(Request $request, $id)
    {
        $data_tag = Tag::query()->get();
        $resumes = CandidateResume::query()->findOrFail($id);
        $educations = CandidateEducation::query()->where('resume_id', $id)->get();
        $experiences = CandidateExperience::query()->where('resume_id', $id)->get();
        $networkProfiles = CandidateNetworkProfile::query()->where('resume_id', $id)->get();

        $check_bookmark = Bookmark::query()->where('resume_id', $id)->where('user_id', \auth()->user()->id)->first();
        if ($check_bookmark){
            $check_bookmark = 1;
        }else{
            $check_bookmark = 2;
        }
        $type = 1;

        return view('frontend.resumes.detail', compact('resumes', 'data_tag', 'educations', 'experiences', 'networkProfiles', 'check_bookmark', 'type'));
    }
    public function manage(Request $request)
    {
        $candidate_id = Candidate::query()->where('user_id', Session::get('user_data.id'))->value('id');
        $resumes = CandidateResume::query()->where('candidate_id', $candidate_id)->get();
        return view('frontend.resumes.manage', compact('resumes'));
    }
    public function create(Request $request)
    {
        $data_tag = Tag::query()->get();
        return view('frontend.resumes.add', compact('data_tag'));
    }
    public function browser(Request $request)
    {
        $resumes = CandidateResume::query()->latest()->paginate(4);
        $data_tag = Tag::query()->get();
        return view('frontend.resumes.browser', compact('resumes', 'data_tag'));
    }
    public function addBookmark($id)
    {

        $insert_bookmark = new Bookmark();
        $insert_bookmark->resume_id = $id;
        $insert_bookmark->user_id = \auth()->user()->id;
        $insert_bookmark->type_bookmark = 1;
        if ($insert_bookmark->save()) {
            Session::put('alert_', [
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
        $remove_bookmark = Bookmark::query()->where('resume_id', $id)->where('user_id', \auth()->user()->id)->first();
        if ($remove_bookmark){
            if ($remove_bookmark->delete()) {
                Session::put('alert_', [
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
    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $request->input('province');
//        return 123;
        $query_province = Province::query();
        $query_district = District::query();
        $query_ward = Ward::query();
        $query_industry = Industry::query();

        if ($request->input('province')){
            $results = $query_district->where('province_id', $request->input('province'))->where('name', 'like', "%$keyword%")->get();
        }elseif ($request->input('district')){
            $results = $query_ward->where('district_id', $request->input('district'))->where('name', 'like', "%$keyword%")->get();
        }else{
            if ($type == 'province') {
                $results = $query_province->where('name', 'like', "%$keyword%")->get();
            } elseif ($type == 'district') {
                $results = $query_district->where('name', 'like', "%$keyword%")->get();
            } elseif ($type == 'ward') {
                $results = $query_ward->where('name', 'like', "%$keyword%")->get();
            } elseif ($type == 'industry'){
                $results = $query_industry->where('name', 'like', "%$keyword%")->get();
            }
        }

        $data = $results->map(function ($item) {
            return [
                'id_data' => $item->id,
                'name' => $item->name,
            ];
        });
        return response()->json($data);
    }
    public function edit(Request $request, $id)
    {
        $data_resume = CandidateResume::query()->findOrFail($id);
        $educations = CandidateEducation::query()->where('resume_id', $id)->get();
        $experiences = CandidateExperience::query()->where('resume_id', $id)->get();
        $networkProfiles = CandidateNetworkProfile::query()->where('resume_id', $id)->get();
        $data_tag = Tag::query()->get();
        return view('frontend.resumes.add', compact('data_resume','educations', 'experiences', 'networkProfiles','data_tag'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $resume = new CandidateResume();
            $user_id = Session::get('user_data.id');
            $candidate_id = Candidate::query()->where('user_id', $user_id)->value('id');
            $resume->candidate_id = $candidate_id;
            $resume->full_name = $request->input('full_name');
            $resume->email = $request->input('email');
            $resume->professional_title = $request->input('professional_title');
            $resume->province_id = $request->input('province_id');
            $resume->district_id = $request->input('district_id');
            $resume->ward_id = $request->input('ward_id');

            $tag = $request->input('tag_id');
            $resume->tag_id = $tag ? implode(', ', $tag) : null;

            $type_salary = $request->input('type_salary');
            if ($type_salary == 1) {
                $resume->minimum_salary = $request->input('minimum_salary') ?? '';
                $resume->maximum_salary = $request->input('maximum_salary') ?? '';
                $resume->salary = null;
            } elseif ($type_salary == 2) {
                $resume->minimum_salary = null;
                $resume->maximum_salary = null;
                $resume->salary = $request->input('salary_fixed') ?? '';
            } else {
                $resume->minimum_salary = null;
                $resume->maximum_salary = null;
                $resume->salary = null;
            }

            $resume->type_salary = $type_salary;
            $resume->resume_content = $request->input('resume_content');

            if (!$resume->save()) {
                throw new \Exception('Failed to save resume data.');
            }

            $networkProfiles = [];
            if ($request->has('nwp_name') && $request->has('nwp_url')) {
                $names = $request->input('nwp_name');
                $urls = $request->input('nwp_url');
                $count = count($names);

                for ($i = 0; $i < $count; $i++) {
                    if (!empty($names[$i]) && !empty($urls[$i])) {
                        $networkProfiles[] = [
                            'resume_id' => $resume->id,
                            'name' => $names[$i],
                            'url' => $urls[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                if (!empty($networkProfiles)) {
                    if (!DB::table('candidate_network_profiles')->insert($networkProfiles)) {
                        throw new \Exception('Failed to insert network profiles data.');
                    }
                }
            }

            $educations = [];
            if ($request->has('school_name') && $request->has('qualification')) {
                $school_name = $request->input('school_name', []);
                $qualification = $request->input('qualification', []);
                $education_start = $request->input('start-education', []);
                $education_end = $request->input('end-education', []);
                $education_note = $request->input('note-education', []);
                $count = count($school_name);

                for ($i = 0; $i < $count; $i++) {
                    if (!empty($school_name[$i]) && !empty($qualification[$i])) {
                        $educations[] = [
                            'resume_id' => $resume->id,
                            'school_name' => $school_name[$i],
                            'qualification' => $qualification[$i],
                            'start_day' => $education_start[$i] ?? null,
                            'end_day' => $education_end[$i] ?? null,
                            'note' => $education_note[$i] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                if (!empty($educations)) {
                    if (!DB::table('candidate_educations')->insert($educations)) {
                        throw new \Exception('Failed to insert education data.');
                    }
                }
            }

            $experiences = [];
            if ($request->has('employer') && $request->has('job_title')) {
                $epx_employer = $request->input('employer', []);
                $job_title = $request->input('job_title', []);
                $job_start = $request->input('start-exp', []);
                $job_end = $request->input('end-exp', []);
                $epx_note = $request->input('note-exp', []);
                $count = count($epx_employer);

                for ($i = 0; $i < $count; $i++) {
                    if (!empty($epx_employer[$i]) && !empty($job_title[$i])) {
                        $experiences[] = [
                            'resume_id' => $resume->id,
                            'employer' => $epx_employer[$i],
                            'job_title' => $job_title[$i],
                            'start_day' => $job_start[$i] ?? null,
                            'end_day' => $job_end[$i] ?? null,
                            'note' => $epx_note[$i] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                if (!empty($experiences)) {
                    if (!DB::table('candidate_experiences')->insert($experiences)) {
                        throw new \Exception('Failed to insert experience data.');
                    }
                }
            }

            DB::commit();

            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Added Job successfully!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();

            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Add fail',
                'alert_text' => 'Something went wrong, please try again later! Error: ' . $e->getMessage(),
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
//        try {
            $resume = CandidateResume::query()->find($id);
            $user_id = Session::get('user_data.id');
            $candidate_id = Candidate::query()->where('user_id', $user_id)->value('id');
            $resume->candidate_id = $candidate_id;
            $resume->full_name = $request->input('full_name');
            $resume->email = $request->input('email');
            $resume->professional_title = $request->input('professional_title');
            $resume->province_id = $request->input('province_id');
            $resume->district_id = $request->input('district_id');
            $resume->ward_id = $request->input('ward_id');

            $tag = $request->input('tag_id');
            $resume->tag_id = $tag ? implode(', ', $tag) : null;

            $type_salary = $request->input('type_salary');
            if ($type_salary == 1) {
                $resume->minimum_salary = $request->input('minimum_salary') ?? '';
                $resume->maximum_salary = $request->input('maximum_salary') ?? '';
                $resume->salary = null;
            } elseif ($type_salary == 2) {
                $resume->minimum_salary = null;
                $resume->maximum_salary = null;
                $resume->salary = $request->input('salary_fixed') ?? '';
            } else {
                $resume->minimum_salary = null;
                $resume->maximum_salary = null;
                $resume->salary = null;
            }

            $resume->type_salary = $type_salary;
            $resume->resume_content = $request->input('resume_content');

            if (!$resume->save()) {
                throw new \Exception('Failed to save resume data.');
            }

            /*------------------------------------------------------------*/
            /* NetworkProfile
            /*------------------------------------------------------------*/
            $nwpNames = $request->input('nwp_name');
            $nwpUrls = $request->input('nwp_url');

            if (is_array($nwpNames) && is_array($nwpUrls)) {
                foreach ($nwpNames as $nwp_id => $names) {
                    if (is_array($names)){
                        foreach ($names as $index => $name) {
                            if ($name != '' && isset($nwpUrls[$nwp_id][0])) {
                                CandidateNetworkProfile::updateOrCreate(
                                    ['id' => $nwp_id],
                                    ['resume_id' => $id, 'name' => $name, 'url' => $nwpUrls[$nwp_id][$index] ?? '']
                                );
                            }
                        }
                    }
                }
            }


            /*------------------------------------------------------------*/
            /* Education
            /*------------------------------------------------------------*/
            $school_name = $request->input('school_name');
            $qualification = $request->input('qualification');
            $education_start = $request->input('start-education');
            $education_end = $request->input('end-education');
            $education_note = $request->input('note-education');

            if (is_array($school_name) && is_array($qualification)) {
                foreach ($school_name as $edu_id => $names) {
                    if (is_array($names)){
                        foreach ($names as $index => $name) {
                            if ($name != '' && isset($qualification[$edu_id][0])) {
                                CandidateEducation::updateOrCreate(
                                    ['id' => $edu_id],
                                    [
                                        'resume_id' => $id,
                                        'school_name' => $name,
                                        'qualification' => $qualification[$edu_id][$index],
                                        'start_day' => $education_start[$edu_id][$index] ?? null,
                                        'end_day' => $education_end[$edu_id][$index] ?? null,
                                        'note' => $education_note[$edu_id][$index] ?? null,
                                    ]
                                );
                            }
                        }
                    }
                }
            }

            /*------------------------------------------------------------*/
            /* Experience
            /*------------------------------------------------------------*/
            $exp_employer = $request->input('employer');
            $job_title = $request->input('job_title');
            $job_start = $request->input('start-exp');
            $job_end = $request->input('end-exp');
            $epx_note = $request->input('note-exp');

            if (is_array($exp_employer) && is_array($job_title)) {
                foreach ($exp_employer as $exp_id => $employers) {
                    if (is_array($employers)) {
                        foreach ($employers as $index => $exp_employer_) {
                            if ($exp_employer_ != '' && isset($job_title[$exp_id][0])) {
                                $data = [
                                    'resume_id' => $id,
                                    'employer' => $exp_employer_,
                                    'job_title' => $job_title[$exp_id][0],
                                    'start_day' => $job_start[$exp_id][0] ?? null,
                                    'end_day' => $job_end[$exp_id][0] ?? null,
                                    'note' => $epx_note[$exp_id][0] ?? null,
                                ];

//                                print_r($data);die;

                                // Debugging output
                                Log::info('Updating or Creating Candidate Experience', $data);

                                CandidateExperience::updateOrCreate(
                                    ['id' => $exp_id],
                                    $data
                                );
                            }
                        }
                    }
                }
            }


            DB::commit();

            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Added Job successfully!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
//        } catch (\Exception $e) {
//            DB::rollBack();
//
//            Session::put('alert_', [
//                'alert_type' => 'error',
//                'alert_title' => 'Add fail',
//                'alert_text' => 'Something went wrong, please try again later! Error: ' . $e->getMessage(),
//                'alert_reload' => 'false',
//            ]);
//            return redirect()->back();
//        }
    }
    public function destroy($id){
        $resume = CandidateResume::query()->findOrFail($id);
        if ($resume->delete()){
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
    public function destroy_nwp($id){
        $data_nwp = CandidateNetworkProfile::query()->find($id);
        if ($data_nwp->delete()){
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
    public function destroy_edu($id){
        $data_edu = CandidateEducation::query()->find($id);
        if ($data_edu->delete()){
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
    public function destroy_exp($id){
        $data_exp = CandidateExperience::query()->find($id);
        if ($data_exp->delete()){
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
}
