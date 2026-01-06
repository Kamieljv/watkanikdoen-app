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
        ];
        if (env('APP_ENV') == 'production') {
            $rules['h-captcha-token'] = ['required', new ValidHCaptcha()];
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

        $counter = 1;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
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
        $type = 'register';
        return view('auth.login', compact('type'));
    }

    public function verify(Request $request, $verification_code)
    {
        $user = User::where('verification_code', '=', $verification_code)->first();
        
        if (!$user) {
            return redirect()->route('login')->with('error', __('auth.email_verify_error'));
        }

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

        session(['email' => $user->email]);

        if (setting('auth.verify_email')) {
            if ($request->expectsJson()) {
                return response([
                    'status' => 'success',
                    'userId' => $user->id,
                    'redirect' => route('registration.complete') ?? $this->redirectPath()
                ], 200);
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

}
