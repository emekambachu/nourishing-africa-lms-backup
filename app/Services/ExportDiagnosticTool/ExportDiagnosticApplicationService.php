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

        // get all question Id's and store them in an array
        $questions = self::question()->select('id')->get()->toArray();

        // get single question using following commands
        return self::question()->with('export_diagnostic_category', 'export_diagnostic_options', 'export_diagnostic_answer')
            ->whereHas('export_diagnostic_category', function (Builder $query){
                $query->orderBy('sort');
            })->whereHas('export_diagnostic_options', function (Builder $query) {
                $query->orderBy('sort');
            })->whereHas('export_diagnostic_answer', function (Builder $query) use ($questions) {
                $query->where('export_diagnostic_user_id', '<>', Session::get('session_id'))
                    ->whereNotIn('export_diagnostic_question_id', $questions);
            })->orderBy('sort')->first();

    }
}
