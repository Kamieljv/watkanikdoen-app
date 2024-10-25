<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    public function isLoggedIn(Request $request)
    {
        if (auth()->user()->id === $request->user_id) {
            return response(['status' => 'success', 'user' => auth()->user()->id], 200);
        }

        return response(['status' => 'failed'], 200);
    }

    protected function authenticated(Request $request, $user)
    {
        if (setting('auth.verify_email') && !$user->verified) {
            // If user email is not verified, log out and
            $this->guard()->logout();
            return False;
        } else {
            return True;
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

        $authenticated = $this->authenticated($request, $this->guard()->user());

        if ($request->expectsJson()) {
            if (!$authenticated) {
                return response(['status' => 'failed', 'message' => __('auth.please_verify_email')], 200);
            }
            return response([
                'status' => 'success',
                'user' => auth()->user(),
                'redirect' => session('url.intended') ?? $this->redirectPath()
            ], 200);
        } else {
            if (!$authenticated) {
                return redirect()->back()->with('warning', __('auth.please_verify_email'));
            }
            return redirect()->intended($this->redirectPath());
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->expectsJson()) {
            return response(['status' => 'failed', 'message' => trans('auth.failed')], 200);
        } else {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
