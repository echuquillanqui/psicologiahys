<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function username()
    {
        return 'login';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login_type' => ['required', 'in:system,patient'],
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $loginType = $request->input('login_type');
        $field = $loginType === 'patient' ? 'username' : 'email';
        $login = $this->loginValue($request);
        $user = User::where($field, $login)->first();

        if (! $user || ! $user->active || ($loginType === 'patient') !== ($user->profile === 'patient')) {
            return false;
        }

        return Auth::attempt([
            $field => $login,
            'password' => $request->input('password'),
        ], $request->boolean('remember'));
    }

    private function loginValue(Request $request): string
    {
        $login = trim($request->input('login'));

        if ($request->input('login_type') === 'patient') {
            return preg_replace('/\s+/', '', $login);
        }

        return $login;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
