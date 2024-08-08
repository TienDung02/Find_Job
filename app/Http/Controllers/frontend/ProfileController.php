<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $data = null;
        if ($user) {
            if ($user->role == 2) {
                $data = Candidate::where('user_id', $user->id)->firstOrFail();
            } elseif ($user->role == 3) {
                $data = Employer::where('user_id', $user->id)->firstOrFail();
            }
        }
        return view('frontend.profile.index', compact('data'));
    }
    public function update(Request $request)
    {

        $user = Auth::user();
        $data = null;
        if ($user->role == 2) {
            $data = Candidate::where('user_id', $user->id)->firstOrFail();
        } elseif ($user->role == 3) {
            $data = Employer::where('user_id', $user->id)->firstOrFail();
        }
        if ($data) {
            $data->avatar = $request->input('avatar');
            if ($request->hasFile('avatar')) {

                if ($data->avatar) {
                    Storage::disk('public')->delete($data->avatar);
                }
                $file = $request->file('avatar');
                $path = $file->store('uploads', 'public');
                $url = asset('storage/' . $path);
                $data->avatar = $url;
                $user->save();
            }else{
                $data->avatar = $request->input('avatar_old');
            }
            $data->first_name = $request->input('first_name');
            $data->last_name = $request->input('last_name');
            $data->tel = $request->input('tel');
            $data->about = $request->input('desc');
            if ($data->save()) {
                toastr()->success('Update profile successfully!');
            } else {
                toastr()->error('There was an error updating your profile!');
                return back();
            }
        }
        return view('frontend.profile.index', compact('data'));
    }

}
