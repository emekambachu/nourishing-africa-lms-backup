<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\ExportDiagnosticTool\ExportDiagnosticAnswer;
use App\Models\ExportDiagnosticTool\ExportDiagnosticHiddenQuestion;
use App\Models\ExportDiagnosticTool\ExportDiagnosticOption;
use App\Models\ExportDiagnosticTool\ExportDiagnosticQuestion;
use App\Models\ExportDiagnosticTool\ExportDiagnosticUser;
use App\Services\Learning\Account\YaedpAccountService;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

/**
 * Class ExportDiagnosticApplicationService.
 */
class ExportDiagnosticApplicationService extends YaedpAccountService
{
    public function question(){
        return new ExportDiagnosticQuestion();
    }

    public function questionWithRelationships(){
        return $this->question()->with('export_diagnostic_category', 'export_diagnostic_options');
    }

    public function option(){
        return new ExportDiagnosticOption();
    }

    public function optionWithRelationships(){
        return $this->option()->with('export_diagnostic_category', 'export_diagnostic_question');
    }

    public function answer(){
        return new ExportDiagnosticAnswer();
    }

    public function answerWithRelationships(){
        return $this->question()->with('yaedp_user', 'export_diagnostic_user', 'export_diagnostic_question');
    }

    public function diagnosticUser(){
        return new ExportDiagnosticUser();
    }

    public function diagnosticUserWithRelationships(){
        return $this->question()->with('user', 'export_diagnostic_answers');
    }

    public function hiddenQuestion(){
        return ExportDiagnosticHiddenQuestion::with('yaedp_user');
    }

    public function authenticateUser($request): \Illuminate\Http\JsonResponse
    {
        // where email exists, yedp_user is approved and learning assessment percent is above 70
        $user = self::yaedpUserWithRelationships()
            ->has('learning_assessment')
            ->leftJoin(
                'learning_assessments',
                'yedp_users.id', '=', 'learning_assessments.user_id'
            )->select(
                'yedp_users.*',
                'yedp_users.id AS yaedp_users_id',
                'yedp_users.is_approved AS yaedp_users_approved',
                'learning_assessments.*',
                'learning_assessments.id AS learning_assessments_id',
            )->where(function($query) use ($request){
                $query->where('yedp_users.email', $request->email)
                    ->where('yedp_users.is_approved', 1)
                    ->where('learning_assessments.percent', '>', 69);
//                    ->where('learning_assessments.created_at', '<', '2022-08-24 00:00:01');
            })->first();

        // verify user and check password
        if($user){
            if(Hash::check($request->password, $user->password)){
                // if successful create login session with email
                $response = $this->createLoginSessionWithEmail($user);
            }else{
                $response = response()->json([
                    'success' => false,
                    'errors' => [
                        'password'=>'Incorrect password'
                    ]
                ]);
            }

        }else{
            $response = response()->json([
                'success' => false,
                'errors' => [
                    'unauthorized'=>'Unauthorized user'
                ]
            ]);
        }

        return $response;
    }

    public function createLoginSessionWithEmail($user){

        Session::put('session_id', $user->yaedp_users_id);
        Session::put('session_email', $user->email);
        Session::put('session_name', $user->first_name.' '.$user->surname);
        Session::put('session_mobile', $user->mobile);
        Session::put('session_dob', $user->dob);
        Session::put('session_gender', $user->gender);
        if($user->stateOrigin){
            Session::put('session_state_origin', $user->stateOrigin->name);
        }
        if($user->stateResidence){
            Session::put('session_state_residence', $user->stateResidence->name);
        }

        Session::put('session_education', $user->education_level);
        Session::put('session_location', $user->location);
        Session::put('session_business', $user->business);
        Session::put('session_legal', $user->company_legal);
        Session::put('session_company_type', $user->company_type);
        Session::put('session_value_chain', $user->value_chain);
        Session::put('session_focus_area', $user->focus_area);

        $dateNow = Carbon::now()->format('Y-m-d h:i:s');
        // Check if diagnostic user account has been created
        // If created, update last login, else create new with last login

        $startedUser = $this->diagnosticUser()->where('yaedp_user_id', Session::get('session_id'))->first();
        if(!$startedUser){
            $this->diagnosticUser()->create([
               'yaedp_user_id' => Session::get('session_id'),
               'last_login' => $dateNow,
            ]);
        }
        $startedUser->last_login = $dateNow;
        $startedUser->save();

        return response()->json([
            'success' => true,
            'message' => 'Logged in'
        ]);
    }

    public function getApplicationQuestion(){
        // get answered question id from answers
        $answeredQuestionsId = $this->answer()
            ->select('export_diagnostic_question_id')
            ->where('export_diagnostic_user_id', Session::get('session_id'))
            ->get()->toArray();

        // Get stored hidden questions for this user
        $getHiddenQuestions = $this->hiddenQuestion()
            ->where('yaedp_user_id', Session::get('session_id'))->first();
        $hiddenQuestions = '';
        if($getHiddenQuestions){
            $hiddenQuestions = explode(',', $getHiddenQuestions->questions);
        }

        // get single question using following commands
        return $this->question()->orderBy('sort')
            ->with('export_diagnostic_category', function ($query) {
                $query->orderBy('sort', 'asc');
            })->with('export_diagnostic_options', static function ($query){
                $query->orderBy('sort', 'asc');
            })->when(count($answeredQuestionsId) > 0, function ($query) use ($answeredQuestionsId) {
                $query->whereNotIn('id', $answeredQuestionsId);
            })->when($getHiddenQuestions, function ($query) use ($hiddenQuestions) {
                $query->whereNotIn('id', $hiddenQuestions);
            })->first();
    }

