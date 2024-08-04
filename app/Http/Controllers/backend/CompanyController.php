<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    private $search;


    public function index(Request $request)
    {
        $data = $this->getTable($request);
        return view('backend.company.index', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = $this->getTable($request);
        return view('backend.company.ajax.table', compact('data'));
    }

    public function getTable ($request) {
        $data = company::query();
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        if ($keyword != '' && $keyword != null)
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
        $category_id = '';
        $categoryList = $this->show();
        return view('backend.category.add', compact('categoryList', 'name', 'category_id'));
    }

    public function search($type, $keyword, $limit)
    {
        if ($type == 'employer') {
            $query = company::wherehas('employer', function ($query) use ($keyword) {
                $query->whereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%$keyword%"]);
            });
        }elseif ($type == 'active'){
            $query = company::where('active', $keyword);
        }elseif ($type == 'company'){
            $query =  company::where("company_name", 'like' , ["%$keyword%"]);
        }
        return $query->paginate($limit);
    }

    public function edit($id)
    {
        $company = company::with('industry')->findOrFail($id);
        return view('backend.company.view', compact('company'));
    }



    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $query = company::query();
        if ($type == 'employer') {
            $query->whereHas('employer', function ($query) use ($keyword) {
                $query->whereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%$keyword%"]);
            });
        } elseif ($type == 'company') {
            $query->where('company_name', 'like', '%' . $keyword . '%');
        }

        $data = $query
            ->join('employers', 'companies.employer_id', '=', 'employers.id')
            ->select('companies.id', 'companies.company_name as data2', 'companies.active as data3', \DB::raw("CONCAT(employers.last_name, ' ', employers.first_name) as data1"))
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
        $company = company::find($id);
        if (!$company) {
            return redirect()->route('backend.company.index')->with('error', 'Company not found.');
        }
        $company->active = $request->input('status_to');
        if ($company->save()) {
            $type_ = $request->input('type_');
            if ($type_ == 'view') {
                toastr()->success('Update company successfully!');
                return response()->json([
                    'redirect' => route('company.index', compact('data')),
                    'message' => 'Update company successfully!'
                ]);
            } else {
                toastr()->success('Update company successfully!');
                return redirect()->back();
            }
        } else {
            toastr()->error('There was an error updating a category!');
//            return redirect()->back();
        }
    }
}
