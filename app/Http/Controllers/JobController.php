<?php

namespace App\Http\Controllers;

use App\Models\candidate;
use App\Models\categories;
use App\Models\company;
use App\Models\job;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $data = job::query();
        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);

        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword,$limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                if ($type == 'active'){
                    $search = '';
                }
            }
        }

        return view('admin.job.index', compact('data', 'search'));
    }

    public function getLimit (Request $request) {
        $data = job::query();
        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);

        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword,$limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                if ($type == 'active'){
                    $search = '';
                }
            }
        }
        return view('admin.job.ajax.table', compact('data', 'search'));
    }

    public function create()
    {
        $name = '';
        $job_id = '';
        $jobList = $this->show();
        return view('admin.job.admin_add_job', compact('jobList', 'name', 'job_id'));
    }

    public function search($type, $keyword,$limit)
    {
        if ($type == 'company') {
            return job::whereHas('company', function ($query) use ($keyword) {
                $query->where('company_name', 'like', "%$keyword%");
            })->get();
        }elseif($type == 'active'){
            return job::where('active', $keyword)->paginate($limit);
        }else{
            return job::where('title', 'like', "%$keyword%")->get();
        }
    }
    public function edit($id_job)
    {
        $job = job::with('company')->findOrFail($id_job);
        return view('admin.job.view', compact('job'));
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
            ->join('companies', 'jobs.id_company', '=', 'companies.id_company')
            ->select('jobs.job_id', 'companies.company_name as data1', 'jobs.title as data2', 'jobs.active as data3')
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
        $data = job::query();
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
        $job_id = job::find($id);
        if (!$job_id) {
            return redirect()->route('admin.job.index')->with('error', 'Job not found.');
        }
        $job_id->active = $request->input('status_to');
        $job_id->update_at = Carbon::now();
        if ($job_id->save()) {
            $type_ = $request->input('type_');
            if ($type_ == 'view') {
                toastr()->success('Update candidate successfully!');
                return response()->json([
                    'redirect' => route('job.index' ,compact('data', 'search')),
                    'message' => 'Update candidate successfully!'
                ]);
            } else {
                toastr()->success('Update candidate successfully!');
                return redirect()->back();
            }
        } else {
            toastr()->error('There was an error updating a categories!');
//            return back();
        }
    }


    public function destroy($id)
    {
        $job = job::find($id);

        if (!$job) {
            toastr()->error('job not found.');
            return redirect()->route('categories.index');
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
