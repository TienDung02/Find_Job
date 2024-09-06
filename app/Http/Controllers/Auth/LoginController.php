<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request)
    {
//        Session::put('url', [
//            'previous' => url()->previous(),
//        ]);

        return view('auth.login');
    }

    public function login(Request $request)
    {
//        dd(Session::get('url'));
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $data = null;

            $jobs_count = '';

            if ($user) {
                if ($user->role == 2) {
                    $data = Candidate::where('user_id', $user->id)->first();
                } elseif ($user->role == 3) {
                    $data = Employer::where('user_id', $user->id)->first();
                    $jobs_count = $data->free_jobs_count;
                }
            }

            $user = User::query()->where('id', $user->id)->first();

            if ($data) {
                Session::put('user_data', [
                    'id' => \auth()->user()->id,
                    'avatar' => $data->user->avatar ?? '',
                    'name' => $user->first_name . ' ' . $user->last_name ?? '',
                    'email' => \auth()->user()->email ?? '',
                    'free_jobs_count' => $jobs_count
                ]);
            }
            return redirect($this->redirectTo);
        } else {
            toastr()->error('Login failed!');
            return redirect()->route('auth.login');
        }
    }

    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/home');
    }
    public function changePassword(Request $request){
        $user = Auth::user();
        $data = null;
        if ($user) {
            if ($user->role == 2) {
                $data = Candidate::where('user_id', $user->id)->firstOrFail();
            } elseif ($user->role == 3) {
                $data = Employer::where('user_id', $user->id)->firstOrFail();
            }
        }
        return view('frontend.login.change_password', compact('data'));
    }
    public function update(Request $request){
        $user = Auth::user();

        if (!Hash::check($request->cur_password, $user->password)) {
            Session::put('alert_', [
                'alert__type' => 'error',
                'alert__title' => 'Update fail',
                'alert__text' => 'Current password is not correct',
                'alert_reload' => 'false',
            ]);
            return redirect()->route('changePassword');

        }
        if ($request->new_password !== $request->confirm_password) {

            return redirect()->route('changePassword');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        Session::put('alert_', [
            'alert_type' => 'success',
            'alert_title' => 'Update success',
            'alert_text' => '',
            'alert_reload' => 'false',
        ]);
        return redirect()->route('changePassword');
    }
    public function store(Request $request){
//        return 123;
        $insert_user = new User();
        $insert_user->role = $request->input('type_register');
        $insert_user->user_name = $request->input('user_name');
        $insert_user->email = $request->input('email');
        $insert_user->password = Hash::make('123');
        $insert_user->active = 0;

        $userExists = User::where('email', $insert_user->email)->exists();
        if (!$userExists) {
            if ($insert_user->save()) {
                if ($insert_user->role == 2){
                    $new_user = new Candidate();
                    $new_user->rating = '0';
                }elseif($insert_user->role == 3){
                    $new_user = new Employer();
                }
                $user_ = User::query()->where('email', $insert_user->email)->first();
                $user_id = $user_->id;
                $new_user->user_id = $user_id;
                $new_user->avatar = '/storage/uploads/user.png';
                $new_user->first_name = '';
                $new_user->last_name = '';
                $new_user->tel = '';
                $new_user->about = '';
                if ($new_user->save()) {
                    $token = Str::random(32);
                    $activationUrl = route('activate.account', $token);
                    Session::put('alert_', [
                        'email' => $insert_user->email,
                        'activation_token' => $token,
                        'alert_title' => 'Account created successfully.',
                        'alert_text' => 'Please check your email to get your password and activate your account.',
                        'alert_type' => 'success',
                        'alert_reload' => 'false',
                    ]);
                    $data = [
                        'name' => $insert_user->user_name,
                        'password' => 123,
                        'url' => $activationUrl
                    ];
                    $user['to'] = $insert_user->email;
                    Mail::send('.emails.myMailTemplate', $data, function ($messages) use ($user){
                        $messages->to($user['to']);
                        $messages->subject('Activate account');
                    });
                    return redirect()->route('auth.login');
                }
            } else {
                session()->flash('error', 'There was an error adding a category!');
//                return back();
            }
        } else {
            session()->flash('error', 'This category already exists!');
//            return back();
        }
        return redirect()->route('auth.login');

    }
    public function activate(Request $request, $token)
    {
        $tokenFromUrl = $token;
        $tokenFromSession = Session::get('alert_.activation_token');
        if ($tokenFromUrl === $tokenFromSession) {
            $email = Session::get('alert_.email');
            $account = User::query()->where('email', $email)->first();
            if ($account){
                $account->active = 1;
                if ($account->save()) {
                    Session::forget('alert_.activation_token');
                    $userData = Session::get('alert_', []);
                    $userData['alert_title'] = 'Your account has been activated.';
                    $userData['alert_text'] = '';
                    $userData['alert_type'] = 'success';
                    Session::put('alert_', $userData);
                    return redirect()->route('auth.login');
                }
            }
            return 'save fail';
        } else {
            return "Invalid activation token!". '----------' . $tokenFromUrl . '  |-|  ' . $tokenFromSession;
        }
    }
    protected function redirectTo()
    {
        return '/';
    }
    public function authenticated(Request $request)
    {
        $user = Auth::user();
        if(isset($user->block) && $user->block == 1){
            Auth::logout();
            throw ValidationException::withMessages([
                $this->username() => __('BLOCK'),
            ]);
        }
        return Redirect::intended();
    }
}
