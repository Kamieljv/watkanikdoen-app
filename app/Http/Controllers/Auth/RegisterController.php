<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Mail\VerifyEmail;
use App\Rules\ValidHCaptcha;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' =>
            [
                'complete',
            ]]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:' . config('app.auth.min_password_length') . '|confirmed',
            'terms' => 'required',
        ];
        if (env('APP_ENV') == 'production') {
            $rules['h-captcha-response'] = ['required', new ValidHCaptcha()];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        $role = Role::where('name', '=', config('voyager.user.default_role'))->first();

        $verification_code = null;
        $verified = 1;

        if (setting('auth.verify_email', false)) {
            $verification_code = str_random(30);
            $verified = 0;
        }

        if (isset($data['username']) && !empty($data['username'])) {
            $username = $data['username'];
        } elseif (isset($data['name']) && !empty($data['name'])) {
            $username = str_slug($data['name']);
        } else {
            $username = $this->getUniqueUsernameFromEmail($data['email']);
        }

        $username_original = $username;
        $counter = 1;

        while (User::where('username', '=', $username)->first()) {
            $username = $username_original . (string)$counter;
            $counter += 1;
        }


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $username,
            'password' => bcrypt($data['password']),
            'role_id' => $role->id,
            'verification_code' => $verification_code,
            'verified' => $verified,
            'trial_ends_at' => null,
        ]);

        if (setting('auth.verify_email', false)) {
            $this->sendVerificationEmail($user);
        }

        return $user;
    }

    private function sendVerificationEmail($user)
    {
        Notification::route('mail', $user->email)->notify(new VerifyEmail($user));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function verify(Request $request, $verification_code)
    {
        $user = User::where('verification_code', '=', $verification_code)->first();

        $user->verification_code = null;
        $user->verified = 1;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('login')->with('success', __('auth.email_verify_success'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        event(new Registered($user));

        if (setting('auth.verify_email')) {
            if ($request->expectsJson()) {
                return response(['status' => 'success', 'user' => $user], 200);
            } else {
                return redirect(route('registration.complete'))->with(['email' => $user->email]);
            }
        } else {
            $this->guard()->login($user);

            return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with('success', __('auth.register_complete_heading'));
        }
    }

    /**
     * Send user to the registration completed page
     */
    public function complete()
    {
        return view('auth.register-complete');
    }

    public function getUniqueUsernameFromEmail($email)
    {
        $username = strtolower(trim(str_slug(explode('@', $email)[0])));

        $new_username = $username;

        $user_exists = User::where('username', '=', $username)->first();
        $counter = 1;
        while (isset($user_exists->id)) {
            $new_username = $username . $counter;
            $counter += 1;
            $user_exists = User::where('username', '=', $new_username)->first();
        }

        $username = $new_username;

        if (strlen($username) < 4) {
            $username = $username . uniqid();
        }

        return strtolower($username);
    }
}
