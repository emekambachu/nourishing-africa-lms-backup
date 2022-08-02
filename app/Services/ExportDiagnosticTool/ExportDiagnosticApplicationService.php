<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\ExportDiagnosticTool\ExportDiagnosticAnswer;
use App\Models\ExportDiagnosticTool\ExportDiagnosticOption;
use App\Models\ExportDiagnosticTool\ExportDiagnosticQuestion;
use App\Models\ExportDiagnosticTool\ExportDiagnosticUser;
use App\Services\Learning\Account\YaedpAccountService;
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

        $startedUser = self::diagnosticUser()->where('yaedp_user_id', $user->id);
        if(!$startedUser){
            self::diagnosticUser()->create([
               'yaedp_user_id' => $user->id,
            ]);
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
        $option = '';
        if($question->type === 'radio'){
            $option = self::option()->findOrFail($request->option_id);
        }
        self::answer()->create([
           'yaedp_user_id' => Session::get('session_id'),
           'export_diagnostic_user_id' => Session::get('session_id'),
           'export_diagnostic_question_id' => $question->id,
           'export_diagnostic_category_id' => $question->export_diagnostic_category_id,
           'answer' => $option->option,
           'points' => $option->points,
        ]);
    }

}
