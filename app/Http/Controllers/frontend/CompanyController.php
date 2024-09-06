<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\District;
use App\Models\Employer;
use App\Models\Industry;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function create(Request $request)
    {
        $company = '';
        $employer = Employer::query()->where('user_id', \auth()->user()->id)->value('id');
        $company = Company::query()->where('employer_id', $employer)->first();
        return view('frontend.company.add', compact('company'));
    }
    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $request->input('province');

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
    public function store(Request $request)
    {
        $insert_company = new Company();
        $employer_id = Employer::query()->where('user_id', \auth()->user()->id)->value('id');
        $insert_company->employer_id = $employer_id;
        $insert_company->company_name = $request->input('company_name');
        $insert_company->company_tagline = $request->input('company_tagline') ?? ' ';
        $insert_company->province_id = $request->input('province') ?? ' ';
        $insert_company->district_id = $request->input('district') ?? ' ';
        $insert_company->ward_id = $request->input('ward') ?? ' ';
        $insert_company->headquarters = $request->input('address') ?? ' ';
        $insert_company->company_website = $request->input('company_website') ?? ' ';
        $insert_company->email = $request->input('company_email') ?? ' ';
        $insert_company->phone = $request->input('company_phone') ?? ' ';
        $insert_company->twitter = $request->input('company_twitter') ?? ' ';
        $insert_company->facebook = $request->input('company_facebook') ?? ' ';
        $insert_company->industry_id = $request->input('industry') ?? ' ';
        $insert_company->company_size = $request->input('company_size') ?? ' ';
        $insert_company->description = $request->input('desc') ?? ' ';
        $insert_company->active = 0;



        $company_logo = $request->file('company_logo');
        if ($company_logo){
            $path_logo = $company_logo->store('uploads/company/logo', 'public');
            $url_logo = asset('storage/' . $path_logo);
            $insert_company->company_logo = $url_logo;
        }else{
            $insert_company->company_logo = $request->input('avatar_old');
        }


//        dd($company_logo);
//        dd($insert_company);

        if ($insert_company->save()) {
            $company = '';
            $employer = Employer::query()->where('user_id', \auth()->user()->id)->value('id');
            $company = Company::query()->where('employer_id', $employer)->first();
            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Added company successfully!',
                'alert_reload' => 'false',
            ]);
            return view('frontend.company.add', compact('company'));
        } else {
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Add fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return back();
        }

    }
    public function update(Request $request, $id)
    {
        $update_company = Company::find($id);
        $employer_id = Employer::query()->where('user_id', \auth()->user()->id)->value('id');
        $update_company->employer_id = $employer_id;
        $update_company->company_name = $request->input('company_name');
        $update_company->company_tagline = $request->input('company_tagline') ?? ' ';
        $update_company->province_id = $request->input('province') ?? ' ';
        $update_company->district_id = $request->input('district') ?? ' ';
        $update_company->ward_id = $request->input('ward') ?? ' ';
        $update_company->headquarters = $request->input('address') ?? ' ';
        $update_company->company_website = $request->input('company_website') ?? ' ';
        $update_company->email = $request->input('company_email') ?? ' ';
        $update_company->phone = $request->input('company_phone') ?? ' ';
        $update_company->twitter = $request->input('company_twitter') ?? ' ';
        $update_company->facebook = $request->input('company_facebook') ?? ' ';
        $update_company->industry_id = $request->input('industry') ?? ' ';
        $update_company->company_size = $request->input('company_size') ?? ' ';
        $update_company->description = $request->input('desc') ?? ' ';



        $file = $request->file('company_logo');
        if ($file){

            $path = $file->store('uploads', 'public');
//            $url = asset('storage/' . $path);
            $update_company->company_logo = $path;
        }else{
            $update_company->company_logo = $request->input('avatar_old');
        }

//        dd($insert_company);

        if ($update_company->save()) {
            Session::put('alert_2', [
                'alert_type' => 'success',
                'alert_title' => 'Company updated successfully!',
                'alert_reload' => 'false',
            ]);
            return redirect()->route('company.add');
        } else {
            Session::put('alert_', [
                'alert_type' => 'error',
                'alert_title' => 'Updated fail',
                'alert_text' => 'Something went wrong, please try again later!',
                'alert_reload' => 'false',
            ]);
            return redirect()->back();
        }

    }

}
