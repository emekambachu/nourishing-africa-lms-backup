<?php

use App\Http\Controllers\ExportDiagnosticTool\DiagnosticApplicationController;
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
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updateProfile']);

    // Profile update request
    Route::get('/yaedp/get/update-request',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'getUpdateRequest']);
    Route::post('/yaedp/submit/update-request',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'submitUpdateProfileRequest']);

    // Update Email
    Route::post('/yaedp/update-email',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updateEmail']);

    // Update Password
    Route::post('/yaedp/update-password',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updatePassword'])
        ->name('yaedp.update-password');

});

// get all states
Route::get('/states', [App\Http\Controllers\Api\BaseController::class, 'getStates']);

// YAEDP Export Diagnostic Tool
Route::post('/yaedp/export-diagnostic/login', [DiagnosticApplicationController::class, 'login']);
Route::get('/yaedp/export-diagnostic/get-question', [DiagnosticApplicationController::class, 'getQuestion']);
Route::post('/yaedp/export-diagnostic/submit-question', [DiagnosticApplicationController::class, 'submitQuestion']);


