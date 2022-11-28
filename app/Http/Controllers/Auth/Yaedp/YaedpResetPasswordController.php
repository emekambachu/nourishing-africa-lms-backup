<?php

namespace App\Http\Controllers\Auth\Yaedp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordResetRequest;
use App\Services\Base\BaseService;
use App\Services\Learning\Account\PasswordResetService;
use Illuminate\Http\Request;

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
            // process user email, get user info
            $userExists = PasswordResetService::processPasswordReset($request->email);
            // Send password reset link to user email
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

        $verifiedUser = BaseService::yaedpUser()->where([
            ['verification_token', $token]
        ])->first();

        if(!$verifiedUser){
            return view('errors.404');
        }
        return view('auth.yaedp.reset-password', compact('verifiedUser'));
    }

    public function passwordResetConfirm($token, Request $request){

        try {
            PasswordResetService::confirmNewPassword($token, $request);
            return response()->json([
                'success' => true,
                'message' => 'Your password has been updated, login to your account'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }

    }
}
