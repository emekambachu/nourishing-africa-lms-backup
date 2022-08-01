<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\ExportDiagnosticTool\ExportDiagnosticCategory;

/**
 * Class ExportDiagnosticCategoryService.
 */
class ExportDiagnosticCategoryService
{
    public static function category(){
        return new ExportDiagnosticCategory();
    }

    public static function categoryWithRelationships(){
        return self::category()->with('export_diagnostic_questions');
    }

    public static function storeCategory($request){
        // Check if inputs exist
        // Iterate all inputs and add them individually
        if(!empty($request['inputs'])){
            foreach ($request['inputs'] as $input) {
                self::category()->create([
                    'name' => $input['name'],
                    'sort' => $input['sort'],
                ]);
            }
        }
    }

    public static function updateCategory($request, $id){
        $category = self::category()->find($id);
        $input = $request->all();
        $category->update($input);
        return $category;
    }

    public static function deleteCategory($id){
        $category = self::categoryWithRelationships()->find($id);
        $category->delete();
    }

}
