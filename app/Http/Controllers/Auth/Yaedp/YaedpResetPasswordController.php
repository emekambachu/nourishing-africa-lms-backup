<?php

namespace App\Http\Controllers\Auth\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\YaedpUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class YaedpResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function forgotPassword(){
        return view('auth.yaedp.forgot-password');
    }

    public function sendPasswordResetLink(Request $request){

        $input = $request->all();
        $rules = [
            'email' => 'email|required|min:5',
        ];

        $validator = Validator::make($input, $rules);

        // Validate the input and return correct response
        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ], 400); // 400 being the HTTP code for an invalid request.
        }

        $userExists = YaedpUser::where([
            ['email', $input['email']]
        ])->first();

        if(!$userExists){
            return response()->json([
                'success' => false,
                'message' => 'Email does not exist',
            ]);
        }

        function verificationToken($length = 12){
            $characters = '0123456789ABCDEFGHI';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $userExists->verification_token = verificationToken();
        $userExists->save();

        // data for email
        $data = [
            'name' => $userExists->name,
            'email' => $userExists->email,
            'verification_token' => $userExists->verification_token,
        ];

        // Send email to the NA Team
        Mail::send('emails.yaedp.password-reset-link', $data, static function ($message) use ($data) {
            $message->from('info@nourishingafrica.com', 'YAEDP: Password Reset');
            $message->to($data['email']);
            $message->replyTo('yaedp@nourishingafrica.com', 'YAEDP: Password Reset');
            $message->subject('YAEDP Password Reset Link');
        });

        // check for failures
        if(Mail::failures()) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to send email',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'A password reset link has been sent to '.$data['email'], ', click on the link to proceed'
        ], 200);
    }

    public function passwordResetToken($token){
        $verifiedUser = YaedpUser::where([
            ['verification_token', $token]
        ])->first();

        if(!$verifiedUser){
            return view('errors.404');
        }
        return view('auth.yaedp.reset-password', compact('verifiedUser'));
    }

    public function passwordResetConfirm($token, Request $request){

        $password = $request->input('password');

        $userToken = YaedpUser::where([
            ['verification_token', $token]
        ])->first();

        if(!$userToken){
            return response()->json(['errors' => 'Incorrect password reset token'], 404);
        }

        $userToken->password = bcrypt($password);
        $userToken->save();

        return response()->json(['success' => 'Your password has been updated, login to your account'], 200);
    }
}
