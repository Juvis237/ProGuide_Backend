<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'admin';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/admin";

    public function __construct()
    {
    }

    public function showLoginForm()
    {
        if (Auth()->check()) {
            return redirect()->route('home');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if (auth()->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home');
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        Auth()->logout();
        return redirect()->route('admin.login');
    }
}
