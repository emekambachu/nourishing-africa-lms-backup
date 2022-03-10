<?php

use App\Http\Controllers\Auth\Yaedp\YaedpLoginController;
use App\Http\Controllers\Auth\Yaedp\YaedpResetPasswordController;
use App\Http\Controllers\GithubDeploymentController;
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

// YAEDP Login
Route::get('/', static function (){
    return view('auth.yaedp.login');
});
Route::get('yaedp/login', [YaedpLoginController::class, 'showLoginForm'])
    ->name('yaedp.login');
Route::get('yaedp', [YaedpLoginController::class, 'showLoginForm'])
    ->name('yaedp.login');
Route::post('yaedp/login/submit', [YaedpLoginController::class, 'login'])
    ->name('yaedp.login.submit');
Route::post('yaedp/logout', [YaedpLoginController::class, 'logout'])
    ->name('yaedp.logout');

// YAEDP Password Reset
Route::get('yaedp/forgot-password', [YaedpResetPasswordController::class, 'forgotPassword'])
    ->name('yaedp.forgot-password');
Route::post('yaedp/forgot-password/send-link', [YaedpResetPasswordController::class, 'sendPasswordResetLink'])
    ->name('yaedp.forgot-password.send-link');
Route::get('yaedp/password-reset-token/{token}', [YaedpResetPasswordController::class, 'passwordResetToken'])
    ->name('yaedp.password-reset-token');
Route::post('yaedp/password-reset/confirm/{token}', [YaedpResetPasswordController::class, 'passwordResetConfirm'])
    ->name('yaedp.password-reset-confirm');

// Account
Route::get('yaedp/account',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'dashboard'])
    ->name('yaedp.account');
Route::get('yaedp/account/modules',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'modules'])
    ->name('yaedp.account.modules');
Route::get('yaedp/account/{id}/courses',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'courses'])
    ->name('yaedp.account.courses');
Route::get('yaedp/account/{id}/course',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'course'])
    ->name('yaedp.account.course');
Route::post('yaedp/account/course/{id}/complete',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'courseComplete'])
    ->name('yaedp.account.course.complete');
Route::get('yaedp/account/course/download-document/{id}/{file_name}',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'downloadCourseDocument'])
    ->name('yaedp.account.course.download-document');
Route::get('yaedp/account/faq',
    [App\Http\Controllers\Yaedp\YaedpAccountController::class, 'faq'])
    ->name('yaedp.account.faq');
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

// YAEDP Assessment Controller
Route::get('yaedp/account/assessments',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'index'])
    ->name('yaedp.account.assessments');
Route::get('yaedp/account/assessment/{id}/start',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'start'])
    ->name('yaedp.account.assessment.start');
Route::get('yaedp/account/assessment/{id}/questions',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'questions'])
    ->name('yaedp.account.assessment.questions');
Route::post('yaedp/account/assessment/{id}/submit',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'submitAssessment'])
    ->name('yaedp.account.assessment.submit');
Route::get('yaedp/account/assessment/certificate',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'certificate'])
    ->name('yaedp.account.assessment.certificate');
Route::get('yaedp/account/assessment/certificate',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'certificate'])
    ->name('yaedp.account.assessment.certificate');
Route::get('yaedp/account/assessment/certificate/download',
    [App\Http\Controllers\Yaedp\YaedpAssessmentController::class, 'downloadCertificate'])
    ->name('yaedp.account.assessment.certificate.download');

//Github Deployment
Route::post('github/deploy', [GithubDeploymentController::class, 'deploy']);
