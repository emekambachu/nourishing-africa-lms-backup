<?php

use App\Http\Controllers\Auth\Yaedp\YaedpLoginController;
use App\Http\Controllers\Auth\Yaedp\YaedpResetPasswordController;
use App\Http\Controllers\GithubDeploymentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Yaedp\YaedpAccountController;
use App\Http\Controllers\Yaedp\YaedpDocumentUploadController;
use App\Http\Controllers\Yaedp\YaedpSelectedUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

// Redirect to external NA full url
Route::get('home', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('home');
Route::get('about', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('about');
Route::get('team', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('team');
Route::get('careers', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('careers');
Route::get('entrepreneurs', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('entrepreneurs');
Route::get('membership', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('membership');
Route::get('esp/page', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('esp.page');
Route::get('esp/login', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('esp.login');
Route::get('data', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('data');
Route::get('funding', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('funding');
Route::get('capacity-building', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('capacity-building');
Route::get('events', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('events');
Route::get('jobs', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('jobs');
Route::get('trainings', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('trainings');
Route::get('training-innovation', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('training-innovation');
Route::get('technology-innovation', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('technology-innovation');
Route::get('ask-an-expert', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('ask-an-expert');
Route::get('association-directory', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('association-directory');
Route::get('first-thursdays', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('first-thursdays');
Route::get('podcasts', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('podcasts');
Route::get('food', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('food');
Route::get('chefs-and-cooks', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('chefs-and-cooks');
Route::get('news-and-updates', static function (){
    return Redirect::to('http://nourishingafrica.com');
})->name('news-and-updates');
Route::get('member/login', static function (){
    return Redirect::to('http://nourishingafrica.com/login');
})->name('member.login');


// Disable default auth
Auth::routes([
    'register' => false,
    'login' => false,
    'reset' => false,
    'verify' => false
]);

// Public
Route::get('/yaedp/images', static function (){
    return view('terms');
})->name('yaedp.terms');

Route::get('/yaedp/videos', static function (){
    return view('terms');
})->name('yaedp.terms');

// YAEDP Login
Route::get('/', static function (){
    return view('auth.yaedp.login');
});

Route::get('/yaedp/login', [YaedpLoginController::class, 'showLoginForm'])
    ->name('yaedp.login');
Route::get('/yaedp', [YaedpLoginController::class, 'showLoginForm'])
    ->name('yaedp.login');

Route::post('/yaedp/login/submit', [YaedpLoginController::class, 'login'])
    ->name('yaedp.login.submit');
Route::get('/yaedp/logout', [YaedpLoginController::class, 'logout'])
    ->name('yaedp.logout');

// YAEDP Password Reset
Route::get('/yaedp/forgot-password', [YaedpResetPasswordController::class, 'forgotPassword'])
    ->name('yaedp.forgot-password');
Route::post('/yaedp/forgot-password/send-link', [YaedpResetPasswordController::class, 'sendPasswordResetLink'])
    ->name('yaedp.forgot-password.send-link');
Route::get('/yaedp/password-reset-token/{token}', [YaedpResetPasswordController::class, 'passwordResetToken'])
    ->name('yaedp.password-reset-token');
Route::post('/yaedp/password-reset/confirm/{token}', [YaedpResetPasswordController::class, 'passwordResetConfirm'])
    ->name('yaedp.password-reset-confirm');

//YAEDP Account
Route::get('/yaedp/account',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'dashboard'])
    ->name('yaedp.account');
Route::get('/yaedp/account/modules',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'modules'])
    ->name('yaedp.account.modules');
Route::get('/yaedp/account/{id}/courses',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'courses'])
    ->name('yaedp.account.courses');
Route::get('/yaedp/account/{id}/course',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'course'])
    ->name('yaedp.account.course');
Route::post('/yaedp/account/course/{id}/complete',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'courseComplete'])
    ->name('yaedp.account.course.complete');
Route::get('/yaedp/account/course/download-document/{id}/{file_name}',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'downloadCourseDocument'])
    ->name('yaedp.account.course.download-document');
Route::get('/yaedp/account/faq',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'faq'])
    ->name('yaedp.account.faq');
Route::get('/yaedp/account/self-help',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'selfHelp'])
    ->name('yaedp.account.self-help');
Route::get('yaedp/account/course/{id}/discussions',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'showDiscussions'])
    ->name('yaedp.account.discussion.all');
Route::post('yaedp/account/discussion',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'discussion'])
    ->name('yaedp.account.discussion');
Route::post('yaedp/account/discussion/like',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'likeDiscussion'])
    ->name('yaedp.account.like-discussion');
Route::get('yaedp/account/notifications',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'accountNotifications'])
    ->name('yaedp.account.notifications');
Route::get('yaedp/account/about-program',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'aboutProgram'])
    ->name('yaedp.account.about-program');
Route::get('/yaedp/account/document/uploads', [YaedpDocumentUploadController::class, 'index'])
    ->name('yaedp.account.document-uploads');

// YAEDP Account Business Profile
Route::get('/yaedp/account/business/profile', [YaedpSelectedUserController::class, 'businessProfile'])
    ->name('yaedp.account.business.profile');
Route::get('/yaedp/account/export/resources', [YaedpSelectedUserController::class, 'exportResources'])
    ->name('yaedp.account.export.resources');

// YAEDP Account Settings
Route::get('/yaedp/account/settings',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'accountSettings'])
    ->name('yaedp.account.settings');
Route::get('/yaedp/account/settings/email',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'accountSettingsEmail'])
    ->name('yaedp.account.settings.email');
Route::get('/yaedp/account/settings/password',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'accountSettingsPassword'])
    ->name('yaedp.account.settings.password');
Route::get('/yaedp/account/{token}/email-confirmation',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'emailConfirmationToken'])
    ->name('yaedp.account.email-confirmation.token');

// YAEDP Unauthorized User
Route::get('/yaedp/account/unauthorized', [YaedpAccountController::class, 'unauthorized'])
    ->name('yaedp.account.unauthorized');

// YAEDP Assessment Controller
Route::get('/yaedp/account/assessments',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'index'])
    ->name('yaedp.account.assessments');
Route::get('/yaedp/account/assessment/{id}/start',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'start'])
    ->name('yaedp.account.assessment.start');
Route::get('/yaedp/account/assessment/{id}/questions',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'questions'])
    ->name('yaedp.account.assessment.questions');
Route::post('/yaedp/account/assessment/{id}/submit',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'submitAssessment'])
    ->name('yaedp.account.assessment.submit');
Route::get('/yaedp/account/assessment/certificate',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'certificate'])
    ->name('yaedp.account.assessment.certificate');
