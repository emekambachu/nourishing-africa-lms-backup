<?php

namespace App\Services\Learning\Account;

use App\Models\YaedpUser;
use App\Services\BaseService;
use Illuminate\Support\Facades\Mail;

/**
 * Class PasswordResetService.
 */
class PasswordResetService extends BaseService
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

    public static function processPasswordReset($email){

        // get user data from email
        $user = self::yaedpUser()->where([
            ['email', $email]
        ])->first();

        // add verification token to user
        $user->verification_token = self::verificationToken();
        $user->save();

        return $user;
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

    public static function confirmNewPassword($token, $request){

        // check if user token is correct
        $password = $request->input('password');
        $userToken = self::YaedpUser()->where([
            ['verification_token', $token]
        ])->first();

        if(!$userToken){
            return response()->json([
                'success' => false,
                'message' => 'Incorrect password reset token'
            ], 404);
        }

        // update password if user token is correct
        $userToken->password = bcrypt($password);
        $userToken->save();
    }
}
