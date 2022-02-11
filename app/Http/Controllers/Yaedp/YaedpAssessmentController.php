<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningAssessment;
use App\Models\Learning\LearningAssignmentAnswer;
use App\Models\Learning\LearningAssignmentQuestion;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function start($id){

        $getModules = new LearningModule();
        $data['module'] = $getModules->findOrFail($id);
        $data['modules'] = $getModules->where('learning_category_id', $this->yaedpId())->get();

        return view('yaedp.account.assessments.start', $data);
    }

    public function questions($id){

        $data['questions'] = LearningAssignmentQuestion::where('learning_module_id', $id)->get();
        $getModules = new LearningModule();
        $data['module'] = $getModules->findOrFail($id);
        $data['modules'] = $getModules->where('learning_category_id', $this->yaedpId())->get();

        return view('yaedp.account.assessments.questions', $data);
    }

    public function submitAssessment(Request $request, $id){

        $rules = array(
            'answers.*.answer' => 'required',
            'answers.*.question_id' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        $module = LearningModule::findOrFail($id);

        $assessmentAnswers = new learningAssignmentAnswer();
        if(count($request['answers']) > 0){
            foreach ($request['answers'] as $key => $value){
                $assessmentAnswers->create([
                    'user_id' => Auth::user()->id,
                    'learning_module_id' => $module->id,
                    'learning_category_id' => $module->learning_category_id,
                    'learning_assignment_question_id' => $value['question_id'],
                    'answer' => $value['answer'],
                    'passed' => $value['answer'] == $value['correct_answer'] ? 1 : 0
                ]);
            }
        }

        // count questions for this model
        $countAssessmentQuestions = LearningAssignmentQuestion::where([
            ['learning_module_id', $module->id],
            ['learning_category_id', $this->yaedpId()],
        ])->count();

        // count passed answers
        $countCorrectAnswers = $assessmentAnswers->where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $module->id],
            ['learning_category_id', $this->yaedpId()],
            ['passed', 1],
        ])->count();

        // Insert into assessment
        $learningAssessment = LearningAssessment::create([
            'user_id' => Auth::user()->id,
            'learning_module_id' => $module->id,
            'learning_category_id' => $this->yaedpId(),
            'score' => $countCorrectAnswers,
            'percent' => ($countCorrectAnswers / $countAssessmentQuestions) * 100,
        ]);

        return response()->json([
            'success'=>'success',
            'percent'=>$learningAssessment->percent.'%',
            'comment'=> $learningAssessment->percent > 80 ? 'Good Job' : 'Sorry, you did not make the cut off mark.',
        ]);

//        return redirect()->route('yaedp.account.assessment.score', $module->id);
    }
}
