<?php

namespace App\Services\Learning\Account;

use App\Models\YaedpUser;
use Illuminate\Support\Facades\Mail;

/**
 * Class PasswordResetService.
 */
class PasswordResetService
{
    public static function verificationToken($length = 12){
        $characters = '0123456789ABCDEFGHI';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function processPasswordReset($request){

        $input = $request->all();
        $userExists = YaedpUser::where([
            ['email', $input['email']]
        ])->first();

        if(!$userExists){
            return response()->json([
                'success' => false,
                'message' => 'Email does not exist',
            ]);
        }

        $userExists->verification_token = self::verificationToken();
        $userExists->save();

        return $userExists;
    }

    public static function sendPasswordResetEmail($user){

        // data for email
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'verification_token' => $user->verification_token,
        ];

        // Send email to the NA Team
        Mail::send('emails.yaedp.password-reset-link', $data, static function ($message) use ($data) {
            $message->from('yaedp@nourishingafrica.com', 'Password Reset | Password Reset');
            $message->to($data['email']);
            $message->replyTo('yaedp@nourishingafrica.com', 'Password Reset | Password Reset');
            $message->subject('YAEDP Password Reset Link');
        });

        return $data;
    }
}
