<?php

namespace App\Http\Controllers\ExportDiagnosticTool;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExportDiagnosticTool\ExportDiagnosticLoginRequest;
use App\Http\Requests\ExportDiagnosticTool\SubmitAnswerRequest;
use App\Services\ExportDiagnosticTool\ExportDiagnosticApplicationService;
use Illuminate\Support\Facades\Session;

class DiagnosticApplicationController extends Controller
{
    /**
     * @var ExportDiagnosticApplicationService
     */
    private $application;

    public function __construct(ExportDiagnosticApplicationService $application){
        $this->application = $application;
    }

    public function index(){
        return view('diagnostic-tool.application.index');
    }

    public function login(ExportDiagnosticLoginRequest $request)
    {
        try {
            // Authenticate user with email, password, yedp_users table and learning_assessments table
            return $this->application->authenticateUser($request);

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
            $question = $this->application->getApplicationQuestion();
            // If no more questions, get calculated scores
            if(!$question){
                $status = $this->application->calculateUserScore();
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

    public function storeAnswer(SubmitAnswerRequest $request, $id){
        try {
            $this->application->storeAnswerFromQuestionId($request, $id);
            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function applicationProgress(){
        try {
            $progressPercent = $this->application->getprogressPercentage();
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
