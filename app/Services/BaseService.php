<?php

namespace App\Services;

use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningCourse;
use App\Models\Learning\LearningCourseView;
use App\Models\Learning\LearningLoginSession;
use App\Models\Learning\LearningModule;
use App\Models\Learning\LearningModuleView;
use App\Models\State;
use App\Models\YaedpUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class BaseService.
 */
class BaseService
{
    public static function yaedpId(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public static function yaedpUser(){
        return new YaedpUser();
    }

    public static function yaedpUserWithRelationships(){
        return YaedpUser::with('learning_assessment', 'learning_module_assessments');
    }

    public static function getModules(){
        return new LearningModule();
    }

    public static function getCategoryModules(){
        return self::getModules()->with('learningCourses')
            ->has('learningCourses')
            ->where('learning_category_id', self::yaedpId());
    }

    public static function findModuleById($id){
        return self::getModules()->where([
            ['learning_category_id', self::yaedpId()],
            ['id', $id]
        ])->first();
    }

    public static function getModulesWithRelationship(){
        return self::getModules()->with('learningCourses', 'learningCourseViews')
            ->has('learningCourses')
            ->where('learning_category_id', self::yaedpId());
    }

    public static function getModuleViews(){
        return LearningModuleView::where('learning_category_id', self::yaedpId());
    }

    public static function getCourses(){
        return new LearningCourse();
    }

    public static function getCourseViews(){
        return LearningCourseView::where('learning_category_id', self::yaedpId());
    }

    public static function getCategoryCourses(){
        return self::getCourses()->where('learning_category_id', self::yaedpId());
    }

    public static function getCoursesWithRelationship(){
        return self::getCourses()
            ->with('learningModule', 'learning_course_resources')
            ->where('learning_category_id', self::yaedpId());
    }

    public static function learningLoginSession(){
        return new LearningLoginSession();
    }

    public static function learningLoginSessionWithRelationships(){
        return self::learningLoginSession()->with('yaedp_user', 'yaedpUser');
    }

    public static function nigerianStates(){
        return State::orderBy('name')->get();
    }

    public static function getIp(Request $request){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return $request->ip(); // it will return server ip when no client ip found
    }


}
