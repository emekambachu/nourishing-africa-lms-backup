<?php

namespace App\Http\Controllers\ExportDiagnosticTool;

use App\Http\Controllers\Controller;
use App\Http\Requests\YaedpLoginRequest;
use App\Services\ExportDiagnosticTool\ExportDiagnosticApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiagnosticApplicationController extends Controller
{
    public function index(){
        return view('diagnostic-tool.application.index');
    }

    public function login(YaedpLoginRequest $request){
        try {
            ExportDiagnosticApplicationService::createLoginSessionWithEmail($request);
            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function instructions(){
        if(Session::has('session_email')){
            return view('diagnostic-tool.application.instructions');
        }
        Session::flash('logged_out', 'You have been logged out');
        return view('diagnostic-tool.application.index');
    }

    public function start(){
        if(Session::has('session_email')){
            return redirect()->route('yaedp.export-diagnostic.start');
        }
        Session::flash('logged_out', 'You have been logged out');
        return redirect()->route('yaedp.export-diagnostic.index');
    }

    public function logout(){

    }
}
