<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningAssessment;
use App\Models\Learning\LearningAssignmentAnswer;
use App\Models\Learning\LearningAssignmentQuestion;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
use App\Services\Learning\Account\YaedpAccountService;
use App\Services\Learning\Account\YaedpAssessmentService;
use PDF;
use Carbon\Carbon;
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

    public function deleteModuleAnswers($moduleId){
        $moduleAnswers = LearningAssignmentAnswer::where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $moduleId],
        ])->get();

        if($moduleAnswers){
            $moduleAnswers->each->delete();
        }
    }

    private function completedAssessment($category){
        return  LearningAssessment::where([
            ['user_id', Auth::user()->id],
            ['learning_category_id', $category],
        ])->first();
    }

    public function index(){

        $data['completedAssessment'] = $this->completedAssessment($this->yaedpId());
        $data['moduleAssessments'] = LearningModuleView::where([
            ['user_id', Auth::user()->id],
            ['status', 1],
        ])->oldest()->get();

        return view('yaedp.account.assessments.index', $data);
    }

    public function start($id){
        $getModules = new LearningModule();
        $data['module'] = $getModules->findOrFail($id);
        $data['modules'] = $getModules->where('learning_category_id', $this->yaedpId())
            ->orderBy('created_at', 'asc')->get();

        return view('yaedp.account.assessments.start', $data);
    }

    public function questions($id){

        // get questions for this module
        $data['questions'] = LearningAssignmentQuestion::where('learning_module_id', $id)->get();

        $data['module'] = YaedpAccountService::findModuleById($id);
        $data['modules'] = YaedpAccountService::getCategoryModules();

        $data['exhaustedRetakes'] = YaedpAssessmentService::exhaustedRetakesByUser(Auth::user()->id, $id, 3);
        $data['modulePassed'] = YaedpAssessmentService::moduleAssessmentPassedByUser(Auth::user()->id, $id);

        return view('yaedp.account.assessments.questions', $data);
    }

    public function submitAssessment(Request $request, $id){

        // Delete previous answers before submission
        $this->deleteModuleAnswers($id);

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

        $getModules = new LearningModule();
        $module = $getModules->where('id', $id)->first();

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
        $getModuleAssessment = new LearningModuleView();

        // Check if user as been assessed on this module
        $moduleAssessment = $getModuleAssessment->where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $module->id],
            ['learning_category_id', $this->yaedpId()],
        ])->first();

        // if user has been assessed, if they have taken 3 retakes
        // take no action, else update their new scores
        if($moduleAssessment){
            if($moduleAssessment->retake === 3){
                return response()->json([
                    'no_retakes'=>'No retakes',
                    'percent'=> $moduleAssessment->percent.'%',
                    'comment'=> "You've run out of retakes, your score can't be updated. Try to do better in other modules which can boost your score.",
                ]);
            }
            $moduleAssessment->status = 1;
            $moduleAssessment->score = $countCorrectAnswers;
            $moduleAssessment->percent = round($percentageScore, 2);
            $moduleAssessment->passed = round($percentageScore, 2) > 65  ? 1 : 0;
            ++$moduleAssessment->retake;
            $moduleAssessment->save();
        }else{
            // Insert into assessment if user has not been assessed
            $moduleAssessment = $getModuleAssessment->create([
                'user_id' => Auth::user()->id,
                'learning_module_id' => $module->id,
                'learning_category_id' => $this->yaedpId(),
                'status' => 1,
                'score' => $countCorrectAnswers,
                'percent' => round($percentageScore, 2),
                'passed' => $percentageScore > 65 ? 1 : 0,
                'retake' => 1,
            ]);
        }

        // get completed modules
        $countAllModules = $getModules->count();
        $countCompletedModules = $getModuleAssessment->where([
            ['user_id', Auth::user()->id],
            ['learning_category_id', $this->yaedpId()],
            ['status', 1],
        ])->count();

        $accumulatedScore = $getModuleAssessment->where('user_id', Auth::user()->id)
            ->where('learning_category_id', $this->yaedpId())->sum('score');
        $countTotalAnswers = LearningAssignmentAnswer::where([
            ['learning_category_id', $this->yaedpId()],
            ['user_id', Auth::user()->id],
        ])->count();
        $accumulatedPercentage = ($accumulatedScore / $countTotalAnswers) * 100;

        // Function for cumulative assessment
        function learningAssessment($score, $percent, $category){

            $hasAssessment = LearningAssessment::where([
                ['user_id', Auth::user()->id],
                ['learning_category_id', $category],
            ])->first();

            if($hasAssessment){
                $hasAssessment->score = $score;
                $hasAssessment->percent = round($percent, 2);
                $hasAssessment->passed = $percent > 80 ? 1 : 0;
                $hasAssessment->save();
            }else{
                $hasAssessment = new LearningAssessment();
                $hasAssessment->user_id = Auth::user()->id;
                $hasAssessment->learning_category_id = $category;
                $hasAssessment->score = $score;
                $hasAssessment->percent = round($percent, 2);
                $hasAssessment->passed = $percent > 80 ? 1 : 0;
                $hasAssessment->save();
            }
            return $hasAssessment;
        }

        // if this is the final module in all modules proceed with cumulative assessment
        $learningAssessment = '';
        if($countAllModules === $countCompletedModules){
            $learningAssessment = learningAssessment($accumulatedScore, $accumulatedPercentage, $this->yaedpId());
        }

        function resultComment($percent, $retake){
            $comment = '';
            if($percent > 65 && $percent < 80) {
                $comment = "Good job, If you are confident in your ability to score a higher mark, you can retry the assessment. You have " . (3 - $retake) . " retake(s).";
            }else if($percent > 80){
                $comment = "Good job";
            }else{
                $comment = "Oops that didn’t work well, you can retry the assessment to get a better score. you have ". (3 - $retake) . " retake(s).";
            }
            return $comment;
        }

        function accumulatedComment($percent){
            $comment = '';
            if($percent > 80){
                $comment = "Congratulations!, you have passed the overall assessment, you can now download your certificate";
            }else{
                $comment = "Oops, you haven't reached the cut-off mark to. You can re-take some assessments to get a better score";
            }
            return $comment;
        }

        return response()->json([
            'success' => $countCorrectAnswers.' - '.$countAssessmentQuestions,
            'percent' => round($percentageScore, 2).'%',
            'comment' => resultComment($percentageScore, $moduleAssessment->retake),
            'retakes' => $moduleAssessment->retake,
            'result' => $percentageScore > 65 ? 'passed' : 'failed',
            'module_id' => $module->id,
            'accumulated' => $learningAssessment !=='',
            'accumulated_passed' => $learningAssessment !=='' ? $learningAssessment->passed : false,
            'accumulated_percent' => $learningAssessment !=='' ? $learningAssessment->percent : false,
            'accumulated_comment' => $learningAssessment !=='' ? accumulatedComment($learningAssessment->percent) : false,
        ]);

    }

    public function certificate(){
        $data['completedAssessment'] = $this->completedAssessment($this->yaedpId());
        $data['certificateDate'] = Carbon::now()->format('jS \\of F Y');

        return view('yaedp.account.assessments.certificate', $data);
    }

    public function DownloadCertificate(){

        $data = YaedpAssessmentService::generateCertificateForUser(Auth::user()->id, Auth::user()->first_name, Auth::user()->surname);

        return PDF::loadView('yaedp_certificate_pdf', compact('data'))
            ->download($data['name'].'_'.$data['certificate_id'].'.pdf');
    }
}
