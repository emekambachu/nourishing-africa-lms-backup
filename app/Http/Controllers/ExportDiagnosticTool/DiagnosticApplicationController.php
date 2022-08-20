<?php

namespace App\Http\Controllers\ExportDiagnosticTool;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExportDiagnosticLoginRequest;
use App\Http\Requests\LearningLoginRequest;
use App\Services\ExportDiagnosticTool\ExportDiagnosticApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiagnosticApplicationController extends Controller
{
    public function index(){
        return view('diagnostic-tool.application.index');
    }

    public function login(ExportDiagnosticLoginRequest $request){
        try {
            // check if user is authenticated
            $authenticatedUser = ExportDiagnosticApplicationService::authenticateUser($request);
            if($authenticatedUser){
                // If authenticated, login and create session
                ExportDiagnosticApplicationService::createLoginSessionWithEmail($authenticatedUser);
                return response()->json([
                    'success' => true
                ]);
            }
            return response()->json([
                'success' => false,
                'errors' => [
                    'unauthorized'=>'Unauthorized user'
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function participantInformation(){
        if(Session::has('session_email')){
            return view('diagnostic-tool.application.participant-information');
        }
        Session::flash('logged_out', 'You have been logged out');
        return redirect()->route('yaedp.export-diagnostic.index');
    }

    public function instructions(){
        if(Session::has('session_email')){
            return view('diagnostic-tool.application.instructions');
        }
        Session::flash('logged_out', 'You have been logged out');
        return redirect()->route('yaedp.export-diagnostic.index');
    }

    public function start(){
        if(Session::has('session_email')){
            return view('diagnostic-tool.application.start');
        }
        Session::flash('logged_out', 'You have been logged out');
        return redirect()->route('yaedp.export-diagnostic.index');
    }

    public function getQuestion(){
        try {
            $status = '';
            $question = ExportDiagnosticApplicationService::getApplicationQuestion();
            // If no more questions, get calculated scores
            if(!$question){
                $status = ExportDiagnosticApplicationService::calculateUserScore();
            }

            return response()->json([
                'success' => true,
                'question' => $question,
                'status' => $status
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function storeAnswer(Request $request, $id){
        try {
            ExportDiagnosticApplicationService::storeAnswerFromQuestionId($request, $id);
            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function applicationProgress(){
        try {
            $progressPercent = ExportDiagnosticApplicationService::getprogressPercentage();
            return response()->json([
                'success' => true,
                'progress' => $progressPercent
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(){
        if(Session::has('session_email')){
            Session::flush();
        }
        Session::flash('logged_out', 'You have been logged out');
        return redirect()->route('yaedp.export-diagnostic.index');
    }
}
