<?php

namespace App\Http\Controllers\Auth\Yaedp;

use App\Http\Controllers\Controller;
use App\Http\Requests\LearningLoginRequest;
use App\Models\Learning\LearningLoginSession;
use App\Providers\RouteServiceProvider;
use App\Services\YaedpLoginService;
use App\Traits\IpTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
//    public function __construct()
//    {
//        $this->middleware('guest:yaedp-users')->except('logout');
//    }

    public function showLoginForm(){
        return view('auth.yaedp.login', ['url' => 'yaedp/login']);
    }

    public function login(LearningLoginRequest $request){
        try {
            $response = YaedpLoginService::loginUser($request);
        }catch (\Exception $e) {
            $response = redirect()->back()->with('warning', $e->getMessage());
        }
        return $response;
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
