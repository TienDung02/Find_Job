<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getTable($request);
        return view('backend.job.index', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = $this->getTable($request);
        return view('backend.job.ajax.table', compact('data'));
    }

    public function getTable ($request) {
        $data = job::query();
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

    public function create()
    {
        $name = '';
        $job_id = '';
        $jobList = $this->show();
        return view('backend.job.admin_add_job', compact('jobList', 'name', 'job_id'));
    }

    public function search($type, $keyword,$limit)
    {
        if ($type == 'company') {
            $query = job::whereHas('company', function ($query) use ($keyword) {
                $query->where('company_name', 'like', "%$keyword%");
            });
        }elseif($type == 'active'){
            $query = job::where('active', $keyword);
        }else{
            $query =  job::where('title', 'like', "%$keyword%");
        }
        return $query->paginate($limit);
    }
    public function edit($id_job)
    {
        $job = job::with('company')->findOrFail($id_job);
        return view('backend.job.view', compact('job'));
    }



    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');

        $query = Job::query();

        if ($type == 'company') {
            $query->whereHas('company', function ($query) use ($keyword) {
                $query->where('company_name', 'like', '%' . $keyword . '%');
            });
        } elseif ($type == 'title') {
            $query->where('title', 'like', '%' . $keyword . '%');
        }
        $data = $query
            ->join('companies', 'jobs.company_id', '=', 'companies.id')
            ->select('jobs.id', 'companies.company_name as data1', 'jobs.title as data2', 'jobs.active as data3')
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
        $job_id = job::find($id);
        if (!$job_id) {
            return redirect()->route('job.index')->with('error', 'Job not found.');
        }
        $job_id->active = $request->input('status_to');
        if ($job_id->save()) {
            $type_ = $request->input('type_');
            if ($type_ == 'view') {
                toastr()->success('Update candidate successfully!');
                return response()->json([
                    'redirect' => route('job.index' ,compact('data')),
                    'message' => 'Update candidate successfully!'
                ]);
            } else {
                toastr()->success('Update candidate successfully!');
                return redirect()->back();
            }
        } else {
            toastr()->error('There was an error updating a industry!');
//            return back();
        }
    }


    public function destroy($id)
    {
        $job = job::find($id);

        if (!$job) {
            toastr()->error('job not found.');
            return redirect()->route('industry.index');
        }

        if ($job->delete()) {
            toastr()->success('job deleted successfully!');
            return redirect()->back();
        } else {
            toastr()->error('There was an error deleting the job!');
            return redirect()->back();
        }
    }
}
