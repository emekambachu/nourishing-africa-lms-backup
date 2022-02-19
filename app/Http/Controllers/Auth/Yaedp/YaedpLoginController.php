<?php

namespace App\Http\Controllers\Auth\Yaedp;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class YaedpLoginController extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:yaedp-users')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.yaedp.login', ['url' => 'yaedp/login']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('yaedp-users')->attempt([
            'email' => $request->email,
            'password' => $request->password],
            $request->get('remember'))) {

            return redirect()->intended('/yaedp/account');
        }
        Session::flash('warning', 'Incorrect Login Details');
        return back()->withInput($request->only('email', 'remember'));
    }

    //add for logout function to work
    use AuthenticatesUsers {
        logout as performLogout;
    }

    //perform logout
    public function logout(){
        Auth::guard('yaedp-users')->logout();
        return redirect()->route('yaedp.login');
    }
}
