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
use Illuminate\Support\Facades\Session;

/**
 * Class ExportDiagnosticApplicationService.
 */
class ExportDiagnosticApplicationService extends YaedpAccountService
{
    public static function question(){
        return new ExportDiagnosticQuestion();
    }

    public static function questionWithRelationships(){
        return self::question()->with('export_diagnostic_category', 'export_diagnostic_options');
    }

    public static function option(){
        return new ExportDiagnosticOption();
    }

    public static function optionWithRelationships(){
        return self::option()->with('export_diagnostic_category', 'export_diagnostic_question');
    }

    public static function answer(){
        return new ExportDiagnosticAnswer();
    }

    public static function answerWithRelationships(){
        return self::question()->with('yaedp_user', 'export_diagnostic_user', 'export_diagnostic_question');
    }

    public static function diagnosticUser(){
        return new ExportDiagnosticUser();
    }

    public static function diagnosticUserWithRelationships(){
        return self::question()->with('user', 'export_diagnostic_answers');
    }

    public static function hiddenQuestion(){
        return ExportDiagnosticHiddenQuestion::with('yaedp_user');
    }

    public static function authenticateUser($email){
        // where email exists, yedp_user is approved and learning assessment percent is above 70
        return self::yaedpUser()->where([
                    ['email', $email],
                    ['is_approved', 1],
                ])->leftjoin('learning_assessments', function($join){
            $join->on('yedp_users.id', '=', 'learning_assessments.user_id');
        })->where('learning_assessments.percent', '>=', 70)
            ->first();
    }

    public static function createLoginSessionWithEmail($user){

        Session::put('session_id', $user->id);
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

        $startedUser = self::diagnosticUser()->where('yaedp_user_id', $user->id)->first();
        if(!$startedUser){
            self::diagnosticUser()->create([
               'yaedp_user_id' => $user->id,
               'last_login' => Carbon::now()->format('Y-m-d h:i:s'),
            ]);
        }else{
            $startedUser->last_login = Carbon::now()->format('Y-m-d h:i:s');
            $startedUser->save();
        }
    }

    public static function getApplicationQuestion(){
        // get answered question id from answers
        $answeredQuestionsId = self::answer()
            ->select('export_diagnostic_question_id')
            ->where('export_diagnostic_user_id', Session::get('session_id'))
            ->get()->toArray();

        // Get stored hidden questions for this user
        $getHiddenQuestions = self::hiddenQuestion()
            ->where('yaedp_user_id', Session::get('session_id'))->first();
        $hiddenQuestions = '';
        if($getHiddenQuestions){
            $hiddenQuestions = explode(',', $getHiddenQuestions->questions);
        }

        // get single question using following commands
        return self::question()->orderBy('sort')
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

    public static function getProgressPercentage(){
        // get answered question id from answers
        $answeredQuestionsId = self::answer()
            ->select('export_diagnostic_question_id')
            ->where('export_diagnostic_user_id', Session::get('session_id'))
            ->get()->toArray();

        // Get stored hidden questions for this user
        $getHiddenQuestions = self::hiddenQuestion()
            ->where('yaedp_user_id', Session::get('session_id'))->first();
        $hiddenQuestions = '';
        if($getHiddenQuestions){
            $hiddenQuestions = explode(',', $getHiddenQuestions->questions);
        }

        // get single question using following commands
        $questions = self::question()->orderBy('sort')
            ->with('export_diagnostic_category', function ($query) {
                $query->orderBy('sort', 'asc');
            })->with('export_diagnostic_options', static function ($query){
                $query->orderBy('sort', 'asc');
            })->when($getHiddenQuestions, function ($query) use ($hiddenQuestions) {
                $query->whereNotIn('id', $hiddenQuestions);
            })->get();

        return round((count($answeredQuestionsId) / $questions->count()) * 100, 0);
    }

    public static function calculateUserScore(){
        $score = self::answer()->where('yaedp_user_id', Session::get('session_id'))->sum('points');
        $generalScore = 1560;
        // Add extra 50 points for females
        if(Session::get('session_gender') === 'female'){
            $generalScore += 50;
        }
        $percent = ($score / $generalScore) * 100;

        $status = self::diagnosticUser()->where('yaedp_user_id', Session::get('session_id'))->first();
        if($status->completed !== 1){
            $status->completed = 1;
            $status->percent = $percent;
            $status->score = $score;
            $status->save();
        }
        return $status;
    }

    public static function storeAnswerFromQuestionId($request, $id){

        $question = self::questionWithRelationships()->findOrFail($id);
        //If question type is radio, get option value and point from id
        // that was passed from the form
        if($question->type === 'radio') {
            $option = self::option()->findOrFail($request->option_id);
            self::answer()->create([
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
                $hasCondition = self::hiddenQuestion()
                    ->where('yaedp_user_id', Session::get('session_id'))
                    ->first();
                if(!$hasCondition){
                    self::hiddenQuestion()->create([
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
                $optionPoints += self::option()->findOrFail($value)->points;
                $selectedOptionsArray[] = self::option()->findOrFail($value)->option;
            }
            self::answer()->create([
                'yaedp_user_id' => Session::get('session_id'),
                'export_diagnostic_user_id' => Session::get('session_id'),
                'export_diagnostic_question_id' => $question->id,
                'export_diagnostic_category_id' => $question->export_diagnostic_category_id,
                'answer' => implode(", ", $selectedOptionsArray),
                'points' => $optionPoints,
            ]);
        }else{
            self::answer()->create([
                'yaedp_user_id' => Session::get('session_id'),
                'export_diagnostic_user_id' => Session::get('session_id'),
                'export_diagnostic_question_id' => $question->id,
                'export_diagnostic_category_id' => $question->export_diagnostic_category_id,
                'answer' => $request->answer,
            ]);
        }

    }

}
