<?php

namespace App\Services\Learning\Account;

use Illuminate\Support\Facades\Auth;

/**
 * Class YaedpAssessmentService.
 */
class YaedpAssessmentService extends YaedpAccountService
{
    public static function getModuleAssessmentsWithLimit($num = null){
        return self::getModuleViews()->where([
            ['user_id', Auth::user()->id],
            ['status', 1],
            ['learning_category_id', self::yaedpId()]
        ])->latest()->limit($num);
    }
}
