<?php

namespace App\Http\Controllers\Auth\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningLoginSession;
use App\Providers\RouteServiceProvider;
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
    use IpTrait;

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

        if(Auth::guard('yaedp-users')->attempt([
            'email' => $request->email,
            'password' => $request->password],
            $request->get('remember'))) {

            $this->authenticated($request);
            return redirect()->intended('/yaedp/account');
        }
        Session::flash('warning', 'Incorrect Login Details');
        return back()->withInput($request->only('email', 'remember'));
    }

    protected function authenticated(Request $request){
        // Get User Agent (Browser and device)
        $user_agent = (new \Illuminate\Http\Request)->server('HTTP_USER_AGENT');
        $ip = self::getIp($request);

        $loginSession = new LearningLoginSession();
        $hasSession = $loginSession->where('email', $request->email)->first();

        if($hasSession){
            $hasSession->update([
                'user_id' => $hasSession->id,
                'ip' => $ip,
                'user_agent' => $user_agent,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }else{
            $loginSession->create([
                'learning_category_id' => 3,
                'email' => $request->email,
                'ip' => $ip,
                'user_agent' => $user_agent,
            ]);
        }
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
