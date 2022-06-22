<?php

namespace App\Services;

use App\Models\Learning\LearningLoginSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class YaedpLoginService.
 */
class YaedpLoginService extends BaseService
{
    public static function storeLoginSession($request){
        // Get User Agent (Browser and device)
        $user_agent = (new Request)->server('HTTP_USER_AGENT');
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
}
