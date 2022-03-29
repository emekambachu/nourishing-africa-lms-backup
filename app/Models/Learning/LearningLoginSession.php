<?php

namespace App\Models\Learning;

use App\Models\YaedpUser;
use App\Traits\IpTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningLoginSession extends Model
{
    use IpTrait;

    protected $fillable = [
        'user_id',
        'email',
        'ip',
        'user_agent',
        'updated_at'
    ];

    public function yaedpUser(){
        $this->belongsTo(YaedpUser::class, 'email', 'email');
    }

    public static function getSession(Request $request){
        // Get User Agent (Browser and device)
        $user_agent = (new \Illuminate\Http\Request)->server('HTTP_USER_AGENT');
        $ip = self::getIp($request);

        $loginSession = new self();
        $hasSession = $loginSession->where('user_id', Auth::user()->id)->first();

        if($hasSession){
            $hasSession->update([
                'ip' => $ip,
                'user_agent' => $user_agent,
            ]);
        }else{
            $loginSession->create([
                'user_id' => $loginSession->id,
                'ip' => $ip,
                'user_agent' => $user_agent,
            ]);
        }
    }

}
