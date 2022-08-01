<?php

namespace App\Services\ExportDiagnosticTool;

use App\Services\Learning\Account\YaedpAccountService;
use Illuminate\Support\Facades\Session;

/**
 * Class ExportDiagnosticApplicationService.
 */
class ExportDiagnosticApplicationService extends YaedpAccountService
{
    public static function createLoginSessionWithEmail($request){
        $user = self::yaedpUser()->where('email', $request->email)->first();
        Session::put('session_email', $user->email);
        Session::put('session_name', $user->surname.' '.$user->first_name);
    }
}
