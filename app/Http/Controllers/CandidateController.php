<?php

namespace App\Http\Controllers;

use App\Models\candidate;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class CandidateController extends Controller
{

    private $getCandidate;
    private $search;


    public function index(Request $request)
    {
        $data = candidate::query();
        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword, $limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                if ($type == 'active'){
                    $search = '';
                }
            }
        }
        return view('backend.candidate.index', compact('data', 'search'));
    }

    public function getLimit (Request $request) {
        $data = candidate::query();
        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword, $limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                if ($type == 'active'){
                    $search = '';
                }
            }
        }
        return view('backend.candidate.ajax.table', compact('data', 'search'));
    }
    public function edit($id_candidate)
    {
        $data = candidate::findOrFail($id_candidate);
        $educations = $data->educations;
        $user = $data->user;
        $experience = $data->experience;
        $network_profile = $data->network_profile;
        return view('backend.candidate.view', compact('data', 'educations', 'experience', 'network_profile', 'user' ));
    }
    public function search($type, $keyword,$limit)
    {
        if ($type == 'email') {
            return Candidate::whereHas('user', function ($query) use ($keyword) {
                $query->where('email', 'like', "%$keyword%");
            })->get();
        }elseif ($type == 'active'){
            return Candidate::where('active', $keyword)->paginate($limit);
        }else{
            return Candidate::whereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%$keyword%"])->get();
        }
    }
    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');

        $query = Candidate::query();

        if ($type == 'name') {
            $query->where(function ($query) use ($keyword) {
                $query->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%');
            });
        } elseif ($type == 'email') {
            $query->whereHas('user', function ($query) use ($keyword) {
                $query->where('email', 'like', '%' . $keyword . '%');
            });
        }

        $data = $query
            ->join('user', 'candidates.id_user', '=', 'user.id_user')
            ->select('candidates.id_candidate', 'user.email as data1',
                \DB::raw("CONCAT(candidates.last_name, ' ', candidates.first_name) as data2"), 'candidates.active as data3')
            ->get();
        $data = $data->map(function ($item) {
            return [
                'id_data' => $item->data1,
                'data1' => $item->data1,
                'data2' => $item->data2,
                'data3' => $item->data3
            ];
        });
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $data = candidate::query();
        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        if ($keyword != '') {
            $search = $this->search($type, $keyword, $limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                if ($type == 'active') {
                    $search = '';
                }
            }
        }
        $id = $request->input('id');
        $candidate_id = candidate::find($id);
        if (!$candidate_id) {
            return redirect()->route('backend.candidate.index')->with('error', 'Candidate not found.');
        }
        $candidate_id->active = $request->input('status_to');
        $candidate_id->update_at = Carbon::now();
        if ($candidate_id->save()) {
            $type_ = $request->input('type_');
            if ($type_ == 'view') {
                toastr()->success('Update candidate successfully!');
                return response()->json([
                    'redirect' => route('candidate.index', compact('data', 'search')),
                    'message' => 'Update candidate successfully!'
                ]);
            } else {
                toastr()->success('Update candidate successfully!');
                return redirect()->back();
            }
        } else {
            toastr()->error('There was an error updating a category!');
//            return back();
        }
    }
}
