<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\company;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class CompanyController extends Controller
{

    private $search;


    public function index(Request $request)
    {
        $data = company::query();
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
        return view('admin.company.index', compact('data', 'search'));
    }

    public function getLimit (Request $request) {
        $data = company::query();
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

        return view('admin.company.ajax.table', compact('data', 'search'));
    }

    public function create()
    {
        $name = '';
        $category_id = '';
        $categoryList = $this->show();
        return view('admin.categories.add', compact('categoryList', 'name', 'category_id'));
    }

    public function search($type, $keyword, $limit)
    {
        $query = company::query();
        if ($type == 'employer') {
            return $query->whereHas('employer', function ($query) use ($keyword) {
                $query->whereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%$keyword%"]);
            })->get();
        }elseif ($type == 'active'){
            return $query->where('active', $keyword)->paginate($limit);
        }elseif ($type == 'company'){
            return $query->where("company_name", 'like' , ["%$keyword%"])->get();
        }
    }

    public function edit($id)
    {
        $company = company::with('industry')->findOrFail($id);
        return view('admin.company.view', compact('company'));
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
            ->join('employers', 'companies.id_employer', '=', 'employers.id_employer')
            ->select('companies.id_company', 'companies.company_name as data2', 'companies.active as data3', \DB::raw("CONCAT(employers.last_name, ' ', employers.first_name) as data1"))
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
        $data = company::query();
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
        $company = company::find($id);
        if (!$company) {
            return redirect()->route('admin.company.index')->with('error', 'Company not found.');
        }
        $company->active = $request->input('status_to');
        $company->update_at = Carbon::now();
        if ($company->save()) {
            $type_ = $request->input('type_');
            if ($type_ == 'view') {
                toastr()->success('Update company successfully!');
                return response()->json([
                    'redirect' => route('company.index', compact('data', 'search')),
                    'message' => 'Update company successfully!'
                ]);
            } else {
                toastr()->success('Update company successfully!');
                return redirect()->back();
            }
        } else {
            toastr()->error('There was an error updating a categories!');
//            return redirect()->back();
        }
    }
}
