<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\ExportDiagnosticTool\ExportDiagnosticOption;
use App\Models\ExportDiagnosticTool\ExportDiagnosticQuestion;

/**
 * Class ExportDiagnosticToolQuestionService.
 */
class ExportDiagnosticQuestionService
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

    public static function questionsFromCategoryId($id){
        return self::question()->with('export_diagnostic_category', 'export_diagnostic_options')
            ->where('export_diagnostic_category_id', $id);
    }

    public static function storeQuestion($request){
        // Check if inputs exist
        // Iterate all inputs and add them individually
        $inputs = $request->all();
        return self::question()->create($inputs);
    }

    public static function updateQuestion($request, $id){
        $question = self::question()->findOrFail($id);
        $input = $request->all();
        $question->update($input);
        return $question;
    }

    public static function deleteQuestion($id){
        $question = self::questionWithRelationships()->find($id);

        if(count($question->export_diagnostic_options) > 0){
            $question->export_diagnostic_options->each->delete();
        }
        $question->delete();
    }

    public static function storeOptionsWithQuestionId($request, $id){

        $categoryId = self::question()->where('id', $id)->first()->export_diagnostic_category_id;

        if(!empty($request['inputs'])){
            foreach ($request['inputs'] as $input) {
                self::option()->create([
                    'export_diagnostic_category_id' => $categoryId,
                    'export_diagnostic_question_id' => $id,
                    'option' => $input['option'],
                    'sort' => $input['sort'],
                    'points' => $input['points'],
                ]);
            }
        }

    }

    public static function getOptionsFromQuestionId($id){
        return self::optionWithRelationships()->where('export_diagnostic_question_id', $id);
    }

    public static function deleteOption($id){
        return self::option()->findOrFail($id)->delete();
    }

}
