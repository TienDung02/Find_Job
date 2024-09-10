<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        return view('frontend.profile.index', compact('data', 'user'));
    }
    public function update(Request $request)
    {

        $id_user = Session::get('user_data.id');
        $user = User::query()->find($id_user);
        if ($user->role == 2) {
            $data = Candidate::where('user_id', $user->id)->firstOrFail();
        } elseif ($user->role == 3) {
            $data = Employer::where('user_id', $user->id)->firstOrFail();
        }
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $old_avatar = $user->avatar;
        $path = $old_avatar;

        $file = $request->file('avatar');
        if ($file){

            $path = '/storage/'.$file->store('uploads/avatar_user', 'public');
            if ($old_avatar != '/storage/uploads/avatar_user/user.png'){
                $filePath = public_path($old_avatar);
                unlink($filePath);
            }
            $user->avatar = $path;
        }
        if ($user->save()){
            if ($data) {

                $data->tel = $request->input('tel');
                $data->about = $request->input('desc');
                if ($data->save()) {
                    $userData = Session::get('user_data', []);
                    $userData['avatar'] = $path;
                    Session::put('user_data', $userData);
                    toastr()->success('Update profile successfully!');
                } else {
                    toastr()->error('There was an error updating your profile!');
                    return back();
                }
            }
        }

        return redirect()->route('profile');
    }

}
