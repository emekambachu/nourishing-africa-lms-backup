<?php

namespace App\Http\Controllers\Auth\Yaedp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordResetRequest;
use App\Models\YaedpUser;
use App\Services\Learning\Account\PasswordResetService;
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

    public function sendPasswordResetLink(PasswordResetRequest $request){

        try {
            $userExists = PasswordResetService::processPasswordReset($request);
            $user = PasswordResetService::sendPasswordResetEmail($userExists);

            return response()->json([
                'success' => true,
                'message' => 'A password reset link has been sent to '.$user['email'], ', click on the link to proceed'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 200);
        }

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
