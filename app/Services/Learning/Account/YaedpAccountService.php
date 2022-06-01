<?php

namespace App\Services\Learning\Account;

use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningCourse;
use App\Models\Learning\LearningCourseView;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
use Illuminate\Support\Facades\Auth;

/**
 * Class YaedpAccountService.
 */
class YaedpAccountService
{
    public static function yaedpId(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public static function getModules(){
        return new LearningModule();
    }

    public static function getCourses(){
        return new LearningCourse();
    }

    public static function getCourseViews(){
       return LearningCourseView::where('learning_category_id', self::yaedpId());
    }

    public static function getModuleViews(){
        return LearningModuleView::where('learning_category_id', self::yaedpId());
    }

    public static function getCategoryModules(){
        return self::getModules()->with('learningCourses', 'learningCourseViews')
            ->has('learningCourses')
            ->where('learning_category_id', self::yaedpId());
    }

    public static function getCategoryCourses(){
        return self::getCourses()->where('learning_category_id', self::yaedpId());
    }

    public static function getCompletedCourses(){
        return self::getCourseViews()
            ->with('learningCourse', 'learningModule')->where([
                ['user_id', Auth::user()->id],
                ['status', 1],
            ]);
    }

    public static function getStartedCoursesWithLimit($num = null){
        return self::getCourseViews()
            ->with('learningCourse')->has('learningCourse')->where([
                ['user_id', Auth::user()->id],
            ])->orderBy('id', 'desc')->limit($num)->get();
    }

    public static function getModuleAssessmentsWithLimit($num = null){
         return self::getModuleViews()->where([
            ['user_id', Auth::user()->id],
            ['status', 1],
            ['learning_category_id', self::yaedpId()]
        ])->latest()->limit($num)->get();
    }

    public static function getModuleProgress(){
        $moduleProgress = []; // create empty array
        // Loop through modules
        foreach(self::getCategoryModules() as $mKey => $mValue){
            // loop through completed courses and get the number
            // of courses that has been completed for each module
            $moduleProgress[$mKey]['count'] = 0; // create count key in loop
            if(count(self::getCompletedCourses()) > 0){
                foreach(self::getCompletedCourses() as $cKey => $cValue){
                    if($cValue->learning_module_id === $mValue->id){
                        $moduleProgress[$mKey]['count']++;
                    }
                }
                // After looping the completedCourseViews
                // Assign array names to the percentage, id and name
                // Assign countCourseCompleted variable back to 0
                $moduleProgress[$mKey]['percent'] = ($moduleProgress[$mKey]['count'] / $mValue->learningCourses->count()) * 100;
                $moduleProgress[$mKey]['moduleId'] = $mValue->id;
                $moduleProgress[$mKey]['moduleTitle'] = $mValue->title;
            }
        }

        return $moduleProgress;
    }


}