    public function getProgressPercentage(){
        // get answered question id from answers
        $answeredQuestionsId = $this->answer()
            ->select('export_diagnostic_question_id')
            ->where('export_diagnostic_user_id', Session::get('session_id'))
            ->get()->toArray();

        // Get stored hidden questions for this user
        $getHiddenQuestions = $this->hiddenQuestion()
            ->where('yaedp_user_id', Session::get('session_id'))->first();
        $hiddenQuestions = '';
        if($getHiddenQuestions){
            $hiddenQuestions = explode(',', $getHiddenQuestions->questions);
        }

        // get single question using following commands
        $questions = $this->question()->orderBy('sort')
            ->with('export_diagnostic_category', function ($query) {
                $query->orderBy('sort', 'asc');
            })->with('export_diagnostic_options', static function ($query){
                $query->orderBy('sort', 'asc');
            })->when($getHiddenQuestions, function ($query) use ($hiddenQuestions) {
                $query->whereNotIn('id', $hiddenQuestions);
            })->get();

        return round((count($answeredQuestionsId) / $questions->count()) * 100, 0);
    }

    public function storeAnswerFromQuestionId($request, $id){

        $question = $this->questionWithRelationships()->findOrFail($id);
        //If question type is radio, get option value and point from id
        // that was passed from the form
        if($question->type === 'radio') {
            $option = $this->option()->findOrFail($request->option_id);
            $this->answer()->create([
                'yaedp_user_id' => Session::get('session_id'),
                'export_diagnostic_user_id' => Session::get('session_id'),
                'export_diagnostic_question_id' => $question->id,
                'export_diagnostic_category_id' => $question->export_diagnostic_category_id,
                'answer' => $option->option,
                'points' => $option->points,
            ]);

            // if question is conditional
            // check if user has other conditional questions
            // if they don't create a new hidden question for the user
            // else concatinate the new hidden questions to the user
            if($question->conditional === 1){
                $hasCondition = $this->hiddenQuestion()
                    ->where('yaedp_user_id', Session::get('session_id'))
                    ->first();
                if(!$hasCondition){
                    $this->hiddenQuestion()->create([
                       'yaedp_user_id' => Session::get('session_id'),
                       'export_diagnostic_user_id' => Session::get('session_id'),
                       'questions' => $option->hide_questions,
                    ]);
                }else{
                    $hasCondition->questions .= ',' . $option->hide_questions;
                    $hasCondition->save();
                }
            }

        // if question type is a checkbox, get array of ids from form
        // Iterate them and get their points and option from options table
        // add options to array and store as a string in answers table
        }elseif($question->type === 'checkbox'){
            $optionPoints = 0;
            $selectedOptionsArray = [];
            foreach($request->option_ids as $key=>$value){
                $optionPoints += $this->option()->findOrFail($value)->points;
                $selectedOptionsArray[] = $this->option()->findOrFail($value)->option;
            }
            $this->answer()->create([
                'yaedp_user_id' => Session::get('session_id'),
                'export_diagnostic_user_id' => Session::get('session_id'),
                'export_diagnostic_question_id' => $question->id,
                'export_diagnostic_category_id' => $question->export_diagnostic_category_id,
                'answer' => implode(", ", $selectedOptionsArray),
                'points' => $optionPoints,
            ]);
        }else{
            $this->answer()->create([
                'yaedp_user_id' => Session::get('session_id'),
                'export_diagnostic_user_id' => Session::get('session_id'),
                'export_diagnostic_question_id' => $question->id,
                'export_diagnostic_category_id' => $question->export_diagnostic_category_id,
                'answer' => $request->answer,
            ]);
        }

    }

    public function calculateUserScore(){
        $score = $this->answer()->where('yaedp_user_id', Session::get('session_id'))->sum('points');
        $generalScore = 1560;
        // Add extra 50 points for females
        if(Session::get('session_gender') === 'female'){
            $score += 50;
        }
        $percent = ($score / $generalScore) * 100;

        $user = $this->diagnosticUser()->where('yaedp_user_id', Session::get('session_id'))->first();
        if($user->completed !== 1){
            $user->completed = 1;
            $user->percent = $percent;
            $user->score = $score;
            $user->save();

            // Send email
            $this->sendCompletionEmail($user);
        }
        return $user;
    }

    public function sendCompletionEmail($user): void
    {
        $mail = [
            'name' => $user->user->name,
            'email' => $user->user->email,
        ];

        Mail::send('emails.export-diagnostic.completion', $mail, static function ($message) use ($mail) {
            $message->from('yaedp@nourishingafrica.com', 'YAEDP|Export-readiness Diagnostic Tool');
            $message->to($mail['email'], $mail['name']);
            $message->replyTo('yaedp@nourishingafrica.com', 'YAEDP|Export-readiness Diagnostic Tool');
            $message->subject('Completed|Export-readiness Diagnostic Tool');
        });
    }

}
