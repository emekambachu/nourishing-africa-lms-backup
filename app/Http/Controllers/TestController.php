<?php

namespace App\Http\Controllers;

use App\Models\ExportDiagnosticTool\ExportDiagnosticUser;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function archiveIneligibleUsers(){

        return ExportDiagnosticUser::leftJoin(
                'learning_assessments',
                'export_diagnostic_users.yaedp_user_id', '=', 'learning_assessments.user_id'
            )->leftJoin(
            'yedp_users',
            'yedp_users.id', '=', 'export_diagnostic_users.yaedp_user_id'
            )->select(
                'yedp_users.*',
                'yedp_users.id AS yaedp_users_id',
                'learning_assessments.*',
                'learning_assessments.id AS learning_assessments_id',
                'export_diagnostic_users.*',
                'export_diagnostic_users.id AS export_diagnostic_users_id',
            )->where(function($query){
                $query->where('yedp_users.is_approved', 0)
                    ->orWhere('learning_assessments.percent', '<', 70)
                    // where yaedp user does not have a learning_assessments table
                    ->orWhere('learning_assessments.id', null);
            })->update([
                'export_diagnostic_users.status' => 1
            ]);

    }
}
