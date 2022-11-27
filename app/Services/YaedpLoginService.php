<?php

namespace App\Services;

use App\Services\Base\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class YaedpLoginService.
 */
class YaedpLoginService extends BaseService
{
    public static function storeLoginSession($request){
        // Get User Agent (Browser and device)
        $user_agent = $request->server('HTTP_USER_AGENT');
        $ip = self::getIp($request);

        $hasSession = BaseService::learningLoginSession()
            ->where('email', $request->email)->first();
        $userId = BaseService::yaedpUser()
            ->where('email', $request->email)->first()->id;

        if($hasSession){
            $hasSession->update([
                'user_id' => $userId,
                'ip' => $ip,
                'user_agent' => $user_agent,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }else{
            BaseService::learningLoginSession()->create([
                'user_id' => $userId,
                'learning_category_id' => 3,
                'email' => $request->email,
                'ip' => $ip,
                'user_agent' => $user_agent,
            ]);
        }
    }

    public static function loginUser($request){

        // authenticate user and check if they are approved
        if(Auth::guard('yaedp-users')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_approved' => 1],
            $request->get('remember'))) {

            // if authenticated store login time and session
            self::storeLoginSession($request);
            // redirect to account
            return redirect()->intended('/yaedp/account');
        }

        Session::flash('warning', 'Incorrect or unauthorized login');
        return back()->withInput($request->only('email', 'remember'));
    }
}
