<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningAssignmentQuestion;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningModule;
use Illuminate\Http\Request;

class YaedpAssessmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth:yaedp-users');
    }

    public function yaedpId(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public function index(){

        return view('yaedp.account.assessments.index');
    }

    public function show(){

    }

    public function start(){

        return view('yaedp.account.assessments.start');
    }

    public function questions($id){

        $data['questions'] = LearningAssignmentQuestion::where('learning_module_id', $id)->get();
        $data['module'] = LearningModule::findOrFail($id);

        return view('yaedp.account.assessments.start', $data);
    }
}