Route::get('/yaedp/account/assessment/certificate/download',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'downloadCertificate'])
    ->name('yaedp.account.assessment.certificate.download');

// YAEDP Export Diagnostic tool
Route::get('/yaedp/export-readiness-diagnostic/',
    [App\Http\Controllers\ExportDiagnosticTool\DiagnosticApplicationController::class, 'index'])
    ->name('yaedp.export-diagnostic.index');
Route::get('/yaedp/export-diagnostic/instructions',
    [App\Http\Controllers\ExportDiagnosticTool\DiagnosticApplicationController::class, 'instructions'])
    ->name('yaedp.export-diagnostic.instructions');
Route::get('/yaedp/export-diagnostic/participant-information',
    [App\Http\Controllers\ExportDiagnosticTool\DiagnosticApplicationController::class, 'participantInformation'])
    ->name('yaedp.export-diagnostic.participant-information');
Route::get('/yaedp/export-diagnostic/start',
    [App\Http\Controllers\ExportDiagnosticTool\DiagnosticApplicationController::class, 'start'])
    ->name('yaedp.export-diagnostic.start');
Route::get('/yaedp/export-diagnostic/logout',
    [App\Http\Controllers\ExportDiagnosticTool\DiagnosticApplicationController::class, 'logout'])
    ->name('yaedp.export-diagnostic.logout');


    //new routes for public users

    Route::get('/yaedp/media',
    [App\Http\Controllers\Yaedp\YaedpImageController::class, 'index'])
    ->name('yaedp.media.pictures');
   

    Route::get('/yaedp/media/videos',
    [App\Http\Controllers\Yaedp\YaedpVideoController::class, 'index'])
    ->name('yaedp.media.videos');

   

    Route::get('/yaedp/articles', static function (){
        return view('yaedp.articles.index');
    })->name('yaedp.articles.index');

    Route::get('/yaedp/participant/profile',
    [App\Http\Controllers\Yaedp\YaedpSelectedProductController::class, 'getProductsByValuedChain'])
    ->name('yaedp.participant.profile');

    // Route::get('/yaedp/participant/profile', static function (){
    //     return view('yaedp.participant_profile.index');
    // })->name('yaedp.participant.profile');

    Route::get('/yaedp/participant/profile/{id}', static function (){
        return view('yaedp.participant_profile.show');
    })->name('yaedp.participant.profile.show');

//Tests
Route::get('/yaedp/archive-ineligible-users', [TestController::class, 'archiveIneligibleUsers']);

//Github Deployment
Route::post('/github/deploy', [GithubDeploymentController::class, 'deploy']);
