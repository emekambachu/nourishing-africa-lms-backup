<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Models\Learning\LearningAssessment;
use App\Models\Learning\LearningAssignmentAnswer;
use App\Models\Learning\LearningAssignmentQuestion;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
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

    private function passedAssessment($category){
        return  LearningAssessment::where([
            ['user_id', Auth::user()->id],
            ['learning_category_id', $category],
            ['percent', '>=', 80],
        ])->first();
    }

    public function index(){

        $data['assessmentPassed'] = $this->passedAssessment($this->yaedpId());
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

        $data['questions'] = LearningAssignmentQuestion::where('learning_module_id', $id)->get();

        $getModules = new LearningModule();
        $data['module'] = $getModules->findOrFail($id);
        $data['modules'] = $getModules->where('learning_category_id', $this->yaedpId())->get();

        $moduleAssessment = new LearningModuleView();
        $data['exhaustedRetakes'] = $moduleAssessment->where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $data['module']->id],
            ['retake', 3],
        ])->first();
        $data['modulePassed'] = $moduleAssessment->where([
            ['user_id', Auth::user()->id],
            ['learning_module_id', $data['module']->id],
            ['passed', 1],
        ])->first();

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
            $moduleAssessment->score = $countCorrectAnswers > $moduleAssessment->score ? $countCorrectAnswers : $moduleAssessment->score;
            $moduleAssessment->percent = round($percentageScore, 2) > $moduleAssessment->percent ? round($percentageScore, 2) : $moduleAssessment->percent;
            $moduleAssessment->passed = (round($percentageScore, 2) || $moduleAssessment->percent) > 65  ? 1 : 0;
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


        // Check if this is the last module and include overall assessment
        $lastModule = $getModules->where('learning_category_id', $this->yaedpId())
            ->latest()->first();
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
        if($lastModule->id === $module->id){
            $learningAssessment = learningAssessment($accumulatedScore, $accumulatedPercentage, $this->yaedpId());
        }

        return response()->json([
            'success' => $countCorrectAnswers.' - '.$countAssessmentQuestions,
            'percent' => round($percentageScore, 2).'%',
            'comment' => $percentageScore > 65 ? "Passed, Good job." : "Sorry, you did not make the cut off mark. you have ". (3 - $moduleAssessment->retake) . " retake(s).",
            'retakes' => $moduleAssessment->retake,
            'result' => $percentageScore > 65 ? 'passed' : 'failed',
            'module_id' => $module->id,
            'accumulated' => $learningAssessment !=='',
            'accumulated_passed' => $learningAssessment !=='' ? $learningAssessment->passed : 0,
        ]);

    }

    public function certificate(){

        $data['assessmentPassed'] = $this->passedAssessment($this->yaedpId());
        $data['certificateDate'] = Carbon::now()->format('jS \\of F Y');

        return view('yaedp.account.assessments.certificate', $data);
    }

    public function DownloadCertificate(){

//        $fontPath = 'fonts/Nunito-Light.ttf';
//        $fontType = pathinfo($fontPath, PATHINFO_EXTENSION);
//        $fontData = file_get_contents($fontPath);
//        $base64Font = 'data:image/' . $fontType . ';base64,' . base64_encode($fontData);

        $path = 'images/icons/certificate_yaedp_700.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64_image = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $data = [
            'name' => Auth::user()->first_name.' '.Auth::user()->surname,
            'current_date' => Carbon::now()->format('jS \\of F Y'),
            'certificate_image' => $base64_image,
            ];

        return PDF::loadView('yaedp_certificate_pdf', compact('data'))
            ->download($data['name'].'_'.time().'.pdf');
    }
}
