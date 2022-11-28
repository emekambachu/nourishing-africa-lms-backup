<?php

namespace App\Services;

use App\Models\Learning\LearningProfileUpdateRequest;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Class AccountSettingsService.
 */
class AccountSettingsService extends BaseService
{
    public static function submitProfileUpdateRequest($request){
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['learning_category_id'] = self::yaedpId();

        LearningProfileUpdateRequest::create($input);
    }

    public static function emailProfileUpdateRequestToAdmin(){
        // Send email to YAEDP admin after submitting update request
        $data['name'] = Auth::user()->surname.' '.Auth::user()->first_name;
        $data['email_body'] = "<strong>{$data['name']}</strong> has sent a YAEDP profile update request.<br>
                                Click <a href='/admin/learning/3/update-request'>here</a> to go to the admin and access it";
        $adminEmails = ['embachu@nourishingafrica.com', 'reyinfunjowo@nourishingafrica.com', 'tkareem@nourishingafrica.com'];
        Mail::send('emails.index', $data, static function ($message) use ($adminEmails) {
            $message->from('yaedp@nourishingafrica.com', 'African Food Changemakers | YAEDP');
            $message->to($adminEmails);
            $message->replyTo('yaedp@nourishingafrica.com', 'African Food Changemakers | YAEDP');
            $message->subject('YAEDP | Update request');
        });
    }

}
