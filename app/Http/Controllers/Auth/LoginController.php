<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        if (setting('auth.email_or_username')) {
            return setting('auth.email_or_username');
        }

        return 'email';
    }

    public function showLoginForm()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if (setting('auth.verify_email') && !$user->verified) {
            $this->guard()->logout();
            return redirect()->back()->with('warning', __('auth.please_verify_email'));
        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }


    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
