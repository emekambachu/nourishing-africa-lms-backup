<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\ExportDiagnosticTool\ExportDiagnosticAnswer;
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

    public static function createLoginSessionWithEmail($request){
        $user = self::yaedpUser()->where('email', $request->email)->first();
        Session::put('session_id', $user->id);
        Session::put('session_email', $user->email);
        Session::put('session_name', $user->surname.' '.$user->first_name);

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

        // get question Id's from answers
        $questionIdFromAnswers = self::answer()
            ->select('export_diagnostic_question_id')
            ->where('export_diagnostic_user_id', Session::get('session_id'))
            ->get()->toArray();
        $answered = self::answer()
            ->where('export_diagnostic_user_id', Session::get('session_id'))
            ->count();

        // get single question using following commands
        return self::question()->orderBy('sort')
            ->with('export_diagnostic_category', function ($query){
                $query->orderBy('sort');
            })->with('export_diagnostic_options', function ($query) {
                $query->orderBy('sort');
            })->when($answered > 0, function ($query) use ($questionIdFromAnswers) {
                $query->whereNotIn('id', $questionIdFromAnswers);
            })->first();
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

    public static function getProgressPercentage(){
        // get all questions, divide them by the answered questions
        $questions = self::question()->count();
        $answered = self::answer()
            ->where('export_diagnostic_user_id', Session::get('session_id'))
            ->count();
        return ($answered / $questions) * 100;
    }

}
