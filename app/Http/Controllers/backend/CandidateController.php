<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{

    private $getCandidate;
    private $search;


    public function index(Request $request)
    {
        $data = $this->getTable($request);
        return view('backend.candidate.index', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = $this->getTable($request);
        return view('backend.candidate.ajax.table', compact('data'));
    }

    public function getTable ($request) {
        $data = candidate::query();
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword,$limit);
            if ($search->isNotEmpty()) {
                $data = $search;
            }
        }
        return $data;
    }
    public function edit($id_candidate)
    {
        $data = candidate::findOrFail($id_candidate);
        $educations = $data->educations;
        $user = $data->user;
        $experience = $data->experiences;
        $network_profile = $data->networkProfiles;
//        return $data;
        return view('backend.candidate.view', compact('data', 'educations', 'experience', 'network_profile', 'user' ));
    }
    public function search($type, $keyword,$limit)
    {
        if ($type == 'email') {
            $query = Candidate::whereHas('user', function ($query) use ($keyword) {
                $query->where('email', 'like', "%$keyword%");
            });
        }elseif ($type == 'active'){
            $query =  Candidate::where('active', $keyword);
        }else{
            $query = Candidate::whereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%$keyword%"]);
        }
        return $query->paginate($limit);
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
            ->join('users', 'candidates.user_id', '=', 'users.id')
            ->select('candidates.id', 'users.email as data1',
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
        $data = $this->getTable($request);
        $id = $request->input('id');
        $candidate_id = candidate::find($id);
        if (!$candidate_id) {
            return redirect()->route('candidate.index')->with('error', 'Candidate not found.');
        }
        $candidate_id->active = $request->input('status_to');
        if ($candidate_id->save()) {
            $type_ = $request->input('type_');
            if ($type_ == 'view') {
                toastr()->success('Update candidate successfully!');
                return response()->json([
                    'redirect' => route('candidate.index', compact('data')),
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
