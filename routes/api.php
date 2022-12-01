<?php

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\ExportDiagnosticTool\DiagnosticApplicationController;
use App\Http\Controllers\Yaedp\YaedpAccountController;
use App\Http\Controllers\Yaedp\YaedpDocumentUploadController;
use App\Http\Controllers\Yaedp\YaedpSelectedBusinessController;
use App\Http\Controllers\Yaedp\YaedpSelectedCertificationController;
use App\Http\Controllers\Yaedp\YaedpSelectedProductController;
use App\Http\Controllers\Yaedp\YaedpSelectedUserController;
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

// Base Routes
// States
Route::get('/states', [BaseController::class, 'getStates']);
Route::get('/yaedp/value-chains', [BaseController::class, 'valueChains']);

// Sanctum middleware group
Route::middleware('auth:sanctum')->group(function (){

    // Get users with specific guard
    Route::get('yaedp/authenticate', static function (Request $request) {
        return $request->user('yaedp-users');
    });

    // Document Uploads
    Route::get('/yaedp/upload/documents', [YaedpDocumentUploadController::class, 'getDocuments']);
    Route::post('/yaedp/upload/document/create', [YaedpDocumentUploadController::class, 'store']);
    Route::delete('/yaedp/upload/document/{id}/delete', [YaedpDocumentUploadController::class, 'destroy']);

    // Update profile
    Route::post('/yaedp/update-profile', [YaedpAccountController::class, 'updateProfile']);

    // Profile update request
    Route::get('/yaedp/get/update-request', [YaedpAccountController::class, 'getUpdateRequest']);
    Route::post('/yaedp/submit/update-request', [YaedpAccountController::class, 'submitUpdateProfileRequest']);

    // Update Email
    Route::post('/yaedp/update-email',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updateEmail']);

    // Update Password
    Route::post('/yaedp/update-password',
        [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'updatePassword'])
        ->name('yaedp.update-password');

    // YAEDP Selected Users
    // Business Profile
    Route::get('/yaedp/business/{email}/profile', [YaedpSelectedUserController::class, 'getBusinessProfile']);

    // Yaedp User Products
    Route::get('/yaedp/{id}/products', [YaedpSelectedProductController::class, 'getUserProducts']);
    Route::post('/yaedp/{id}/products/add', [YaedpSelectedProductController::class, 'addUserProduct']);
    Route::post('/yaedp/{user_id}/products/{product_id}/update', [YaedpSelectedProductController::class, 'updateUserProduct']);
    Route::delete('/yaedp/{user_id}/products/{product_id}/delete', [YaedpSelectedProductController::class, 'deleteUserProduct']);

    // Yaedp User Business
    Route::get('/yaedp/{id}/business', [YaedpSelectedBusinessController::class, 'getUserBusiness']);
    Route::post('/yaedp/{id}/business/add', [YaedpSelectedBusinessController::class, 'addUserBusiness']);
    Route::post('/yaedp/{user_id}/business/{business_id}/update', [YaedpSelectedBusinessController::class, 'updateUserBusiness']);
    Route::delete('/yaedp/{user_id}/business/{business_id}/delete', [YaedpSelectedBusinessController::class, 'deleteUserBusiness']);

    // Yaedp User Certifications
    Route::get('/yaedp/{id}/certifications',
        [YaedpSelectedCertificationController::class, 'getCertifications']);
    Route::post('/yaedp/{id}/certifications/add',
        [YaedpSelectedCertificationController::class, 'addUserCertifications']);
    Route::post('/yaedp/{user_id}/certifications/{cert_id}/update',
        [YaedpSelectedCertificationController::class, 'updateUserCertification']);
    Route::delete('/yaedp/{user_id}/certifications/{cert_id}/delete',
        [YaedpSelectedCertificationController::class, 'deleteUserCertification']);
});

// YAEDP Export Diagnostic Tool
Route::post('/yaedp/export-diagnostic/login', [DiagnosticApplicationController::class, 'login']);
Route::get('/yaedp/export-diagnostic/get-question', [DiagnosticApplicationController::class, 'getQuestion']);
Route::post('/yaedp/export-diagnostic/question/{id}/answer/store', [DiagnosticApplicationController::class, 'storeAnswer']);
Route::get('/yaedp/export-diagnostic/application/progress', [DiagnosticApplicationController::class, 'applicationProgress']);


