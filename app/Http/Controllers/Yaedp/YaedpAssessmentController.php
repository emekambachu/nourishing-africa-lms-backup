<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningAssessment;
use App\Models\Learning\LearningAssignmentAnswer;
use App\Models\Learning\LearningAssignmentQuestion;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
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

        $percentageScore = ($countCorrectAnswers / $countAssessmentQuestions) * 100;

        $getAssessment = new LearningAssessment();

        // Check if user as been assessed
        $moduleAssessment = $getAssessment->where([
            ['user_id', Auth::user()->id],
            ['type', 'module'],
            ['learning_module_id', $module->id],
            ['learning_category_id', $this->yaedpId()],
        ])->first();

        // if user has been assessed, if they have taken 3 retakes
        // take no action, else update their new scores
        if($moduleAssessment){
            if($moduleAssessment->retake === 2){
                return response()->json([
                    'no_retakes'=>'No retakes',
                    'percent'=> $moduleAssessment->percent.'%',
                    'comment'=> "You've run out of retakes, your score can't be updated. Try to do better in other modules which can boost your score.",
                ]);
            }

            $moduleAssessment->score = $countCorrectAnswers;
            $moduleAssessment->percent = $percentageScore;
            $moduleAssessment->passed = $percentageScore > 65 ? 1 : 0;
            $moduleAssessment->retake = $percentageScore < 65 ? $moduleAssessment->retake + 1 : $moduleAssessment->retake;
            $moduleAssessment->save();
        }else{
            // Insert into assessment if user has not been assessed
            $moduleAssessment = $getAssessment->create([
                'user_id' => Auth::user()->id,
                'type' => 'module',
                'learning_module_id' => $module->id,
                'learning_category_id' => $this->yaedpId(),
                'score' => $countCorrectAnswers,
                'percent' => $percentageScore,
                'passed' => $percentageScore > 65 ? 1 : 0,
                'retake' => $percentageScore < 65 ? 1 : 0,
            ]);
        }

        // Unlock next module when current module assessment has been passed
        if($moduleAssessment->percent > 65){

            $moduleView = new LearningModuleView();
            $moduleViewed = $moduleView->where([
                ['user_id', Auth::user()->id],
                ['learning_module_id', $module->id],
                ['learning_category_id', $this->yaedpId()],
            ])->first();

            if($moduleViewed){
                $moduleViewed->status = 1;
                $moduleViewed->save();
            }else{
                $moduleView->create([
                    'user_id' => Auth::user()->id,
                    'learning_module_id' => $module->id,
                    'learning_category_id' => $this->yaedpId(),
                    'status' => 1
                ]);
            }
        }

        return response()->json([
            'success'=>'success',
            'percent'=> $moduleAssessment->percent.'%',
            'comment'=> $moduleAssessment->percent > 65 ? 'Good Job' : 'Sorry, you did not make the cut off mark.',
            'result'=> $moduleAssessment->percent > 65 ? 'passed' : 'failed',
            'module_id'=> $module->id,
        ]);

    }
}
