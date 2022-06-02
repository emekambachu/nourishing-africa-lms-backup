<?php

namespace App\Services\Learning\Account;

use App\Models\Learning\LearningDiscussion;

/**
 * Class YaedpDiscussionService.
 */
class YaedpDiscussionService extends YaedpAccountService
{
    public static function learningDiscussion(){
        return LearningDiscussion::where('learning_category_id', self::yaedpId());
    }

    public static function getCourseDiscussions($courseId, $moduleId){
        return self::learningDiscussion()->where([
            ['learning_course_id', $courseId],
            ['learning_module_id', $moduleId],
            ['status', 1],
        ]);
    }
}
