<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Sanctum middleware group
Route::middleware('auth:sanctum')->group(function (){

    // Get users with specific guard
    Route::get('yaedp/authenticate', static function (Request $request) {
        return $request->user('yaedp-users');
    });

    // Update profile
    Route::post('/yaedp/update-profile',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updateProfile'])
        ->name('yaedp.update-profile');

    Route::get('/yaedp/get/update-request',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'getUpdateRequest'])
        ->name('yaedp.get.update-request');

    Route::post('/yaedp/submit/update-request',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'submitUpdateProfileRequest'])
        ->name('yaedp.submit.update-request');

    // Update Email
    Route::post('/yaedp/update-email',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updateEmail'])
        ->name('yaedp.update-email');

    // Update Password
    Route::post('/yaedp/update-password',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updatePassword'])
        ->name('yaedp.update-password');

});


