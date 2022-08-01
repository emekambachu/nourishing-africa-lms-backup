<?php

namespace App\Http\Controllers\ExportDiagnosticTool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiagnosticApplicationController extends Controller
{
    public function index(){
        return view('diagnostic-tool.application.index');
    }
}
