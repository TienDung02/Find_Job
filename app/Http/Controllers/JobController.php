<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\job;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
class JobController extends Controller
{

    private $getCandidate;
    private $search;


    public function index(Request $request)
    {
        $limit = 5;
        $data = job::with('employer')->paginate($limit);
        return view('admin.job.admin_job_page', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = job::query();
        $data->with('parent');

        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit-job', 5);


        $categories = $this->search($type, $keyword, $limit);

        $data = $data->paginate($limit);
        if ($categories->isNotEmpty()) {
            $data = $categories;
        }

        return view('admin.job.ajax.job_table', compact('data'));
    }

    public function create()
    {
        $name = '';
        $job_id = '';
        $jobList = $this->show();
        return view('admin.job.admin_add_job', compact('jobList', 'name', 'job_id'));
    }

//    public function search($type, $keyword, $limit)
//    {
//        if ($type === 'parent') {
//            $this->search = job::where('parent_id', $keyword)->paginate($limit);
//        }else{
//            $this->search = job::where('id_job', $keyword)->paginate($limit);
//        }
//
//        return $this->search;
//    }

//    public function show($type = 'add', $id=0, $job_id=0, $space='&nbsp;')
//    {
//        $data = job::all();
//        foreach ($data as $value) {
//            if ($type == 'add'){
//                if ($value['parent_id'] == $id){
//                    $this->Getjob .= "<option "  . " value='" . $value['id_job'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
//                    $this->show('add',$value['id_job'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
//                }
//            }
//            else if ($type == 'edit'){
//                if ($job_id == 0){
//                    if ($value['parent_id'] == $id){
//                        $this->Getjob .= "<option "  . " value='" . $value['id_job'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
//                        $this->show($type = 'add', $value['id_job'],$job_id, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
//                    }
//                }else{
//                    $selected = ' ';
//                    if ($value['parent_id'] == $id) {
//                        if ($value['id_job'] == $job_id) {
//                            $selected = 'selected';
//                        }
//                        $this->Getjob .= "<option "  . " value='" . $value['id_job'] . "' $selected>" . $space . "-&nbsp;" . $value['name'] . "</option>";
//                        $this->show('add',$value['id_job'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
//                    }
//                }
//            }
//        }
//
//        return $this->Getjob;
//    }

//    public function store(Request $request)
//    {
//        $data = job::query();
//        $limit = $request->input('limit-job', 5);
//        $data = $data->paginate($limit);
//        $insert_job = new job();
//        $insert_job->name = $request->input('name');
//        $insert_job->parent_id = $request->input('parent_id');
//
//        $jobExists = job::where('name', $insert_job->name)
//            ->where('parent_id', $insert_job->parent_id)
//            ->exists();
//
//        if (!$jobExists) {
//            if ($insert_job->save()) {
//                toastr()->success('Added job successfully!');
//            } else {
//                toastr()->error('There was an error adding a job!');
//                return back();
//            }
//        } else {
//            toastr()->error('This job already exists!');
//            return back();
//        }
//        return view('admin.job.admin_job_page', compact('data'));
//    }



    public function edit($id_job)
    {
        $jobList = job::with('employer')->findOrFail($id_job);
        return view('admin.job.admin_view_job', compact('jobList', ));
    }



    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $parent_id = $request->input('parent_id', null);

        $query = job::query();

        if ($type === 'parent') {
            $query->where('parent_id', 0);
            if ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            }
        } else if ($type === 'job') {
            if ($parent_id) {
                $query->where('parent_id', $parent_id);
            }
            if ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            }
        }

        $suggestions = $query->take(100)->get(['id_job', 'name']);

        return response()->json($suggestions);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
        ]);
        $id_job = job::find($id);
        if (!$id_job) {
            return redirect()->route('categories.index')->with('error', 'job not found.');
        }
        $id_job->parent_id = $request->input('parent_id');
        $id_job->name = $request->input('name');
        if ($id_job->save()) {
            toastr()->success('Update job successfully!');
        } else {
            toastr()->error('There was an error updating a job!');
            return back();
        }

        return redirect()->route('categories.index');
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
