<?php

use App\Http\Controllers\GithubDeploymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function (){
    return view('auth.login');
});

// Login and Authentication
Auth::routes();

// Password Reset
Route::get('forgot-password',
    [App\Http\Controllers\Auth\ResetPasswordController::class, 'forgotPassword'])
    ->name('learning.forgot-password');
Route::post('intern-matchmaking/password-reset/send-link',
    [App\Http\Controllers\Auth\ResetPasswordController::class, 'sendPasswordResetLink'])
    ->name('learning.password-reset.send-link');
Route::get('intern-matchmaking/password-reset-token/{token}',
    [App\Http\Controllers\Auth\ResetPasswordController::class, 'passwordResetToken'])
    ->name('learning.password-reset-token');
Route::post('intern-matchmaking/password-reset/confirm/{token}',
    [App\Http\Controllers\Auth\ResetPasswordController::class, 'passwordResetConfirm'])
    ->name('learning.password-reset-confirm');

//Github Deployment
Route::post('github/deploy', [GithubDeploymentController::class, 'deploy']);
