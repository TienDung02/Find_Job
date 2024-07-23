<?php

namespace App\Http\Controllers;

use App\Models\candidate;
use App\Models\category;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
class CandidateController extends Controller
{

    private $getCandidate;
    private $search;


    public function index(Request $request)
    {
        $data = candidate::query();

        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit-candidate', 5);
        $data = $data->paginate($limit);

        $candidate = $this->search($type, $keyword);
        $aa = candidate::where('id_candidate', $keyword)->get();
//        $candidate = $candidate->get();
//        if ($candidate->isNotEmpty()) {
//            $data = $candidate;
//        }

        return view('admin.candidate.admin_candidate_page', compact('data', 'aa'));
    }

    public function getLimit (Request $request) {
        $data = candidate::query();

        $keyword = $request->input('keyword', '1');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);

        $candidate = $this->search($type, $keyword);
//        $aa = candidate::where('id_candidate', $keyword)->get();

        if ($candidate) {
            $data = $candidate;
        }
        return view('admin.candidate.ajax.candidate_table', compact('data'));
    }

    public function edit($id_candidate)
    {
        $data = candidate::findOrFail($id_candidate);
        $educations = $data->educations;
        $experience = $data->experience;
        $network_profile = $data->network_profile;
        return view('admin.candidate.admin_view_candidate', compact('data', 'educations', 'experience', 'network_profile' ));
    }

    public function search($type, $keyword)
    {
        if ($type == 'email') {
            $this->getCandidate =  candidate::where('id_candidate', $keyword)->get();
        }else{
            $this->getCandidate = candidate::where(function($query) use ($keyword) {
                $query->where('first_name', 'like', "%$keyword%")
                    ->orWhere('last_name', 'like', "%$keyword%")->get();
            });
        }
        return $this->getCandidate;
    }

    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $email = $request->input('data_first_suggest', null);

        $query = candidate::query();

        if ($type === 'email') {
            if ($keyword) {
                $query->where('id_candidate', $keyword);
            }
        }
        else if ($type === 'name') {
            if ($email) {
                $query->where('email', $email);
            }
            if ($keyword) {
                $query->where('id_candidate', $keyword);
            }
        }
        $suggestions = $query->get(['id_candidate', 'email', 'first_name', 'last_name']);
        $suggestions = $suggestions->map(function ($item) {
            return [
                'id_data' => $item->id_candidate, // Đổi tên trường từ id_candidate thành id
                'data1' => $item->email,
                'data2' => $item->last_name . " " . $item->first_name
            ];
        });
//        print_r($suggestions)
        return response()->json($suggestions);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
        ]);
        $id_candidate = candidate::find($id);
        if (!$id_candidate) {
            return redirect()->route('categories.index')->with('error', 'candidate not found.');
        }
        $id_candidate->parent_id = $request->input('parent_id');
        $id_candidate->name = $request->input('name');
        if ($id_candidate->save()) {
            toastr()->success('Update candidate successfully!');
        } else {
            toastr()->error('There was an error updating a candidate!');
            return back();
        }

        return redirect()->route('categories.index');
    }

}
